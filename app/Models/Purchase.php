<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
   use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'nama_invoice',
        'tgl_invoice',
        'tanggal_terima_barang',
        'status',
        'total_pembelian',
    ];

    protected $casts = [
        'tgl_invoice' => 'date',
        'tanggal_terima_barang' => 'date',
        'total_pembelian' => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function purchaseReturns()
    {
        return $this->hasMany(PurchaseReturn::class);
    }

    // Auto generate invoice number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($purchase) {
            if (empty($purchase->nama_invoice)) {
                $purchase->nama_invoice = 'INV-' . date('Ymd') . '-' . str_pad(Purchase::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
