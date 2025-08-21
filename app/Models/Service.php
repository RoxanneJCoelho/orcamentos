<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    protected static function booted()
    {
        static::creating(function ($service) {
            $categoria = $service->categoria; // assume que já existe a relação
            $prefix = strtoupper(substr($categoria->nome, 0, 5)); // ex: "Front-End" -> "FRONT"

            // Pega o último código da categoria e incrementa
            $ultimo = self::where('categoria_id', $service->categoria_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($ultimo && preg_match('/\d+$/', $ultimo->code, $matches)) {
                $numero = str_pad($matches[0] + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $numero = '001';
            }

            $service->code = $prefix . '-' . $numero;
        });
    }
}
