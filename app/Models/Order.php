<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | CONSTANTES DE ESTADOS DEL PEDIDO
    |--------------------------------------------------------------------------
    */

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_PREPARING = 'preparing';
    public const STATUS_DELIVERING = 'delivering';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /*
    |--------------------------------------------------------------------------
    | CONSTANTES DE ESTADO DE PAGO
    |--------------------------------------------------------------------------
    */

    public const PAYMENT_PENDING = 'pending';
    public const PAYMENT_PAID = 'paid';
    public const PAYMENT_CANCELLED = 'cancelled';

    /*
    |--------------------------------------------------------------------------
    | MÉTODOS DE PAGO
    |--------------------------------------------------------------------------
    */

    public const METHOD_CASH = 'cash';
    public const METHOD_QR = 'qr';
    public const METHOD_CARD = 'card';
    public const METHOD_TRANSFER = 'transfer';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'tenant_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'address',
        'google_maps_link',
        'notes',
        'subtotal',
        'delivery_fee',
        'total',
        'payment_method',
        'payment_status',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'tenant_id' => 'integer',
        'subtotal' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | DEFAULT VALUES
    |--------------------------------------------------------------------------
    */

    protected $attributes = [
        'subtotal' => 0,
        'delivery_fee' => 0,
        'total' => 0,
        'payment_status' => self::PAYMENT_PENDING,
        'status' => self::STATUS_PENDING,
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: PEDIDO PERTENECE A UN NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: PEDIDO TIENE MUCHOS ITEMS
    |--------------------------------------------------------------------------
    */

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: FILTRAR POR NEGOCIO
    |--------------------------------------------------------------------------
    | Uso:
    | Order::forTenant($tenantId)->get();
    |--------------------------------------------------------------------------
    */

    public function scopeForTenant(Builder $query, int $tenantId): Builder
    {
        return $query->where('tenant_id', $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS PENDIENTES
    |--------------------------------------------------------------------------
    | Uso:
    | Order::pending()->get();
    |--------------------------------------------------------------------------
    */

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS CONFIRMADOS
    |--------------------------------------------------------------------------
    */

    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS EN PREPARACIÓN
    |--------------------------------------------------------------------------
    */

    public function scopePreparing(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PREPARING);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS EN CAMINO
    |--------------------------------------------------------------------------
    */

    public function scopeDelivering(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_DELIVERING);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS COMPLETADOS
    |--------------------------------------------------------------------------
    */

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS CANCELADOS
    |--------------------------------------------------------------------------
    */

    public function scopeCancelled(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS ACTIVOS
    |--------------------------------------------------------------------------
    | Pedidos que todavía no terminaron.
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNotIn('status', [
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: PEDIDOS DEL DÍA
    |--------------------------------------------------------------------------
    */

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', now()->toDateString());
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE: ÚLTIMOS PEDIDOS
    |--------------------------------------------------------------------------
    */

    public function scopeLatestOrders(Builder $query): Builder
    {
        return $query->latest();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: ESTADO DEL PEDIDO EN ESPAÑOL
    |--------------------------------------------------------------------------
    | Uso:
    | $order->status_label
    |--------------------------------------------------------------------------
    */

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Pendiente',
            self::STATUS_CONFIRMED => 'Confirmado',
            self::STATUS_PREPARING => 'Preparando',
            self::STATUS_DELIVERING => 'En camino',
            self::STATUS_COMPLETED => 'Entregado',
            self::STATUS_CANCELLED => 'Cancelado',
            default => 'Desconocido',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: COLOR DEL ESTADO
    |--------------------------------------------------------------------------
    | Uso:
    | $order->status_color
    |--------------------------------------------------------------------------
    */

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'yellow',
            self::STATUS_CONFIRMED => 'blue',
            self::STATUS_PREPARING => 'orange',
            self::STATUS_DELIVERING => 'purple',
            self::STATUS_COMPLETED => 'green',
            self::STATUS_CANCELLED => 'red',
            default => 'gray',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: ESTADO DEL PAGO EN ESPAÑOL
    |--------------------------------------------------------------------------
    | Uso:
    | $order->payment_status_label
    |--------------------------------------------------------------------------
    */

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            self::PAYMENT_PENDING => 'Pendiente',
            self::PAYMENT_PAID => 'Pagado',
            self::PAYMENT_CANCELLED => 'Cancelado',
            default => 'Desconocido',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: MÉTODO DE PAGO EN ESPAÑOL
    |--------------------------------------------------------------------------
    | Uso:
    | $order->payment_method_label
    |--------------------------------------------------------------------------
    */

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            self::METHOD_CASH => 'Efectivo',
            self::METHOD_QR => 'QR',
            self::METHOD_CARD => 'Tarjeta',
            self::METHOD_TRANSFER => 'Transferencia',
            default => 'No definido',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: TOTAL FORMATEADO
    |--------------------------------------------------------------------------
    | Uso:
    | $order->formatted_total
    |--------------------------------------------------------------------------
    */

    public function getFormattedTotalAttribute(): string
    {
        return 'Bs ' . number_format((float) $this->total, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS COMPATIBLES
    |--------------------------------------------------------------------------
    | Mantengo estos métodos para que no se rompan vistas/controladores antiguos
    | donde estés usando $order->statusLabel(), paymentStatusLabel(), etc.
    |--------------------------------------------------------------------------
    */

    public function statusLabel(): string
    {
        return $this->status_label;
    }

    public function paymentStatusLabel(): string
    {
        return $this->payment_status_label;
    }

    public function paymentMethodLabel(): string
    {
        return $this->payment_method_label;
    }

    public function formattedTotal(): string
    {
        return $this->formatted_total;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS DE ESTADO
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isPreparing(): bool
    {
        return $this->status === self::STATUS_PREPARING;
    }

    public function isDelivering(): bool
    {
        return $this->status === self::STATUS_DELIVERING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isActive(): bool
    {
        return !in_array($this->status, [
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ], true);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: VALIDAR SI PERTENECE A UN TENANT
    |--------------------------------------------------------------------------
    */

    public function belongsToTenant(int $tenantId): bool
    {
        return (int) $this->tenant_id === $tenantId;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: RECALCULAR TOTAL DESDE ITEMS
    |--------------------------------------------------------------------------
    | Este método será útil cuando implementemos checkout real con OrderItems.
    |--------------------------------------------------------------------------
    */

    public function recalculateTotal(): void
    {
        $subtotal = $this->items()->sum('subtotal');

        $this->update([
            'subtotal' => $subtotal,
            'total' => $subtotal + (float) $this->delivery_fee,
        ]);
    }
}