<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Customer')]
class IndexCustomer extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $customerId = null;
    public $message = '';
    public $filterRole = '';

    protected $updatesQueryString = ['search', 'perPage', 'filterRole'];
    protected $paginationTheme = 'tailwind';

    public function customers()
    {
        return User::customers()
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
        $this->customerId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->customerId) {
            User::findOrFail($this->customerId)->delete();
            session()->flash('message', 'Customer berhasil dihapus!');
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->customerId = null;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterRole = '';
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.customer.index-customer', [
            'customers' => $this->customers(),
            'roles' => Role::where('level', 2)->where('is_active', true)->get(),
        ]);
    }
}