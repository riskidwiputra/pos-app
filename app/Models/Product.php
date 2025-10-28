<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'unit_id',
        'kode_produk',
        'nama_produk',
        'deskripsi',
        'harga_jual',
        'stok_tersedia',
        'stok_minimum',
        'barcode_product',
        'gambar_barang',
        'status_product',
    ];

    protected $casts = [
        'harga_jual' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function purchaseReturnItems()
    {
        return $this->hasMany(PurchaseReturnItem::class);
    }

    // Check if stock is low
    public function isLowStock()
    {
        return $this->stok_tersedia <= $this->stok_minimum;
    }

    // Scope for low stock products
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stok_tersedia', '<=', 'stok_minimum');
    }

    
}
