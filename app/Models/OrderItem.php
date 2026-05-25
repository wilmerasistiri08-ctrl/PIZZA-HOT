<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'unit_price',
        'quantity',
        'subtotal',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'unit_price' => 'decimal:2',
        'quantity' => 'integer',
        'subtotal' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | DEFAULT VALUES
    |--------------------------------------------------------------------------
    */

    protected $attributes = [
        'quantity' => 1,
        'unit_price' => 0,
        'subtotal' => 0,
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: ITEM PERTENECE A UN PEDIDO
    |--------------------------------------------------------------------------
    */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: ITEM PERTENECE A UN PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: FILTRAR POR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function scopeForOrder(Builder $query, int $orderId): Builder
    {
        return $query->where('order_id', $orderId);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: FILTRAR POR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function scopeForProduct(Builder $query, int $productId): Builder
    {
        return $query->where('product_id', $productId);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: PRECIO UNITARIO FORMATEADO
    |--------------------------------------------------------------------------
    */

    public function getFormattedUnitPriceAttribute(): string
    {
        return 'Bs ' . number_format((float) $this->unit_price, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: SUBTOTAL FORMATEADO
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Bs ' . number_format((float) $this->subtotal, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: CALCULAR SUBTOTAL
    |--------------------------------------------------------------------------
    */

    public function calculateSubtotal(): float
    {
        return (float) $this->unit_price * (int) $this->quantity;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: ACTUALIZAR SUBTOTAL
    |--------------------------------------------------------------------------
    */

    public function updateSubtotal(): void
    {
        $this->update([
            'subtotal' => $this->calculateSubtotal(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: VALIDAR SI EL ITEM PERTENECE A UN PEDIDO
    |--------------------------------------------------------------------------
    */

    public function belongsToOrder(int $orderId): bool
    {
        return (int) $this->order_id === $orderId;
    }

    /*
    |--------------------------------------------------------------------------
    | BOOT MODEL
    |--------------------------------------------------------------------------
    | Antes de guardar, calcula automáticamente el subtotal.
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::saving(function (OrderItem $item): void {
            $item->subtotal = (float) $item->unit_price * (int) $item->quantity;
        });
    }
}