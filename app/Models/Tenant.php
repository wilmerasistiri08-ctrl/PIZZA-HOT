<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    | Campos permitidos para creación/actualización masiva.
    | IMPORTANTE:
    | Ya NO usamos user_id en tenants.
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'whatsapp_number',
        'address',
        'google_maps',
        'tiktok',
        'schedule',
        'is_open',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'is_open' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | USUARIOS DEL NEGOCIO
    |--------------------------------------------------------------------------
    | Un negocio puede tener varios usuarios:
    | owner, admin, employee.
    |--------------------------------------------------------------------------
    */

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORÍAS DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCTOS DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | PEDIDOS DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function logoUrl(): string
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }

        return asset('images/default-logo.png');
    }

    public function publicUrl(): string
    {
        return url('/' . $this->slug);
    }

    public function whatsappUrl(?string $message = null): string
    {
        $phone = preg_replace('/\D/', '', $this->whatsapp_number);

        if (!str_starts_with($phone, '591')) {
            $phone = '591' . $phone;
        }

        $url = "https://wa.me/{$phone}";

        if ($message) {
            $url .= '?text=' . urlencode($message);
        }

        return $url;
    }
}