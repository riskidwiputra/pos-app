<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginCustomerController extends Controller
{
   public function store(LoginRequest $request): RedirectResponse
    {
        
        $request->authenticate();
        if (Auth::user()->hasRole('customer') == true) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOMECUST);
        }else{
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Akun tidak ditemukan.']);
        }
        
    }
}