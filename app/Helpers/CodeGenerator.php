<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class CodeGenerator
{

    public static function generate(string $modelClass, string $field = 'kode_kategori', int $length = 2): string
    {
        
        $existingCodes = $modelClass::withTrashed(false)
            ->orderBy($field, 'asc')
            ->pluck($field)
            ->map(fn($code) => (int) $code)
            ->toArray();

        $nextNumber = 1;

        while (in_array($nextNumber, $existingCodes)) {
            $nextNumber++;
        }

        return str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
    }
}
