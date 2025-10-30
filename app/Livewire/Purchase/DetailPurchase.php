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
        $this->purchase = Purchase::with(['supplier', 'items.product.unit', 'payments'])
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

    public function addPayment()
    {
        $this->validate();

        // Validasi jumlah bayar tidak melebihi sisa tagihan
        if ($this->jumlah_bayar > $this->purchase->sisa_tagihan) {
            $this->addError('jumlah_bayar', 'Jumlah pembayaran melebihi sisa tagihan!');
            return;
        }

        DB::beginTransaction();
        
        try {
            // Create payment record
            PurchasePayment::create([
                'purchase_id' => $this->purchase->id,
                'tanggal_bayar' => $this->tanggal_bayar,
                'jumlah_bayar' => $this->jumlah_bayar,
                'metode_bayar' => $this->metode_bayar,
                'catatan' => $this->catatan_pembayaran,
            ]);
            
            // Update purchase
            $newJumlahDibayar = $this->purchase->jumlah_dibayar + $this->jumlah_bayar;
            $newSisaTagihan = $this->purchase->total_harga - $newJumlahDibayar;
            $newStatus = $newSisaTagihan <= 0 ? 'Lunas' : 'Belum Lunas';
            
            $this->purchase->update([
                'jumlah_dibayar' => $newJumlahDibayar,
                'sisa_tagihan' => $newSisaTagihan,
                'status_pembayaran' => $newStatus,
            ]);
            
            DB::commit();
            
            // Refresh purchase data
            $this->purchase = Purchase::with(['supplier', 'items.product.unit', 'payments'])
                                        ->findOrFail($this->purchase->id);
            
            $this->message = 'Pembayaran berhasil ditambahkan!';
            $this->closePaymentModal();
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('jumlah_bayar', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deletePayment($paymentId)
    {
        DB::beginTransaction();
        
        try {
            $payment = PurchasePayment::findOrFail($paymentId);
            
            // Update purchase
            $newJumlahDibayar = $this->purchase->jumlah_dibayar - $payment->jumlah_bayar;
            $newSisaTagihan = $this->purchase->total_harga - $newJumlahDibayar;
            $newStatus = $newSisaTagihan <= 0 ? 'Lunas' : 'Belum Lunas';
            
            $this->purchase->update([
                'jumlah_dibayar' => $newJumlahDibayar,
                'sisa_tagihan' => $newSisaTagihan,
                'status_pembayaran' => $newStatus,
            ]);
            
            $payment->delete();
            
            DB::commit();
            
            // Refresh purchase data
            $this->purchase = Purchase::with(['supplier', 'items.product.unit', 'payments'])
                                        ->findOrFail($this->purchase->id);
            
            $this->message = 'Pembayaran berhasil dihapus!';
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->message = 'Terjadi kesalahan: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.purchase.detail-purchase');
    }
}