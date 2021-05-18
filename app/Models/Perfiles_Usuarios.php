<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles_Usuarios extends Model
{
    use HasFactory;
    protected $table='perfiles_usuarios';

    protected $fillable = [
        'id_perfil',
        'id_user',
        'id_empresa',
        'estado',

    ];


    protected $guarded = [];
}
