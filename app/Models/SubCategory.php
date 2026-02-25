<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_categories'; 

    protected $fillable = [
        'category_id',
        'kode_subkategori',
        'nama_subkategori',
        'deskripsi',
        'is_service',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected $casts = [
        'is_service' => 'boolean',
    ];

    public function scopeService($query)
    {
        return $query->where('is_service', true);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();
        
    //     static::creating(function ($subCategory) {
    //         if (empty($subCategory->kode_subkategori)) {
    //             $subCategory->kode_subkategori = 'SUB' . str_pad(SubCategory::max('id') + 1, 4, '0', STR_PAD_LEFT);
    //         }
    //     });
    // }
}
