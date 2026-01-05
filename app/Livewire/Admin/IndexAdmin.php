<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Admin')]
class IndexAdmin extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $adminId = null;
    public $message = '';
    public $filterRole = '';

    protected $updatesQueryString = ['search', 'perPage', 'filterRole'];
    protected $paginationTheme = 'tailwind';

    public function admins()
    {
        return User::admins()
            ->with('role')
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterRole, function($query) {
                $query->where('role_id', $this->filterRole);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingFilterRole() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->adminId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->adminId) {
            User::findOrFail($this->adminId)->delete();
            session()->flash('message', 'Admin berhasil dihapus!');
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->adminId = null;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterRole = '';
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.admin.index-admin', [
            'admins' => $this->admins(),
            'roles' => Role::where('level', 1)->where('is_active', true)->get(),
        ]);
    }
}