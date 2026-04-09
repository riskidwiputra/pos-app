<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit Pelanggan')]
class UpdateCustomer extends Component
{
    public User $customer;
    public $name = '';
    public $email = '';
    public $username = '';
    public $password = '';
    public $role_id = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->customer->id,
            'password' => 'nullable|string|min:6|confirmed',
            'username' => 'required|unique:users,username,' . $this->customer->id,
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.min' => 'Password minimal 6 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'username.required' => 'Username wajib diisi',
        'username.unique' => 'Username sudah terdaftar',
    ];

    public function mount($id)
    {
        $this->customer = User::findOrFail($id);
        $this->name = $this->customer->name;
        $this->email = $this->customer->email;
        $this->username = $this->customer->username;
        $this->role_id = $this->customer->role_id;
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'role_id' => $this->role_id,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $this->customer->update($data);

        session()->flash('message', 'Data pelanggan berhasil diupdate!');
        return redirect()->route('customer.index');
    }

    public function render()
    {
        return view('livewire.customer.update-customer');
    }
}
