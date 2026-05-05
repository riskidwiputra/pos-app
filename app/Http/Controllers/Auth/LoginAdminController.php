<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAdminRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
   public function store(LoginAdminRequest $request): RedirectResponse
    {
        $request->authenticate();
        // check kalau bukan akun pelanngan
       
        if (Auth::user()->hasRole('customer') == true) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Akun tidak memiliki akses admin.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}