<?php

namespace App\Livewire\Auth;

use App\Models\Role;
use App\Models\Permission;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('Kelola Hak Akses Role')]
class ManageRolePermissions extends Component
{
    public $selectedRoleId = null;
    public $selectedRole = null;
    public $rolePermissions = [];

    #[Computed]
    public function roles()
    {
        // Hanya tampilkan admin dan karyawan (level 1)
        // Super Admin dan Customer tidak bisa di-edit
        return Role::where('level', 1)
            ->where('level', '!=', 0)
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function permissionsGrouped()
    {
        return Permission::with('children')
            ->where('type', 'menu')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function selectRole($roleId)
    {
        $this->selectedRoleId = $roleId;
        $this->selectedRole = Role::with('permissions')->find($roleId);
        $this->rolePermissions = $this->selectedRole->permissions->pluck('id')->toArray();
    }



    public function savePermissions()
    {
        if (!$this->selectedRole) {
            session()->flash('error', 'Pilih role terlebih dahulu');
            return;
        }

        $this->selectedRole->permissions()->sync($this->rolePermissions);

        session()->flash('success', 'Hak akses berhasil diperbarui');
    }

    public function render()
    {
        return view('livewire.auth.manage-role-permissions');
    }
}