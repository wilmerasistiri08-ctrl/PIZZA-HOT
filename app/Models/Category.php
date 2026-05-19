<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'tenant_id',
        'name',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Negocio propietario de la categoría
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Productos de la categoría
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}