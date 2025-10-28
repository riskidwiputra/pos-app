<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['kode_unit' => '01', 'singkatan' => 'Pcs', 'nama_unit' => 'Pieces / Per buah'],
            ['kode_unit' => '02', 'singkatan' => 'Box', 'nama_unit' => 'Per box / kotak'],
            ['kode_unit' => '03', 'singkatan' => 'Pack', 'nama_unit' => 'Per pack / kemasan'],
            ['kode_unit' => '04', 'singkatan' => 'Lusin', 'nama_unit' => 'Per lusin (12 pcs)'],
            ['kode_unit' => '05', 'singkatan' => 'Rim', 'nama_unit' => 'Per rim (500 lembar)'],
            ['kode_unit' => '06', 'singkatan' => 'Lembar', 'nama_unit' => 'Per lembar'],
            ['kode_unit' => '07', 'singkatan' => 'Meter', 'nama_unit' => 'Per meter'],
            ['kode_unit' => '08', 'singkatan' => 'Roll', 'nama_unit' => 'Per roll / gulungan'],
            ['kode_unit' => '09', 'singkatan' => 'Set', 'nama_unit' => 'Per set'],
            ['kode_unit' => '10', 'singkatan' => 'Kodi', 'nama_unit' => 'Per kodi (20 pcs)'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
