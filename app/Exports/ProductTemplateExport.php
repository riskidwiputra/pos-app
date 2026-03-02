<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ProductSheet(),
            new CategoryReferenceSheet(),
            new SubCategoryReferenceSheet(),
            new UnitReferenceSheet(),
        ];
    }
}

class ProductSheet implements 
    FromCollection, 
    WithHeadings, 
    WithStyles,
    WithColumnWidths,
    WithEvents,
    WithTitle
{
    public function title(): string
    {
        return 'Template Produk';
    }

    public function collection()
    {
        // Return 3 sample rows
        return collect([
            [
                'Contoh Produk 1',
                1,
                1,
                1,
                15000,
                10,
            ],
            [
                'Contoh Produk 2',
                2,
                2,
                2,
                25000,
                5,
            ],
            [
                'Contoh Produk 3',
                3,
                3,
                3,
                500000,
                3,
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama Produk*',
            'ID Kategori*',
            'ID Sub Kategori*',
            'ID Unit*',
            'Harga Jual*',
            'Stok Minimum*',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 15,
            'C' => 18,
            'D' => 15,
            'E' => 15,
            'F' => 15,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Freeze first row
                $sheet->freezePane('A2');
                
                // Add border to all cells
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ];
                
                $sheet->getStyle('A1:F100')->applyFromArray($styleArray);
                
                // Add notes
                $lastRow = $sheet->getHighestRow() + 2;
                $sheet->setCellValue('A' . $lastRow, 'CATATAN PENTING:');
                $sheet->getStyle('A' . $lastRow)->getFont()->setBold(true)->setSize(12)->getColor()->setRGB('FF0000');
                
                $notes = [
                    '* = Field wajib diisi',
                    'Lihat sheet "Daftar Kategori" untuk melihat ID Kategori yang tersedia',
                    'Lihat sheet "Daftar Sub Kategori" untuk melihat ID Sub Kategori yang tersedia',
                    'Lihat sheet "Daftar Unit" untuk melihat ID Unit yang tersedia',
                    'Pastikan ID yang Anda masukkan sesuai dengan ID yang ada di sheet referensi',
                    'Hapus baris contoh sebelum mengupload',
                    'Format file: .xlsx atau .xls',
                    'Maksimal 1000 baris per upload',
                ];
                
                foreach ($notes as $index => $note) {
                    $rowNum = $lastRow + $index + 1;
                    $sheet->setCellValue('A' . $rowNum, '• ' . $note);
                    $sheet->getStyle('A' . $rowNum)->getAlignment()->setWrapText(true);
                }
                
                // Merge cells for notes
                $sheet->mergeCells('A' . $lastRow . ':F' . $lastRow);
                foreach ($notes as $index => $note) {
                    $rowNum = $lastRow + $index + 1;
                    $sheet->mergeCells('A' . $rowNum . ':F' . $rowNum);
                }
            },
        ];
    }
}

class CategoryReferenceSheet implements 
    FromCollection, 
    WithHeadings, 
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    public function title(): string
    {
        return 'Daftar Kategori';
    }

    public function collection()
    {
        return Category::select('id', 'nama_kategori')
            ->orderBy('nama_kategori')
            ->get()
            ->map(function($category) {
                return [
                    'id' => $category->id,
                    'nama_kategori' => $category->nama_kategori,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Kategori',
            'Nama Kategori',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '059669']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 30,
        ];
    }
}

class SubCategoryReferenceSheet implements 
    FromCollection, 
    WithHeadings, 
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    public function title(): string
    {
        return 'Daftar Sub Kategori';
    }

    public function collection()
    {
        return SubCategory::with('category')
            ->select('id', 'category_id', 'nama_subkategori')
            ->orderBy('category_id')
            ->orderBy('nama_subkategori')
            ->get()
            ->map(function($subCategory) {
                return [
                    'id' => $subCategory->id,
                    'category_id' => $subCategory->category_id,
                    'nama_kategori' => $subCategory->category->nama_kategori ?? '',
                    'nama_subkategori' => $subCategory->nama_subkategori,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Sub Kategori',
            'ID Kategori',
            'Nama Kategori',
            'Nama Sub Kategori',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DC2626']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 15,
            'C' => 25,
            'D' => 30,
        ];
    }
}

class UnitReferenceSheet implements 
    FromCollection, 
    WithHeadings, 
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    public function title(): string
    {
        return 'Daftar Unit';
    }

    public function collection()
    {
        return Unit::select('id', 'nama_unit')
            ->orderBy('nama_unit')
            ->get()
            ->map(function($unit) {
                return [
                    'id' => $unit->id,
                    'nama_unit' => $unit->nama_unit,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Unit',
            'Nama Unit',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'EA580C']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 30,
        ];
    }
}