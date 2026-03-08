<?php

namespace App\Livewire\Print;

use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.print')]
#[Title('Cetak Nota')]
class PrintNota extends Component
{
    public $sale;

    public function mount($sale)
    {
    
        $this->sale = Sale::with(['items.product', 'users'])->findOrFail($sale);

    }

    public function render()
    {
        return view('livewire.print.print-nota');
    }
}