<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\PurchasePayment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Detail Pembelian')]
class DetailPurchase extends Component
{
    public Purchase $purchase;
    public $showPaymentModal = false;
    public $message = '';
    
    // Payment Form
    public $tanggal_bayar = '';
    public $jumlah_bayar = 0;
    public $metode_bayar = 'Cash';
    public $catatan_pembayaran = '';

    protected $rules = [
        'tanggal_bayar' => 'required|date',
        'jumlah_bayar' => 'required|numeric|min:1',
        'metode_bayar' => 'required|in:Cash,Transfer,E-Wallet',
    ];

    protected $messages = [
        'tanggal_bayar.required' => 'Tanggal pembayaran wajib diisi',
        'jumlah_bayar.required' => 'Jumlah pembayaran wajib diisi',
        'jumlah_bayar.min' => 'Jumlah pembayaran minimal 1',
        'metode_bayar.required' => 'Metode pembayaran wajib dipilih',
    ];

    public function mount($id)
    {
        $this->purchase = Purchase::with(['supplier', 'items.product.unit'])
                                    ->findOrFail($id);
        $this->tanggal_bayar = Carbon::now()->format('Y-m-d');
    }

    public function openPaymentModal()
    {
        if ($this->purchase->status_pembayaran === 'Lunas') {
            $this->message = 'Pembelian sudah lunas!';
            return;
        }
        
        $this->showPaymentModal = true;
        $this->jumlah_bayar = $this->purchase->sisa_tagihan;
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
        $this->reset(['tanggal_bayar', 'jumlah_bayar', 'metode_bayar', 'catatan_pembayaran']);
        $this->tanggal_bayar = Carbon::now()->format('Y-m-d');
    }

    

    public function render()
    {
        return view('livewire.purchase.detail-purchase');
    }
}