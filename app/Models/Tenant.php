<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [

        'user_id',

        'name',

        'slug',

        'logo',

        'whatsapp_number',

        'schedule',

        'address',

        'google_maps',

        'tiktok',

        'is_open'

    ];

    /*
    |--------------------------------------------------------------------------
    | CATEGORÍAS
    |--------------------------------------------------------------------------
    */

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCTOS
    |--------------------------------------------------------------------------
    */

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
