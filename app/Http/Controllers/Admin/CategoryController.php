<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RETORNOS PERMITIDOS
    |--------------------------------------------------------------------------
    */

    private const RETURN_PRODUCT_CREATE = 'product_create';
    private const RETURN_CATEGORIES_INDEX = 'categories_index';

    /*
    |--------------------------------------------------------------------------
    | OBTENER TENANT ACTUAL
    |--------------------------------------------------------------------------
    */

    private function tenantId(): int
    {
        $user = Auth::user();

        if (!$user || !$user->tenant_id) {
            abort(403, 'Este usuario no tiene un negocio asignado.');
        }

        return (int) $user->tenant_id;
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR CATEGORÍAS DEL NEGOCIO AUTENTICADO
    |--------------------------------------------------------------------------
    */

    public function index(): View
    {
        $tenantId = $this->tenantId();

        $categories = Category::query()
            ->where('tenant_id', $tenantId)
            ->withCount('products')
            ->orderByDesc('is_active')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO CREAR CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function create(Request $request): View
    {
        $returnTo = $this->normalizeReturnTo(
            $request->query('return_to')
        );

        return view('admin.categories.create', compact('returnTo'));
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $tenantId = $this->tenantId();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'return_to' => [
                'nullable',
                'string',
                Rule::in([
                    self::RETURN_PRODUCT_CREATE,
                    self::RETURN_CATEGORIES_INDEX,
                ]),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | GENERAR SLUG SEGURO
        |--------------------------------------------------------------------------
        */

        $slug = $this->makeSlug(
            $validated['slug'] ?? $validated['name']
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDAR SLUG ÚNICO POR NEGOCIO
        |--------------------------------------------------------------------------
        */

        $exists = Category::query()
            ->where('tenant_id', $tenantId)
            ->where('slug', $slug)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'Ya existe una categoría con esa URL en este negocio.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SUBIR IMAGEN
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store("tenants/{$tenantId}/categories", 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | CREAR CATEGORÍA
        |--------------------------------------------------------------------------
        */

        $category = Category::create([
            'tenant_id' => $tenantId,
            'name' => trim($validated['name']),
            'slug' => $slug,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active', true),
        ]);

        /*
        |--------------------------------------------------------------------------
        | RETORNAR A CREACIÓN DE PRODUCTO SI VIENE DESDE ESE MÓDULO
        |--------------------------------------------------------------------------
        */

        $returnTo = $validated['return_to'] ?? self::RETURN_CATEGORIES_INDEX;

        if ($returnTo === self::RETURN_PRODUCT_CREATE) {
            return redirect()
                ->route('admin.products.create')
                ->with('success', 'Categoría creada correctamente. Ahora puedes seleccionarla para tu producto.')
                ->with('created_category_id', $category->id);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR CATEGORÍA
    |--------------------------------------------------------------------------
    | No usamos una vista show para evitar errores si no existe:
    | admin.categories.show
    |--------------------------------------------------------------------------
    */

    public function show(Category $category): RedirectResponse
    {
        $this->authorizeTenant($category);

        return redirect()
            ->route('admin.categories.edit', $category);
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO EDITAR CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function edit(Category $category): View
    {
        $this->authorizeTenant($category);

        return view('admin.categories.edit', compact('category'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->authorizeTenant($category);

        $tenantId = $this->tenantId();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'remove_image' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | GENERAR SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $this->makeSlug(
            $validated['slug'] ?? $validated['name']
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDAR SLUG ÚNICO POR NEGOCIO EXCLUYENDO LA CATEGORÍA ACTUAL
        |--------------------------------------------------------------------------
        */

        $exists = Category::query()
            ->where('tenant_id', $tenantId)
            ->where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'Ya existe otra categoría con esa URL en este negocio.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | MANEJO DE IMAGEN
        |--------------------------------------------------------------------------
        */

        $imagePath = $category->image;

        if ($request->boolean('remove_image')) {
            $this->deleteImage($category->image);
            $imagePath = null;
        }

        if ($request->hasFile('image')) {
            $this->deleteImage($category->image);

            $imagePath = $request
                ->file('image')
                ->store("tenants/{$tenantId}/categories", 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR CATEGORÍA
        |--------------------------------------------------------------------------
        */

        $category->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorizeTenant($category);

        /*
        |--------------------------------------------------------------------------
        | EVITAR ELIMINAR CATEGORÍAS CON PRODUCTOS
        |--------------------------------------------------------------------------
        */

        if ($category->products()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'No puedes eliminar esta categoría porque tiene productos asociados.');
        }

        /*
        |--------------------------------------------------------------------------
        | ELIMINAR IMAGEN ASOCIADA
        |--------------------------------------------------------------------------
        */

        $this->deleteImage($category->image);

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR QUE LA CATEGORÍA PERTENEZCA AL NEGOCIO AUTENTICADO
    |--------------------------------------------------------------------------
    */

    private function authorizeTenant(Category $category): void
    {
        if ((int) $category->tenant_id !== $this->tenantId()) {
            abort(403, 'No tienes permiso para acceder a esta categoría.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALIZAR SLUG
    |--------------------------------------------------------------------------
    */

    private function makeSlug(string $value): string
    {
        $slug = Str::slug(trim($value));

        if (!$slug) {
            $slug = 'categoria-' . now()->timestamp;
        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR RETORNO
    |--------------------------------------------------------------------------
    */

    private function normalizeReturnTo(?string $returnTo): string
    {
        $allowed = [
            self::RETURN_PRODUCT_CREATE,
            self::RETURN_CATEGORIES_INDEX,
        ];

        if (!$returnTo || !in_array($returnTo, $allowed, true)) {
            return self::RETURN_CATEGORIES_INDEX;
        }

        return $returnTo;
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR IMAGEN DEL STORAGE
    |--------------------------------------------------------------------------
    */

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}