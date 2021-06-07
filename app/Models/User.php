<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'apellido',
        'cedula',
        'telefono',
        'direccion',
        'entrada',
        'salida',
        'salario',
        'id_empresa',
        'edad',
        'email',
        'password',
        'cargo',
        'horas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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

    //Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function asignarRol($role)
    {
        $this->roles()->sync($role, false);
    }

    public function tieneRol()
    {
        return $this->roles->flatten()->pluck('name')->unique();
    }
    // puesto

    public function puestoU()
    {
        return $this->belongsToMany(Puesto::class)->withTimestamps();
    }

    public function asignarPuestoU($puesto)
    {
        $this->puestoU()->sync($puesto, false);
    }

    public function tienePuestoU()
    {
        return $this->puestoU->flatten()->pluck('name')->unique();
    }

    //Sexo
    public function sexoU()
    {
        return $this->belongsToMany(sexo::class)->withTimestamps();
    }

    public function asignarSexoU($Sexo)
    {
        
        $this->sexoU()->sync($Sexo, false);
    }

    public function tienesSexoU()
    {
        return $this->sexoU->flatten()->pluck('name')->unique();
    }


       //Pagos del Usuario     
       public function pagosU()
       {
           return $this->belongsToMany(Pagos::class)->withTimestamps();
       }
   
       public function asignarPagosU($pagos)
       {
           
           $this->pagosU()->sync($pagos, false);
       }
   
       public function tienesPagoU()
       {
           return $this->pagosU->flatten()->pluck('pago')->unique();
       }

}

