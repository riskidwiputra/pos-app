<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

#[Layout('layouts.app')]
#[Title('Tambah Pelanggan')]
class CreateCustomer extends Component
{
     #[Validate('required|string|max:255')]
    public $name = '';
    
    #[Validate('required|email|unique:users,email')]
    public $email = '';
    
    #[Validate('required|string|min:6|confirmed')]
    public $password = '';
    
    #[Validate('required')]
    public $password_confirmation = '';
    
    #[Validate('required|exists:roles,id')]
    public $role_id = '';

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 6 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'role_id.required' => 'Role wajib dipilih',
        'role_id.exists' => 'Role tidak valid',
    ];

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->role_id,
        ]);

        session()->flash('message', 'Admin berhasil ditambahkan!');
        return redirect()->route('admin.index');
    }

    
    public function render()
    {
         return view('livewire.customer.create-customer', [
            'roles' => Role::where('level', 2)->where('is_active', true)->get(),
        ]);
    }
}
