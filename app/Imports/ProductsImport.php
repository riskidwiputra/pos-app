<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;

class ProductsImport implements 
    ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsOnError,
    SkipsOnFailure,
    WithBatchInserts,
    WithChunkReading
{
    use Importable;

    protected $errors = [];
    protected $failures = [];
    protected $successCount = 0;

    public function model(array $row)
    {
        // Skip empty rows
        if (empty($row['nama_produk'])) {
            return null;
        }

        // Validate category exists
        $category = Category::find($row['id_kategori']);
        if (!$category) {
            $this->errors[] = "Baris '{$row['nama_produk']}': ID Kategori '{$row['id_kategori']}' tidak ditemukan";
            return null;
        }

        // Validate subcategory exists and belongs to the category
        $subCategory = SubCategory::find($row['id_sub_kategori']);
        if (!$subCategory) {
            $this->errors[] = "Baris '{$row['nama_produk']}': ID Sub Kategori '{$row['id_sub_kategori']}' tidak ditemukan";
            return null;
        }

        if ($subCategory->category_id != $row['id_kategori']) {
            $this->errors[] = "Baris '{$row['nama_produk']}': Sub Kategori '{$subCategory->nama_subkategori}' tidak termasuk dalam kategori '{$category->nama_kategori}'";
            return null;
        }

        // Validate unit exists
        $unit = Unit::find($row['id_unit']);
        if (!$unit) {
            $this->errors[] = "Baris '{$row['nama_produk']}': ID Unit '{$row['id_unit']}' tidak ditemukan";
            return null;
        }

        // Generate unique kode produk
        do {
            $kodeProduk = 'PRD-' . strtoupper(Str::random(6));
        } while (Product::where('kode_produk', $kodeProduk)->exists());

        // Generate unique barcode
        // do {
        //     $kode_category = str_pad($row['id_kategori'], 3, '0', STR_PAD_LEFT);
        //     $kode_sub_category = str_pad($row['id_sub_kategori'], 3, '0', STR_PAD_LEFT);
        //     $kode_unit = str_pad($row['id_unit'], 3, '0', STR_PAD_LEFT);
        //     // $barcode = $kode_category . $kode_sub_category . $kode_unit . $kodeProduk;
        // } while (Product::where('barcode_product', $barcode)->exists());

        $this->successCount++;

        return new Product([
            'category_id' => $row['id_kategori'],
            'sub_category_id' => $row['id_sub_kategori'],
            'unit_id' => $row['id_unit'],
            'kode_produk' => $kodeProduk,
            'nama_produk' => $row['nama_produk'],
            'deskripsi' => null,
            'harga_jual' => $row['harga_jual'],
            'stok_tersedia' => 0,
            'stok_minimum' => $row['stok_minimum'],
            // 'barcode_product' => $barcode,
            'gambar_barang' => null,
            'status_product' => 'Tersedia',
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|integer|exists:categories,id',
            'id_sub_kategori' => 'required|integer|exists:sub_categories,id',
            'id_unit' => 'required|integer|exists:units,id',
            'harga_jual' => 'required|numeric|min:0',
            'stok_minimum' => 'required|integer|min:0',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi',
            'nama_produk.max' => 'Nama produk maksimal 255 karakter',
            
            'id_kategori.required' => 'ID Kategori wajib diisi',
            'id_kategori.integer' => 'ID Kategori harus berupa angka',
            'id_kategori.exists' => 'ID Kategori tidak ditemukan di database',
            
            'id_sub_kategori.required' => 'ID Sub Kategori wajib diisi',
            'id_sub_kategori.integer' => 'ID Sub Kategori harus berupa angka',
            'id_sub_kategori.exists' => 'ID Sub Kategori tidak ditemukan di database',
            
            'id_unit.required' => 'ID Unit wajib diisi',
            'id_unit.integer' => 'ID Unit harus berupa angka',
            'id_unit.exists' => 'ID Unit tidak ditemukan di database',
            
            'harga_jual.required' => 'Harga jual wajib diisi',
            'harga_jual.numeric' => 'Harga jual harus berupa angka',
            'harga_jual.min' => 'Harga jual tidak boleh negatif',
            
            'stok_minimum.required' => 'Stok minimum wajib diisi',
            'stok_minimum.integer' => 'Stok minimum harus berupa angka bulat',
            'stok_minimum.min' => 'Stok minimum tidak boleh negatif',
        ];
    }

    public function onError(\Throwable $e)
    {
        $this->errors[] = 'Error: ' . $e->getMessage();
    }

    public function onFailure(\Maatwebsite\Excel\Validators\Failure ...$failures)
    {
        $this->failures = array_merge($this->failures, $failures);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getFailures()
    {
        return $this->failures;
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}