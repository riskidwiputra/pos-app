<?php

namespace App\Livewire\Setting;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Detail Pembelian')]
class UserRoleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    
    public $userId;
    public $selectedRoleId;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $userId;
        $this->selectedRoleId = $user->role_id;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->userId = null;
        $this->selectedRoleId = null;
    }

    public function updateRole()
    {
        $this->validate([
            'selectedRoleId' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update(['role_id' => $this->selectedRoleId]);

        session()->flash('message', 'Role user berhasil diperbarui!');
        
        $this->closeModal();
    }
    public function render()
    {
         $users = User::query()
            ->with('role')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        $roles = Role::where('is_active', true)->get();

        return view('livewire.setting.user-role-management', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
