<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.register')]
#[Title('Daftar Akun - Percetakan Matahari')]
class CustomerRegister extends Component
{
    public $fullname = '';
    public $email = '';
    public $username = '';
    public $password = '';
    public $confirmPassword = '';
    public $terms = false;

    public function mount()
    {
        //check sudah login
        if (Auth::check()) {
            redirect(RouteServiceProvider::HOME);
        }
    }

    public function register()
    {
        $rules = [
            'fullname' => 'required|string|min:3|max:255',
            'username' => 'required|string|min:3|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ];

      

        $this->validate($rules, [
            'fullname.required' => 'Nama lengkap harus diisi',
            'fullname.min' => 'Nama minimal 3 karakter',
            'username.required' => 'Username harus diisi',
            'username.min' => 'Username minimal 3 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'confirmPassword.same' => 'Konfirmasi password tidak cocok',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
        ]);

        // Buat customer baru
        $customer = User::create([
            'name' => $this->fullname,
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'role_id' => 3,
        ]);

        event(new Registered($customer));

        Auth::login($customer);

        return redirect(RouteServiceProvider::HOME);

    }

    public function render()
    {
        return view('livewire.auth.registerUser');
    }
}