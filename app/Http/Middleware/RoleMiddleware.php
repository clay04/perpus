<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // belum login
        if (!auth()->check()) {
            abort(403, 'Akses ditolak');
        }

        // cek role enum
        if (auth()->user()->role->value !== $role) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
