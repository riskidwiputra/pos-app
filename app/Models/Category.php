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
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();
        
    //     static::creating(function ($category) {
    //         if (empty($category->kode_kategori)) {
    //             $category->kode_kategori = 'KAT' . str_pad(Category::max('id') + 1, 4, '0', STR_PAD_LEFT);
    //         }
    //     });
    // }
}
