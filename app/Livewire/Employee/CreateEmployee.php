<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Karyawan')]
class CreateEmployee extends Component
{
    #[Validate('required|string|max:255')]
    public $nama_lengkap = '';
    
    #[Validate('required|string|max:20')]
    public $no_telepon = '';
    
    #[Validate('required|string')]
    public $alamat = '';
    
    #[Validate('required|date|before:today')]
    public $tanggal_lahir = '';
    
    #[Validate('required|in:Laki-laki,Perempuan')]
    public $jenis_kelamin = '';
    
    #[Validate('required|string|max:100')]
    public $posisi = '';
    
    #[Validate('required|date')]
    public $tanggal_masuk = '';
    
    #[Validate('required|numeric|min:0')]
    public $gaji = '';
    
    #[Validate('required|in:Aktif,Tidak Aktif,Cuti')]
    public $status_pekerjaan = 'Aktif';

    public $message;

    protected $messages = [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi',
        'no_telepon.required' => 'No telepon wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
        'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        'posisi.required' => 'Posisi wajib diisi',
        'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
        'gaji.required' => 'Gaji wajib diisi',
        'gaji.numeric' => 'Gaji harus berupa angka',
        'gaji.min' => 'Gaji tidak boleh negatif',
        'status_pekerjaan.required' => 'Status pekerjaan wajib dipilih',
    ];

    public function store()
    {
        $this->validate();

        Employee::create([
            'nama_lengkap' => $this->nama_lengkap,
            'no_telepon' => $this->no_telepon,
            'alamat' => $this->alamat,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'posisi' => $this->posisi,
            'tanggal_masuk' => $this->tanggal_masuk,
            'gaji' => $this->gaji,
            'status_pekerjaan' => $this->status_pekerjaan,
        ]);

        session()->flash('message', 'Karyawan berhasil ditambahkan!');
        return redirect()->route('karyawan.index');
    }

    
    public function render()
    {
        return view('livewire.employee.create-employee',);
    }
}
