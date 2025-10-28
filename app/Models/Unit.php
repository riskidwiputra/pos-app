<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_unit',
        'nama_unit',
        'singkatan',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
