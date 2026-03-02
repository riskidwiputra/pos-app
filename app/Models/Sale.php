<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
   use HasFactory, SoftDeletes;

     protected $fillable = [
        'invoice_number',
        'customer_id',
        'transaction_date',
        'payment_method',
        'notes',
        'total',
        'paid_amount',
        'change_amount',
        'status',
        'created_by',
    ];

     protected $casts = [
        'transaction_date' => 'date',
        'total' => 'integer',
        'paid_amount' => 'integer',
        'change_amount' => 'integer',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

     public function items()
    {
       return $this->hasMany(SaleItem::class, 'sale_id');
    }

  

}
