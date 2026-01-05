<?php

namespace App\Livewire\Setting;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Detail Pembelian')]
class PermissionManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterModule = '';
    public $filterType = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;
    
    public $permissionId;
    public $name;
    public $slug;
    public $module;
    public $type = 'feature';
    public $description;
    
    public $deleteId;

    protected $queryString = ['search', 'filterModule', 'filterType'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions,slug,' . $this->permissionId,
            'module' => 'required|string|max:255',
            'type' => 'required|in:menu,feature',
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
        $this->description = $permission->description;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        Permission::updateOrCreate(
            ['id' => $this->permissionId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'module' => $this->module,
                'type' => $this->type,
                'description' => $this->description,
            ]
        );

        session()->flash('message', $this->permissionId ? 'Permission berhasil diperbarui!' : 'Permission berhasil ditambahkan!');
        
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

        session()->flash('message', 'Permission berhasil dihapus!');
        
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
        $this->type = 'feature';
        $this->description = '';
    }

    public function render()
    {
        $permissions = Permission::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('module', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterModule, function ($query) {
                $query->where('module', $this->filterModule);
            })
            ->when($this->filterType, function ($query) {
                $query->where('type', $this->filterType);
            })
            ->orderBy('module')
            ->orderBy('name')
            ->paginate($this->perPage);

        $modules = Permission::distinct()->pluck('module');

        return view('livewire.setting.permission-management', [
            'permissions' => $permissions,
            'modules' => $modules,
        ]);
    }
}