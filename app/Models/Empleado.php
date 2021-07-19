<?php

namespace App\Models;

use Carbon\Carbon;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    public $primaryKey='id_empleado';

protected $table='empleado';

protected $column='email';


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
    
    protected $cats = [
        'Fecha_Entrada' => 'date',
    ];


    //puesto

    public function puesto()
    {
        return $this->belongsToMany(Puesto::class)->withTimestamps();
    }

    public function asignarPuesto($puesto)
    {
        $this->puesto()->sync($puesto, false);
    }

    public function tienePuesto()
    {
        return $this->puesto->flatten()->pluck('name')->unique();
    }

    //Vacaciones

    public function vacaciones()
    {
        return $this->belongsToMany(Vacaciones::class)->withTimestamps();
    }

    public function asignarVacaciones($vacaciones)
    {
        
        $this->vacaciones()->sync($vacaciones, false);
    }

    public function tieneVacaciones()
    {
        return $this->vacaciones->flatten()->pluck('vacacione')->unique();
    }

    // Sexo
    public function sexo()
    {
        return $this->belongsToMany(Sexo::class)->withTimestamps();
    }


    public function asignarSexo($Sexo)
    {
        
        $this->sexo()->sync($Sexo, false);
    }

    public function tienesSexo()
    {
        return $this->sexo->flatten()->pluck('name')->unique();
    }

    //Forma de pago

    public function pagos()
    {
        return $this->belongsToMany(Pagos::class)->withTimestamps();
    }

    public function asignarPagos($pagos)
    {
        
        $this->pagos()->sync($pagos, false);
    }

    public function tienesPago()
    {
        return $this->pagos->flatten()->pluck('pago')->unique();
    }

    //Asignacioenes

    public function asigna()
    {
        return $this->belongsToMany(Asignaciones::class)->withTimestamps();
    }

    public function asignarA($asigna)
    {
        
        $this->asigna()->sync($asigna, false);
    }

    public function tienesAsignaciones()
    {
        return $this->asigna->flatten()->pluck('asignaciones')->unique();
    }

        //Ciudades

        public function ciudad()
        {
            return $this->belongsToMany(Ciudades::class)->withTimestamps();
        }
    
        public function ciudadesA($ciudad)
        {
            
            $this->ciudad()->sync($ciudad, false);
        }
    
        public function tienesciudades()
        {
            return $this->ciudad->flatten()->pluck('nombre')->unique();
        }

    //Tipo de Contrato

        public function tipcontrato()
        {
            return $this->belongsToMany(TipContrato::class)->withTimestamps();
        }
    
        public function tipcontratoAsignar($contrato)
        {
            
            $this->tipcontrato()->sync($contrato, false);
        }
    
        public function tienescontrato()
        {
            return $this->tipcontrato->flatten()->pluck('name')->unique();
        }
}
