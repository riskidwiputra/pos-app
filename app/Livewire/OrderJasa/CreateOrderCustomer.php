<?php

namespace App\Livewire\OrderJasa;

use App\Models\ServiceOrder;
use App\Models\Category;
use App\Models\ServiceCategory;
use App\Models\SubCategory;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

#[Layout('layouts.app')]
#[Title('Tambah Pesanan Saya')]
class CreateOrderCustomer extends Component
{
    use WithFileUploads;

    // Customer Info
    public $customer_name = '';
    public $customer_phone = '';
    public $customer_email = '';

    // Order Details
    public $category_id = '';
    public $order_title = '';
    public $order_description = '';
    public $quantity = 1;
    public $unit = 'pcs';


    // Files & Notes
    public $design_file;
    public $notes = '';
    public $kategori ;

    // Status
    public $status = 'pending';


    public function mount()
    {
        $this->kategori =  ServiceCategory::orderBy('nama_jasa')->get();
    }

    #[Computed]
    public function categories()
    {
        return ServiceCategory::orderBy('nama_jasa')->get();
    }

    

    public function save()
    {
        $this->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'category_id' => 'required|exists:service_categories,id',
            'order_title' => 'required|string|max:255',
            'order_description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'design_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar,ai,psd,cdr|max:10240',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,approved,in_progress,completed',
        ], [
            'customer_name.required' => 'Nama customer wajib diisi',
            'customer_phone.required' => 'Nomor telepon wajib diisi',
            'customer_email.email' => 'Format email tidak valid',
            'category_id.required' => 'Kategori jasa wajib dipilih',
            'category_id.exists' => 'Kategori jasa tidak valid',
            'order_title.required' => 'Judul order wajib diisi',
            'order_description.required' => 'Deskripsi order wajib diisi',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.min' => 'Jumlah minimal 1',
            'unit.required' => 'Satuan wajib dipilih',
            'design_file.mimes' => 'File harus berformat: pdf, jpg, jpeg, png, zip, rar, ai, psd, cdr',
            'design_file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $designFilePath = null;
            
            if ($this->design_file) {
                $designFilePath = $this->design_file->store('service-orders', 'public');
            }

            // Cari user berdasarkan email atau buat guest user
            $userId = Auth::id(); // Default ke user yang sedang login (admin)
            
            if ($this->customer_email) {
                $customer = User::where('email', $this->customer_email)->first();
                if ($customer) {
                    $userId = $customer->id;
                }
            }
            $status = 'pending';
            $statusPembayaran = 'belum_lunas';
          
            $orderDate = Carbon::now();
            $totalPrice = ServiceCategory::find($this->category_id)->harga_maksimal * $this->quantity;

            ServiceOrder::create([
                'user_id' => $userId,
                'category_id' => $this->category_id,
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'customer_email' => $this->customer_email,
                'order_title' => $this->order_title,
                'order_description' => $this->order_description,
                'quantity' => $this->quantity,
                'unit' => $this->unit,
                'order_date' => $orderDate,
                'total_price' => $totalPrice,
                'design_file' => $designFilePath,
                'notes' => $this->notes,
                'status' => $this->status,
                'status_pembayaran' => $statusPembayaran,
                'created_by' => Auth::id(),
            ]);

            session()->flash('success', 'Order jasa berhasil ditambahkan');
            return redirect()->route('order-jasa.riwayat-pesanan');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            dd($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.order-jasa.create-customer-order-jasa');
    }
}