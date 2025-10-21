<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseReturn extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_id',
        'supplier_id',
        'nomor_return',
        'tanggal_return',
        'alasan_return',
        'status_return',
        'total_return',
    ];

    protected $casts = [
        'tanggal_return' => 'date',
        'total_return' => 'decimal:2',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseReturnItems()
    {
        return $this->hasMany(PurchaseReturnItem::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($return) {
            if (empty($return->nomor_return)) {
                $return->nomor_return = 'RET-' . date('Ymd') . '-' . str_pad(PurchaseReturn::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
