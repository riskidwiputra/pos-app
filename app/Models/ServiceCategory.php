<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_categories';

    protected $fillable = [
        'nama_jasa',
        'deskripsi',
        'total_harga',
        'keterangan_bahan',
        'gambar_contoh',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'total_harga'          => 'integer',
        'is_active'            => 'boolean',
    ];

    // ─── Scopes ────────────────────────────────────────────────────────────────

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTerurut($query)
    {
        return $query->orderBy('nama_jasa');
    }

    // ─── Relationships ──────────────────────────────────────────────────────────

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'service_category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ─── Accessors ──────────────────────────────────────────────────────────────

    public function getHargaFormatAttribute(): string
    {
        $harga = 'Rp ' . number_format($this->total_harga, 0, ',', '.');


        return $harga;
    }

    public function getStatusBadgeAttribute(): array
    {
        return $this->is_active
            ? ['label' => 'Aktif',    'color' => 'green']
            : ['label' => 'Nonaktif', 'color' => 'gray'];
    }


   


}