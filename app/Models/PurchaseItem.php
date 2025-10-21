<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
   use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'jumlah_barang',
        'harga_satuan',
        'subtotal',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchaseReturnItems()
    {
        return $this->hasMany(PurchaseReturnItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Calculate subtotal before saving
        static::saving(function ($item) {
            $item->subtotal = $item->jumlah_barang * $item->harga_satuan;
        });

        // Update stock after saving
        static::saved(function ($item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->increment('stok_tersedia', $item->jumlah_barang);
            }

            // Update purchase total
            $item->purchase->update([
                'total_pembelian' => $item->purchase->purchaseItems()->sum('subtotal')
            ]);
        });

        // Update stock after deleting
        static::deleted(function ($item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->decrement('stok_tersedia', $item->jumlah_barang);
            }

            // Update purchase total
            if ($item->purchase) {
                $item->purchase->update([
                    'total_pembelian' => $item->purchase->purchaseItems()->sum('subtotal')
                ]);
            }
        });
    }
}
