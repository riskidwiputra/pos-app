<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Penjualan dari Januari - Mei 2025
     * Mencakup berbagai produk dari semua kategori
     * Dibuat variatif untuk keperluan laporan: harian, mingguan, bulanan, per item
     *
     * Catatan: customer_id = null (walk-in / kasir langsung)
     *          created_by  = 2 (Admin, sesuai UsersSeeder)
     */
    public function run(): void
    {
        // Helper: ambil produk sekali, index by kode_produk
        $products = Product::all()->keyBy('kode_produk');

        // ============================================================
        // DEFINISI TRANSAKSI PENJUALAN
        // Format tiap transaksi:
        //   date, payment_method, notes, items[]
        //   items: [kode_produk, qty, harga_jual (opsional, default dari produk)]
        // ============================================================

        $transactions = [

            // ==========================================================
            // JANUARI 2025
            // ==========================================================

            // Minggu 1
            [
                'date' => '2025-01-08', 'payment' => 'cash', 'notes' => 'Pembelian awal tahun stok sekolah',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 5],
                    ['kode' => 'ATK-PEN-002', 'qty' => 3],
                    ['kode' => 'ATK-PCL-001', 'qty' => 10],
                    ['kode' => 'ATK-PCL-002', 'qty' => 10],
                    ['kode' => 'KRT-BKT-001', 'qty' => 6],
                ],
            ],
            [
                'date' => '2025-01-09', 'payment' => 'transfer', 'notes' => 'Pelanggan kantor - pembelian ATK bulanan',
                'items' => [
                    ['kode' => 'ATK-PEN-003', 'qty' => 3],
                    ['kode' => 'ATK-SPD-001', 'qty' => 6],
                    ['kode' => 'ATK-SPD-002', 'qty' => 4],
                    ['kode' => 'KRT-HVS-001', 'qty' => 5],
                    ['kode' => 'ARS-STP-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-10', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PHP-ERS-001', 'qty' => 8],
                    ['kode' => 'PHP-TPC-001', 'qty' => 5],
                    ['kode' => 'PHP-TPR-001', 'qty' => 4],
                    ['kode' => 'ATK-STB-001', 'qty' => 3],
                    ['kode' => 'ATK-STB-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-01-11', 'payment' => 'cash', 'notes' => 'Print dokumen + beli ATK',
                'items' => [
                    ['kode' => 'CET-BRS-001', 'qty' => 100],  // flyer A5
                    ['kode' => 'ATK-PEN-004', 'qty' => 5],
                    ['kode' => 'KRT-STN-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-13', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 3],
                    ['kode' => 'ATK-PEN-005', 'qty' => 2],
                    ['kode' => 'ARS-CLP-001', 'qty' => 2],
                    ['kode' => 'ARS-CLP-003', 'qty' => 3],
                    ['kode' => 'PMJ-LEM-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-14', 'payment' => 'transfer', 'notes' => 'Order cetak brosur perusahaan',
                'items' => [
                    ['kode' => 'CET-BRS-002', 'qty' => 200],
                    ['kode' => 'FIN-LAM-001', 'qty' => 200],
                ],
            ],
            [
                'date' => '2025-01-15', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'qty' => 3],
                    ['kode' => 'KRT-HVS-002', 'qty' => 2],
                    ['kode' => 'ARS-ORD-001', 'qty' => 3],
                    ['kode' => 'ARS-ORD-002', 'qty' => 2],
                ],
            ],

            // Minggu 2
            [
                'date' => '2025-01-16', 'payment' => 'cash', 'notes' => 'Mahasiswa beli alat gambar',
                'items' => [
                    ['kode' => 'ATK-PCL-003', 'qty' => 1],
                    ['kode' => 'ATK-PCL-005', 'qty' => 3],
                    ['kode' => 'PMJ-PNG-001', 'qty' => 2],
                    ['kode' => 'PMJ-PNG-003', 'qty' => 1],
                    ['kode' => 'PHP-ERS-003', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-17', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'qty' => 2],
                    ['kode' => 'PRT-TNT-006', 'qty' => 3],
                    ['kode' => 'PRT-TNT-007', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-18', 'payment' => 'transfer', 'notes' => 'Cetak kartu nama + jilid skripsi',
                'items' => [
                    ['kode' => 'CET-KNM-001', 'qty' => 2],
                    ['kode' => 'FIN-JLD-003', 'qty' => 3],
                    ['kode' => 'FIN-LAM-002', 'qty' => 30],
                ],
            ],
            [
                'date' => '2025-01-20', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-SPD-003', 'qty' => 2],
                    ['kode' => 'ATK-STB-004', 'qty' => 3],
                    ['kode' => 'KRT-STN-001', 'qty' => 2],
                    ['kode' => 'KRT-STN-003', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-21', 'payment' => 'cash', 'notes' => 'Pembelian perlengkapan kantor baru',
                'items' => [
                    ['kode' => 'PMJ-KLK-001', 'qty' => 1],
                    ['kode' => 'PMJ-ORG-001', 'qty' => 2],
                    ['kode' => 'ARS-BXF-001', 'qty' => 4],
                    ['kode' => 'ARS-PRF-001', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-01-22', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 10],
                    ['kode' => 'ATK-PEN-004', 'qty' => 8],
                    ['kode' => 'KRT-BKT-001', 'qty' => 12],
                    ['kode' => 'PHP-ERS-001', 'qty' => 6],
                ],
            ],

            // Minggu 3
            [
                'date' => '2025-01-23', 'payment' => 'transfer', 'notes' => 'Order banner promo toko baju',
                'items' => [
                    ['kode' => 'DIG-BNR-001', 'qty' => 4],
                    ['kode' => 'DIG-BNR-003', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-24', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'qty' => 1],
                    ['kode' => 'PRT-TNT-002', 'qty' => 1],
                    ['kode' => 'PRT-TNT-003', 'qty' => 1],
                    ['kode' => 'PRT-TNT-004', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-01-25', 'payment' => 'cash', 'notes' => 'Beli ATK sekolah anak',
                'items' => [
                    ['kode' => 'ATK-PCL-001', 'qty' => 4],
                    ['kode' => 'ATK-PCL-002', 'qty' => 4],
                    ['kode' => 'ATK-STB-001', 'qty' => 2],
                    ['kode' => 'KRT-BKT-003', 'qty' => 1],
                    ['kode' => 'PMJ-CTR-002', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-01-27', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ARS-STP-002', 'qty' => 2],
                    ['kode' => 'ARS-STP-003', 'qty' => 3],
                    ['kode' => 'ARS-CLP-002', 'qty' => 2],
                    ['kode' => 'PMJ-LEM-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-28', 'payment' => 'transfer', 'notes' => 'Cetak kalender perusahaan 2025',
                'items' => [
                    ['kode' => 'CET-KLD-001', 'qty' => 25],
                    ['kode' => 'CET-KLD-002', 'qty' => 10],
                ],
            ],
            [
                'date' => '2025-01-29', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'KRT-HVS-003', 'qty' => 2],
                    ['kode' => 'KRT-KRN-001', 'qty' => 20],
                    ['kode' => 'KRT-KRN-002', 'qty' => 30],
                    ['kode' => 'KRT-STN-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-01-30', 'payment' => 'cash', 'notes' => 'Cetak stiker kemasan UMKM',
                'items' => [
                    ['kode' => 'STK-UDG-002', 'qty' => 50],
                    ['kode' => 'STK-LBL-003', 'qty' => 2],
                    ['kode' => 'STK-VNL-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-01-31', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 7],
                    ['kode' => 'ATK-PEN-002', 'qty' => 5],
                    ['kode' => 'PRT-TNT-005', 'qty' => 1],
                    ['kode' => 'PHP-TPC-002', 'qty' => 4],
                ],
            ],

            // ==========================================================
            // FEBRUARI 2025
            // ==========================================================

            [
                'date' => '2025-02-01', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-STB-001', 'qty' => 4],
                    ['kode' => 'ATK-STB-003', 'qty' => 3],
                    ['kode' => 'ATK-STB-005', 'qty' => 2],
                    ['kode' => 'KRT-BKT-004', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-02-03', 'payment' => 'transfer', 'notes' => 'Order cetak nota 3 jenis usaha',
                'items' => [
                    ['kode' => 'CET-NOT-001', 'qty' => 5],
                    ['kode' => 'CET-NOT-002', 'qty' => 3],
                    ['kode' => 'CET-NOT-003', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-04', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNR-001', 'qty' => 1],
                    ['kode' => 'PRT-RBN-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-05', 'payment' => 'cash', 'notes' => 'Guru beli alat tulis kelas',
                'items' => [
                    ['kode' => 'ATK-SPD-001', 'qty' => 8],
                    ['kode' => 'ATK-SPD-002', 'qty' => 4],
                    ['kode' => 'PHP-WBE-001', 'qty' => 2],
                    ['kode' => 'PHP-WBE-002', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-02-06', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ARS-ORD-003', 'qty' => 4],
                    ['kode' => 'ARS-BXF-001', 'qty' => 3],
                    ['kode' => 'ARS-BXF-002', 'qty' => 5],
                    ['kode' => 'KRT-HVS-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-07', 'payment' => 'cash', 'notes' => 'Cetak foto wisuda',
                'items' => [
                    ['kode' => 'DIG-FOT-001', 'qty' => 20],
                    ['kode' => 'DIG-FOT-002', 'qty' => 5],
                    ['kode' => 'FIN-LAM-001', 'qty' => 10],
                ],
            ],
            [
                'date' => '2025-02-10', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-006', 'qty' => 5],
                    ['kode' => 'ATK-PEN-007', 'qty' => 2],
                    ['kode' => 'PHP-ERS-002', 'qty' => 4],
                    ['kode' => 'PHP-TPR-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-02-11', 'payment' => 'transfer', 'notes' => 'Pesanan x-banner pameran dagang',
                'items' => [
                    ['kode' => 'DIG-RUP-002', 'qty' => 4],
                    ['kode' => 'DIG-RUP-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-12', 'payment' => 'cash', 'notes' => 'Beli alat meja kerja baru',
                'items' => [
                    ['kode' => 'PMJ-ORG-002', 'qty' => 1],
                    ['kode' => 'PMJ-KLK-002', 'qty' => 1],
                    ['kode' => 'PMJ-CTR-001', 'qty' => 1],
                    ['kode' => 'PMJ-CTR-003', 'qty' => 1],
                    ['kode' => 'PMJ-LEM-004', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-13', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'STK-LBL-001', 'qty' => 3],
                    ['kode' => 'STK-LBL-002', 'qty' => 2],
                    ['kode' => 'STK-LBL-003', 'qty' => 4],
                ],
            ],
            [
                'date' => '2025-02-14', 'payment' => 'cash', 'notes' => 'Cetak foto couple Valentine',
                'items' => [
                    ['kode' => 'DIG-FOT-001', 'qty' => 30],
                    ['kode' => 'DIG-FOT-003', 'qty' => 15],
                    ['kode' => 'FIN-LAM-002', 'qty' => 20],
                ],
            ],
            [
                'date' => '2025-02-15', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'qty' => 4],
                    ['kode' => 'KRT-HVS-004', 'qty' => 50],
                    ['kode' => 'KRT-HVS-005', 'qty' => 50],
                    ['kode' => 'KRT-KRN-003', 'qty' => 30],
                ],
            ],
            [
                'date' => '2025-02-17', 'payment' => 'transfer', 'notes' => 'Pesan buku modul pelatihan',
                'items' => [
                    ['kode' => 'CET-BKU-001', 'qty' => 30],
                    ['kode' => 'CET-BKU-002', 'qty' => 20],
                ],
            ],
            [
                'date' => '2025-02-18', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 6],
                    ['kode' => 'ATK-PCL-004', 'qty' => 1],
                    ['kode' => 'ATK-STB-001', 'qty' => 4],
                    ['kode' => 'KRT-AGD-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-19', 'payment' => 'cash', 'notes' => 'Tinta printer habis mendadak',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'qty' => 1],
                    ['kode' => 'PRT-TNT-002', 'qty' => 1],
                    ['kode' => 'PRT-TNT-003', 'qty' => 1],
                    ['kode' => 'PRT-TNT-004', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-02-20', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ARS-STP-001', 'qty' => 1],
                    ['kode' => 'ARS-STP-003', 'qty' => 5],
                    ['kode' => 'ARS-STP-004', 'qty' => 3],
                    ['kode' => 'ARS-PRF-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-21', 'payment' => 'cash', 'notes' => 'Cetak pamflet kegiatan masjid',
                'items' => [
                    ['kode' => 'CET-BRS-003', 'qty' => 200],
                    ['kode' => 'DIG-PST-001', 'qty' => 5],
                ],
            ],
            [
                'date' => '2025-02-24', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PHP-TPR-003', 'qty' => 2],
                    ['kode' => 'PHP-ERS-001', 'qty' => 5],
                    ['kode' => 'ATK-SPD-005', 'qty' => 5],
                    ['kode' => 'PMJ-PNG-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-02-25', 'payment' => 'transfer', 'notes' => 'Stiker vinyl toko online',
                'items' => [
                    ['kode' => 'STK-VNL-001', 'qty' => 5],
                    ['kode' => 'STK-UDG-002', 'qty' => 100],
                    ['kode' => 'STK-LBL-004', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-02-26', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-006', 'qty' => 2],
                    ['kode' => 'PRT-TNT-007', 'qty' => 2],
                    ['kode' => 'PRT-RBN-002', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-02-27', 'payment' => 'cash', 'notes' => 'Beli ATK untuk rumah + kantor',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 4],
                    ['kode' => 'ATK-PCL-001', 'qty' => 6],
                    ['kode' => 'ATK-PCL-002', 'qty' => 6],
                    ['kode' => 'KRT-BKT-002', 'qty' => 1],
                    ['kode' => 'PHP-ERS-001', 'qty' => 4],
                    ['kode' => 'PMJ-LEM-002', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-02-28', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'KRT-AGD-001', 'qty' => 3],
                    ['kode' => 'KRT-AGD-003', 'qty' => 2],
                    ['kode' => 'ARS-ORD-001', 'qty' => 5],
                ],
            ],

            // ==========================================================
            // MARET 2025
            // ==========================================================

            [
                'date' => '2025-03-01', 'payment' => 'cash', 'notes' => 'Awal bulan - restock ATK kantor',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 12],
                    ['kode' => 'ATK-PEN-004', 'qty' => 10],
                    ['kode' => 'ATK-SPD-001', 'qty' => 6],
                    ['kode' => 'KRT-HVS-001', 'qty' => 3],
                    ['kode' => 'ARS-CLP-001', 'qty' => 2],
                    ['kode' => 'ARS-CLP-003', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-03-03', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-008', 'qty' => 3],
                    ['kode' => 'PRT-TNT-006', 'qty' => 2],
                    ['kode' => 'PMJ-LEM-001', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-03-04', 'payment' => 'transfer', 'notes' => 'Cetak banner event komunitas',
                'items' => [
                    ['kode' => 'DIG-BNR-001', 'qty' => 6],
                    ['kode' => 'DIG-PST-001', 'qty' => 10],
                    ['kode' => 'DIG-RUP-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-03-05', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-STB-001', 'qty' => 5],
                    ['kode' => 'ATK-STB-002', 'qty' => 5],
                    ['kode' => 'ATK-STB-003', 'qty' => 4],
                    ['kode' => 'ATK-STB-005', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-03-06', 'payment' => 'cash', 'notes' => 'Mahasiswa beli untuk KKN',
                'items' => [
                    ['kode' => 'KRT-BKT-001', 'qty' => 10],
                    ['kode' => 'KRT-BKT-004', 'qty' => 5],
                    ['kode' => 'ATK-PEN-001', 'qty' => 8],
                    ['kode' => 'ATK-PEN-002', 'qty' => 6],
                    ['kode' => 'ATK-PCL-001', 'qty' => 10],
                    ['kode' => 'PHP-ERS-001', 'qty' => 8],
                ],
            ],
            [
                'date' => '2025-03-07', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'FIN-JLD-001', 'qty' => 5],
                    ['kode' => 'FIN-JLD-002', 'qty' => 8],
                    ['kode' => 'FIN-LAM-002', 'qty' => 20],
                ],
            ],
            [
                'date' => '2025-03-08', 'payment' => 'transfer', 'notes' => 'Hari Perempuan - cetak sertifikat event',
                'items' => [
                    ['kode' => 'KRT-KRN-003', 'qty' => 50],
                    ['kode' => 'FIN-FLS-001', 'qty' => 50],
                    ['kode' => 'FIN-LAM-001', 'qty' => 50],
                ],
            ],
            [
                'date' => '2025-03-10', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNR-002', 'qty' => 1],
                    ['kode' => 'PRT-TNR-003', 'qty' => 1],
                    ['kode' => 'PMJ-KLK-001', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-03-11', 'payment' => 'cash', 'notes' => 'Kantor baru beli perlengkapan',
                'items' => [
                    ['kode' => 'ARS-ORD-001', 'qty' => 10],
                    ['kode' => 'ARS-ORD-002', 'qty' => 8],
                    ['kode' => 'ARS-ORD-003', 'qty' => 5],
                    ['kode' => 'ARS-BXF-001', 'qty' => 6],
                    ['kode' => 'PMJ-ORG-001', 'qty' => 3],
                    ['kode' => 'PMJ-ORG-002', 'qty' => 2],
                    ['kode' => 'PMJ-KLK-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-03-12', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 5],
                    ['kode' => 'ATK-PCL-002', 'qty' => 6],
                    ['kode' => 'PHP-TPC-001', 'qty' => 4],
                    ['kode' => 'KRT-STN-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-03-13', 'payment' => 'transfer', 'notes' => 'Cetak buku laporan bulanan perusahaan',
                'items' => [
                    ['kode' => 'CET-BKU-002', 'qty' => 15],
                    ['kode' => 'FIN-JLD-001', 'qty' => 15],
                ],
            ],
            [
                'date' => '2025-03-14', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'STK-CUT-001', 'qty' => 5],
                    ['kode' => 'STK-CUT-002', 'qty' => 3],
                    ['kode' => 'STK-UDG-001', 'qty' => 30],
                ],
            ],
            [
                'date' => '2025-03-15', 'payment' => 'cash', 'notes' => 'Weekend ramai - berbagai pembeli',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 8],
                    ['kode' => 'ATK-PEN-002', 'qty' => 6],
                    ['kode' => 'ATK-SPD-001', 'qty' => 4],
                    ['kode' => 'PHP-ERS-001', 'qty' => 6],
                    ['kode' => 'KRT-BKT-001', 'qty' => 8],
                    ['kode' => 'KRT-HVS-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-03-17', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'DIG-FOT-001', 'qty' => 25],
                    ['kode' => 'DIG-FOT-003', 'qty' => 10],
                    ['kode' => 'FIN-LAM-003', 'qty' => 15],
                ],
            ],
            [
                'date' => '2025-03-18', 'payment' => 'cash', 'notes' => 'Beli tinta epson set',
                'items' => [
                    ['kode' => 'PRT-TNT-005', 'qty' => 2],
                    ['kode' => 'PRT-TNT-001', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-03-19', 'payment' => 'transfer', 'notes' => 'Order label barcode toko retail',
                'items' => [
                    ['kode' => 'STK-LBL-001', 'qty' => 10],
                    ['kode' => 'STK-LBL-002', 'qty' => 8],
                    ['kode' => 'STK-LBL-003', 'qty' => 5],
                    ['kode' => 'STK-LBL-004', 'qty' => 4],
                ],
            ],
            [
                'date' => '2025-03-20', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PMJ-CTR-001', 'qty' => 2],
                    ['kode' => 'PMJ-CTR-002', 'qty' => 3],
                    ['kode' => 'PMJ-CTR-004', 'qty' => 3],
                    ['kode' => 'PMJ-LEM-003', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-03-21', 'payment' => 'cash', 'notes' => 'Cetak flyer promo Ramadan',
                'items' => [
                    ['kode' => 'CET-BRS-001', 'qty' => 300],
                    ['kode' => 'CET-BRS-002', 'qty' => 150],
                    ['kode' => 'DIG-PST-001', 'qty' => 8],
                ],
            ],
            [
                'date' => '2025-03-22', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-003', 'qty' => 2],
                    ['kode' => 'ATK-SPD-004', 'qty' => 3],
                    ['kode' => 'KRT-AGD-001', 'qty' => 2],
                    ['kode' => 'KRT-STN-001', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-03-24', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ARS-STP-002', 'qty' => 3],
                    ['kode' => 'ARS-STP-003', 'qty' => 4],
                    ['kode' => 'ARS-CLP-001', 'qty' => 3],
                    ['kode' => 'ARS-PRF-001', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-03-25', 'payment' => 'transfer', 'notes' => 'Cetak kartu nama premium 3 orang',
                'items' => [
                    ['kode' => 'CET-KNM-002', 'qty' => 3],
                    ['kode' => 'FIN-FLS-001', 'qty' => 30],
                ],
            ],
            [
                'date' => '2025-03-27', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-006', 'qty' => 3],
                    ['kode' => 'PRT-TNT-008', 'qty' => 3],
                    ['kode' => 'PRT-RBN-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-03-28', 'payment' => 'cash', 'notes' => 'Persiapan lebaran - cetak amplop',
                'items' => [
                    ['kode' => 'KRT-KRN-002', 'qty' => 50],
                    ['kode' => 'KRT-KRN-003', 'qty' => 40],
                    ['kode' => 'FIN-POT-001', 'qty' => 50],
                ],
            ],
            [
                'date' => '2025-03-31', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 6],
                    ['kode' => 'ATK-PCL-001', 'qty' => 8],
                    ['kode' => 'KRT-BKT-001', 'qty' => 5],
                    ['kode' => 'PHP-ERS-001', 'qty' => 5],
                    ['kode' => 'ATK-STB-001', 'qty' => 3],
                ],
            ],

            // ==========================================================
            // APRIL 2025
            // ==========================================================

            [
                'date' => '2025-04-01', 'payment' => 'cash', 'notes' => 'Setelah lebaran - beli ATK baru',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 10],
                    ['kode' => 'ATK-PEN-002', 'qty' => 8],
                    ['kode' => 'ATK-PCL-001', 'qty' => 12],
                    ['kode' => 'KRT-HVS-001', 'qty' => 4],
                ],
            ],
            [
                'date' => '2025-04-02', 'payment' => 'transfer', 'notes' => 'Cetak spanduk Hari Kartini',
                'items' => [
                    ['kode' => 'DIG-BNR-001', 'qty' => 8],
                    ['kode' => 'DIG-BNR-002', 'qty' => 3],
                    ['kode' => 'DIG-RUP-001', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-04-03', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'qty' => 2],
                    ['kode' => 'PRT-TNT-002', 'qty' => 2],
                    ['kode' => 'PRT-TNT-003', 'qty' => 2],
                    ['kode' => 'PRT-TNT-004', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-04-04', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PHP-TPC-001', 'qty' => 5],
                    ['kode' => 'PHP-TPC-002', 'qty' => 5],
                    ['kode' => 'PHP-TPR-001', 'qty' => 6],
                    ['kode' => 'PHP-ERS-002', 'qty' => 4],
                ],
            ],
            [
                'date' => '2025-04-05', 'payment' => 'cash', 'notes' => 'Siswa SMA beli persiapan ujian',
                'items' => [
                    ['kode' => 'ATK-PCL-002', 'qty' => 15],
                    ['kode' => 'PHP-ERS-001', 'qty' => 15],
                    ['kode' => 'KRT-BKT-001', 'qty' => 12],
                    ['kode' => 'ATK-STB-001', 'qty' => 8],
                    ['kode' => 'ATK-PEN-001', 'qty' => 10],
                ],
            ],
            [
                'date' => '2025-04-07', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ARS-ORD-001', 'qty' => 4],
                    ['kode' => 'ARS-ORD-002', 'qty' => 4],
                    ['kode' => 'ARS-CLP-002', 'qty' => 4],
                    ['kode' => 'ARS-BXF-001', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-04-08', 'payment' => 'transfer', 'notes' => 'Cetak undangan pernikahan + amplop',
                'items' => [
                    ['kode' => 'STK-UDG-001', 'qty' => 200],
                    ['kode' => 'FIN-LAM-001', 'qty' => 100],
                    ['kode' => 'FIN-FLS-002', 'qty' => 100],
                ],
            ],
            [
                'date' => '2025-04-09', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PMJ-LEM-001', 'qty' => 4],
                    ['kode' => 'PMJ-LEM-002', 'qty' => 3],
                    ['kode' => 'PMJ-LEM-004', 'qty' => 3],
                    ['kode' => 'PMJ-PNG-001', 'qty' => 4],
                ],
            ],
            [
                'date' => '2025-04-10', 'payment' => 'cash', 'notes' => 'Kantor beli toner laser',
                'items' => [
                    ['kode' => 'PRT-TNR-001', 'qty' => 1],
                    ['kode' => 'PRT-TNR-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-04-11', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 7],
                    ['kode' => 'ATK-PEN-005', 'qty' => 4],
                    ['kode' => 'ATK-PEN-006', 'qty' => 5],
                    ['kode' => 'KRT-STN-002', 'qty' => 4],
                ],
            ],
            [
                'date' => '2025-04-12', 'payment' => 'cash', 'notes' => 'Weekend - banyak pelajar belanja',
                'items' => [
                    ['kode' => 'ATK-PCL-001', 'qty' => 15],
                    ['kode' => 'ATK-PCL-002', 'qty' => 12],
                    ['kode' => 'KRT-BKT-001', 'qty' => 15],
                    ['kode' => 'PHP-ERS-001', 'qty' => 12],
                    ['kode' => 'ATK-STB-001', 'qty' => 7],
                    ['kode' => 'ATK-STB-002', 'qty' => 6],
                ],
            ],
            [
                'date' => '2025-04-14', 'payment' => 'transfer', 'notes' => 'Order vinyl stiker kemasan produk UMKM',
                'items' => [
                    ['kode' => 'STK-VNL-001', 'qty' => 8],
                    ['kode' => 'STK-VNL-002', 'qty' => 3],
                    ['kode' => 'STK-UDG-002', 'qty' => 150],
                ],
            ],
            [
                'date' => '2025-04-15', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'CET-BRS-001', 'qty' => 200],
                    ['kode' => 'CET-BRS-002', 'qty' => 100],
                ],
            ],
            [
                'date' => '2025-04-16', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'qty' => 5],
                    ['kode' => 'KRT-HVS-002', 'qty' => 3],
                    ['kode' => 'KRT-HVS-003', 'qty' => 2],
                    ['kode' => 'KRT-KRN-001', 'qty' => 30],
                ],
            ],
            [
                'date' => '2025-04-17', 'payment' => 'cash', 'notes' => 'Beli kalkulator scientific untuk anak kuliah',
                'items' => [
                    ['kode' => 'PMJ-KLK-003', 'qty' => 2],
                    ['kode' => 'ATK-PCL-003', 'qty' => 1],
                    ['kode' => 'ATK-PCL-005', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-04-18', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'FIN-JLD-001', 'qty' => 8],
                    ['kode' => 'FIN-JLD-002', 'qty' => 10],
                    ['kode' => 'FIN-POT-002', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-04-19', 'payment' => 'transfer', 'notes' => 'Cetak foto studio wisuda S1',
                'items' => [
                    ['kode' => 'DIG-FOT-001', 'qty' => 40],
                    ['kode' => 'DIG-FOT-002', 'qty' => 10],
                    ['kode' => 'FIN-LAM-001', 'qty' => 20],
                    ['kode' => 'FIN-JLD-003', 'qty' => 5],
                ],
            ],
            [
                'date' => '2025-04-21', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-SPD-001', 'qty' => 6],
                    ['kode' => 'ATK-SPD-002', 'qty' => 4],
                    ['kode' => 'ATK-SPD-003', 'qty' => 2],
                    ['kode' => 'PHP-WBE-001', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-04-22', 'payment' => 'cash', 'notes' => 'Hari Bumi - cetak banner go green',
                'items' => [
                    ['kode' => 'DIG-BNR-001', 'qty' => 5],
                    ['kode' => 'DIG-PST-001', 'qty' => 6],
                    ['kode' => 'CET-BRS-002', 'qty' => 100],
                ],
            ],
            [
                'date' => '2025-04-23', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-006', 'qty' => 4],
                    ['kode' => 'PRT-TNT-007', 'qty' => 3],
                    ['kode' => 'PRT-TNT-008', 'qty' => 4],
                    ['kode' => 'PRT-RBN-001', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-04-24', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 8],
                    ['kode' => 'ATK-PEN-004', 'qty' => 6],
                    ['kode' => 'PHP-ERS-001', 'qty' => 8],
                    ['kode' => 'KRT-BKT-001', 'qty' => 10],
                ],
            ],
            [
                'date' => '2025-04-25', 'payment' => 'transfer', 'notes' => 'Label barcode minimarket',
                'items' => [
                    ['kode' => 'STK-LBL-001', 'qty' => 15],
                    ['kode' => 'STK-LBL-002', 'qty' => 10],
                    ['kode' => 'STK-LBL-003', 'qty' => 8],
                ],
            ],
            [
                'date' => '2025-04-26', 'payment' => 'cash', 'notes' => 'Weekend - berbagai pelanggan',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 6],
                    ['kode' => 'ATK-PCL-001', 'qty' => 8],
                    ['kode' => 'ATK-STB-001', 'qty' => 5],
                    ['kode' => 'ATK-STB-002', 'qty' => 4],
                    ['kode' => 'KRT-BKT-001', 'qty' => 6],
                    ['kode' => 'PMJ-LEM-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-04-28', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'ARS-STP-001', 'qty' => 1],
                    ['kode' => 'ARS-STP-003', 'qty' => 4],
                    ['kode' => 'ARS-CLP-003', 'qty' => 4],
                    ['kode' => 'ARS-PRF-001', 'qty' => 1],
                ],
            ],
            [
                'date' => '2025-04-29', 'payment' => 'transfer', 'notes' => 'Cetak spanduk hari buruh',
                'items' => [
                    ['kode' => 'DIG-BNR-003', 'qty' => 4],
                    ['kode' => 'DIG-RUP-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-04-30', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'qty' => 3],
                    ['kode' => 'KRT-HVS-004', 'qty' => 40],
                    ['kode' => 'KRT-HVS-005', 'qty' => 40],
                    ['kode' => 'KRT-KRN-002', 'qty' => 25],
                ],
            ],

            // ==========================================================
            // MEI 2025
            // ==========================================================

            [
                'date' => '2025-05-02', 'payment' => 'cash', 'notes' => 'Pasca Hari Buruh - buka kembali',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 8],
                    ['kode' => 'ATK-PEN-002', 'qty' => 6],
                    ['kode' => 'ATK-PCL-001', 'qty' => 10],
                    ['kode' => 'KRT-BKT-001', 'qty' => 8],
                ],
            ],
            [
                'date' => '2025-05-03', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'qty' => 2],
                    ['kode' => 'PRT-TNT-002', 'qty' => 1],
                    ['kode' => 'PRT-TNT-003', 'qty' => 1],
                    ['kode' => 'PRT-TNT-004', 'qty' => 1],
                    ['kode' => 'PRT-TNT-006', 'qty' => 2],
                ],
            ],
            [
                'date' => '2025-05-05', 'payment' => 'transfer', 'notes' => 'Cetak poster Hari Pendidikan Nasional',
                'items' => [
                    ['kode' => 'CET-BRS-001', 'qty' => 500],
                    ['kode' => 'DIG-PST-001', 'qty' => 12],
                    ['kode' => 'DIG-BNR-001', 'qty' => 5],
                ],
            ],
            [
                'date' => '2025-05-06', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'PHP-ERS-001', 'qty' => 10],
                    ['kode' => 'PHP-TPC-001', 'qty' => 6],
                    ['kode' => 'PHP-TPR-001', 'qty' => 5],
                    ['kode' => 'PHP-TPR-002', 'qty' => 3],
                ],
            ],
            [
                'date' => '2025-05-07', 'payment' => 'cash', 'notes' => 'Guru-guru beli persiapan ujian sekolah',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'qty' => 10],
                    ['kode' => 'KRT-HVS-002', 'qty' => 6],
                    ['kode' => 'ATK-PEN-001', 'qty' => 20],
                    ['kode' => 'ATK-PEN-004', 'qty' => 15],
                    ['kode' => 'ATK-PCL-002', 'qty' => 20],
                    ['kode' => 'PHP-ERS-001', 'qty' => 20],
                ],
            ],
            [
                'date' => '2025-05-08', 'payment' => 'cash', 'notes' => '',
                'items' => [
                    ['kode' => 'FIN-JLD-001', 'qty' => 10],
                    ['kode' => 'FIN-JLD-002', 'qty' => 12],
                    ['kode' => 'FIN-LAM-001', 'qty' => 30],
                    ['kode' => 'FIN-LAM-003', 'qty' => 20],
                ],
            ],
            [
                'date' => '2025-05-09', 'payment' => 'transfer', 'notes' => 'Cetak materi ujian sekolah + soal',
                'items' => [
                    ['kode' => 'CET-BRS-003', 'qty' => 500],
                    ['kode' => 'CET-BKU-002', 'qty' => 20],
                ],
            ],
            [
                'date' => '2025-05-10', 'payment' => 'cash', 'notes' => 'Weekend - belanja akhir pekan',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'qty' => 7],
                    ['kode' => 'ATK-PEN-002', 'qty' => 5],
                    ['kode' => 'ATK-STB-001', 'qty' => 4],
                    ['kode' => 'ATK-STB-003', 'qty' => 4],
                    ['kode' => 'KRT-BKT-001', 'qty' => 8],
                    ['kode' => 'PMJ-CTR-002', 'qty' => 2],
                    ['kode' => 'PMJ-LEM-002', 'qty' => 2],
                ],
            ],
        ];

        // ============================================================
        // PROSES INSERT
        // ============================================================

        $invoiceCounter = 1;

        foreach ($transactions as $trx) {
            DB::beginTransaction();
            try {
                $invoiceNumber = 'INV-' . date('Ymd', strtotime($trx['date'])) . '-' . str_pad($invoiceCounter, 4, '0', STR_PAD_LEFT);

                // Hitung total & validasi item
                $total = 0;
                $resolvedItems = [];

                foreach ($trx['items'] as $item) {
                    $kode    = $item['kode'];
                    $product = $products->get($kode);

                    if (!$product) {
                        throw new \Exception("Produk dengan kode {$kode} tidak ditemukan!");
                    }

                    $price    = $item['harga_jual'] ?? $product->harga_jual;
                    $qty      = $item['qty'];
                    $subtotal = $price * $qty;
                    $total   += $subtotal;

                    $resolvedItems[] = [
                        'product'    => $product,
                        'price'      => $price,
                        'qty'        => $qty,
                        'subtotal'   => $subtotal,
                    ];
                }

                // Simulasi pembayaran (semua cash / transfer langsung lunas)
                $paidAmount   = $total;
                $changeAmount = 0;

                // Buat Sale
                $sale = Sale::create([
                    'invoice_number'   => $invoiceNumber,
                    'customer_id'      => null,
                    'transaction_date' => $trx['date'],
                    'payment_method'   => $trx['payment'],
                    'notes'            => $trx['notes'],
                    'total'            => $total,
                    'paid_amount'      => $paidAmount,
                    'change_amount'    => $changeAmount,
                    'status'           => 'lunas',
                    'created_by'       => 2, // Admin (UsersSeeder)
                ]);

                // Buat SaleItem & update stok
                foreach ($resolvedItems as $ri) {
                    $product = $ri['product'];

                    SaleItem::create([
                        'sale_id'       => $sale->id,
                        'product_id'    => $product->id,
                        'product_name'  => $product->nama_produk,
                        'price'         => $ri['price'],
                        'price_purchase'=> $product->harga_beli ?? 0,
                        'quantity'      => $ri['qty'],
                        'unit'          => $product->unit->singkatan ?? 'Pcs',
                        'subtotal'      => $ri['subtotal'],
                    ]);

                    // Kurangi stok (update in-memory juga agar transaksi berikutnya akurat)
                    $product->stok_tersedia -= $ri['qty'];
                    $product->save();

                    // Perbarui cache in-memory
                    $products->put($product->kode_produk, $product->fresh());
                }

                DB::commit();
                $invoiceCounter++;

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }
}