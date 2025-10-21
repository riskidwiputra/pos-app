<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
   use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_lengkap',
        'no_telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'posisi',
        'tanggal_masuk',
        'gaji',
        'status_pekerjaan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'gaji' => 'decimal:2',
    ];
}
