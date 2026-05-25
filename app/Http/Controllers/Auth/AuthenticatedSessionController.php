<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR LOGIN
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | INICIAR SESIÓN
    |--------------------------------------------------------------------------
    | Redirecciona según el rol del usuario:
    |
    | super_admin              -> /super-admin/dashboard
    | owner / admin / employee -> /admin/dashboard
    |--------------------------------------------------------------------------
    */

    public function store(LoginRequest $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | AUTENTICAR USUARIO
        |--------------------------------------------------------------------------
        */

        $request->authenticate();

        /*
        |--------------------------------------------------------------------------
        | REGENERAR SESIÓN
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | OBTENER USUARIO AUTENTICADO
        |--------------------------------------------------------------------------
        */

        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'No se pudo iniciar sesión correctamente.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === User::ROLE_SUPER_ADMIN) {
            return redirect()->intended(
                route('super.admin.dashboard')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ROLES DEL PANEL DEL NEGOCIO
        |--------------------------------------------------------------------------
        */

        $tenantPanelRoles = [
            User::ROLE_OWNER,
            User::ROLE_ADMIN,
            User::ROLE_EMPLOYEE,
        ];

        if (in_array($user->role, $tenantPanelRoles, true)) {

            /*
            |--------------------------------------------------------------------------
            | VALIDAR QUE TENGA NEGOCIO ASIGNADO
            |--------------------------------------------------------------------------
            */

            if (is_null($user->tenant_id)) {

                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'Tu usuario no tiene un negocio asignado. Contacta al administrador.',
                    ]);
            }

            return redirect()->intended(
                route('admin.dashboard')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ROL NO RECONOCIDO
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Tu usuario no tiene permisos para acceder al sistema.',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CERRAR SESIÓN
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}