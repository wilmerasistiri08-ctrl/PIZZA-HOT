<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tenant_id',
        'customer_name',
        'customer_phone',
        'address',
        'google_maps_link',
        'total',
        'status'
    ];
}
