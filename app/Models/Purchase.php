<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
   use HasFactory, SoftDeletes;

     protected $fillable = [
        'purchase_code',
        'supplier_id',
        'nomor_invoice',
        'tgl_invoice',
        'tanggal_terima_barang',
        'total_harga',
        'jumlah_dibayar',
        'sisa_tagihan',
        'status_pembayaran',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tgl_invoice' => 'date',
        'tanggal_terima_barang' => 'date',
        'total_harga' => 'integer:2',
        'jumlah_dibayar' => 'integer:2',
        'sisa_tagihan' => 'integer:2',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

     public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function payments()
    {
        return $this->hasMany(PurchasePayment::class)->orderBy('tanggal_bayar', 'desc');
    }

    public function purchaseReturns()
    {
        return $this->hasMany(PurchaseReturn::class);
    }

}
