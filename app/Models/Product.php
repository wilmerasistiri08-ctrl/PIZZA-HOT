<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'tenant_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'image',
        'gallery',
        'is_available',
        'featured',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'tenant_id' => 'integer',
        'category_id' => 'integer',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'stock' => 'integer',
        'gallery' => 'array',
        'is_available' => 'boolean',
        'featured' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | DEFAULT VALUES
    |--------------------------------------------------------------------------
    */

    protected $attributes = [
        'stock' => 0,
        'is_available' => true,
        'featured' => false,
    ];

    /*
    |--------------------------------------------------------------------------
    | APPENDS
    |--------------------------------------------------------------------------
    | Estos campos estarán disponibles cuando el modelo se convierta a array/json.
    |--------------------------------------------------------------------------
    */

    protected $appends = [
        'image_url',
        'final_price',
        'formatted_price',
        'formatted_final_price',
        'formatted_discount_price',
        'status_label',
        'status_color',
        'discount_percentage',
    ];

    /*
    |--------------------------------------------------------------------------
    | BOOT MODEL
    |--------------------------------------------------------------------------
    | Genera slug automáticamente si no se envía.
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::creating(function (Product $product): void {
            if (blank($product->slug)) {
                $product->slug = static::generateUniqueSlug(
                    $product->name,
                    (int) $product->tenant_id
                );
            }
        });

        static::updating(function (Product $product): void {
            if ($product->isDirty('name') && blank($product->slug)) {
                $product->slug = static::generateUniqueSlug(
                    $product->name,
                    (int) $product->tenant_id,
                    (int) $product->id
                );
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: PRODUCTO PERTENECE A UN NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: PRODUCTO PERTENECE A UNA CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: PRODUCTO PUEDE ESTAR EN MUCHOS ITEMS DE PEDIDO
    |--------------------------------------------------------------------------
    */

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: FILTRAR POR NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function scopeForTenant(Builder $query, int|string|null $tenantId): Builder
    {
        if (blank($tenantId)) {
            return $query->whereRaw('1 = 0');
        }

        return $query->where('tenant_id', (int) $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: FILTRAR POR CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function scopeForCategory(Builder $query, int|string|null $categoryId): Builder
    {
        if (blank($categoryId)) {
            return $query;
        }

        return $query->where('category_id', (int) $categoryId);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: DISPONIBLES
    |--------------------------------------------------------------------------
    */

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: AGOTADOS / NO DISPONIBLES
    |--------------------------------------------------------------------------
    */

    public function scopeUnavailable(Builder $query): Builder
    {
        return $query->where('is_available', false);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: DESTACADOS
    |--------------------------------------------------------------------------
    */

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: CON STOCK
    |--------------------------------------------------------------------------
    */

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: SIN STOCK
    |--------------------------------------------------------------------------
    */

    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->where('stock', '<=', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PRODUCTOS COMPRABLES
    |--------------------------------------------------------------------------
    | Producto comprable = disponible + stock mayor a 0.
    |--------------------------------------------------------------------------
    */

    public function scopePurchasable(Builder $query): Builder
    {
        return $query
            ->where('is_available', true)
            ->where('stock', '>', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: DISPONIBLES POR NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function scopeAvailableForTenant(Builder $query, int|string|null $tenantId): Builder
    {
        return $query
            ->forTenant($tenantId)
            ->available();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: BÚSQUEDA
    |--------------------------------------------------------------------------
    */

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        $term = trim($term);

        return $query->where(function (Builder $subQuery) use ($term): void {
            $subQuery
                ->where('name', 'like', '%' . $term . '%')
                ->orWhere('description', 'like', '%' . $term . '%')
                ->orWhere('slug', 'like', '%' . $term . '%');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: ORDEN ADMIN
    |--------------------------------------------------------------------------
    */

    public function scopeAdminOrder(Builder $query): Builder
    {
        return $query
            ->latest('updated_at')
            ->latest('id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: ORDEN TIENDA PÚBLICA
    |--------------------------------------------------------------------------
    */

    public function scopePublicOrder(Builder $query): Builder
    {
        return $query
            ->orderByDesc('featured')
            ->orderBy('name');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: URL DE IMAGEN
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute(): string
    {
        if (blank($this->image)) {
            return asset('images/default-product.png');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: PRECIO FINAL
    |--------------------------------------------------------------------------
    */

    public function getFinalPriceAttribute(): float
    {
        return $this->hasDiscount()
            ? (float) $this->discount_price
            : (float) $this->price;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: PRECIO FORMATEADO
    |--------------------------------------------------------------------------
    */

    public function getFormattedPriceAttribute(): string
    {
        return 'Bs ' . number_format((float) $this->price, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: PRECIO FINAL FORMATEADO
    |--------------------------------------------------------------------------
    */

    public function getFormattedFinalPriceAttribute(): string
    {
        return 'Bs ' . number_format((float) $this->final_price, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: PRECIO DESCUENTO FORMATEADO
    |--------------------------------------------------------------------------
    */

    public function getFormattedDiscountPriceAttribute(): ?string
    {
        if (!$this->hasDiscount()) {
            return null;
        }

        return 'Bs ' . number_format((float) $this->discount_price, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: ESTADO VISUAL
    |--------------------------------------------------------------------------
    */

    public function getStatusLabelAttribute(): string
    {
        if (!$this->is_available) {
            return 'Agotado';
        }

        if (!$this->hasStock()) {
            return 'Sin stock';
        }

        return 'Disponible';
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: COLOR DEL ESTADO
    |--------------------------------------------------------------------------
    */

    public function getStatusColorAttribute(): string
    {
        if (!$this->is_available) {
            return 'red';
        }

        if (!$this->hasStock()) {
            return 'yellow';
        }

        return 'green';
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: PORCENTAJE DESCUENTO
    |--------------------------------------------------------------------------
    */

    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        $price = (float) $this->price;
        $discountPrice = (float) $this->discount_price;

        if ($price <= 0) {
            return 0;
        }

        return (int) round((($price - $discountPrice) / $price) * 100);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: URL DE IMAGEN
    |--------------------------------------------------------------------------
    */

    public function imageUrl(): string
    {
        return $this->image_url;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: PRECIO FINAL
    |--------------------------------------------------------------------------
    */

    public function finalPrice(): float
    {
        return $this->final_price;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: ¿TIENE DESCUENTO?
    |--------------------------------------------------------------------------
    */

    public function hasDiscount(): bool
    {
        return !is_null($this->discount_price)
            && (float) $this->discount_price > 0
            && (float) $this->discount_price < (float) $this->price;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: ¿TIENE STOCK?
    |--------------------------------------------------------------------------
    */

    public function hasStock(): bool
    {
        return (int) $this->stock > 0;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: ¿PUEDE COMPRARSE?
    |--------------------------------------------------------------------------
    */

    public function canBePurchased(): bool
    {
        return $this->is_available === true && $this->hasStock();
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: ESTADO
    |--------------------------------------------------------------------------
    */

    public function statusLabel(): string
    {
        return $this->status_label;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: VALIDAR TENANT
    |--------------------------------------------------------------------------
    */

    public function belongsToTenant(int|string|null $tenantId): bool
    {
        if (is_null($tenantId)) {
            return false;
        }

        return (int) $this->tenant_id === (int) $tenantId;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: REDUCIR STOCK
    |--------------------------------------------------------------------------
    */

    public function decreaseStock(int $quantity): bool
    {
        if ($quantity <= 0) {
            return false;
        }

        if ((int) $this->stock < $quantity) {
            return false;
        }

        $this->decrement('stock', $quantity);

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: AUMENTAR STOCK
    |--------------------------------------------------------------------------
    */

    public function increaseStock(int $quantity): bool
    {
        if ($quantity <= 0) {
            return false;
        }

        $this->increment('stock', $quantity);

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: ELIMINAR IMAGEN PRINCIPAL
    |--------------------------------------------------------------------------
    */

    public function deleteImage(): void
    {
        if (
            filled($this->image)
            && !Str::startsWith($this->image, ['http://', 'https://'])
            && Storage::disk('public')->exists($this->image)
        ) {
            Storage::disk('public')->delete($this->image);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: GENERAR SLUG ÚNICO POR TENANT
    |--------------------------------------------------------------------------
    */

    public static function generateUniqueSlug(
        string $name,
        int $tenantId,
        ?int $ignoreProductId = null
    ): string {
        $baseSlug = Str::slug($name);

        if (blank($baseSlug)) {
            $baseSlug = 'producto';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            static::query()
                ->where('tenant_id', $tenantId)
                ->where('slug', $slug)
                ->when($ignoreProductId, function (Builder $query) use ($ignoreProductId): void {
                    $query->where('id', '!=', $ignoreProductId);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}