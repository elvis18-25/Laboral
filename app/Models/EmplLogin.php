<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Empleado as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EmplLogin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'EmplLogin';
    public $primaryKey='id_empleado';

protected $table='empleado';

protected $column='email,password';
// protected $column='email';

    // protected $guard='EmplLogin';
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'direccion',
        'Fecha_Entrada',
        'fecha_salida',
        'salario',
        'edad',
        'email',
        'password',
        'cargo',
        'id_empresa',
        'horas',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
