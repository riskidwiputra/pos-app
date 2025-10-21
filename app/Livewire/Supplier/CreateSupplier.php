<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Tambah Supplier')]

class CreateSupplier extends Component
{
    #[Validate('required|string|max:255')]
    public $nama_supplier = '';
    #[Validate('required|string')]
    public $alamat = '';
    #[Validate('required|string|max:20')]
    public $no_telepon = '';
    #[Validate('nullable|email')]
    public $email = '';

    public $message;


    protected $rules = [
        'nama_supplier' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_telepon' => 'required|string|max:20',
        'email' => 'nullable|email',
    ];

    protected $messages = [
        'nama_supplier.required' => 'Nama supplier wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'no_telepon.required' => 'No telepon wajib diisi',
        'email.email' => 'Format email tidak valid',
    ];

    public function store()
    {
     
        $this->validate();



         Supplier::create([
            'nama_supplier' => $this->nama_supplier,
            'alamat' => $this->alamat,
            'no_telepon' => $this->no_telepon,
            'email' => $this->email,
        ]);

    
        session()->flash('message', 'Supplier berhasil ditambahkan!');
        return redirect()->route('supplier.index');
    }

    public function render()
    {
        return view('livewire.supplier.create-supplier');
    }
}
