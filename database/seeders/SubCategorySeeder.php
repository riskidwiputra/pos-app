<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            // Alat Tulis (Category ID: 1)
            ['category_id' => 1, 'kode_subkategori' => '01', 'nama_subkategori' => 'Pulpen'],
            ['category_id' => 1, 'kode_subkategori' => '02', 'nama_subkategori' => 'Pensil'],
            ['category_id' => 1, 'kode_subkategori' => '03', 'nama_subkategori' => 'Spidol'],
            ['category_id' => 1, 'kode_subkategori' => '04', 'nama_subkategori' => 'Stabilo / Highlighter'],
            ['category_id' => 1, 'kode_subkategori' => '05', 'nama_subkategori' => 'Pensil Warna'],
            ['category_id' => 1, 'kode_subkategori' => '06', 'nama_subkategori' => 'Crayon'],
            ['category_id' => 1, 'kode_subkategori' => '07', 'nama_subkategori' => 'Pensil Mekanik'],
            ['category_id' => 1, 'kode_subkategori' => '08', 'nama_subkategori' => 'Isi Pensil Mekanik'],
            ['category_id' => 1, 'kode_subkategori' => '09', 'nama_subkategori' => 'Spidol Whiteboard'],
            ['category_id' => 1, 'kode_subkategori' => '10', 'nama_subkategori' => 'Spidol Permanent'],

            // Kertas & Buku (Category ID: 2)
            ['category_id' => 2, 'kode_subkategori' => '01', 'nama_subkategori' => 'Kertas HVS A4'],
            ['category_id' => 2, 'kode_subkategori' => '02', 'nama_subkategori' => 'Kertas HVS F4'],
            ['category_id' => 2, 'kode_subkategori' => '03', 'nama_subkategori' => 'Kertas HVS A3'],
            ['category_id' => 2, 'kode_subkategori' => '04', 'nama_subkategori' => 'Kertas Foto'],
            ['category_id' => 2, 'kode_subkategori' => '05', 'nama_subkategori' => 'Kertas Art Paper'],
            ['category_id' => 2, 'kode_subkategori' => '06', 'nama_subkategori' => 'Kertas Buffalo'],
            ['category_id' => 2, 'kode_subkategori' => '07', 'nama_subkategori' => 'Buku Tulis'],
            ['category_id' => 2, 'kode_subkategori' => '08', 'nama_subkategori' => 'Buku Gambar'],
            ['category_id' => 2, 'kode_subkategori' => '09', 'nama_subkategori' => 'Sticky Notes'],
            ['category_id' => 2, 'kode_subkategori' => '10', 'nama_subkategori' => 'Amplop'],

            // Penghapus & Korektor (Category ID: 3)
            ['category_id' => 3, 'kode_subkategori' => '01', 'nama_subkategori' => 'Penghapus Pensil'],
            ['category_id' => 3, 'kode_subkategori' => '02', 'nama_subkategori' => 'Penghapus Spidol'],
            ['category_id' => 3, 'kode_subkategori' => '03', 'nama_subkategori' => 'Tip-Ex Cair'],
            ['category_id' => 3, 'kode_subkategori' => '04', 'nama_subkategori' => 'Tip-Ex Pen'],
            ['category_id' => 3, 'kode_subkategori' => '05', 'nama_subkategori' => 'Tip-Ex Roll'],
            ['category_id' => 3, 'kode_subkategori' => '06', 'nama_subkategori' => 'Penghapus Listrik'],
            ['category_id' => 3, 'kode_subkategori' => '07', 'nama_subkategori' => 'Serutan Pensil'],
            ['category_id' => 3, 'kode_subkategori' => '08', 'nama_subkategori' => 'Serutan Elektrik'],
            ['category_id' => 3, 'kode_subkategori' => '09', 'nama_subkategori' => 'Penghapus Papan Tulis'],
            ['category_id' => 3, 'kode_subkategori' => '10', 'nama_subkategori' => 'Refill Tip-Ex'],

            // Perlengkapan Arsip (Category ID: 4)
            ['category_id' => 4, 'kode_subkategori' => '01', 'nama_subkategori' => 'Map Plastik'],
            ['category_id' => 4, 'kode_subkategori' => '02', 'nama_subkategori' => 'Map Kertas'],
            ['category_id' => 4, 'kode_subkategori' => '03', 'nama_subkategori' => 'Ordner'],
            ['category_id' => 4, 'kode_subkategori' => '04', 'nama_subkategori' => 'Stopmap'],
            ['category_id' => 4, 'kode_subkategori' => '05', 'nama_subkategori' => 'Box File'],
            ['category_id' => 4, 'kode_subkategori' => '06', 'nama_subkategori' => 'Clear Holder'],
            ['category_id' => 4, 'kode_subkategori' => '07', 'nama_subkategori' => 'Binder Clip'],
            ['category_id' => 4, 'kode_subkategori' => '08', 'nama_subkategori' => 'Paper Clip'],
            ['category_id' => 4, 'kode_subkategori' => '09', 'nama_subkategori' => 'Stapler'],
            ['category_id' => 4, 'kode_subkategori' => '10', 'nama_subkategori' => 'Isi Stapler'],

            // Perlengkapan Meja (Category ID: 5)
            ['category_id' => 5, 'kode_subkategori' => '01', 'nama_subkategori' => 'Penggaris'],
            ['category_id' => 5, 'kode_subkategori' => '02', 'nama_subkategori' => 'Gunting'],
            ['category_id' => 5, 'kode_subkategori' => '03', 'nama_subkategori' => 'Cutter'],
            ['category_id' => 5, 'kode_subkategori' => '04', 'nama_subkategori' => 'Lem'],
            ['category_id' => 5, 'kode_subkategori' => '05', 'nama_subkategori' => 'Double Tape'],
            ['category_id' => 5, 'kode_subkategori' => '06', 'nama_subkategori' => 'Lakban'],
            ['category_id' => 5, 'kode_subkategori' => '07', 'nama_subkategori' => 'Tempat Pensil'],
            ['category_id' => 5, 'kode_subkategori' => '08', 'nama_subkategori' => 'Penjepit Kertas'],
            ['category_id' => 5, 'kode_subkategori' => '09', 'nama_subkategori' => 'Perforator'],
            ['category_id' => 5, 'kode_subkategori' => '10', 'nama_subkategori' => 'Kalender Meja'],

            // Printer & Tinta (Category ID: 6)
            ['category_id' => 6, 'kode_subkategori' => '01', 'nama_subkategori' => 'Tinta Printer Canon'],
            ['category_id' => 6, 'kode_subkategori' => '02', 'nama_subkategori' => 'Tinta Printer Epson'],
            ['category_id' => 6, 'kode_subkategori' => '03', 'nama_subkategori' => 'Tinta Printer HP'],
            ['category_id' => 6, 'kode_subkategori' => '04', 'nama_subkategori' => 'Tinta Printer Brother'],
            ['category_id' => 6, 'kode_subkategori' => '05', 'nama_subkategori' => 'Toner Laser'],
            ['category_id' => 6, 'kode_subkategori' => '06', 'nama_subkategori' => 'Refill Tinta'],
            ['category_id' => 6, 'kode_subkategori' => '07', 'nama_subkategori' => 'Cartridge Bekas'],
            ['category_id' => 6, 'kode_subkategori' => '08', 'nama_subkategori' => 'Ribbon Printer'],
            ['category_id' => 6, 'kode_subkategori' => '09', 'nama_subkategori' => 'Drum Unit'],
            ['category_id' => 6, 'kode_subkategori' => '10', 'nama_subkategori' => 'Cleaning Kit'],

            // Percetakan Umum (Category ID: 7)
            ['category_id' => 7, 'kode_subkategori' => '01', 'nama_subkategori' => 'Cetak Dokumen Hitam Putih'],
            ['category_id' => 7, 'kode_subkategori' => '02', 'nama_subkategori' => 'Cetak Dokumen Warna'],
            ['category_id' => 7, 'kode_subkategori' => '03', 'nama_subkategori' => 'Fotocopy'],
            ['category_id' => 7, 'kode_subkategori' => '04', 'nama_subkategori' => 'Scan Dokumen'],
            ['category_id' => 7, 'kode_subkategori' => '05', 'nama_subkategori' => 'Cetak Brosur'],
            ['category_id' => 7, 'kode_subkategori' => '06', 'nama_subkategori' => 'Cetak Flyer'],
            ['category_id' => 7, 'kode_subkategori' => '07', 'nama_subkategori' => 'Cetak Pamflet'],
            ['category_id' => 7, 'kode_subkategori' => '08', 'nama_subkategori' => 'Cetak Poster'],
            ['category_id' => 7, 'kode_subkategori' => '09', 'nama_subkategori' => 'Cetak Stiker'],
            ['category_id' => 7, 'kode_subkategori' => '10', 'nama_subkategori' => 'Cetak Label'],

            // Finishing Percetakan (Category ID: 8)
            ['category_id' => 8, 'kode_subkategori' => '01', 'nama_subkategori' => 'Laminating Dingin'],
            ['category_id' => 8, 'kode_subkategori' => '02', 'nama_subkategori' => 'Laminating Panas'],
            ['category_id' => 8, 'kode_subkategori' => '03', 'nama_subkategori' => 'Jilid Spiral'],
            ['category_id' => 8, 'kode_subkategori' => '04', 'nama_subkategori' => 'Jilid Kawat'],
            ['category_id' => 8, 'kode_subkategori' => '05', 'nama_subkategori' => 'Jilid Hardcover'],
            ['category_id' => 8, 'kode_subkategori' => '06', 'nama_subkategori' => 'Jilid Softcover'],
            ['category_id' => 8, 'kode_subkategori' => '07', 'nama_subkategori' => 'Pemotongan Kertas'],
            ['category_id' => 8, 'kode_subkategori' => '08', 'nama_subkategori' => 'Pond / Potong Sudut'],
            ['category_id' => 8, 'kode_subkategori' => '09', 'nama_subkategori' => 'Emboss / Timbul'],
            ['category_id' => 8, 'kode_subkategori' => '10', 'nama_subkategori' => 'Hotprint'],

           ['category_id' => 9, 'kode_subkategori' => '02', 'nama_subkategori' => 'Label Barcode & Harga', 'deskripsi' => 'Label untuk barcode dan harga produk'],
            ['category_id' => 9, 'kode_subkategori' => '03', 'nama_subkategori' => 'Stiker Vinyl & Outdoor', 'deskripsi' => 'Stiker vinyl tahan cuaca untuk kebutuhan outdoor'],
            ['category_id' => 9, 'kode_subkategori' => '04', 'nama_subkategori' => 'Label Undangan & Kemasan', 'deskripsi' => 'Label untuk undangan dan kemasan produk'],


            // 10 - Amplop & Map
            ['category_id' => 10, 'kode_subkategori' => '01', 'nama_subkategori' => 'Amplop Surat', 'deskripsi' => 'Amplop putih dan coklat berbagai ukuran'],
            ['category_id' => 10, 'kode_subkategori' => '02', 'nama_subkategori' => 'Map Plastik & Mika', 'deskripsi' => 'Map plastik dan mika transparan'],
            ['category_id' => 10, 'kode_subkategori' => '03', 'nama_subkategori' => 'Map Kertas & Snelhecter', 'deskripsi' => 'Map kertas dan snelhecter untuk dokumen'],
            ['category_id' => 10, 'kode_subkategori' => '04', 'nama_subkategori' => 'Stopmap & Folder', 'deskripsi' => 'Stopmap folio dan folder dokumen'],
            ['category_id' => 10, 'kode_subkategori' => '05', 'nama_subkategori' => 'Map Arsip & Box File', 'deskripsi' => 'Map arsip dan box file untuk penyimpanan dokumen'],
            ['category_id' => 10, 'kode_subkategori' => '06', 'nama_subkategori' => 'Amplop Undangan & Coklat', 'deskripsi' => 'Amplop undangan dan coklat berbagai ukuran'],
            ['category_id' => 10, 'kode_subkategori' => '07', 'nama_subkategori' => 'Map Proyek & Presentasi', 'deskripsi' => 'Map proyek dan presentasi untuk kebutuhan kantor'],
            ['category_id' => 10, 'kode_subkategori' => '08', 'nama_subkategori' => 'Map Resleting & Map Kancing', 'deskripsi' => 'Map dengan resleting dan kancing untuk dokumen penting'],


            
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create($subCategory);
        }
    }
}
