<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login dan apakah rolenya ada di dalam parameter yang diizinkan
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, abort dengan pesan 403 (Unauthorized)
        abort(403, 'Unauthorized action. Kamu tidak memiliki hak akses ke halaman ini.');
    }
}