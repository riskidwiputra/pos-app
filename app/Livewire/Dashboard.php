<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Dashboard extends Component
{
    public $userRole;
    public $totalPermissions;
    public $menuAccess;
    public $menus;

    public function mount()
    {
        $this->userRole = auth()->user()->role->name;
        $this->totalPermissions = auth()->user()->role->permissions->count();
        $this->menuAccess = auth()->user()->getMenuPermissions()->count();
        $this->menus = auth()->user()->getMenuPermissions();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}