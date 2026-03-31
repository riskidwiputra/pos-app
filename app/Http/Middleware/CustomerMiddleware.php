<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {

     
         $user = $request->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        if ($user->isCustomer()) {
            return $next($request);
            
        }
        return redirect()->route('login')
                ->with('error', 'Akses ditolak. Anda bukan customer.');
      
    }
}