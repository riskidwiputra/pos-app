<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Tambah Pembelian')]
class ManagePermissions extends Component
{
    public $roles;
    public $selectedRole;
    public $rolePermissions = [];
    public $menuPermissions;
    public $featurePermissions;
    public $activeTab = 'menus';

    public function mount()
    {
        $this->roles = Role::where('slug', '!=', 'super-admin')->get();
        $this->menuPermissions = Permission::where('type')->orderBy('order')->get()->groupBy('category');
        $this->featurePermissions = Permission::where('type')->get()->groupBy('category');
    }

    public function selectRole($roleId)
    {
        $this->selectedRole = Role::with('permissions')->find($roleId);
        $this->rolePermissions = $this->selectedRole->permissions->pluck('id')->toArray();
    }

    public function togglePermission($permissionId)
    {
        if (in_array($permissionId, $this->rolePermissions)) {
            $this->rolePermissions = array_diff($this->rolePermissions, [$permissionId]);
        } else {
            $this->rolePermissions[] = $permissionId;
        }
    }

    public function toggleAllInCategory($categoryIndex, $type)
    {
        $permissions = $type === 'menu' 
            ? $this->menuPermissions->values()[$categoryIndex] 
            : $this->featurePermissions->values()[$categoryIndex];
            
        $permissionIds = $permissions->pluck('id')->toArray();
        $allSelected = empty(array_diff($permissionIds, $this->rolePermissions));
        
        if ($allSelected) {
            // Uncheck all
            $this->rolePermissions = array_diff($this->rolePermissions, $permissionIds);
        } else {
            // Check all
            $this->rolePermissions = array_unique(array_merge($this->rolePermissions, $permissionIds));
        }
    }

    public function savePermissions()
    {
        if (!$this->selectedRole) {
            session()->flash('error', 'Pilih role terlebih dahulu');
            return;
        }

        $this->selectedRole->permissions()->sync($this->rolePermissions);
        
        session()->flash('success', 'Permissions berhasil diupdate untuk ' . $this->selectedRole->name);
        
        $this->selectRole($this->selectedRole->id);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.roles.manage-permissions');
    }
}