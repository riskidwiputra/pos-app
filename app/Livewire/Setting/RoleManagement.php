<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class RoleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;
    
    public $roleId;
    public $name;
    public $slug;
    public $default_module;
    public $description;
    public $is_active = true;
    
    public $deleteId;

    protected $queryString = ['search'];

    #[Layout('layouts.app')]
    #[Title('Detail Pembelian')]
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $this->roleId,
            'default_module' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
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
        $role = Role::findOrFail($id);
        
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->slug = $role->slug;
        $this->default_module = $role->default_module;
        $this->description = $role->description;
        $this->is_active = $role->is_active;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        Role::updateOrCreate(
            ['id' => $this->roleId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'default_module' => $this->default_module,
                'description' => $this->description,
                'is_active' => $this->is_active,
            ]
        );

        session()->flash('message', $this->roleId ? 'Role berhasil diperbarui!' : 'Role berhasil ditambahkan!');
        
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $role = Role::findOrFail($this->deleteId);
        
        // Check if role has users
        if ($role->users()->count() > 0) {
            session()->flash('error', 'Role tidak dapat dihapus karena masih digunakan oleh user!');
            $this->showDeleteModal = false;
            return;
        }
        
        $role->delete();
        session()->flash('message', 'Role berhasil dihapus!');
        
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
        $this->roleId = null;
        $this->name = '';
        $this->slug = '';
        $this->default_module = '';
        $this->description = '';
        $this->is_active = true;
    }

    public function render()
    {
        $roles = Role::query()
            ->withCount(['permissions', 'users'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.setting.role-management', [
            'roles' => $roles,
        ]);
    }
}