<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sueldo_aumento;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SueldoAumentoController extends Controller
{
    
    public function salarioSave()
    {
        $nombre=request('name');
        $monto=request('monto');
        $id=request('id');

        $empleados=Empleado::findOrFail($id);
        
        $sueldo= new sueldo_aumento();
        $sueldo->id_empleado=$id;
        $sueldo->sueldo_base=$empleados->salario;
        $sueldo->sueldo_increment=$monto;
        $sueldo->description=$nombre;
        $sueldo->estado=0;
        $sueldo->user=Auth::user()->name;
        $sueldo->id_empresa=Auth::user()->id_empresa;
        $sueldo->save();

        $sueldoMonto=sueldo_aumento::where("id_empleado",'=',$id)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->select(DB::raw('sum(sueldo_increment) as amount'))
        ->first();

        return view('Empleados.Plantillas.salarios',compact('sueldo','sueldoMonto','empleados'));
        return $monto; 

    }


    public function showsalario($id)
    {
        $sueldo=sueldo_aumento::findOrFail($id);
        return view('Empleados.modal.showsalario',compact('sueldo'));
    }

    public function updatesalario($id)
    {
        $sueldo=sueldo_aumento::findOrFail($id);
        $nombre=request('name');
        $monto=request('monto');
        $sueldo->sueldo_increment=$monto;
        $sueldo->description=$nombre;
        $sueldo->update();

        $getEmple=sueldo_aumento::findOrFail($id);

        $sueldoMonto=sueldo_aumento::where("id_empleado",'=',$getEmple->id_empleado)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->select(DB::raw('sum(sueldo_increment) as amount'))
        ->first();

        
        $sueld=sueldo_aumento::where('id_empleado','=',$getEmple->id_empleado)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();
        $user=Auth::user()->name;

        $empleado=Empleado::findOrFail($getEmple->id_empleado);
        $sum=$sueldoMonto->amount+$empleado->salario;
        return view('Empleados.Plantillas.getsueldo',compact('sueld','sueldoMonto','empleado','user','sum'));
    }

    public function deletesalario($id)
    {
        $sueldo=sueldo_aumento::findOrFail($id);
        $sueldo->estado=1;
        $sueldo->update();

        $getEmple=sueldo_aumento::findOrFail($id);

        $sueldoMonto=sueldo_aumento::where("id_empleado",'=',$getEmple->id_empleado)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->select(DB::raw('sum(sueldo_increment) as amount'))
        ->first();

        
        $sueld=sueldo_aumento::where('id_empleado','=',$getEmple->id_empleado)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();
        $user=Auth::user()->name;

        $empleado=Empleado::findOrFail($getEmple->id_empleado);
        $sum=$sueldoMonto->amount+$empleado->salario;
        return view('Empleados.Plantillas.getsueldo',compact('sueld','sueldoMonto','empleado','user','sum'));

    }
}
