<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Supplier::insert([
            [
                'nama_supplier' => 'CV Sumber Rejeki',
                'alamat' => 'Jl. Gatot Subroto No. 123, Medan Sunggal, Kota Medan, Sumatera Utara',
                'no_telepon' => '081362789001',
                'email' => 'sumberrejeki@gmail.com',
            ],
            [
                'nama_supplier' => 'PT Maju Jaya Abadi',
                'alamat' => 'Jl. Setia Budi No. 45, Medan Selayang, Kota Medan, Sumatera Utara',
                'no_telepon' => '082173456789',
                'email' => 'majujayaabadi@outlook.com',
            ],
            [
                'nama_supplier' => 'UD Berkah Mandiri',
                'alamat' => 'Jl. Kapten Muslim No. 78, Medan Helvetia, Kota Medan, Sumatera Utara',
                'no_telepon' => '081265432198',
                'email' => null,
            ],
            [
                'nama_supplier' => 'CV Karya Sejahtera',
                'alamat' => 'Jl. Asia No. 56, Medan Area, Kota Medan, Sumatera Utara',
                'no_telepon' => '085261234567',
                'email' => 'karyasejahtera@gmail.com',
            ],
            [
                'nama_supplier' => 'Toko Mitra Usaha',
                'alamat' => 'Jl. Marelan Raya No. 90, Medan Marelan, Kota Medan, Sumatera Utara',
                'no_telepon' => '083812345678',
                'email' => null,
            ],
            [
                'nama_supplier' => 'UD Jaya Bersama',
                'alamat' => 'Jl. Imam Bonjol No. 21, Kisaran Timur, Kabupaten Asahan, Sumatera Utara',
                'no_telepon' => '081370001122',
                'email' => 'jayabersama@gmail.com',
            ],
            [
                'nama_supplier' => 'CV Sinar Abadi',
                'alamat' => 'Jl. Lintas Sumatera No. 10, Kisaran Barat, Kabupaten Asahan, Sumatera Utara',
                'no_telepon' => '082274556677',
                'email' => 'sinarabadi@yahoo.com',
            ],
            [
                'nama_supplier' => 'PT Andalas Supplier',
                'alamat' => 'Jl. Diponegoro No. 33, Kisaran Kota, Kabupaten Asahan, Sumatera Utara',
                'no_telepon' => '081398765432',
                'email' => 'andalassupplier@gmail.com',
            ],
            [
                'nama_supplier' => 'UD Makmur Sentosa',
                'alamat' => 'Jl. Kartini No. 15, Kisaran Timur, Kabupaten Asahan, Sumatera Utara',
                'no_telepon' => '085370998877',
                'email' => null,
            ],
            [
                'nama_supplier' => 'CV Berkah Jaya',
                'alamat' => 'Jl. Teuku Umar No. 88, Medan Polonia, Kota Medan, Sumatera Utara',
                'no_telepon' => '082211223344',
                'email' => 'berkahjaya@gmail.com',
            ],
        ]);
    }
}
