<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class MenuManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;
    
    public $permissionId;
    public $name;
    public $slug;
    public $module;
    public $type = 'menu';
    public $icon;
    public $url;
    public $parent_id;
    public $order = 0;
    public $description;
    public $selectedRoles = [];
    
    public $deleteId;

    protected $queryString = ['search', 'perPage'];

    #[Layout('layouts.app')]
    #[Title('Detail Pembelian')]
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions,slug,' . $this->permissionId,
            'module' => 'required|string|max:255',
            'type' => 'required|in:menu,feature',
            'icon' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:permissions,id',
            'order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
        $this->resetValidation();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->slug = $permission->slug;
        $this->module = $permission->module;
        $this->type = $permission->type;
        $this->icon = $permission->icon;
        $this->url = $permission->url;
        $this->parent_id = $permission->parent_id;
        $this->order = $permission->order;
        $this->description = $permission->description;
        $this->selectedRoles = $permission->roles->pluck('id')->toArray();
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $permission = Permission::updateOrCreate(
            ['id' => $this->permissionId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'module' => $this->module,
                'type' => $this->type,
                'icon' => $this->icon,
                'url' => $this->url,
                'parent_id' => $this->parent_id,
                'order' => $this->order,
                'description' => $this->description,
            ]
        );

        // Sync roles
        if (!empty($this->selectedRoles)) {
            $permission->roles()->sync($this->selectedRoles);
        } else {
            $permission->roles()->detach();
        }

        session()->flash('message', $this->permissionId ? 'Menu berhasil diperbarui!' : 'Menu berhasil ditambahkan!');
        
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $permission = Permission::findOrFail($this->deleteId);
        $permission->delete();

        session()->flash('message', 'Menu berhasil dihapus!');
        
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    private function resetFields()
    {
        $this->permissionId = null;
        $this->name = '';
        $this->slug = '';
        $this->module = '';
        $this->type = 'menu';
        $this->icon = '';
        $this->url = '';
        $this->parent_id = null;
        $this->order = 0;
        $this->description = '';
        $this->selectedRoles = [];
    }

    public function render()
    {
        $permissions = Permission::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('module', 'like', '%' . $this->search . '%')
                    ->orWhere('url', 'like', '%' . $this->search . '%');
            })
            ->with('roles')
            ->orderBy('module')
            ->orderBy('order')
            ->paginate($this->perPage);

        $roles = Role::where('is_active', true)->get();
        $parentMenus = Permission::where('type', 'menu')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        return view('livewire.setting.menu-management', [
            'permissions' => $permissions,
            'roles' => $roles,
            'parentMenus' => $parentMenus,
        ]);
    }
}