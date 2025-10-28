<?php

namespace App\Livewire\Unit;

use App\Helpers\CodeGenerator;
use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;


#[Layout('layouts.app')]
#[Title('Tambah Unit')]


class CreateUnit extends Component
{


    public $kode_unit = '';

    #[Validate('required|string')]
    public $nama_unit = '';
     #[Validate('required|string')]
    public $singkatan = '';

    public $message;

    protected $rules = [
        'nama_unit' => 'required|string',
        'singkatan' => 'required|string',
    ];

    protected $messages = [
        'nama_unit.required' => 'Nama unit wajib diisi',
        'singkatan.required' => 'Singkatan wajib diisi',
    ];

    public function store()
    {
     
        $this->validate();
        $kode_unit = CodeGenerator::generate(unit::class, 'kode_unit', 2);

        Unit::create([
            'kode_unit' => $kode_unit,
            'nama_unit' => $this->nama_unit,
            'singkatan' => $this->singkatan,
        ]);
        session()->flash('message', 'Unit berhasil ditambahkan!');
        return redirect()->route('unit.index');
    }

    public function render()
    {
        return view('livewire.unit.create-unit');
    }
}
