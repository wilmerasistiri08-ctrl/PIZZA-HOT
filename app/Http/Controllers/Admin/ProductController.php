<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class ProductController extends Controller
{
    private const IMAGE_DISK = 'public';

    /*
    |--------------------------------------------------------------------------
    | LISTADO DE PRODUCTOS DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): ViewContract
    {
        $tenant = $this->currentTenant();

        $search = trim((string) $request->query('search', ''));
        $categoryId = $request->query('category_id');
        $status = (string) $request->query('status', '');

        $orderColumn = $this->hasColumn('products', 'updated_at')
            ? 'updated_at'
            : ($this->hasColumn('products', 'created_at') ? 'created_at' : 'id');

        $productsQuery = Product::query()
            ->where('tenant_id', $tenant->id)
            ->with([
                'tenant',
                'category',
            ]);

        /*
        |--------------------------------------------------------------------------
        | BÚSQUEDA
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {
            $productsQuery->where(function (EloquentBuilder $query) use ($search): void {
                $query->where('name', 'like', "%{$search}%");

                if ($this->hasColumn('products', 'description')) {
                    $query->orWhere('description', 'like', "%{$search}%");
                }

                if ($this->hasColumn('products', 'slug')) {
                    $query->orWhere('slug', 'like', "%{$search}%");
                }

                $query->orWhereHas('category', function (EloquentBuilder $categoryQuery) use ($search): void {
                    $categoryQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTRO POR CATEGORÍA
        |--------------------------------------------------------------------------
        */

        if (!blank($categoryId) && $categoryId !== 'all' && is_numeric($categoryId)) {
            $productsQuery->where('category_id', (int) $categoryId);
        }

        /*
        |--------------------------------------------------------------------------
        | FILTRO POR ESTADO
        |--------------------------------------------------------------------------
        */

        if ($status !== '') {
            match ($status) {
                'available' => $this->hasColumn('products', 'is_available')
                    ? $productsQuery->where('is_available', true)
                    : null,

                'unavailable' => $this->hasColumn('products', 'is_available')
                    ? $productsQuery->where('is_available', false)
                    : null,

                'featured' => $this->hasColumn('products', 'featured')
                    ? $productsQuery->where('featured', true)
                    : null,

                'out_stock' => $this->hasColumn('products', 'stock')
                    ? $productsQuery->where('stock', '<=', 0)
                    : null,

                default => null,
            };
        }

        $products = $productsQuery
            ->orderByDesc($orderColumn)
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        $categories = $this->tenantCategories($tenant)->get();

        $statsBaseQuery = Product::query()
            ->where('tenant_id', $tenant->id);

        $stats = [
            'total' => (clone $statsBaseQuery)->count(),

            'available' => $this->hasColumn('products', 'is_available')
                ? (clone $statsBaseQuery)->where('is_available', true)->count()
                : 0,

            'unavailable' => $this->hasColumn('products', 'is_available')
                ? (clone $statsBaseQuery)->where('is_available', false)->count()
                : 0,

            'featured' => $this->hasColumn('products', 'featured')
                ? (clone $statsBaseQuery)->where('featured', true)->count()
                : 0,
        ];

        return view('admin.products.index', compact(
            'tenant',
            'products',
            'categories',
            'stats'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO CREAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function create(Request $request): ViewContract
    {
        $tenant = $this->currentTenant();

        $categories = $this->tenantCategories($tenant)->get();

        $selectedCategoryId = $request->query('category_id');

        return view('admin.products.create', compact(
            'tenant',
            'categories',
            'selectedCategoryId'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $tenant = $this->currentTenant();

        if (!$this->tenantCategories($tenant)->exists()) {
            return redirect()
                ->route('admin.categories.create', [
                    'return_to' => 'product_create',
                ])
                ->with('warning', 'Primero debes crear una categoría para registrar productos.');
        }

        $validated = $this->validateProduct($request, $tenant);

        $imagePath = $this->storeImage($request, $tenant);

        try {
            $product = new Product();

            $payload = [
                'tenant_id' => $tenant->id,
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'discount_price' => $validated['discount_price'] ?? null,
                'stock' => $validated['stock'] ?? 0,
                'image' => $imagePath,
                'gallery' => null,
                'is_available' => $request->boolean('is_available', true),
                'featured' => $request->boolean('featured', false),
            ];

            if ($this->hasColumn('products', 'slug')) {
                $payload['slug'] = $this->generateUniqueSlug(
                    $validated['name'],
                    $tenant->id
                );
            }

            $product->forceFill(
                $this->onlyExistingProductColumns($payload)
            )->save();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Producto creado correctamente.');
        } catch (Throwable $e) {
            $this->deleteImage($imagePath);

            throw $e;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function show(Product $product): ViewContract
    {
        $tenant = $this->currentTenant();

        $this->authorizeProduct($product, $tenant);

        $product->load([
            'tenant',
            'category',
        ]);

        if (!ViewFacade::exists('admin.products.show')) {
            $categories = $this->tenantCategories(
                $tenant,
                (int) $product->category_id
            )->get();

            return view('admin.products.edit', compact(
                'tenant',
                'product',
                'categories'
            ));
        }

        return view('admin.products.show', compact(
            'tenant',
            'product'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO EDITAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product): ViewContract
    {
        $tenant = $this->currentTenant();

        $this->authorizeProduct($product, $tenant);

        $categories = $this->tenantCategories(
            $tenant,
            (int) $product->category_id
        )->get();

        return view('admin.products.edit', compact(
            'tenant',
            'product',
            'categories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Product $product): RedirectResponse
    {
        $tenant = $this->currentTenant();

        $this->authorizeProduct($product, $tenant);

        $validated = $this->validateProduct($request, $tenant);

        $oldImagePath = $product->image;
        $newImagePath = $product->image;

        if ($request->boolean('remove_image')) {
            $newImagePath = null;
        }

        if ($request->hasFile('image')) {
            $newImagePath = $this->storeImage($request, $tenant);
        }

        try {
            $payload = [
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'discount_price' => $validated['discount_price'] ?? null,
                'stock' => $validated['stock'] ?? 0,
                'image' => $newImagePath,
                'is_available' => $request->boolean('is_available', false),
                'featured' => $request->boolean('featured', false),
            ];

            if ($this->hasColumn('products', 'slug')) {
                $payload['slug'] = $this->generateUniqueSlug(
                    $validated['name'],
                    $tenant->id,
                    (int) $product->id
                );
            }

            $product->forceFill(
                $this->onlyExistingProductColumns($payload)
            )->save();

            if ($oldImagePath && $oldImagePath !== $newImagePath) {
                $this->deleteImage($oldImagePath);
            }

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Producto actualizado correctamente.');
        } catch (Throwable $e) {
            if ($newImagePath && $newImagePath !== $oldImagePath) {
                $this->deleteImage($newImagePath);
            }

            throw $e;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CAMBIAR DISPONIBILIDAD
    |--------------------------------------------------------------------------
    */

    public function toggleAvailability(Product $product): RedirectResponse
    {
        $tenant = $this->currentTenant();

        $this->authorizeProduct($product, $tenant);

        if (!$this->hasColumn('products', 'is_available')) {
            return back()
                ->withErrors([
                    'is_available' => 'La columna is_available no existe en la tabla products.',
                ]);
        }

        $product->forceFill([
            'is_available' => !$product->is_available,
        ])->save();

        return back()
            ->with('success', 'Disponibilidad actualizada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product): RedirectResponse
    {
        $tenant = $this->currentTenant();

        $this->authorizeProduct($product, $tenant);

        $imagePath = $product->image;
        $gallery = $product->gallery ?? null;

        $product->delete();

        $this->deleteImage($imagePath);
        $this->deleteGalleryImages($gallery);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | TENANT ACTUAL
    |--------------------------------------------------------------------------
    */

    private function currentTenant(): Tenant
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Debes iniciar sesión.');
        }

        if (!$user->tenant_id) {
            abort(403, 'Este usuario no tiene un negocio asignado.');
        }

        $tenant = Tenant::query()
            ->whereKey($user->tenant_id)
            ->first();

        if (!$tenant) {
            abort(403, 'El negocio asignado no existe.');
        }

        return $tenant;
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORÍAS DEL TENANT
    |--------------------------------------------------------------------------
    */

    private function tenantCategories(Tenant $tenant, ?int $includeCategoryId = null): EloquentBuilder
    {
        return Category::query()
            ->where('tenant_id', $tenant->id)
            ->when(
                $this->hasColumn('categories', 'is_active'),
                function (EloquentBuilder $query) use ($includeCategoryId): void {
                    $query->where(function (EloquentBuilder $subQuery) use ($includeCategoryId): void {
                        $subQuery->where('is_active', true);

                        if ($includeCategoryId) {
                            $subQuery->orWhere('id', $includeCategoryId);
                        }
                    });
                }
            )
            ->orderBy('name');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    private function validateProduct(Request $request, Tenant $tenant): array
    {
        return $request->validate([
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')
                    ->where(function ($query) use ($tenant) {
                        return $query->where('tenant_id', $tenant->id);
                    }),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price',
            ],

            'stock' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'is_available' => [
                'nullable',
                'boolean',
            ],

            'featured' => [
                'nullable',
                'boolean',
            ],

            'remove_image' => [
                'nullable',
                'boolean',
            ],
        ], [
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no pertenece a este negocio.',
            'name.required' => 'El nombre del producto es obligatorio.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio debe ser un número válido.',
            'discount_price.lt' => 'El precio con descuento debe ser menor al precio normal.',
            'image.image' => 'El archivo seleccionado debe ser una imagen.',
            'image.mimes' => 'La imagen debe estar en formato JPG, JPEG, PNG o WEBP.',
            'image.max' => 'La imagen no debe superar los 4MB.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SUBIR IMAGEN
    |--------------------------------------------------------------------------
    */

    private function storeImage(Request $request, Tenant $tenant): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();

        $filename = Str::uuid()->toString() . '.' . $extension;

        return $file->storeAs(
            'products/' . $tenant->slug,
            $filename,
            self::IMAGE_DISK
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR IMAGEN
    |--------------------------------------------------------------------------
    */

    private function deleteImage(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        if (Str::startsWith($imagePath, ['http://', 'https://'])) {
            return;
        }

        $cleanPath = ltrim($imagePath, '/');

        $cleanPath = Str::replaceFirst('storage/', '', $cleanPath);
        $cleanPath = Str::replaceFirst('public/', '', $cleanPath);

        if (Storage::disk(self::IMAGE_DISK)->exists($cleanPath)) {
            Storage::disk(self::IMAGE_DISK)->delete($cleanPath);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR GALERÍA
    |--------------------------------------------------------------------------
    */

    private function deleteGalleryImages(null|array|string $gallery): void
    {
        if (!$gallery) {
            return;
        }

        if (is_string($gallery)) {
            $decodedGallery = json_decode($gallery, true);

            $gallery = is_array($decodedGallery)
                ? $decodedGallery
                : [];
        }

        foreach ($gallery as $imagePath) {
            if (is_string($imagePath)) {
                $this->deleteImage($imagePath);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | AUTORIZAR PRODUCTO DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    private function authorizeProduct(Product $product, Tenant $tenant): void
    {
        if ((int) $product->tenant_id !== (int) $tenant->id) {
            abort(403, 'No puedes administrar productos de otro negocio.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | GENERAR SLUG ÚNICO POR NEGOCIO
    |--------------------------------------------------------------------------
    */

    private function generateUniqueSlug(
        string $name,
        int $tenantId,
        ?int $ignoreProductId = null
    ): string {
        $baseSlug = Str::slug($name);

        if (blank($baseSlug)) {
            $baseSlug = 'producto';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            Product::query()
                ->where('tenant_id', $tenantId)
                ->where('slug', $slug)
                ->when($ignoreProductId, function (EloquentBuilder $query) use ($ignoreProductId): void {
                    $query->where('id', '!=', $ignoreProductId);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | FILTRAR SOLO COLUMNAS EXISTENTES EN PRODUCTS
    |--------------------------------------------------------------------------
    */

    private function onlyExistingProductColumns(array $data): array
    {
        return array_filter(
            $data,
            function (mixed $value, string $column): bool {
                return $this->hasColumn('products', $column);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFICAR COLUMNAS CON CACHE
    |--------------------------------------------------------------------------
    */

    private function hasColumn(string $table, string $column): bool
    {
        static $cache = [];

        $key = $table . '.' . $column;

        if (!array_key_exists($key, $cache)) {
            $cache[$key] = Schema::hasColumn($table, $column);
        }

        return $cache[$key];
    }
}