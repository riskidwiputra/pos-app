<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_return_id',
        'product_id',
        'purchase_item_id',
        'jumlah_return',
        'harga_satuan',
        'subtotal',
        'keterangan',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function purchaseReturn()
    {
        return $this->belongsTo(PurchaseReturn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Calculate subtotal before saving
        static::saving(function ($item) {
            $item->subtotal = $item->jumlah_return * $item->harga_satuan;
        });

        // Update stock after saving
        static::saved(function ($item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->decrement('stok_tersedia', $item->jumlah_return);
            }

            // Update return total
            $item->purchaseReturn->update([
                'total_return' => $item->purchaseReturn->purchaseReturnItems()->sum('subtotal')
            ]);
        });

        // Update stock after deleting
        static::deleted(function ($item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->increment('stok_tersedia', $item->jumlah_return);
            }

            // Update return total
            if ($item->purchaseReturn) {
                $item->purchaseReturn->update([
                    'total_return' => $item->purchaseReturn->purchaseReturnItems()->sum('subtotal')
                ]);
            }
        });
    }
}
