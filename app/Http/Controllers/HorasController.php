<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horas;
use App\Models\Empleado;
use App\Models\Empresa;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\nomina_horas;
use App\Models\nomina_empleados;

class HorasController extends Controller
{
    
    public function updatehoras($id)
    {
        $horas=Horas::findOrFail($id);
        $empleado=Empleado::findOrFail($horas->id_empleado);
        $empresa=Empresa::findOrFail(Auth::user()->id_empresa);
        
        
        $entrada=new DateTime($empresa->timestart);
        $salida=new DateTime($empresa->timeend);
        $jornada=request('jornada');
        $fechaenrada=new datetime(request('fechaentrada'));
        $fechasalidad= new datetime(request('fechasalidad'));

        $p=0;
        $b=0;
        $type="EXTRAS";



        for($i = $fechaenrada; $i <= $fechasalidad; $i->modify('+1 day')){
            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
            
        switch($nombre_dia)
        {
            case 1:
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 2: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 3: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 4: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 5: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 6: 
                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
        }
        
        }

        
        if($p<0){
            $type="DESCONTADA";
            $p=abs($p);
        }

        if($empleado->horas!=0){
            if($jornada==0){
                $jorni="DIURNA";
                $sum=$empleado->horas*1.35;
                $sum=$sum*$p;
            }else{
                $jorni="NOCTURNA";
                $mensual=$empleado->horas*1.35;
                $semanal=$empleado->horas*1.15;
                $sum=$mensual+$semanal;
                $sum=$sum*$p;
            }
        }else{
            if($jornada==0){
                $jorni="DIURNA";
                $sumer=$empleado->salario/23.83/8;
                $sum=round($sumer,2)*1.35;
                $sum=$sum*$p;
            }else{
                $jorni="NOCTURNA";
                $sumer=$empleado->salario/23.83/8;
                $mensual=round($sumer,2)*1.35;
                $semanal=round($sumer,2)*1.15;
                $sum=$mensual+$semanal;
                $sum=$sum*$p;
            }

        }

        $horas->id_empleado= $empleado->id_empleado;
        $horas->horaentrada=$empresa->timestart;
        $horas->horasalidad=$empresa->timeend;
        $horas->jornada=$jorni;
        $horas->fechainicio= request('fechaentrada');
        $horas->fechafinalizado=request('fechasalidad');
        $horas->monto=round($sum,2);
        $horas->horas=(int)$p;
        $horas->id_empresa=Auth::user()->id_empresa;
        $horas->estado=0;
        $horas->type=$type;
        $horas->save();

        $hora=Horas::all();

        return view('Nominas.Plantillas.horasEmple',compact('hora'));

        // return "llego";
    }
    public function updatehorasListado($id)
    {
        $id_nomina=request('id_nomina');
        $horas=nomina_horas::findOrFail($id);
        $empleado=nomina_empleados::where('id_empleado','=',$horas->id_empleado)->where('id_nomina','=',$id_nomina)->first();
        $empresa=Empresa::findOrFail(Auth::user()->id_empresa);
        
        
        $entrada=new DateTime($empresa->timestart);
        $salida=new DateTime($empresa->timeend);
        $jornada=request('jornada');
        $fechaenrada=new datetime(request('fechaentrada'));
        $fechasalidad= new datetime(request('fechasalidad'));

        $p=0;
        $b=0;
        $type="EXTRAS";



        for($i = $fechaenrada; $i <= $fechasalidad; $i->modify('+1 day')){
            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
            
        switch($nombre_dia)
        {
            case 1:
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 2: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 3: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 4: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 5: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 6: 
                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
        }
        
        }

        
        if($p<0){
            $type="DESCONTADA";
            $p=abs($p);
        }

        if($empleado->horas!=0){
            if($jornada==0){
                $jorni="DIURNA";
                $sum=$empleado->horas*1.35;
                $sum=$sum*$p;
            }else{
                $jorni="NOCTURNA";
                $mensual=$empleado->horas*1.35;
                $semanal=$empleado->horas*1.15;
                $sum=$mensual+$semanal;
                $sum=$sum*$p;
            }
        }else{
            if($jornada==0){
                $jorni="DIURNA";
                $sumer=$empleado->salario/23.83/8;
                $sum=round($sumer,2)*1.35;
                $sum=$sum*$p;
            }else{
                $jorni="NOCTURNA";
                $sumer=$empleado->salario/23.83/8;
                $mensual=round($sumer,2)*1.35;
                $semanal=round($sumer,2)*1.15;
                $sum=$mensual+$semanal;
                $sum=$sum*$p;
            }

        }

        $horas->id_empleado= $empleado->id_empleado;
        $horas->id_nomina=$id_nomina;
        $horas->horaentrada=$empresa->timestart;
        $horas->horasalidad=$empresa->timeend;
        $horas->jornada=$jorni;
        $horas->fechainicio= request('fechaentrada');
        $horas->fechafinalizado=request('fechasalidad');
        $horas->monto=round($sum,2);
        $horas->horas=(int)$p;
        $horas->id_empresa=Auth::user()->id_empresa;
        $horas->estado=0;
        $horas->type=$type;
        $horas->save();

        return 0;
        // $hora=nomina_horas::all();

        // return view('Nominas.Plantillas.horasEmple',compact('hora'));

        // return "llego";
    }

