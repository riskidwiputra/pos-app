<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_code',
        'user_id',
        'category_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'order_title',
        'order_description',
        'quantity',
        'unit',
        'order_date',
        'estimated_completion_date',
        'actual_completion_date',
        'total_price',
        'payment',
        'down_payment',
        'design_file',
        'notes',
        'status',
        'rejection_reason',
        'approved_by',
        'approved_at',
        'created_by',
    ];

    protected $casts = [
        'order_date' => 'date',
        'estimated_completion_date' => 'date',
        'actual_completion_date' => 'date',
        'approved_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->order_code)) {
                $model->order_code = self::generateOrderCode();
            }
            $model->remaining_payment = $model->total_price - $model->down_payment;
        });

        static::updating(function ($model) {
            // Update sisa pembayaran jika total_price atau down_payment berubah
            $model->remaining_payment = $model->total_price - $model->down_payment;
        });
    }

    public static function generateOrderCode()
    {
        $date = now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', today())
                         ->latest('id')
                         ->first();
        
        $sequence = $lastOrder ? intval(substr($lastOrder->order_code, -4)) + 1 : 1;
        
        return 'ORD-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeAll($query)
    {
        return $query;
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Status Helpers
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function canBeApproved()
    {
        return $this->status === 'pending';
    }

    public function canBeRejected()
    {
        return $this->status === 'pending';
    }

    public function canBeEdited()
    {
        return in_array($this->status, ['pending', 'approved', 'in_progress']);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'in_progress' => 'Sedang Diproses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'approved' => 'blue',
            'rejected' => 'red',
            'in_progress' => 'purple',
            'completed' => 'green',
            'delivered' => 'emerald',
            'cancelled' => 'gray',
            default => 'gray',
        };
    }


}