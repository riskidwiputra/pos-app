<?php

namespace App\Livewire\Employee;

use Livewire\Component;

use App\Models\Employee;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit Karyawan')]
class UpdateEmployee extends Component
{
    public Employee $employee;
    public $nama_lengkap = '';
    public $no_telepon = '';
    public $alamat = '';
    public $tanggal_lahir = '';
    public $jenis_kelamin = '';
    public $posisi = '';
    public $tanggal_masuk = '';
    public $gaji = '';
    public $status_pekerjaan = '';

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'tanggal_lahir' => 'required|date|before:today',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'posisi' => 'required|string|max:100',
        'tanggal_masuk' => 'required|date',
        'gaji' => 'required|numeric|min:0',
        'status_pekerjaan' => 'required|in:Aktif,Tidak Aktif,Cuti',
    ];

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
        'status_pekerjaan.required' => 'Status pekerjaan wajib dipilih',
    ];

    public function mount($id)
    {
        $employee = Employee::findOrFail($id);
        $this->employee = $employee;
        $this->nama_lengkap = $employee->nama_lengkap;
        $this->no_telepon = $employee->no_telepon;
        $this->alamat = $employee->alamat;
        $this->tanggal_lahir = $employee->tanggal_lahir->format('Y-m-d');
        $this->jenis_kelamin = $employee->jenis_kelamin;
        $this->posisi = $employee->posisi;
        $this->tanggal_masuk = $employee->tanggal_masuk->format('Y-m-d');
        $this->gaji = $employee->gaji;
        $this->status_pekerjaan = $employee->status_pekerjaan;
    }

    public function update()
    {
        $this->validate();

        $this->employee->update([
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

        session()->flash('message', 'Data karyawan berhasil diupdate!');
        return redirect()->route('karyawan.index');
    }
    public function render()
    {
        return view('livewire.employee.update-employee');
    }
}
