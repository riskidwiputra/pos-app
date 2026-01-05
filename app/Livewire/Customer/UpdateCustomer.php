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
    public User $admin;
    public $name = '';
    public $email = '';
    public $role_id = '';
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->admin->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'role_id.required' => 'Role wajib dipilih',
        'password.min' => 'Password minimal 6 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
    ];

    public function mount($id)
    {
        $this->admin = User::admins()->findOrFail($id);
        $this->name = $this->admin->name;
        $this->email = $this->admin->email;
        $this->role_id = $this->admin->role_id;
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $this->admin->update($data);

        session()->flash('message', 'Data admin berhasil diupdate!');
        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.customer.update-customer');
    }
}
