<?php

namespace App\Livewire\Unit;

use App\Models\Unit;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit Unit')]

class UpdateUnit extends Component
{
    public Unit $unit;
    public $unit_id;
    public $nama_unit = '';
    public $singkatan = '';

    protected $rules = [
        'nama_unit' => 'required|string|max:255',
        'singkatan' => 'required|string',
    ];

    protected $messages = [
        'nama_unit.required' => 'Nama unit wajib diisi',
        'singkatan.required' => 'Alamat wajib diisi',
    ];

    public function mount($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unit = $unit;
        $this->nama_unit = $unit->nama_unit;
        $this->singkatan = $unit->singkatan;
    }

    public function update()
    {
        $this->validate();

        $this->unit->update([
            'nama_unit' => $this->nama_unit,
            'singkatan' => $this->singkatan,
        ]);

        session()->flash('message', 'Unit berhasil diupdate!');
        return redirect()->route('unit.index');
    }
    
    public function render()
    {
        return view('livewire.unit.update-unit');
    }
}
