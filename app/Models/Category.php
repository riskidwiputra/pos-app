<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'deskripsi',
        'is_service',
    ];
    protected $casts = [
        'is_service' => 'boolean',
    ];



    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class);
    }
    public function scopeService($query)
    {
        return $query->where('is_service', true);
    }

    public function getIsServiceBadgeAttribute()
    {
        return $this->is_service 
            ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Jasa</span>'
            : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Produk</span>';
    }

}
