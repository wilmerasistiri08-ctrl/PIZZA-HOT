<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;

class TenantMiddleware
{
    public function handle($request, Closure $next)
    {
        $slug = $request->route('slug');

        if ($slug) {
            $tenant = Tenant::where('slug', $slug)->firstOrFail();
            app()->instance('tenant', $tenant);
        }

        return $next($request);
    }
}