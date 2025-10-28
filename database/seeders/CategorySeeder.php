<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = [
            ['kode_kategori' => '01', 'nama_kategori' => 'Alat Tulis', 'deskripsi' => 'Kategori untuk alat tulis kantor'],
            ['kode_kategori' => '02', 'nama_kategori' => 'Kertas & Buku', 'deskripsi' => 'Kategori untuk kertas dan buku'],
            ['kode_kategori' => '03', 'nama_kategori' => 'Penghapus & Korektor', 'deskripsi' => 'Kategori untuk penghapus dan korektor'],
            ['kode_kategori' => '04', 'nama_kategori' => 'Perlengkapan Arsip', 'deskripsi' => 'Kategori untuk perlengkapan arsip'],
            ['kode_kategori' => '05', 'nama_kategori' => 'Perlengkapan Meja', 'deskripsi' => 'Kategori untuk perlengkapan meja kerja'],
            ['kode_kategori' => '06', 'nama_kategori' => 'Printer & Tinta', 'deskripsi' => 'Kategori untuk printer dan tinta'],
            ['kode_kategori' => '07', 'nama_kategori' => 'Percetakan Umum', 'deskripsi' => 'Kategori untuk layanan percetakan umum'],
            ['kode_kategori' => '08', 'nama_kategori' => 'Percetakan Digital', 'deskripsi' => 'Kategori untuk layanan percetakan digital'],
            ['kode_kategori' => '09', 'nama_kategori' => 'Finishing Percetakan', 'deskripsi' => 'Kategori untuk finishing dan laminating'],
            ['kode_kategori' => '10', 'nama_kategori' => 'Promosi & Souvenir', 'deskripsi' => 'Kategori untuk produk promosi dan souvenir'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
