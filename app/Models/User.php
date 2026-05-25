<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | CONSTANTES DE ROLES
    |--------------------------------------------------------------------------
    */

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_OWNER = 'owner';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_EMPLOYEE = 'employee';

    /*
    |--------------------------------------------------------------------------
    | ROLES PERMITIDOS PARA PANEL DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    public const TENANT_PANEL_ROLES = [
        self::ROLE_OWNER,
        self::ROLE_ADMIN,
        self::ROLE_EMPLOYEE,
    ];

    /*
    |--------------------------------------------------------------------------
    | ROLES QUE PUEDEN GESTIONAR PRODUCTOS
    |--------------------------------------------------------------------------
    */

    public const PRODUCT_MANAGER_ROLES = [
        self::ROLE_OWNER,
        self::ROLE_ADMIN,
    ];

    /*
    |--------------------------------------------------------------------------
    | ROLES QUE PUEDEN GESTIONAR PEDIDOS
    |--------------------------------------------------------------------------
    */

    public const ORDER_MANAGER_ROLES = [
        self::ROLE_OWNER,
        self::ROLE_ADMIN,
        self::ROLE_EMPLOYEE,
    ];

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'password',
        'role',
    ];

    /*
    |--------------------------------------------------------------------------
    | HIDDEN
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tenant_id' => 'integer',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN: USUARIO PERTENECE A UN NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS DE ROLES
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isOwner(): bool
    {
        return $this->role === self::ROLE_OWNER;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEmployee(): bool
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR SI EL USUARIO TIENE NEGOCIO ASIGNADO
    |--------------------------------------------------------------------------
    */

    public function hasTenant(): bool
    {
        return !is_null($this->tenant_id);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESO AL PANEL DEL NEGOCIO
    |--------------------------------------------------------------------------
    | Para entrar a /admin/* debe:
    |
    | 1. Tener rol de negocio.
    | 2. Tener tenant_id asignado.
    |--------------------------------------------------------------------------
    */

    public function canAccessTenantPanel(): bool
    {
        return $this->hasAnyRole(self::TENANT_PANEL_ROLES)
            && $this->hasTenant();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESO AL PANEL SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    public function canAccessSuperAdminPanel(): bool
    {
        return $this->isSuperAdmin();
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR SI PERTENECE A UN TENANT ESPECÍFICO
    |--------------------------------------------------------------------------
    */

    public function belongsToTenant(int|string|null $tenantId): bool
    {
        if (is_null($tenantId)) {
            return false;
        }

        if (is_null($this->tenant_id)) {
            return false;
        }

        return (int) $this->tenant_id === (int) $tenantId;
    }

    /*
    |--------------------------------------------------------------------------
    | OBTENER TENANT ACTUAL
    |--------------------------------------------------------------------------
    */

    public function currentTenant(): ?Tenant
    {
        return $this->tenant;
    }

    /*
    |--------------------------------------------------------------------------
    | NOMBRE LEGIBLE DEL ROL
    |--------------------------------------------------------------------------
    */

    public function roleLabel(): string
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN => 'Super administrador',
            self::ROLE_OWNER => 'Propietario',
            self::ROLE_ADMIN => 'Administrador',
            self::ROLE_EMPLOYEE => 'Empleado',
            default => 'Usuario',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | PERMISOS DEL PANEL DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function canManageProducts(): bool
    {
        return $this->hasAnyRole(self::PRODUCT_MANAGER_ROLES)
            && $this->hasTenant();
    }

    public function canManageOrders(): bool
    {
        return $this->hasAnyRole(self::ORDER_MANAGER_ROLES)
            && $this->hasTenant();
    }

    public function canManageTenantUsers(): bool
    {
        return $this->hasAnyRole([
            self::ROLE_OWNER,
            self::ROLE_ADMIN,
        ]) && $this->hasTenant();
    }

    public function canViewReports(): bool
    {
        return $this->hasAnyRole([
            self::ROLE_OWNER,
            self::ROLE_ADMIN,
        ]) && $this->hasTenant();
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR SI ES USUARIO INTERNO DE UN NEGOCIO
    |--------------------------------------------------------------------------
    */

    public function isTenantUser(): bool
    {
        return $this->canAccessTenantPanel();
    }
}