<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'tenant_id',
        'name'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}