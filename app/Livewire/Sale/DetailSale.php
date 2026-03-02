<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
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
    
    public function printInvoice()
    {
        $sale = Sale::with(['items.product', 'users'])
            ->findOrFail($this->sale->id);

        $pdf = Pdf::loadView('livewire.print.invoice', [
            'sale' => $sale,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'Invoice-' . $sale->invoice_number . '.pdf');
    }

    public function printNota(){
        $this->dispatch('print-nota', saleId: $this->sale->id);
    }
    public function render()
    {
        return view('livewire.sale.detail-sale');
    }
}