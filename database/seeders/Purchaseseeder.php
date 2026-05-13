<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // MAPPING SUPPLIER PER KATEGORI
        // supplier_id 1  = CV Sumber Rejeki        → Alat Tulis
        // supplier_id 2  = PT Maju Jaya Abadi      → Kertas & Buku
        // supplier_id 3  = UD Berkah Mandiri        → Penghapus & Korektor
        // supplier_id 4  = CV Karya Sejahtera       → Perlengkapan Arsip
        // supplier_id 5  = Toko Mitra Usaha         → Perlengkapan Meja
        // supplier_id 6  = UD Jaya Bersama          → Printer & Tinta
        // supplier_id 7  = CV Sinar Abadi           → Percetakan Umum (bahan baku)
        // supplier_id 8  = PT Andalas Supplier      → Finishing Percetakan (bahan)
        // supplier_id 9  = UD Makmur Sentosa        → Stiker & Label
        // supplier_id 10 = CV Berkah Jaya           → Amplop & Map
        // ============================================================

        $purchases = [

            // ============================================================
            // PEMBELIAN 1 - ALAT TULIS (Supplier: CV Sumber Rejeki)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0001',
                'supplier_id'           => 1,
                'nomor_invoice'         => 'INV/CSR/2025/001',
                'tgl_invoice'           => '2025-01-05',
                'tanggal_terima_barang' => '2025-01-07',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok awal alat tulis - pulpen dan pensil',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'harga_beli' => 8000,  'qty' => 200],
                    ['kode' => 'ATK-PEN-002', 'harga_beli' => 8000,  'qty' => 150],
                    ['kode' => 'ATK-PEN-003', 'harga_beli' => 45000, 'qty' => 50],
                    ['kode' => 'ATK-PEN-004', 'harga_beli' => 5000,  'qty' => 250],
                    ['kode' => 'ATK-PEN-005', 'harga_beli' => 12000, 'qty' => 100],
                    ['kode' => 'ATK-PEN-006', 'harga_beli' => 10000, 'qty' => 120],
                    ['kode' => 'ATK-PEN-007', 'harga_beli' => 38000, 'qty' => 40],
                    ['kode' => 'ATK-PCL-001', 'harga_beli' => 3500,  'qty' => 350],
                    ['kode' => 'ATK-PCL-002', 'harga_beli' => 3000,  'qty' => 400],
                    ['kode' => 'ATK-PCL-003', 'harga_beli' => 55000, 'qty' => 30],
                    ['kode' => 'ATK-PCL-004', 'harga_beli' => 65000, 'qty' => 20],
                    ['kode' => 'ATK-PCL-005', 'harga_beli' => 8000,  'qty' => 100],
                ],
            ],

            // ============================================================
            // PEMBELIAN 2 - ALAT TULIS LANJUTAN (Supplier: CV Sumber Rejeki)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0002',
                'supplier_id'           => 1,
                'nomor_invoice'         => 'INV/CSR/2025/002',
                'tgl_invoice'           => '2025-01-12',
                'tanggal_terima_barang' => '2025-01-14',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok awal alat tulis - spidol, stabilo, rautan',
                'items' => [
                    ['kode' => 'ATK-SPD-001', 'harga_beli' => 7000,  'qty' => 150],
                    ['kode' => 'ATK-SPD-002', 'harga_beli' => 7000,  'qty' => 100],
                    ['kode' => 'ATK-SPD-003', 'harga_beli' => 28000, 'qty' => 60],
                    ['kode' => 'ATK-SPD-004', 'harga_beli' => 15000, 'qty' => 50],
                    ['kode' => 'ATK-SPD-005', 'harga_beli' => 5000,  'qty' => 120],
                    ['kode' => 'ATK-STB-001', 'harga_beli' => 9000,  'qty' => 120],
                    ['kode' => 'ATK-STB-002', 'harga_beli' => 9000,  'qty' => 100],
                    ['kode' => 'ATK-STB-003', 'harga_beli' => 9000,  'qty' => 110],
                    ['kode' => 'ATK-STB-004', 'harga_beli' => 18000, 'qty' => 70],
                    ['kode' => 'ATK-STB-005', 'harga_beli' => 18000, 'qty' => 60],
                    ['kode' => 'ATK-RAU-001', 'harga_beli' => 5000,  'qty' => 100],
                    ['kode' => 'ATK-RAU-002', 'harga_beli' => 45000, 'qty' => 20],
                    ['kode' => 'ATK-RAU-003', 'harga_beli' => 12000, 'qty' => 60],
                ],
            ],

            // ============================================================
            // PEMBELIAN 3 - KERTAS & BUKU (Supplier: PT Maju Jaya Abadi)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0003',
                'supplier_id'           => 2,
                'nomor_invoice'         => 'INV/PTMJA/2025/0031',
                'tgl_invoice'           => '2025-01-10',
                'tanggal_terima_barang' => '2025-01-13',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok awal kertas HVS dan buku tulis',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'harga_beli' => 42000, 'qty' => 100],
                    ['kode' => 'KRT-HVS-002', 'harga_beli' => 52000, 'qty' => 80],
                    ['kode' => 'KRT-HVS-003', 'harga_beli' => 55000, 'qty' => 60],
                    ['kode' => 'KRT-HVS-004', 'harga_beli' => 200,   'qty' => 600],
                    ['kode' => 'KRT-HVS-005', 'harga_beli' => 200,   'qty' => 600],
                    ['kode' => 'KRT-BKT-001', 'harga_beli' => 4000,  'qty' => 250],
                    ['kode' => 'KRT-BKT-002', 'harga_beli' => 55000, 'qty' => 30],
                    ['kode' => 'KRT-BKT-003', 'harga_beli' => 18000, 'qty' => 70],
                    ['kode' => 'KRT-BKT-004', 'harga_beli' => 8000,  'qty' => 100],
                    ['kode' => 'KRT-AGD-001', 'harga_beli' => 35000, 'qty' => 40],
                    ['kode' => 'KRT-AGD-002', 'harga_beli' => 28000, 'qty' => 30],
                    ['kode' => 'KRT-AGD-003', 'harga_beli' => 22000, 'qty' => 50],
                    ['kode' => 'KRT-KRN-001', 'harga_beli' => 1500,  'qty' => 400],
                    ['kode' => 'KRT-KRN-002', 'harga_beli' => 800,   'qty' => 500],
                    ['kode' => 'KRT-KRN-003', 'harga_beli' => 1200,  'qty' => 400],
                    ['kode' => 'KRT-STN-001', 'harga_beli' => 30000, 'qty' => 50],
                    ['kode' => 'KRT-STN-002', 'harga_beli' => 8000,  'qty' => 100],
                    ['kode' => 'KRT-STN-003', 'harga_beli' => 12000, 'qty' => 70],
                ],
            ],

            // ============================================================
            // PEMBELIAN 4 - PENGHAPUS & KOREKTOR (Supplier: UD Berkah Mandiri)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0004',
                'supplier_id'           => 3,
                'nomor_invoice'         => 'INV/UDBM/2025/0041',
                'tgl_invoice'           => '2025-01-15',
                'tanggal_terima_barang' => '2025-01-17',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok penghapus, tip-ex cair, dan korektor',
                'items' => [
                    ['kode' => 'PHP-ERS-001', 'harga_beli' => 4000,  'qty' => 200],
                    ['kode' => 'PHP-ERS-002', 'harga_beli' => 8000,  'qty' => 100],
                    ['kode' => 'PHP-ERS-003', 'harga_beli' => 6000,  'qty' => 80],
                    ['kode' => 'PHP-TPC-001', 'harga_beli' => 6000,  'qty' => 130],
                    ['kode' => 'PHP-TPC-002', 'harga_beli' => 5000,  'qty' => 150],
                    ['kode' => 'PHP-TPR-001', 'harga_beli' => 8000,  'qty' => 100],
                    ['kode' => 'PHP-TPR-002', 'harga_beli' => 18000, 'qty' => 60],
                    ['kode' => 'PHP-TPR-003', 'harga_beli' => 22000, 'qty' => 50],
                    ['kode' => 'PHP-WBE-001', 'harga_beli' => 12000, 'qty' => 50],
                    ['kode' => 'PHP-WBE-002', 'harga_beli' => 25000, 'qty' => 30],
                ],
            ],

            // ============================================================
            // PEMBELIAN 5 - PERLENGKAPAN ARSIP (Supplier: CV Karya Sejahtera)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0005',
                'supplier_id'           => 4,
                'nomor_invoice'         => 'INV/CVKS/2025/0051',
                'tgl_invoice'           => '2025-01-18',
                'tanggal_terima_barang' => '2025-01-20',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok ordner, stapler, clip, dan binder',
                'items' => [
                    ['kode' => 'ARS-ORD-001', 'harga_beli' => 22000, 'qty' => 70],
                    ['kode' => 'ARS-ORD-002', 'harga_beli' => 22000, 'qty' => 65],
                    ['kode' => 'ARS-ORD-003', 'harga_beli' => 25000, 'qty' => 50],
                    ['kode' => 'ARS-CLP-001', 'harga_beli' => 8000,  'qty' => 100],
                    ['kode' => 'ARS-CLP-002', 'harga_beli' => 6500,  'qty' => 110],
                    ['kode' => 'ARS-CLP-003', 'harga_beli' => 5000,  'qty' => 120],
                    ['kode' => 'ARS-STP-001', 'harga_beli' => 35000, 'qty' => 30],
                    ['kode' => 'ARS-STP-002', 'harga_beli' => 15000, 'qty' => 45],
                    ['kode' => 'ARS-STP-003', 'harga_beli' => 5000,  'qty' => 120],
                    ['kode' => 'ARS-STP-004', 'harga_beli' => 7000,  'qty' => 90],
                    ['kode' => 'ARS-PRF-001', 'harga_beli' => 30000, 'qty' => 25],
                    ['kode' => 'ARS-PRF-002', 'harga_beli' => 12000, 'qty' => 30],
                    ['kode' => 'ARS-BXF-001', 'harga_beli' => 18000, 'qty' => 50],
                    ['kode' => 'ARS-BXF-002', 'harga_beli' => 8000,  'qty' => 60],
                ],
            ],

            // ============================================================
            // PEMBELIAN 6 - PERLENGKAPAN MEJA (Supplier: Toko Mitra Usaha)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0006',
                'supplier_id'           => 5,
                'nomor_invoice'         => 'INV/TMU/2025/0061',
                'tgl_invoice'           => '2025-01-22',
                'tanggal_terima_barang' => '2025-01-24',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok cutter, penggaris, lem, kalkulator, dan organizer',
                'items' => [
                    ['kode' => 'PMJ-ORG-001', 'harga_beli' => 25000,  'qty' => 30],
                    ['kode' => 'PMJ-ORG-002', 'harga_beli' => 45000,  'qty' => 20],
                    ['kode' => 'PMJ-CTR-001', 'harga_beli' => 18000,  'qty' => 50],
                    ['kode' => 'PMJ-CTR-002', 'harga_beli' => 8000,   'qty' => 75],
                    ['kode' => 'PMJ-CTR-003', 'harga_beli' => 12000,  'qty' => 45],
                    ['kode' => 'PMJ-CTR-004', 'harga_beli' => 6000,   'qty' => 80],
                    ['kode' => 'PMJ-PNG-001', 'harga_beli' => 4000,   'qty' => 100],
                    ['kode' => 'PMJ-PNG-002', 'harga_beli' => 12000,  'qty' => 60],
                    ['kode' => 'PMJ-PNG-003', 'harga_beli' => 15000,  'qty' => 40],
                    ['kode' => 'PMJ-LEM-001', 'harga_beli' => 12000,  'qty' => 100],
                    ['kode' => 'PMJ-LEM-002', 'harga_beli' => 8000,   'qty' => 110],
                    ['kode' => 'PMJ-LEM-003', 'harga_beli' => 15000,  'qty' => 60],
                    ['kode' => 'PMJ-LEM-004', 'harga_beli' => 14000,  'qty' => 55],
                    ['kode' => 'PMJ-KLK-001', 'harga_beli' => 65000,  'qty' => 20],
                    ['kode' => 'PMJ-KLK-002', 'harga_beli' => 25000,  'qty' => 25],
                    ['kode' => 'PMJ-KLK-003', 'harga_beli' => 135000, 'qty' => 12],
                ],
            ],

            // ============================================================
            // PEMBELIAN 7 - PRINTER & TINTA (Supplier: UD Jaya Bersama)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0007',
                'supplier_id'           => 6,
                'nomor_invoice'         => 'INV/UDJB/2025/0071',
                'tgl_invoice'           => '2025-01-25',
                'tanggal_terima_barang' => '2025-01-28',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok tinta Epson, Canon, HP, dan toner laser',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'harga_beli' => 55000,  'qty' => 40],
                    ['kode' => 'PRT-TNT-002', 'harga_beli' => 55000,  'qty' => 35],
                    ['kode' => 'PRT-TNT-003', 'harga_beli' => 55000,  'qty' => 35],
                    ['kode' => 'PRT-TNT-004', 'harga_beli' => 55000,  'qty' => 35],
                    ['kode' => 'PRT-TNT-005', 'harga_beli' => 200000, 'qty' => 20],
                    ['kode' => 'PRT-TNT-006', 'harga_beli' => 25000,  'qty' => 60],
                    ['kode' => 'PRT-TNT-007', 'harga_beli' => 30000,  'qty' => 50],
                    ['kode' => 'PRT-TNT-008', 'harga_beli' => 22000,  'qty' => 55],
                    ['kode' => 'PRT-TNR-001', 'harga_beli' => 380000, 'qty' => 12],
                    ['kode' => 'PRT-TNR-002', 'harga_beli' => 120000, 'qty' => 15],
                    ['kode' => 'PRT-TNR-003', 'harga_beli' => 130000, 'qty' => 12],
                    ['kode' => 'PRT-RBN-001', 'harga_beli' => 25000,  'qty' => 25],
                    ['kode' => 'PRT-RBN-002', 'harga_beli' => 30000,  'qty' => 20],
                ],
            ],

            // ============================================================
            // PEMBELIAN 8 - LABEL & STIKER FISIK (Supplier: UD Makmur Sentosa)
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0008',
                'supplier_id'           => 9,
                'nomor_invoice'         => 'INV/UDMS/2025/0081',
                'tgl_invoice'           => '2025-02-03',
                'tanggal_terima_barang' => '2025-02-05',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Pembelian stok label barcode, label harga, dan label stiker',
                'items' => [
                    ['kode' => 'STK-LBL-001', 'harga_beli' => 35000, 'qty' => 40],
                    ['kode' => 'STK-LBL-002', 'harga_beli' => 28000, 'qty' => 45],
                    ['kode' => 'STK-LBL-003', 'harga_beli' => 12000, 'qty' => 70],
                    ['kode' => 'STK-LBL-004', 'harga_beli' => 25000, 'qty' => 35],
                ],
            ],

            // ============================================================
            // PEMBELIAN 9 - RESTOCK ALAT TULIS (Supplier: CV Sumber Rejeki)
            // Bulan Maret - restock produk fast-moving
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0009',
                'supplier_id'           => 1,
                'nomor_invoice'         => 'INV/CSR/2025/003',
                'tgl_invoice'           => '2025-03-05',
                'tanggal_terima_barang' => '2025-03-07',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Restock pulpen, pensil, dan stabilo',
                'items' => [
                    ['kode' => 'ATK-PEN-001', 'harga_beli' => 8500,  'qty' => 150], // harga naik sedikit
                    ['kode' => 'ATK-PEN-002', 'harga_beli' => 8500,  'qty' => 100],
                    ['kode' => 'ATK-PEN-004', 'harga_beli' => 5000,  'qty' => 200],
                    ['kode' => 'ATK-PCL-001', 'harga_beli' => 3500,  'qty' => 300],
                    ['kode' => 'ATK-PCL-002', 'harga_beli' => 3000,  'qty' => 300],
                    ['kode' => 'ATK-STB-001', 'harga_beli' => 9500,  'qty' => 100], // harga naik
                    ['kode' => 'ATK-STB-002', 'harga_beli' => 9500,  'qty' => 80],
                    ['kode' => 'ATK-STB-003', 'harga_beli' => 9500,  'qty' => 90],
                    ['kode' => 'ATK-SPD-001', 'harga_beli' => 7000,  'qty' => 100],
                    ['kode' => 'ATK-SPD-002', 'harga_beli' => 7000,  'qty' => 80],
                ],
            ],

            // ============================================================
            // PEMBELIAN 10 - RESTOCK KERTAS (Supplier: PT Maju Jaya Abadi)
            // Bulan Maret
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0010',
                'supplier_id'           => 2,
                'nomor_invoice'         => 'INV/PTMJA/2025/0032',
                'tgl_invoice'           => '2025-03-10',
                'tanggal_terima_barang' => '2025-03-12',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Restock kertas HVS A4 dan F4, buku tulis',
                'items' => [
                    ['kode' => 'KRT-HVS-001', 'harga_beli' => 43000, 'qty' => 80], // harga naik
                    ['kode' => 'KRT-HVS-002', 'harga_beli' => 53000, 'qty' => 60],
                    ['kode' => 'KRT-HVS-003', 'harga_beli' => 56000, 'qty' => 50],
                    ['kode' => 'KRT-HVS-004', 'harga_beli' => 200,   'qty' => 500],
                    ['kode' => 'KRT-HVS-005', 'harga_beli' => 200,   'qty' => 500],
                    ['kode' => 'KRT-BKT-001', 'harga_beli' => 4000,  'qty' => 200],
                    ['kode' => 'KRT-STN-002', 'harga_beli' => 8000,  'qty' => 80],
                ],
            ],

            // ============================================================
            // PEMBELIAN 11 - RESTOCK PRINTER & TINTA (Supplier: UD Jaya Bersama)
            // Bulan April
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0011',
                'supplier_id'           => 6,
                'nomor_invoice'         => 'INV/UDJB/2025/0072',
                'tgl_invoice'           => '2025-04-02',
                'tanggal_terima_barang' => '2025-04-05',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Restock tinta printer Epson dan Canon fast-moving',
                'items' => [
                    ['kode' => 'PRT-TNT-001', 'harga_beli' => 55000, 'qty' => 30],
                    ['kode' => 'PRT-TNT-002', 'harga_beli' => 55000, 'qty' => 25],
                    ['kode' => 'PRT-TNT-003', 'harga_beli' => 55000, 'qty' => 25],
                    ['kode' => 'PRT-TNT-004', 'harga_beli' => 55000, 'qty' => 25],
                    ['kode' => 'PRT-TNT-006', 'harga_beli' => 26000, 'qty' => 50], // harga naik
                    ['kode' => 'PRT-TNT-007', 'harga_beli' => 31000, 'qty' => 40],
                    ['kode' => 'PRT-TNT-008', 'harga_beli' => 22000, 'qty' => 45],
                    ['kode' => 'PRT-TNR-002', 'harga_beli' => 120000, 'qty' => 10],
                ],
            ],

            // ============================================================
            // PEMBELIAN 12 - RESTOCK ARSIP & MEJA (Supplier: CV Karya Sejahtera)
            // Bulan Mei
            // ============================================================
            [
                'purchase_code'         => 'PO-2025-0012',
                'supplier_id'           => 4,
                'nomor_invoice'         => 'INV/CVKS/2025/0052',
                'tgl_invoice'           => '2025-05-05',
                'tanggal_terima_barang' => '2025-05-07',
                'status_pembayaran'     => 'Lunas',
                'status'                => 'Aktif',
                'catatan'               => 'Restock alat tulis kantor dan perlengkapan arsip',
                'items' => [
                    ['kode' => 'ARS-ORD-001', 'harga_beli' => 22000, 'qty' => 40],
                    ['kode' => 'ARS-ORD-002', 'harga_beli' => 22000, 'qty' => 35],
                    ['kode' => 'ARS-STP-003', 'harga_beli' => 5000,  'qty' => 80],
                    ['kode' => 'ARS-STP-004', 'harga_beli' => 7000,  'qty' => 60],
                    ['kode' => 'ARS-CLP-001', 'harga_beli' => 8000,  'qty' => 60],
                    ['kode' => 'ARS-CLP-002', 'harga_beli' => 6500,  'qty' => 60],
                    ['kode' => 'ARS-CLP-003', 'harga_beli' => 5000,  'qty' => 80],
                    ['kode' => 'ARS-BXF-001', 'harga_beli' => 18000, 'qty' => 30],
                    ['kode' => 'PMJ-LEM-001', 'harga_beli' => 12000, 'qty' => 70],
                    ['kode' => 'PMJ-LEM-002', 'harga_beli' => 8000,  'qty' => 80],
                    ['kode' => 'PMJ-PNG-001', 'harga_beli' => 4000,  'qty' => 60],
                ],
            ],
        ];

        // ============================================================
        // PROSES INSERT PEMBELIAN
        // ============================================================
        foreach ($purchases as $purchaseData) {
            DB::beginTransaction();
            try {
                // Hitung total_harga dari items
                $totalHarga = 0;
                foreach ($purchaseData['items'] as $item) {
                    $totalHarga += $item['harga_beli'] * $item['qty'];
                }

                $purchase = Purchase::create([
                    'purchase_code'         => $purchaseData['purchase_code'],
                    'supplier_id'           => $purchaseData['supplier_id'],
                    'nomor_invoice'         => $purchaseData['nomor_invoice'],
                    'tgl_invoice'           => $purchaseData['tgl_invoice'],
                    'tanggal_terima_barang' => $purchaseData['tanggal_terima_barang'],
                    'total_harga'           => $totalHarga,
                    'jumlah_dibayar'        => $totalHarga, // lunas semua
                    'sisa_tagihan'          => 0,
                    'status_pembayaran'     => $purchaseData['status_pembayaran'],
                    'status'                => $purchaseData['status'],
                    'catatan'               => $purchaseData['catatan'],
                ]);

                foreach ($purchaseData['items'] as $item) {
                    $kodeitem = $item['kode'];
                    $product = Product::where('kode_produk', $kodeitem)->firstOrFail();
                    // $product = Product::query()->where('kode_produk', $kodeitem)->firstOrFail();
                    $subtotal = $item['harga_beli'] * $item['qty'];

                    PurchaseItem::create([
                        'purchase_id' => $purchase->id,
                        'product_id'  => $product->id,
                        'harga_beli'  => $item['harga_beli'],
                        'qty'         => $item['qty'],
                        'subtotal'    => $subtotal,
                    ]);

                    // Update harga_beli jika harga terbaru lebih tinggi (ikut logic store())
                    if ($product->harga_beli <= $item['harga_beli']) {
                        $product->harga_beli = $item['harga_beli'];
                    }
                    // Tambah stok
                    $product->stok_tersedia += $item['qty'];
                    $product->save();
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }
}