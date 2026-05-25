<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | CAMPOS ASIGNABLES
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'tenant_id',
        'name',
        'slug',
        'image',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'tenant_id' => 'integer',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: CATEGORÍA PERTENECE A UN NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: CATEGORÍA TIENE MUCHOS PRODUCTOS
    |--------------------------------------------------------------------------
    */

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: CATEGORÍAS ACTIVAS
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: CATEGORÍAS POR TENANT
    |--------------------------------------------------------------------------
    */

    public function scopeForTenant(Builder $query, int $tenantId): Builder
    {
        return $query->where('tenant_id', $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: CATEGORÍAS ACTIVAS POR TENANT
    |--------------------------------------------------------------------------
    */

    public function scopeActiveForTenant(Builder $query, int $tenantId): Builder
    {
        return $query
            ->where('tenant_id', $tenantId)
            ->where('is_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: ORDENAR CATEGORÍAS
    |--------------------------------------------------------------------------
    */

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: URL DE IMAGEN
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        }

        return asset('images/default-category.png');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: ESTADO TEXTO
    |--------------------------------------------------------------------------
    */

    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Activa' : 'Inactiva';
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: ESTADO COLOR
    |--------------------------------------------------------------------------
    */

    public function getStatusColorAttribute(): string
    {
        return $this->is_active ? 'green' : 'red';
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: VALIDAR SI PERTENECE AL TENANT ACTUAL
    |--------------------------------------------------------------------------
    */

    public function belongsToTenant(int $tenantId): bool
    {
        return (int) $this->tenant_id === (int) $tenantId;
    }
}