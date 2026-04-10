<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // Tambahkan ...$roles agar bisa mengecek lebih dari satu role
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    // Mengizinkan jika role user ada dalam daftar roles yang dikirim dari route
    if (!in_array(Auth::user()->role, $roles)) {
        abort(403, 'Akses Ditolak! Role Anda tidak diizinkan.');
    }

    return $next($request);
}
}
