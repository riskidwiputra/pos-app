<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Karyawan')]
class IndexEmployee extends Component
{
     use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $employeeId = null;
    public $message = '';
    public $filterStatus = '';

    protected $updatesQueryString = ['search', 'perPage', 'filterStatus', 'filterPosisi'];
    protected $paginationTheme = 'tailwind';

    public function employees()
    {
        return Employee::where(function($query) {
            $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                  ->orWhere('no_telepon', 'like', '%' . $this->search . '%')
                  ->orWhere('posisi', 'like', '%' . $this->search . '%');
        })
        ->when($this->filterStatus, function($query) {
            $query->where('status_pekerjaan', $this->filterStatus);
        })
        ->latest()
        ->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->employeeId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->employeeId) {
            Employee::findOrFail($this->employeeId)->delete();
            // $this->message = 'Karyawan berhasil dihapus!';
            session()->flash('message', 'Karyawan berhasil dihapus!');
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->employeeId = null;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterStatus = '';
        $this->resetPage();
    }
    
    
    public function render()
    {
        return view('livewire.employee.index-employee',[
            'employees' => $this->employees(),
            'posisiList' => Employee::distinct()->pluck('posisi'),
        ]);
    }
}
