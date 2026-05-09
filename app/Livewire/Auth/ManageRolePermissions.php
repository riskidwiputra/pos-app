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
    public ?int $selectedRoleId = null;
    public array $rolePermissions = [];
    public ?string $flashSuccess = null;
    public ?string $flashError = null;

    #[Computed]
    public function roles()
    {
        return Role::where('level', 1)
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function selectedRole()
    {
        if (!$this->selectedRoleId) return null;
        return Role::find($this->selectedRoleId);
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

    public function selectRole(int $roleId): void
    {
        $this->selectedRoleId = $roleId;
        $this->flashSuccess = null;
        $this->flashError = null;

        $role = Role::with('permissions')->find($roleId);
        $this->rolePermissions = $role->permissions->pluck('id')->toArray();
    }

    public function togglePermission(int $permissionId): void
    {
        if (in_array($permissionId, $this->rolePermissions)) {
            $this->rolePermissions = array_values(
                array_diff($this->rolePermissions, [$permissionId])
            );
        } else {
            $this->rolePermissions[] = $permissionId;
        }
    }

    public function clearSelection(): void
    {
        $this->selectedRoleId = null;
        $this->rolePermissions = [];
        $this->flashSuccess = null;
        $this->flashError = null;
    }

    public function savePermissions(): void
    {
        if (!$this->selectedRoleId) {
            $this->flashError = 'Pilih role terlebih dahulu';
            return;
        }

        $role = Role::find($this->selectedRoleId);
        $role->permissions()->sync($this->rolePermissions);

        $this->flashSuccess = 'Hak akses berhasil diperbarui untuk ' . $role->name;
    }

    public function render()
    {
        return view('livewire.auth.manage-role-permissions');
    }
}