<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit Supplier')]

class UpdateSupplier extends Component
{

    public Supplier $supplier;
    public $supplier_id;
    public $nama_supplier = '';
    public $alamat = '';
    public $no_telepon = '';
    public $email = '';

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

    public function mount($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplier = $supplier;
        $this->nama_supplier = $supplier->nama_supplier;
        $this->alamat = $supplier->alamat;
        $this->no_telepon = $supplier->no_telepon;
        $this->email = $supplier->email;
    }

    public function update()
    {
        $this->validate();

        $this->supplier->update([
            'nama_supplier' => $this->nama_supplier,
            'alamat' => $this->alamat,
            'no_telepon' => $this->no_telepon,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Supplier berhasil diupdate!');
        return redirect()->route('supplier.index');
    }

   
    public function render()
    {
        return view('livewire.supplier.update-supplier');
    }
}
