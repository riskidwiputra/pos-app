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
        'harga_dasar',
        'harga_maksimal',
      
        'keterangan_bahan',
        'gambar_contoh',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'harga_dasar'          => 'integer',
        'harga_maksimal'       => 'integer',
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
        $harga = 'Rp ' . number_format($this->harga_dasar, 0, ',', '.');

        if ($this->harga_maksimal) {
            $harga .= ' – Rp ' . number_format($this->harga_maksimal, 0, ',', '.');
        }

        return $harga;
    }

    public function getStatusBadgeAttribute(): array
    {
        return $this->is_active
            ? ['label' => 'Aktif',    'color' => 'green']
            : ['label' => 'Nonaktif', 'color' => 'gray'];
    }


   


}