    public function deletehoras($id)
    {
        $horas=Horas::findOrFail($id);
        $horas->delete();

        $hora=Horas::all();

        return view('Nominas.Plantillas.horasEmple',compact('hora'));

    }
    public function deletehorasListado($id)
    {
        $horas=nomina_horas::findOrFail($id);
        $horas->delete();
        return 0;

        // $hora=Horas::all();

        // return view('Nominas.Plantillas.horasEmple',compact('hora'));

    }


    public function savehorasListado($id)
    {
        $id_nomina=request('id_nomina');
        $empleado=nomina_empleados::where('id_empleado','=',$id)->where('id_nomina','=',$id_nomina)->first();
        $empresa=Empresa::findOrFail(Auth::user()->id_empresa);

        $entrada=new DateTime($empresa->timestart);
        $salida=new DateTime($empresa->timeend);
        $jornada=request('jornada');
        
        $fechaenrada=new datetime(request('fechaentrada'));
        $fechasalidad= new datetime(request('fechasalidad'));

        $p=0;
        $b=0;
        $type="EXTRAS";



        for($i = $fechaenrada; $i <= $fechasalidad; $i->modify('+1 day')){
            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
            
        switch($nombre_dia)
        {
            case 1:
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 2: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 3: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 4: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 5: 
                $veri=0;

                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
            case 6: 
                $extras = date_diff($fechaenrada, $fechasalidad);
                $timeempresa = date_diff($entrada, $salida);
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            break;
        }
        
        }

        
        if($p<0){
            $type="DESCONTADA";
            $p=abs($p);
        }

        if($empleado->horas!=0){
            if($jornada==0){
                $jorni="DIURNA";
                $sum=$empleado->horas*1.35;
                $sum=$sum*$p;
            }else{
                $jorni="NOCTURNA";
                $mensual=$empleado->horas*1.35;
                $semanal=$empleado->horas*1.15;
                $sum=$mensual+$semanal;
                $sum=$sum*$p;
            }
        }else{
            if($jornada==0){
                $jorni="DIURNA";
                $sumer=$empleado->salario/23.83/8;
                $sum=round($sumer,2)*1.35;
                $sum=$sum*$p;
            }else{
                $jorni="NOCTURNA";
                $sumer=$empleado->salario/23.83/8;
                $mensual=round($sumer,2)*1.35;
                $semanal=round($sumer,2)*1.15;
                $sum=$mensual+$semanal;
                $sum=$sum*$p;
            }

        }

        $horas=new nomina_horas();
        $horas->id_empleado=$id;
        $horas->id_nomina= $id_nomina;
        $horas->horaentrada=$empresa->timestart;
        $horas->horasalidad=$empresa->timeend;
        $horas->jornada=$jorni;
        $horas->fechainicio= request('fechaentrada');
        $horas->fechafinalizado=request('fechasalidad');
        $horas->monto=round($sum,2);
        $horas->horas=(int)$p;
        $horas->id_empresa=Auth::user()->id_empresa;
        $horas->estado=0;
        $horas->type=$type;
        $horas->save();

        return view('Nominas.Plantillas.horas',compact('horas'));
        // return  round($sum,2);;

    }

    public function showHorasListado($id)
    {
        $horas=nomina_horas::findOrFail($id);
        return view('Listado.showHoras',compact('horas'));
    }
}
