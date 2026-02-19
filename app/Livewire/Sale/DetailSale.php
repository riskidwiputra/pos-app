<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Detail Penjualan')]
class DetailSale extends Component
{
    public Sale $sale;
    public $message = '';

    public function mount($id)
    {
        $this->sale = Sale::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.sale.detail-sale');
    }
}