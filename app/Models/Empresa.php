<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $tsble='empresas';

    protected $fillable = [
        'nombre',
        'telefono',
        'rnc',
        'direcion',
        'estado',
    ];
}
