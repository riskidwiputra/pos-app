<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Super Admin bisa akses semua
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Customer tidak bisa akses halaman admin
        if ($user->isCustomer()) {
            abort(403, 'Akses ditolak untuk customer');
        }

        // Check permission untuk admin/karyawan
        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki hak akses untuk halaman ini');
    }
}