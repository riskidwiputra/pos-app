<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategoryOrderSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            // ============================================================
            // JASA DESAIN GRAFIS
            // ============================================================
            [
                'nama_jasa'        => 'Desain Logo & Brand Identity',
                'deskripsi'        => 'Pembuatan desain logo profesional beserta panduan brand identity seperti warna, tipografi, dan penggunaan logo',
                'total_harga'      => 350000,
                'keterangan_bahan' => 'File sumber: Adobe Illustrator / CorelDRAW. Output: AI, EPS, PDF, PNG (transparan), JPG. Revisi hingga 3x.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Brosur & Flyer',
                'deskripsi'        => 'Pembuatan desain brosur lipat 2 atau lipat 3, dan flyer promosi siap cetak dengan layout profesional',
                'total_harga'      => 120000,
                'keterangan_bahan' => 'Ukuran A4/A5, full color, format output PDF siap cetak (CMYK, bleed 3mm). Revisi hingga 2x.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Spanduk & Banner',
                'deskripsi'        => 'Pembuatan desain spanduk, banner, roll-up banner, dan X-banner sesuai ukuran yang diinginkan',
                'total_harga'      => 100000,
                'keterangan_bahan' => 'Format output PDF/JPG resolusi 150-300 dpi. Ukuran custom sesuai kebutuhan. Revisi 2x.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Kartu Nama',
                'deskripsi'        => 'Pembuatan desain kartu nama profesional dua sisi ukuran standar 9x5.5cm siap cetak',
                'total_harga'      => 75000,
                'keterangan_bahan' => 'Ukuran 9x5.5cm, 2 sisi, format PDF siap cetak CMYK. Revisi hingga 2x.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Undangan Pernikahan',
                'deskripsi'        => 'Pembuatan desain undangan pernikahan custom, tersedia pilihan tema modern, rustic, islami, dan klasik',
                'total_harga'      => 200000,
                'keterangan_bahan' => 'Ukuran custom, full color, format PDF/JPG siap cetak. Termasuk desain amplop. Revisi hingga 3x.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Kemasan Produk',
                'deskripsi'        => 'Pembuatan desain kemasan produk (packaging), label produk, stiker kemasan, dan box produk',
                'total_harga'      => 250000,
                'keterangan_bahan' => 'Format PDF/AI siap cetak termasuk die-cut template. Revisi hingga 3x. Termasuk mockup presentasi.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Kalender Custom',
                'deskripsi'        => 'Pembuatan desain kalender meja atau kalender dinding dengan foto dan tema custom sesuai kebutuhan',
                'total_harga'      => 175000,
                'keterangan_bahan' => 'Kalender meja A5 (14 hal) atau dinding A2 (13 hal), full color, format PDF siap cetak.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Desain Nota & Kwitansi Custom',
                'deskripsi'        => 'Pembuatan desain nota, kwitansi, atau faktur rangkap 2 dan 3 dengan logo dan identitas usaha',
                'total_harga'      => 90000,
                'keterangan_bahan' => 'Format A5 atau A6, rangkap 2 atau 3, PDF siap cetak. Revisi 2x.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],

            // ============================================================
            // JASA CETAK KHUSUS
            // ============================================================
            [
                'nama_jasa'        => 'Cetak Stiker Custom Cutting',
                'deskripsi'        => 'Layanan cetak stiker dengan cutting sesuai bentuk desain, tersedia bahan vinyl, chromo, dan transparan',
                'total_harga'      => 50000,
                'keterangan_bahan' => 'Bahan: vinyl outdoor, chromo, atau transparan. Laminasi doff/glossy. Minimum order 10 pcs.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Cetak & Jilid Skripsi / Laporan',
                'deskripsi'        => 'Layanan cetak dokumen dan penjilidan skripsi, laporan PKL, tesis, dan laporan formal lainnya',
                'total_harga'      => 85000,
                'keterangan_bahan' => 'Kertas HVS 80gr, cover hardcover atau softcover, jilid spiral atau lakban, warna cover custom.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Cetak Foto Kanvas',
                'deskripsi'        => 'Cetak foto di atas kanvas berkualitas tinggi, cocok untuk dekorasi rumah dan hadiah kenangan',
                'total_harga'      => 150000,
                'keterangan_bahan' => 'Bahan kanvas premium, bingkai kayu atau tanpa bingkai, ukuran 30x40 cm (dapat custom).',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Cetak Plakat & Piagam',
                'deskripsi'        => 'Pembuatan plakat penghargaan, piagam, dan sertifikat custom untuk event, lomba, dan penghargaan',
                'total_harga'      => 195000,
                'keterangan_bahan' => 'Bahan akrilik / kayu. Cetak UV full color. Ukuran A4 atau custom. Termasuk desain.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],

            // ============================================================
            // JASA FINISHING
            // ============================================================
            [
                'nama_jasa'        => 'Laminasi Dokumen Penting',
                'deskripsi'        => 'Layanan laminasi untuk ijazah, KTP, SIM, sertifikat, dan dokumen penting lainnya agar tahan lama',
                'total_harga'      => 15000,
                'keterangan_bahan' => 'Plastik laminasi panas ukuran hingga A4, glossy atau doff. Harga per lembar A4.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],
            [
                'nama_jasa'        => 'Jilid Hardcover Skripsi Eksklusif',
                'deskripsi'        => 'Jilid hardcover eksklusif dengan emboss nama dan judul, cocok untuk skripsi, tesis, dan laporan formal',
                'total_harga'      => 65000,
                'keterangan_bahan' => 'Cover bahan tebal (hardboard), laminasi glossy, emboss tulisan emas. Warna cover sesuai ketentuan kampus.',
                'gambar_contoh'    => null,
                'is_active'        => true,
                'created_by'       => 1,
                'updated_by'       => null,
            ],

            // ============================================================
            // JASA TIDAK AKTIF (contoh kategori yang sudah tidak tersedia)
            // ============================================================
            [
                'nama_jasa'        => 'Cetak Mug Custom',
                'deskripsi'        => 'Cetak foto atau desain pada mug keramik, cocok untuk souvenir, hadiah, dan merchandise',
                'total_harga'      => 85000,
                'keterangan_bahan' => 'Mug keramik 11oz, cetak sublimasi full color. Minimum 1 pcs.',
                'gambar_contoh'    => null,
                'is_active'        => false, // Tidak aktif - mesin sedang rusak
                'created_by'       => 1,
                'updated_by'       => 1,
            ],
            [
                'nama_jasa'        => 'Cetak Kaos Custom',
                'deskripsi'        => 'Cetak desain pada kaos dengan teknik DTG (Direct to Garment) atau sablon, minimum order 12 pcs',
                'total_harga'      => 120000,
                'keterangan_bahan' => 'Bahan cotton combed 30s. Teknik DTG atau sablon plastisol. Ukuran S, M, L, XL, XXL.',
                'gambar_contoh'    => null,
                'is_active'        => false, // Tidak aktif
                'created_by'       => 1,
                'updated_by'       => 1,
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create($category);
        }
    }
}