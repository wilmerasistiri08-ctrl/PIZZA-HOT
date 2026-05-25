<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTRAR NUEVO NEGOCIO
    |--------------------------------------------------------------------------
    | Flujo correcto con la nueva arquitectura:
    |
    | 1. Crear negocio en tenants
    | 2. Crear usuario owner en users
    | 3. Relacionar user.tenant_id con tenants.id
    | 4. Crear categorías iniciales opcionales
    | 5. Redirigir a la tienda pública
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDACIÓN
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                'unique:tenants,slug',
            ],

            'owner_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'whatsapp_number' => [
                'required',
                'string',
                'max:30',
            ],

            'address' => [
                'required',
                'string',
                'max:255',
            ],

            'google_maps' => [
                'required',
                'string',
                'max:1000',
            ],

            'tiktok' => [
                'nullable',
                'string',
                'max:255',
            ],

            'schedule' => [
                'nullable',
                'string',
                'max:255',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALIZAR SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($validated['slug']);

        /*
        |--------------------------------------------------------------------------
        | TRANSACCIÓN
        |--------------------------------------------------------------------------
        | Si algo falla, no se crea nada incompleto.
        |--------------------------------------------------------------------------
        */

        return DB::transaction(function () use ($request, $validated, $slug) {

            /*
            |--------------------------------------------------------------------------
            | GUARDAR LOGO
            |--------------------------------------------------------------------------
            */

            $logoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')
                    ->store("tenants/{$slug}", 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | CREAR TENANT
            |--------------------------------------------------------------------------
            | IMPORTANTE:
            | Ya NO usamos user_id.
            |--------------------------------------------------------------------------
            */

            $tenant = Tenant::create([
                'name' => $validated['name'],
                'slug' => $slug,
                'logo' => $logoPath,
                'whatsapp_number' => $validated['whatsapp_number'],
                'address' => $validated['address'],
                'google_maps' => $validated['google_maps'],
                'tiktok' => $validated['tiktok'] ?? null,
                'schedule' => $validated['schedule'] ?? '10:00 - 22:00',
                'is_open' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | CREAR USUARIO OWNER
            |--------------------------------------------------------------------------
            | Este usuario será el dueño del negocio.
            |--------------------------------------------------------------------------
            */

            User::create([
                'tenant_id' => $tenant->id,
                'name' => $validated['owner_name'] ?? 'Administrador ' . $tenant->name,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'] ?? '12345678'),
                'role' => User::ROLE_OWNER,
            ]);

            /*
            |--------------------------------------------------------------------------
            | CREAR CATEGORÍAS BASE
            |--------------------------------------------------------------------------
            | Opcional, pero útil para que el negocio no nazca vacío.
            |--------------------------------------------------------------------------
            */

            $defaultCategories = [
                'Destacados',
                'Productos',
                'Promociones',
            ];

            foreach ($defaultCategories as $categoryName) {
                Category::create([
                    'tenant_id' => $tenant->id,
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                    'is_active' => true,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | REDIRIGIR A LA TIENDA PÚBLICA
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('tenant.show', $tenant->slug)
                ->with('success', 'Negocio registrado correctamente.');
        });
    }
}