<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Alat Tulis - Category 1
            // Pulpen - SubCategory 1
            ['category_id' => 1, 'sub_category_id' => 1, 'unit_id' => 1, 'kode_produk' => 'ATK-01-001', 'nama_produk' => 'Pulpen Standard Hitam', 'deskripsi' => 'Pulpen warna hitam untuk kebutuhan sehari-hari', 'harga_jual' => 2500.00, 'stok_tersedia' => 500, 'stok_minimum' => 50, 'barcode_product' => '8991234560001', 'status_product' => 'Tersedia'],
            ['category_id' => 1, 'sub_category_id' => 1, 'unit_id' => 1, 'kode_produk' => 'ATK-01-002', 'nama_produk' => 'Pulpen Standard Biru', 'deskripsi' => 'Pulpen warna biru untuk kebutuhan sehari-hari', 'harga_jual' => 2500.00, 'stok_tersedia' => 450, 'stok_minimum' => 50, 'barcode_product' => '8991234560002', 'status_product' => 'Tersedia'],
            ['category_id' => 1, 'sub_category_id' => 1, 'unit_id' => 2, 'kode_produk' => 'ATK-01-003', 'nama_produk' => 'Pulpen Gel 0.5mm (Box isi 12)', 'deskripsi' => 'Pulpen gel berkualitas dalam box isi 12 pcs', 'harga_jual' => 35000.00, 'stok_tersedia' => 80, 'stok_minimum' => 10, 'barcode_product' => '8991234560003', 'status_product' => 'Tersedia'],

            // Pensil - SubCategory 2
            ['category_id' => 1, 'sub_category_id' => 2, 'unit_id' => 1, 'kode_produk' => 'ATK-01-004', 'nama_produk' => 'Pensil 2B', 'deskripsi' => 'Pensil standar 2B untuk menulis', 'harga_jual' => 2000.00, 'stok_tersedia' => 600, 'stok_minimum' => 100, 'barcode_product' => '8991234560004', 'status_product' => 'Tersedia'],
            ['category_id' => 1, 'sub_category_id' => 2, 'unit_id' => 2, 'kode_produk' => 'ATK-01-005', 'nama_produk' => 'Pensil HB (Box isi 12)', 'deskripsi' => 'Pensil HB dalam box isi 12 pcs', 'harga_jual' => 25000.00, 'stok_tersedia' => 70, 'stok_minimum' => 15, 'barcode_product' => '8991234560005', 'status_product' => 'Tersedia'],

            // Spidol - SubCategory 3
            ['category_id' => 1, 'sub_category_id' => 3, 'unit_id' => 1, 'kode_produk' => 'ATK-01-006', 'nama_produk' => 'Spidol Permanent Hitam', 'deskripsi' => 'Spidol permanent warna hitam', 'harga_jual' => 8500.00, 'stok_tersedia' => 200, 'stok_minimum' => 30, 'barcode_product' => '8991234560006', 'status_product' => 'Tersedia'],
            ['category_id' => 1, 'sub_category_id' => 3, 'unit_id' => 9, 'kode_produk' => 'ATK-01-007', 'nama_produk' => 'Spidol Warna (Set 12 warna)', 'deskripsi' => 'Set spidol dengan 12 warna berbeda', 'harga_jual' => 35000.00, 'stok_tersedia' => 100, 'stok_minimum' => 20, 'barcode_product' => '8991234560007', 'status_product' => 'Tersedia'],

            // Stabilo/Highlighter - SubCategory 4
            ['category_id' => 1, 'sub_category_id' => 4, 'unit_id' => 1, 'kode_produk' => 'ATK-01-008', 'nama_produk' => 'Stabilo Kuning', 'deskripsi' => 'Stabilo/Highlighter warna kuning', 'harga_jual' => 6000.00, 'stok_tersedia' => 250, 'stok_minimum' => 40, 'barcode_product' => '8991234560008', 'status_product' => 'Tersedia'],
            ['category_id' => 1, 'sub_category_id' => 4, 'unit_id' => 9, 'kode_produk' => 'ATK-01-009', 'nama_produk' => 'Stabilo Set 4 Warna', 'deskripsi' => 'Set stabilo 4 warna (kuning, hijau, pink, orange)', 'harga_jual' => 22000.00, 'stok_tersedia' => 120, 'stok_minimum' => 25, 'barcode_product' => '8991234560009', 'status_product' => 'Tersedia'],

            // Pensil Warna - SubCategory 5
            ['category_id' => 1, 'sub_category_id' => 5, 'unit_id' => 9, 'kode_produk' => 'ATK-01-010', 'nama_produk' => 'Pensil Warna 12 Warna', 'deskripsi' => 'Set pensil warna 12 warna', 'harga_jual' => 18000.00, 'stok_tersedia' => 150, 'stok_minimum' => 30, 'barcode_product' => '8991234560010', 'status_product' => 'Tersedia'],
            ['category_id' => 1, 'sub_category_id' => 5, 'unit_id' => 9, 'kode_produk' => 'ATK-01-011', 'nama_produk' => 'Pensil Warna 24 Warna', 'deskripsi' => 'Set pensil warna 24 warna', 'harga_jual' => 35000.00, 'stok_tersedia' => 80, 'stok_minimum' => 20, 'barcode_product' => '8991234560011', 'status_product' => 'Tersedia'],

            // Kertas & Buku - Category 2
            // Kertas HVS A4 - SubCategory 11
            ['category_id' => 2, 'sub_category_id' => 11, 'unit_id' => 5, 'kode_produk' => 'KRT-02-001', 'nama_produk' => 'Kertas HVS A4 70gr (1 Rim)', 'deskripsi' => 'Kertas HVS A4 70 gram per rim (500 lembar)', 'harga_jual' => 42000.00, 'stok_tersedia' => 200, 'stok_minimum' => 30, 'barcode_product' => '8991234560012', 'status_product' => 'Tersedia'],
            ['category_id' => 2, 'sub_category_id' => 11, 'unit_id' => 5, 'kode_produk' => 'KRT-02-002', 'nama_produk' => 'Kertas HVS A4 80gr (1 Rim)', 'deskripsi' => 'Kertas HVS A4 80 gram per rim (500 lembar)', 'harga_jual' => 48000.00, 'stok_tersedia' => 180, 'stok_minimum' => 30, 'barcode_product' => '8991234560013', 'status_product' => 'Tersedia'],

            // Kertas HVS F4 - SubCategory 12
            ['category_id' => 2, 'sub_category_id' => 12, 'unit_id' => 5, 'kode_produk' => 'KRT-02-003', 'nama_produk' => 'Kertas HVS F4 70gr (1 Rim)', 'deskripsi' => 'Kertas HVS F4 70 gram per rim (500 lembar)', 'harga_jual' => 45000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560014', 'status_product' => 'Tersedia'],

            // Kertas Foto - SubCategory 14
            ['category_id' => 2, 'sub_category_id' => 14, 'unit_id' => 3, 'kode_produk' => 'KRT-02-004', 'nama_produk' => 'Kertas Foto Glossy A4 (Pack 20 lembar)', 'deskripsi' => 'Kertas foto glossy ukuran A4 isi 20 lembar', 'harga_jual' => 35000.00, 'stok_tersedia' => 100, 'stok_minimum' => 20, 'barcode_product' => '8991234560015', 'status_product' => 'Tersedia'],
            ['category_id' => 2, 'sub_category_id' => 14, 'unit_id' => 3, 'kode_produk' => 'KRT-02-005', 'nama_produk' => 'Kertas Foto Matte A4 (Pack 20 lembar)', 'deskripsi' => 'Kertas foto matte ukuran A4 isi 20 lembar', 'harga_jual' => 38000.00, 'stok_tersedia' => 90, 'stok_minimum' => 20, 'barcode_product' => '8991234560016', 'status_product' => 'Tersedia'],

            // Buku Tulis - SubCategory 17
            ['category_id' => 2, 'sub_category_id' => 17, 'unit_id' => 1, 'kode_produk' => 'KRT-02-006', 'nama_produk' => 'Buku Tulis 38 Lembar', 'deskripsi' => 'Buku tulis standar 38 lembar', 'harga_jual' => 3500.00, 'stok_tersedia' => 400, 'stok_minimum' => 50, 'barcode_product' => '8991234560017', 'status_product' => 'Tersedia'],
            ['category_id' => 2, 'sub_category_id' => 17, 'unit_id' => 1, 'kode_produk' => 'KRT-02-007', 'nama_produk' => 'Buku Tulis 58 Lembar', 'deskripsi' => 'Buku tulis standar 58 lembar', 'harga_jual' => 5000.00, 'stok_tersedia' => 350, 'stok_minimum' => 50, 'barcode_product' => '8991234560018', 'status_product' => 'Tersedia'],

            // Sticky Notes - SubCategory 19
            ['category_id' => 2, 'sub_category_id' => 19, 'unit_id' => 1, 'kode_produk' => 'KRT-02-008', 'nama_produk' => 'Sticky Notes 3x3 inch', 'deskripsi' => 'Sticky notes ukuran 3x3 inch', 'harga_jual' => 8000.00, 'stok_tersedia' => 200, 'stok_minimum' => 30, 'barcode_product' => '8991234560019', 'status_product' => 'Tersedia'],

            // Penghapus & Korektor - Category 3
            // Penghapus Pensil - SubCategory 21
            ['category_id' => 3, 'sub_category_id' => 21, 'unit_id' => 1, 'kode_produk' => 'PHK-03-001', 'nama_produk' => 'Penghapus Pensil Putih', 'deskripsi' => 'Penghapus pensil warna putih', 'harga_jual' => 1500.00, 'stok_tersedia' => 600, 'stok_minimum' => 100, 'barcode_product' => '8991234560020', 'status_product' => 'Tersedia'],
            ['category_id' => 3, 'sub_category_id' => 21, 'unit_id' => 2, 'kode_produk' => 'PHK-03-002', 'nama_produk' => 'Penghapus Pensil (Box isi 20)', 'deskripsi' => 'Penghapus pensil dalam box isi 20 pcs', 'harga_jual' => 28000.00, 'stok_tersedia' => 80, 'stok_minimum' => 15, 'barcode_product' => '8991234560021', 'status_product' => 'Tersedia'],

            // Tip-Ex - SubCategory 23-25
            ['category_id' => 3, 'sub_category_id' => 23, 'unit_id' => 1, 'kode_produk' => 'PHK-03-003', 'nama_produk' => 'Tip-Ex Cair 20ml', 'deskripsi' => 'Tip-ex cair dengan kuas ukuran 20ml', 'harga_jual' => 7000.00, 'stok_tersedia' => 250, 'stok_minimum' => 40, 'barcode_product' => '8991234560022', 'status_product' => 'Tersedia'],
            ['category_id' => 3, 'sub_category_id' => 24, 'unit_id' => 1, 'kode_produk' => 'PHK-03-004', 'nama_produk' => 'Tip-Ex Pen', 'deskripsi' => 'Tip-ex bentuk pen praktis', 'harga_jual' => 9000.00, 'stok_tersedia' => 200, 'stok_minimum' => 35, 'barcode_product' => '8991234560023', 'status_product' => 'Tersedia'],
            ['category_id' => 3, 'sub_category_id' => 25, 'unit_id' => 1, 'kode_produk' => 'PHK-03-005', 'nama_produk' => 'Tip-Ex Roll', 'deskripsi' => 'Tip-ex roll/pita praktis', 'harga_jual' => 12000.00, 'stok_tersedia' => 180, 'stok_minimum' => 30, 'barcode_product' => '8991234560024', 'status_product' => 'Tersedia'],

            // Serutan - SubCategory 27-28
            ['category_id' => 3, 'sub_category_id' => 27, 'unit_id' => 1, 'kode_produk' => 'PHK-03-006', 'nama_produk' => 'Serutan Pensil Manual', 'deskripsi' => 'Serutan pensil manual biasa', 'harga_jual' => 3000.00, 'stok_tersedia' => 300, 'stok_minimum' => 50, 'barcode_product' => '8991234560025', 'status_product' => 'Tersedia'],
            ['category_id' => 3, 'sub_category_id' => 28, 'unit_id' => 1, 'kode_produk' => 'PHK-03-007', 'nama_produk' => 'Serutan Elektrik', 'deskripsi' => 'Serutan pensil elektrik otomatis', 'harga_jual' => 85000.00, 'stok_tersedia' => 30, 'stok_minimum' => 5, 'barcode_product' => '8991234560026', 'status_product' => 'Tersedia'],

            // Perlengkapan Arsip - Category 4
            // Map Plastik - SubCategory 31
            ['category_id' => 4, 'sub_category_id' => 31, 'unit_id' => 1, 'kode_produk' => 'ARS-04-001', 'nama_produk' => 'Map Plastik Bening', 'deskripsi' => 'Map plastik transparan bening', 'harga_jual' => 2000.00, 'stok_tersedia' => 500, 'stok_minimum' => 80, 'barcode_product' => '8991234560027', 'status_product' => 'Tersedia'],
            ['category_id' => 4, 'sub_category_id' => 31, 'unit_id' => 1, 'kode_produk' => 'ARS-04-002', 'nama_produk' => 'Map Plastik Warna', 'deskripsi' => 'Map plastik berbagai warna', 'harga_jual' => 2500.00, 'stok_tersedia' => 450, 'stok_minimum' => 70, 'barcode_product' => '8991234560028', 'status_product' => 'Tersedia'],

            // Ordner - SubCategory 33
            ['category_id' => 4, 'sub_category_id' => 33, 'unit_id' => 1, 'kode_produk' => 'ARS-04-003', 'nama_produk' => 'Ordner Folio 5cm', 'deskripsi' => 'Ordner ukuran folio lebar 5cm', 'harga_jual' => 18000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560029', 'status_product' => 'Tersedia'],
            ['category_id' => 4, 'sub_category_id' => 33, 'unit_id' => 1, 'kode_produk' => 'ARS-04-004', 'nama_produk' => 'Ordner Folio 7cm', 'deskripsi' => 'Ordner ukuran folio lebar 7cm', 'harga_jual' => 22000.00, 'stok_tersedia' => 120, 'stok_minimum' => 20, 'barcode_product' => '8991234560030', 'status_product' => 'Tersedia'],

            // Clear Holder - SubCategory 36
            ['category_id' => 4, 'sub_category_id' => 36, 'unit_id' => 1, 'kode_produk' => 'ARS-04-005', 'nama_produk' => 'Clear Holder 20 Sheet', 'deskripsi' => 'Clear holder isi 20 lembar', 'harga_jual' => 8000.00, 'stok_tersedia' => 200, 'stok_minimum' => 35, 'barcode_product' => '8991234560031', 'status_product' => 'Tersedia'],
            ['category_id' => 4, 'sub_category_id' => 36, 'unit_id' => 1, 'kode_produk' => 'ARS-04-006', 'nama_produk' => 'Clear Holder 40 Sheet', 'deskripsi' => 'Clear holder isi 40 lembar', 'harga_jual' => 12000.00, 'stok_tersedia' => 180, 'stok_minimum' => 30, 'barcode_product' => '8991234560032', 'status_product' => 'Tersedia'],

            // Binder Clip - SubCategory 37
            ['category_id' => 4, 'sub_category_id' => 37, 'unit_id' => 2, 'kode_produk' => 'ARS-04-007', 'nama_produk' => 'Binder Clip Kecil (Box isi 12)', 'deskripsi' => 'Binder clip ukuran kecil', 'harga_jual' => 5000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560033', 'status_product' => 'Tersedia'],
            ['category_id' => 4, 'sub_category_id' => 37, 'unit_id' => 2, 'kode_produk' => 'ARS-04-008', 'nama_produk' => 'Binder Clip Sedang (Box isi 12)', 'deskripsi' => 'Binder clip ukuran sedang', 'harga_jual' => 8000.00, 'stok_tersedia' => 140, 'stok_minimum' => 25, 'barcode_product' => '8991234560034', 'status_product' => 'Tersedia'],

            // Stapler - SubCategory 39-40
            ['category_id' => 4, 'sub_category_id' => 39, 'unit_id' => 1, 'kode_produk' => 'ARS-04-009', 'nama_produk' => 'Stapler Kecil No.10', 'deskripsi' => 'Stapler kecil untuk isi stapler no.10', 'harga_jual' => 15000.00, 'stok_tersedia' => 100, 'stok_minimum' => 20, 'barcode_product' => '8991234560035', 'status_product' => 'Tersedia'],
            ['category_id' => 4, 'sub_category_id' => 40, 'unit_id' => 2, 'kode_produk' => 'ARS-04-010', 'nama_produk' => 'Isi Stapler No.10 (Box)', 'deskripsi' => 'Isi stapler no.10 per box', 'harga_jual' => 3000.00, 'stok_tersedia' => 300, 'stok_minimum' => 50, 'barcode_product' => '8991234560036', 'status_product' => 'Tersedia'],

            // Perlengkapan Meja - Category 5
            // Penggaris - SubCategory 41
            ['category_id' => 5, 'sub_category_id' => 41, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-001', 'nama_produk' => 'Penggaris Plastik 30cm', 'deskripsi' => 'Penggaris plastik bening 30cm', 'harga_jual' => 3000.00, 'stok_tersedia' => 250, 'stok_minimum' => 40, 'barcode_product' => '8991234560037', 'status_product' => 'Tersedia'],
            ['category_id' => 5, 'sub_category_id' => 41, 'unit_id' => 9, 'kode_produk' => 'MEJ-05-002', 'nama_produk' => 'Set Penggaris (3 pcs)', 'deskripsi' => 'Set penggaris isi 3 pcs (penggaris, segitiga, busur)', 'harga_jual' => 8000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560038', 'status_product' => 'Tersedia'],

            // Gunting - SubCategory 42
            ['category_id' => 5, 'sub_category_id' => 42, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-003', 'nama_produk' => 'Gunting Kertas Sedang', 'deskripsi' => 'Gunting kertas ukuran sedang', 'harga_jual' => 8000.00, 'stok_tersedia' => 180, 'stok_minimum' => 30, 'barcode_product' => '8991234560039', 'status_product' => 'Tersedia'],
            ['category_id' => 5, 'sub_category_id' => 42, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-004', 'nama_produk' => 'Gunting Besar Kenko', 'deskripsi' => 'Gunting besar merk Kenko', 'harga_jual' => 15000.00, 'stok_tersedia' => 120, 'stok_minimum' => 20, 'barcode_product' => '8991234560040', 'status_product' => 'Tersedia'],

            // Cutter - SubCategory 43
            ['category_id' => 5, 'sub_category_id' => 43, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-005', 'nama_produk' => 'Cutter Kecil', 'deskripsi' => 'Cutter ukuran kecil praktis', 'harga_jual' => 5000.00, 'stok_tersedia' => 200, 'stok_minimum' => 35, 'barcode_product' => '8991234560041', 'status_product' => 'Tersedia'],
            ['category_id' => 5, 'sub_category_id' => 43, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-006', 'nama_produk' => 'Cutter Besar', 'deskripsi' => 'Cutter ukuran besar heavy duty', 'harga_jual' => 12000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560042', 'status_product' => 'Tersedia'],

            // Lem - SubCategory 44
            ['category_id' => 5, 'sub_category_id' => 44, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-007', 'nama_produk' => 'Lem Cair Povinal 350gr', 'deskripsi' => 'Lem cair povinal ukuran 350gr', 'harga_jual' => 12000.00, 'stok_tersedia' => 180, 'stok_minimum' => 30, 'barcode_product' => '8991234560043', 'status_product' => 'Tersedia'],
            ['category_id' => 5, 'sub_category_id' => 44, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-008', 'nama_produk' => 'Lem Stick Fox 35gr', 'deskripsi' => 'Lem stick merk Fox 35gr', 'harga_jual' => 8000.00, 'stok_tersedia' => 200, 'stok_minimum' => 35, 'barcode_product' => '8991234560044', 'status_product' => 'Tersedia'],

            // Double Tape - SubCategory 45
            ['category_id' => 5, 'sub_category_id' => 45, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-009', 'nama_produk' => 'Double Tape Foam', 'deskripsi' => 'Double tape foam tebal', 'harga_jual' => 10000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560045', 'status_product' => 'Tersedia'],
            ['category_id' => 5, 'sub_category_id' => 45, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-010', 'nama_produk' => 'Double Tape Tipis 1 inch', 'deskripsi' => 'Double tape tipis ukuran 1 inch', 'harga_jual' => 5000.00, 'stok_tersedia' => 200, 'stok_minimum' => 35, 'barcode_product' => '8991234560046', 'status_product' => 'Tersedia'],

            // Lakban - SubCategory 46
            ['category_id' => 5, 'sub_category_id' => 46, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-011', 'nama_produk' => 'Lakban Bening 2 inch', 'deskripsi' => 'Lakban bening ukuran 2 inch', 'harga_jual' => 8000.00, 'stok_tersedia' => 180, 'stok_minimum' => 30, 'barcode_product' => '8991234560047', 'status_product' => 'Tersedia'],
            ['category_id' => 5, 'sub_category_id' => 46, 'unit_id' => 1, 'kode_produk' => 'MEJ-05-012', 'nama_produk' => 'Lakban Coklat 2 inch', 'deskripsi' => 'Lakban coklat ukuran 2 inch', 'harga_jual' => 7000.00, 'stok_tersedia' => 200, 'stok_minimum' => 35, 'barcode_product' => '8991234560048', 'status_product' => 'Tersedia'],

            // Printer & Tinta - Category 6
            // Tinta Canon - SubCategory 51
            ['category_id' => 6, 'sub_category_id' => 51, 'unit_id' => 1, 'kode_produk' => 'TNT-06-001', 'nama_produk' => 'Tinta Canon PG-47 Black', 'deskripsi' => 'Cartridge tinta Canon PG-47 warna hitam', 'harga_jual' => 175000.00, 'stok_tersedia' => 40, 'stok_minimum' => 10, 'barcode_product' => '8991234560049', 'status_product' => 'Tersedia'],
            ['category_id' => 6, 'sub_category_id' => 51, 'unit_id' => 1, 'kode_produk' => 'TNT-06-002', 'nama_produk' => 'Tinta Canon CL-57 Color', 'deskripsi' => 'Cartridge tinta Canon CL-57 warna', 'harga_jual' => 195000.00, 'stok_tersedia' => 35, 'stok_minimum' => 10, 'barcode_product' => '8991234560050', 'status_product' => 'Tersedia'],

            // Tinta Epson - SubCategory 52
            ['category_id' => 6, 'sub_category_id' => 52, 'unit_id' => 1, 'kode_produk' => 'TNT-06-003', 'nama_produk' => 'Tinta Epson 003 Black', 'deskripsi' => 'Tinta botol Epson 003 hitam', 'harga_jual' => 85000.00, 'stok_tersedia' => 50, 'stok_minimum' => 12, 'barcode_product' => '8991234560051', 'status_product' => 'Tersedia'],
            ['category_id' => 6, 'sub_category_id' => 52, 'unit_id' => 1, 'kode_produk' => 'TNT-06-004', 'nama_produk' => 'Tinta Epson 003 Cyan', 'deskripsi' => 'Tinta botol Epson 003 cyan', 'harga_jual' => 85000.00, 'stok_tersedia' => 45, 'stok_minimum' => 12, 'barcode_product' => '8991234560052', 'status_product' => 'Tersedia'],

            // Tinta HP - SubCategory 53
            ['category_id' => 6, 'sub_category_id' => 53, 'unit_id' => 1, 'kode_produk' => 'TNT-06-005', 'nama_produk' => 'Tinta HP 680 Black', 'deskripsi' => 'Cartridge tinta HP 680 hitam', 'harga_jual' => 165000.00, 'stok_tersedia' => 38, 'stok_minimum' => 10, 'barcode_product' => '8991234560053', 'status_product' => 'Tersedia'],
            ['category_id' => 6, 'sub_category_id' => 53, 'unit_id' => 1, 'kode_produk' => 'TNT-06-006', 'nama_produk' => 'Tinta HP 680 Color', 'deskripsi' => 'Cartridge tinta HP 680 warna', 'harga_jual' => 185000.00, 'stok_tersedia' => 36, 'stok_minimum' => 10, 'barcode_product' => '8991234560054', 'status_product' => 'Tersedia'],

            // Toner Laser - SubCategory 55
            ['category_id' => 6, 'sub_category_id' => 55, 'unit_id' => 1, 'kode_produk' => 'TNT-06-007', 'nama_produk' => 'Toner HP 85A (CE285A)', 'deskripsi' => 'Toner HP LaserJet 85A', 'harga_jual' => 450000.00, 'stok_tersedia' => 15, 'stok_minimum' => 5, 'barcode_product' => '8991234560055', 'status_product' => 'Tersedia'],
            ['category_id' => 6, 'sub_category_id' => 55, 'unit_id' => 1, 'kode_produk' => 'TNT-06-008', 'nama_produk' => 'Toner Canon 325', 'deskripsi' => 'Toner Canon Cartridge 325', 'harga_jual' => 425000.00, 'stok_tersedia' => 18, 'stok_minimum' => 5, 'barcode_product' => '8991234560056', 'status_product' => 'Tersedia'],

            // Percetakan Umum - Category 7
            // Cetak Dokumen Hitam Putih - SubCategory 61
            ['category_id' => 7, 'sub_category_id' => 61, 'unit_id' => 6, 'kode_produk' => 'CTK-07-001', 'nama_produk' => 'Cetak Dokumen A4 Hitam Putih', 'deskripsi' => 'Layanan cetak dokumen A4 hitam putih per lembar', 'harga_jual' => 500.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560057', 'status_product' => 'Tersedia'],
            ['category_id' => 7, 'sub_category_id' => 61, 'unit_id' => 6, 'kode_produk' => 'CTK-07-002', 'nama_produk' => 'Cetak Dokumen F4 Hitam Putih', 'deskripsi' => 'Layanan cetak dokumen F4 hitam putih per lembar', 'harga_jual' => 600.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560058', 'status_product' => 'Tersedia'],

            // Cetak Dokumen Warna - SubCategory 62
            ['category_id' => 7, 'sub_category_id' => 62, 'unit_id' => 6, 'kode_produk' => 'CTK-07-003', 'nama_produk' => 'Cetak Dokumen A4 Warna', 'deskripsi' => 'Layanan cetak dokumen A4 warna per lembar', 'harga_jual' => 1500.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560059', 'status_product' => 'Tersedia'],
            ['category_id' => 7, 'sub_category_id' => 62, 'unit_id' => 6, 'kode_produk' => 'CTK-07-004', 'nama_produk' => 'Cetak Dokumen F4 Warna', 'deskripsi' => 'Layanan cetak dokumen F4 warna per lembar', 'harga_jual' => 2000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560060', 'status_product' => 'Tersedia'],

            // Fotocopy - SubCategory 63
            ['category_id' => 7, 'sub_category_id' => 63, 'unit_id' => 6, 'kode_produk' => 'CTK-07-005', 'nama_produk' => 'Fotocopy A4', 'deskripsi' => 'Layanan fotocopy A4 per lembar', 'harga_jual' => 300.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560061', 'status_product' => 'Tersedia'],
            ['category_id' => 7, 'sub_category_id' => 63, 'unit_id' => 6, 'kode_produk' => 'CTK-07-006', 'nama_produk' => 'Fotocopy F4', 'deskripsi' => 'Layanan fotocopy F4 per lembar', 'harga_jual' => 400.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560062', 'status_product' => 'Tersedia'],

            // Scan Dokumen - SubCategory 64
            ['category_id' => 7, 'sub_category_id' => 64, 'unit_id' => 6, 'kode_produk' => 'CTK-07-007', 'nama_produk' => 'Scan Dokumen Standar', 'deskripsi' => 'Layanan scan dokumen per lembar', 'harga_jual' => 1000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560063', 'status_product' => 'Tersedia'],

            // Cetak Brosur - SubCategory 65
            ['category_id' => 7, 'sub_category_id' => 65, 'unit_id' => 6, 'kode_produk' => 'CTK-07-008', 'nama_produk' => 'Cetak Brosur A4 (Art Paper 120gr)', 'deskripsi' => 'Cetak brosur A4 art paper 120gr', 'harga_jual' => 3500.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560064', 'status_product' => 'Tersedia'],
            ['category_id' => 7, 'sub_category_id' => 65, 'unit_id' => 6, 'kode_produk' => 'CTK-07-009', 'nama_produk' => 'Cetak Brosur A5 (Art Paper 120gr)', 'deskripsi' => 'Cetak brosur A5 art paper 120gr', 'harga_jual' => 2000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560065', 'status_product' => 'Tersedia'],

            // Cetak Poster - SubCategory 68
            ['category_id' => 7, 'sub_category_id' => 68, 'unit_id' => 6, 'kode_produk' => 'CTK-07-010', 'nama_produk' => 'Cetak Poster A3', 'deskripsi' => 'Cetak poster ukuran A3', 'harga_jual' => 15000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560066', 'status_product' => 'Tersedia'],

            // Percetakan Digital - Category 8
            // Cetak Banner - SubCategory 71
            ['category_id' => 8, 'sub_category_id' => 71, 'unit_id' => 7, 'kode_produk' => 'DIG-08-001', 'nama_produk' => 'Cetak Banner Flexi Korea', 'deskripsi' => 'Cetak banner flexi korea per meter', 'harga_jual' => 35000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560067', 'status_product' => 'Tersedia'],
            ['category_id' => 8, 'sub_category_id' => 71, 'unit_id' => 7, 'kode_produk' => 'DIG-08-002', 'nama_produk' => 'Cetak Banner Flexi China', 'deskripsi' => 'Cetak banner flexi china per meter', 'harga_jual' => 25000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560068', 'status_product' => 'Tersedia'],

            // Cetak Spanduk - SubCategory 72
            ['category_id' => 8, 'sub_category_id' => 72, 'unit_id' => 7, 'kode_produk' => 'DIG-08-003', 'nama_produk' => 'Cetak Spanduk Albatros', 'deskripsi' => 'Cetak spanduk bahan albatros per meter', 'harga_jual' => 30000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560069', 'status_product' => 'Tersedia'],

            // Cetak MMT - SubCategory 73
            ['category_id' => 8, 'sub_category_id' => 73, 'unit_id' => 7, 'kode_produk' => 'DIG-08-004', 'nama_produk' => 'Cetak MMT 3mm', 'deskripsi' => 'Cetak MMT tebal 3mm per meter', 'harga_jual' => 75000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560070', 'status_product' => 'Tersedia'],
            ['category_id' => 8, 'sub_category_id' => 73, 'unit_id' => 7, 'kode_produk' => 'DIG-08-005', 'nama_produk' => 'Cetak MMT 5mm', 'deskripsi' => 'Cetak MMT tebal 5mm per meter', 'harga_jual' => 95000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560071', 'status_product' => 'Tersedia'],

            // Cetak Kartu Nama - SubCategory 75
            ['category_id' => 8, 'sub_category_id' => 75, 'unit_id' => 2, 'kode_produk' => 'DIG-08-006', 'nama_produk' => 'Cetak Kartu Nama (Box isi 100)', 'deskripsi' => 'Cetak kartu nama art paper 260gr laminasi doff', 'harga_jual' => 50000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560072', 'status_product' => 'Tersedia'],

            // Cetak Undangan - SubCategory 76
            ['category_id' => 8, 'sub_category_id' => 76, 'unit_id' => 6, 'kode_produk' => 'DIG-08-007', 'nama_produk' => 'Cetak Undangan Standar', 'deskripsi' => 'Cetak undangan art carton 230gr', 'harga_jual' => 2500.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560073', 'status_product' => 'Tersedia'],
            ['category_id' => 8, 'sub_category_id' => 76, 'unit_id' => 6, 'kode_produk' => 'DIG-08-008', 'nama_produk' => 'Cetak Undangan Premium', 'deskripsi' => 'Cetak undangan jasmine 260gr + emboss', 'harga_jual' => 5000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560074', 'status_product' => 'Tersedia'],

            // Cetak ID Card - SubCategory 77
            ['category_id' => 8, 'sub_category_id' => 77, 'unit_id' => 1, 'kode_produk' => 'DIG-08-009', 'nama_produk' => 'Cetak ID Card PVC', 'deskripsi' => 'Cetak ID card bahan PVC', 'harga_jual' => 8000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560075', 'status_product' => 'Tersedia'],

            // Cetak Kalender - SubCategory 78
            ['category_id' => 8, 'sub_category_id' => 78, 'unit_id' => 1, 'kode_produk' => 'DIG-08-010', 'nama_produk' => 'Cetak Kalender Meja', 'deskripsi' => 'Cetak kalender meja tahun 2026', 'harga_jual' => 15000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560076', 'status_product' => 'Tersedia'],

            // Finishing Percetakan - Category 9
            // Laminating - SubCategory 81-82
            ['category_id' => 9, 'sub_category_id' => 81, 'unit_id' => 6, 'kode_produk' => 'FIN-09-001', 'nama_produk' => 'Laminating Dingin A4', 'deskripsi' => 'Laminating dingin ukuran A4', 'harga_jual' => 5000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560077', 'status_product' => 'Tersedia'],
            ['category_id' => 9, 'sub_category_id' => 82, 'unit_id' => 6, 'kode_produk' => 'FIN-09-002', 'nama_produk' => 'Laminating Panas A4', 'deskripsi' => 'Laminating panas doff/glossy ukuran A4', 'harga_jual' => 4000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560078', 'status_product' => 'Tersedia'],
            ['category_id' => 9, 'sub_category_id' => 82, 'unit_id' => 6, 'kode_produk' => 'FIN-09-003', 'nama_produk' => 'Laminating Panas F4', 'deskripsi' => 'Laminating panas doff/glossy ukuran F4', 'harga_jual' => 5000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560079', 'status_product' => 'Tersedia'],

            // Jilid - SubCategory 83-86
            ['category_id' => 9, 'sub_category_id' => 83, 'unit_id' => 1, 'kode_produk' => 'FIN-09-004', 'nama_produk' => 'Jilid Spiral Plastik', 'deskripsi' => 'Jilid spiral plastik + mika bening', 'harga_jual' => 7000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560080', 'status_product' => 'Tersedia'],
            ['category_id' => 9, 'sub_category_id' => 84, 'unit_id' => 1, 'kode_produk' => 'FIN-09-005', 'nama_produk' => 'Jilid Kawat', 'deskripsi' => 'Jilid kawat (wire-o)', 'harga_jual' => 10000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560081', 'status_product' => 'Tersedia'],
            ['category_id' => 9, 'sub_category_id' => 85, 'unit_id' => 1, 'kode_produk' => 'FIN-09-006', 'nama_produk' => 'Jilid Hardcover', 'deskripsi' => 'Jilid hardcover buku tebal', 'harga_jual' => 35000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560082', 'status_product' => 'Tersedia'],
            ['category_id' => 9, 'sub_category_id' => 86, 'unit_id' => 1, 'kode_produk' => 'FIN-09-007', 'nama_produk' => 'Jilid Softcover', 'deskripsi' => 'Jilid softcover thermal binding', 'harga_jual' => 15000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560083', 'status_product' => 'Tersedia'],

            // Pemotongan - SubCategory 87
            ['category_id' => 9, 'sub_category_id' => 87, 'unit_id' => 6, 'kode_produk' => 'FIN-09-008', 'nama_produk' => 'Potong Kertas (Per Potong)', 'deskripsi' => 'Layanan pemotongan kertas per potong', 'harga_jual' => 2000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560084', 'status_product' => 'Tersedia'],

            // Pond/Potong Sudut - SubCategory 88
            ['category_id' => 9, 'sub_category_id' => 88, 'unit_id' => 6, 'kode_produk' => 'FIN-09-009', 'nama_produk' => 'Pond Sudut', 'deskripsi' => 'Layanan pond/potong sudut melengkung', 'harga_jual' => 500.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560085', 'status_product' => 'Tersedia'],

            // Emboss - SubCategory 89
            ['category_id' => 9, 'sub_category_id' => 89, 'unit_id' => 6, 'kode_produk' => 'FIN-09-010', 'nama_produk' => 'Emboss/Timbul', 'deskripsi' => 'Layanan emboss/cetak timbul', 'harga_jual' => 3000.00, 'stok_tersedia' => 9999, 'stok_minimum' => 0, 'barcode_product' => '8991234560086', 'status_product' => 'Tersedia'],

            // Promosi & Souvenir - Category 10
            // Mug Custom - SubCategory 91
            ['category_id' => 10, 'sub_category_id' => 91, 'unit_id' => 1, 'kode_produk' => 'SOU-10-001', 'nama_produk' => 'Mug Custom Putih Standar', 'deskripsi' => 'Mug custom putih polos + cetak', 'harga_jual' => 25000.00, 'stok_tersedia' => 200, 'stok_minimum' => 30, 'barcode_product' => '8991234560087', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 91, 'unit_id' => 1, 'kode_produk' => 'SOU-10-002', 'nama_produk' => 'Mug Custom Warna', 'deskripsi' => 'Mug custom berbagai warna + cetak', 'harga_jual' => 30000.00, 'stok_tersedia' => 180, 'stok_minimum' => 25, 'barcode_product' => '8991234560088', 'status_product' => 'Tersedia'],

            // Gantungan Kunci - SubCategory 92
            ['category_id' => 10, 'sub_category_id' => 92, 'unit_id' => 1, 'kode_produk' => 'SOU-10-003', 'nama_produk' => 'Gantungan Kunci Akrilik', 'deskripsi' => 'Gantungan kunci bahan akrilik custom', 'harga_jual' => 5000.00, 'stok_tersedia' => 500, 'stok_minimum' => 50, 'barcode_product' => '8991234560089', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 92, 'unit_id' => 1, 'kode_produk' => 'SOU-10-004', 'nama_produk' => 'Gantungan Kunci Karet', 'deskripsi' => 'Gantungan kunci bahan karet custom', 'harga_jual' => 8000.00, 'stok_tersedia' => 400, 'stok_minimum' => 50, 'barcode_product' => '8991234560090', 'status_product' => 'Tersedia'],

            // Pin & Bros - SubCategory 93
            ['category_id' => 10, 'sub_category_id' => 93, 'unit_id' => 1, 'kode_produk' => 'SOU-10-005', 'nama_produk' => 'Pin Bros 5cm', 'deskripsi' => 'Pin bros bulat diameter 5cm custom', 'harga_jual' => 6000.00, 'stok_tersedia' => 300, 'stok_minimum' => 40, 'barcode_product' => '8991234560091', 'status_product' => 'Tersedia'],

            // Lanyard - SubCategory 94
            ['category_id' => 10, 'sub_category_id' => 94, 'unit_id' => 1, 'kode_produk' => 'SOU-10-006', 'nama_produk' => 'Lanyard Polyester 2cm', 'deskripsi' => 'Lanyard polyester lebar 2cm custom', 'harga_jual' => 8000.00, 'stok_tersedia' => 250, 'stok_minimum' => 35, 'barcode_product' => '8991234560092', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 94, 'unit_id' => 1, 'kode_produk' => 'SOU-10-007', 'nama_produk' => 'Lanyard Satin 2.5cm', 'deskripsi' => 'Lanyard satin lebar 2.5cm custom', 'harga_jual' => 10000.00, 'stok_tersedia' => 220, 'stok_minimum' => 30, 'barcode_product' => '8991234560093', 'status_product' => 'Tersedia'],

            // Tote Bag - SubCategory 95
            ['category_id' => 10, 'sub_category_id' => 95, 'unit_id' => 1, 'kode_produk' => 'SOU-10-008', 'nama_produk' => 'Tote Bag Blacu Custom', 'deskripsi' => 'Tote bag bahan blacu + sablon', 'harga_jual' => 15000.00, 'stok_tersedia' => 200, 'stok_minimum' => 30, 'barcode_product' => '8991234560094', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 95, 'unit_id' => 1, 'kode_produk' => 'SOU-10-009', 'nama_produk' => 'Tote Bag Kanvas Custom', 'deskripsi' => 'Tote bag bahan kanvas + sablon', 'harga_jual' => 20000.00, 'stok_tersedia' => 180, 'stok_minimum' => 25, 'barcode_product' => '8991234560095', 'status_product' => 'Tersedia'],

            // Kaos Custom - SubCategory 96
            ['category_id' => 10, 'sub_category_id' => 96, 'unit_id' => 1, 'kode_produk' => 'SOU-10-010', 'nama_produk' => 'Kaos Cotton Combed Custom', 'deskripsi' => 'Kaos cotton combed 24s + sablon', 'harga_jual' => 45000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560096', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 96, 'unit_id' => 1, 'kode_produk' => 'SOU-10-011', 'nama_produk' => 'Kaos Cotton Combed Premium', 'deskripsi' => 'Kaos cotton combed 30s + sablon', 'harga_jual' => 55000.00, 'stok_tersedia' => 120, 'stok_minimum' => 20, 'barcode_product' => '8991234560097', 'status_product' => 'Tersedia'],

            // Tumbler - SubCategory 97
            ['category_id' => 10, 'sub_category_id' => 97, 'unit_id' => 1, 'kode_produk' => 'SOU-10-012', 'nama_produk' => 'Tumbler Stainless 500ml', 'deskripsi' => 'Tumbler stainless 500ml custom', 'harga_jual' => 45000.00, 'stok_tersedia' => 100, 'stok_minimum' => 20, 'barcode_product' => '8991234560098', 'status_product' => 'Tersedia'],

            // USB Flashdisk - SubCategory 99
            ['category_id' => 10, 'sub_category_id' => 99, 'unit_id' => 1, 'kode_produk' => 'SOU-10-013', 'nama_produk' => 'USB Flashdisk 8GB Custom', 'deskripsi' => 'USB flashdisk 8GB + logo custom', 'harga_jual' => 35000.00, 'stok_tersedia' => 150, 'stok_minimum' => 25, 'barcode_product' => '8991234560099', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 99, 'unit_id' => 1, 'kode_produk' => 'SOU-10-014', 'nama_produk' => 'USB Flashdisk 16GB Custom', 'deskripsi' => 'USB flashdisk 16GB + logo custom', 'harga_jual' => 50000.00, 'stok_tersedia' => 120, 'stok_minimum' => 20, 'barcode_product' => '8991234560100', 'status_product' => 'Tersedia'],

            // Powerbank - SubCategory 100
            ['category_id' => 10, 'sub_category_id' => 100, 'unit_id' => 1, 'kode_produk' => 'SOU-10-015', 'nama_produk' => 'Powerbank 5000mAh Custom', 'deskripsi' => 'Powerbank 5000mAh + logo custom', 'harga_jual' => 75000.00, 'stok_tersedia' => 80, 'stok_minimum' => 15, 'barcode_product' => '8991234560101', 'status_product' => 'Tersedia'],
            ['category_id' => 10, 'sub_category_id' => 100, 'unit_id' => 1, 'kode_produk' => 'SOU-10-016', 'nama_produk' => 'Powerbank 10000mAh Custom', 'deskripsi' => 'Powerbank 10000mAh + logo custom', 'harga_jual' => 120000.00, 'stok_tersedia' => 60, 'stok_minimum' => 10, 'barcode_product' => '8991234560102', 'status_product' => 'Tersedia'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}