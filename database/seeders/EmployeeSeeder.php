<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $employees = [
            [
                'nama_lengkap'      => 'Budi Santoso',
                'no_telepon'        => '081234567890',
                'alamat'            => 'Jl. Kebon Jeruk No. 12, RT 003/RW 005, Kebon Jeruk, Jakarta Barat',
                'tanggal_lahir'     => '1990-03-15',
                'jenis_kelamin'     => 'Laki-laki',
                'posisi'            => 'Manajer Operasional',
                'tanggal_masuk'     => '2018-01-10',
                'gaji'              => 7500000.00,
                'status_pekerjaan'  => 'Aktif',
            ],
            [
                'nama_lengkap'      => 'Siti Rahayu',
                'no_telepon'        => '082198765432',
                'alamat'            => 'Jl. Raya Bekasi Timur No. 47, RT 002/RW 008, Jatinegara, Jakarta Timur',
                'tanggal_lahir'     => '1995-07-22',
                'jenis_kelamin'     => 'Perempuan',
                'posisi'            => 'Staff Kasir',
                'tanggal_masuk'     => '2020-05-01',
                'gaji'              => 3200000.00,
                'status_pekerjaan'  => 'Aktif',
            ],
            [
                'nama_lengkap'      => 'Agus Permana',
                'no_telepon'        => '085711223344',
                'alamat'            => 'Jl. Ciledug Raya Blok B No. 9, Pesanggrahan, Jakarta Selatan',
                'tanggal_lahir'     => '1988-11-05',
                'jenis_kelamin'     => 'Laki-laki',
                'posisi'            => 'Teknisi Percetakan',
                'tanggal_masuk'     => '2017-08-15',
                'gaji'              => 4500000.00,
                'status_pekerjaan'  => 'Aktif',
            ],
            [
                'nama_lengkap'      => 'Dewi Anggraini',
                'no_telepon'        => '087865554321',
                'alamat'            => 'Jl. Margonda Raya No. 88, Depok, Jawa Barat',
                'tanggal_lahir'     => '1997-02-18',
                'jenis_kelamin'     => 'Perempuan',
                'posisi'            => 'Staff Administrasi',
                'tanggal_masuk'     => '2021-03-01',
                'gaji'              => 3000000.00,
                'status_pekerjaan'  => 'Aktif',
            ],
            [
                'nama_lengkap'      => 'Rizky Firmansyah',
                'no_telepon'        => '081399887766',
                'alamat'            => 'Jl. Pondok Ungu Permai Blok D5 No. 3, Bekasi Utara, Kota Bekasi',
                'tanggal_lahir'     => '1993-09-30',
                'jenis_kelamin'     => 'Laki-laki',
                'posisi'            => 'Staff Gudang',
                'tanggal_masuk'     => '2019-11-20',
                'gaji'              => 3400000.00,
                'status_pekerjaan'  => 'Cuti',
            ],
            [
                'nama_lengkap'      => 'Nurhaliza Putri',
                'no_telepon'        => '089654321098',
                'alamat'            => 'Jl. Raya Bogor KM 32, Cimanggis, Depok, Jawa Barat',
                'tanggal_lahir'     => '1998-06-10',
                'jenis_kelamin'     => 'Perempuan',
                'posisi'            => 'Desainer Grafis',
                'tanggal_masuk'     => '2022-01-17',
                'gaji'              => 4000000.00,
                'status_pekerjaan'  => 'Aktif',
            ],
            [
                'nama_lengkap'      => 'Hendra Kusuma',
                'no_telepon'        => '081276543210',
                'alamat'            => 'Jl. Tanah Abang III No. 21, RT 001/RW 004, Tanah Abang, Jakarta Pusat',
                'tanggal_lahir'     => '1985-04-25',
                'jenis_kelamin'     => 'Laki-laki',
                'posisi'            => 'Supervisor Produksi',
                'tanggal_masuk'     => '2015-06-01',
                'gaji'              => 6000000.00,
                'status_pekerjaan'  => 'Tidak Aktif',
            ],
            [
                'nama_lengkap'      => 'Fitriani Hasanah',
                'no_telepon'        => '082334455667',
                'alamat'            => 'Jl. Serpong Raya No. 55, BSD City, Tangerang Selatan, Banten',
                'tanggal_lahir'     => '1996-12-03',
                'jenis_kelamin'     => 'Perempuan',
                'posisi'            => 'Staff Marketing',
                'tanggal_masuk'     => '2021-09-06',
                'gaji'              => 3800000.00,
                'status_pekerjaan'  => 'Aktif',
            ],
        ];

        $employees = array_map(fn($item) => array_merge($item, [
            'created_at' => $now,
            'updated_at' => $now,
        ]), $employees);

        Employee::insert($employees);
    }
}
