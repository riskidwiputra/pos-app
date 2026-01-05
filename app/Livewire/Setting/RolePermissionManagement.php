<?php

namespace App\Livewire\Setting;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;
use App\Models\Permission;

#[Layout('layouts.app')]
#[Title('Detail Pembelian')]
class RolePermissionManagement extends Component
{
     use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showEditModal = false;
    public $assignAll = false;
    
    public $selectedRoleId;
    public $selectedPermissions = [];
    public $groupedPermissions = [];

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openEditModal($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);
        
        $this->selectedRoleId = $roleId;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->loadGroupedPermissions();
        
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->selectedRoleId = null;
        $this->selectedPermissions = [];
        $this->groupedPermissions = [];
        $this->assignAll = false;
    }

    public function toggleAssignAll()
    {
        $this->assignAll = !$this->assignAll;
        
        if ($this->assignAll) {
            $this->selectedPermissions = Permission::where('is_active', true)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedPermissions = [];
        }
    }

    public function savePermissions()
    {
        $role = Role::findOrFail($this->selectedRoleId);
        $role->permissions()->sync($this->selectedPermissions);

        session()->flash('message', 'Permission role berhasil diperbarui!');
        
        $this->closeEditModal();
    }

    private function loadGroupedPermissions()
    {
        $this->groupedPermissions = Permission::where('is_active', true)
            ->orderBy('module')
            ->orderBy('order')
            ->get()
            ->groupBy('module');
    }
    public function render()
    {
        $roles = Role::query()
            ->withCount('permissions')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.setting.role-permission-management', [
            'roles' => $roles,
        ]);
       
    }
}
