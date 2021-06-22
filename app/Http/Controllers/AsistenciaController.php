<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use App\Models\empleados_equipo;
use App\Models\Equipos;
use App\Models\Horas;
use App\Models\Puesto;
use App\Models\Weekend_empresa;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencia=Asistencia::all();
        $empleado=Empleado::all();
        return view('Asistencias.index',compact('asistencia','empleado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=Empleado::all();
        $asistencia=Asistencia::all();
        $equipo=Equipos::all();
        return view('Asistencias.create',compact('empleados','asistencia','equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $notas=$request->get('notas');
        $jornada=$request->get('jornada');
        $grupo=0;

        if($request->get('grupo')>0){
            $grupo=$request->get('grupo');
            // dd("llego");
        }


        $size = count(collect($request)->get('Din'));
        $array=[];
        
        for ($i=0; $i<=$size ; $i++) { 
            if(!empty(collect($request)->get('Din')[$i])){
                $array[$i]=$request->get('Din')[$i];
           $input['id_empleado']=$request->get('Din')[$i];
           $input['notas']= $notas;
           $input['entrada']=$request->get('entradaSave');
           $input['salidad']=$request->get('salidaSave');
           $input['id_grupo']=$request->get('grupo');
           $input['user']=Auth::user()->name;
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estado']=0;
           $perfiles=Asistencia::create($input);
            }
        }

        $fechaenrada=new datetime($request->get('entradaSave'));
        $fechasalidad= new datetime($request->get('salidaSave'));
        $p=0;
        $b=0;
        $type="EXTRAS";


 for ($a=0; $a<=$size ; $a++) { 
    if(!empty(collect($request)->get('Din')[$a])){
        $id=$array[$a];

        for($i = $fechaenrada; $i <= $fechasalidad; $i->modify('+1 day')){
            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
            
        switch($nombre_dia)
        {
            case 1:
                if($grupo==0){
                $week=Weekend_empresa::where('id_weekend','=',1)->get();
                $extras = date_diff($fechaenrada, $fechasalidad);
                $b=0;

                foreach($week as $weeks){
                    
                          $entrada=new DateTime($weeks->start);
                          $salida=new DateTime($weeks->end);
                          $timeempresa = date_diff($entrada, $salida);
                }
                
                $veri=0;
                $veri=$extras->h-$timeempresa->h;
                $p=$p+$veri;
            }else{
                $equipo=Equipos::findOrFail($grupo);
                if($equipo->type=="EXTRAS"){
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $p=$p+$extras->h;
                }else{
                    
                        $week=Weekend_empresa::where('id_weekend','=',1)->get();
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $b=0;
        
                        foreach($week as $weeks){
                            
                                  $entrada=new DateTime($weeks->start);
                                  $salida=new DateTime($weeks->end);
                                  $timeempresa = date_diff($entrada, $salida);
                        }
                        
                        $veri=0;
                        $veri=$extras->h-$timeempresa->h;
                        $p=$p+$veri;
                }

            }


            break;
            case 2: 
                if($grupo==0){
                    $week=Weekend_empresa::where('id_weekend','=',2)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($grupo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',2)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 3: 
                if($grupo==0){
                    $week=Weekend_empresa::where('id_weekend','=',3)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($grupo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',3)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 4: 
                if($grupo==0){
                    $week=Weekend_empresa::where('id_weekend','=',4)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($grupo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',4)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 5: 
                if($grupo==0){
                    $week=Weekend_empresa::where('id_weekend','=',5)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($grupo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',5)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 6: 
                if($grupo==0){
                    $week=Weekend_empresa::where('id_weekend','=',6)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($grupo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',6)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
        }
        
        }

        
        if($p<0){
            $type="DESCONTADA";
            $p=abs($p);
        }
        
        

        $empleado=Empleado::findOrFail($id);

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

        if($p!=0){
        $horas=new Horas();
        $horas->id_empleado=$empleado->id_empleado;
        $horas->jornada=$jorni;
        $horas->fechainicio= $request->get('entradaSave');
        $horas->fechafinalizado=$request->get('salidaSave');
        $horas->monto=round($sum,2);
        $horas->horas=(int)$p;
        $horas->id_empresa=Auth::user()->id_empresa;
        $horas->estado=0;
        $horas->type=$type;
        $horas->save();
        }
    }
}
        
        return redirect('Asistencia');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function AllGroupAsistencia()
    {
        $empleados=Empleado::all();
        $equipo=empleados_equipo::all();
        $puesto=Puesto::all();
        return view('Asistencias.plantilla',compact('empleados','equipo','puesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function modaleditFecha($id)
    {
        $asistencia=Asistencia::where('id_empleado','=',$id)->first();
        $empleado=Empleado::findOrFail($id);
        return view('Asistencias.modal',compact('asistencia','id','empleado'));
    }
    public function updatefecha($id)
    {
        $equipo=0;
        $asiste=Asistencia::select('id')->where('id_empleado','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $asistencias=Asistencia::findOrFail($asiste->id);
        $hor=Horas::select('id')->where('id_empleado','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        // return $hor->id;
        $horas=Horas::findOrFail($hor->id);

        if($asistencias->id_grupo>0){
            $equipo=$asistencias->id_grupo;
            // $equipo=Equipos::findOrFail($horas->id);
        }

        // return $equipo;

        $asistencias->entrada=request('entrada');
        $asistencias->salidad=request('salidad');
        $asistencias->notas=request('notas');
        $asistencias->update();

        $empleado=Empleado::findOrFail($id);
        $jornada=request('jornada');
        
        $fechaenrada=new datetime(request('entrada'));
        $fechasalidad= new datetime(request('salidad'));

        $p=0;
        $b=0;
        $type="EXTRAS";

        for($i = $fechaenrada; $i <= $fechasalidad; $i->modify('+1 day')){
            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
            
        switch($nombre_dia)
        {
            case 1:
                if($equipo==0){
                    $week=Weekend_empresa::where('id_weekend','=',1)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($equipo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',1)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 2: 
                if($equipo==0){
                    $week=Weekend_empresa::where('id_weekend','=',2)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($equipo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',2)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 3: 
                if($equipo==0){
                    $week=Weekend_empresa::where('id_weekend','=',3)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($equipo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',3)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 4: 
                if($equipo==0){
                    $week=Weekend_empresa::where('id_weekend','=',4)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($equipo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',4)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 5: 
                if($equipo==0){
                    $week=Weekend_empresa::where('id_weekend','=',5)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($equipo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',5)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
            break;
            case 6: 
                if($equipo==0){
                    $week=Weekend_empresa::where('id_weekend','=',6)->get();
                    $extras = date_diff($fechaenrada, $fechasalidad);
                    $b=0;
    
                    foreach($week as $weeks){
                        
                              $entrada=new DateTime($weeks->start);
                              $salida=new DateTime($weeks->end);
                              $timeempresa = date_diff($entrada, $salida);
                    }
                    
                    $veri=0;
                    $veri=$extras->h-$timeempresa->h;
                    $p=$p+$veri;
                }else{
                    $equipo=Equipos::findOrFail($equipo);
                    if($equipo->type=="EXTRAS"){
                        $extras = date_diff($fechaenrada, $fechasalidad);
                        $p=$p+$extras->h;
                    }else{
                        
                            $week=Weekend_empresa::where('id_weekend','=',6)->get();
                            $extras = date_diff($fechaenrada, $fechasalidad);
                            $b=0;
            
                            foreach($week as $weeks){
                                
                                      $entrada=new DateTime($weeks->start);
                                      $salida=new DateTime($weeks->end);
                                      $timeempresa = date_diff($entrada, $salida);
                            }
                            
                            $veri=0;
                            $veri=$extras->h-$timeempresa->h;
                            $p=$p+$veri;
                    }
    
                }
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

        if($p!=0){
        $horas->id_empleado=$id;
        $horas->jornada=$jorni;
        $horas->fechainicio= request('entrada');
        $horas->fechafinalizado=request('salidad');
        $horas->monto=round($sum,2);
        $horas->horas=(int)$p;
        $horas->id_empresa=Auth::user()->id_empresa;
        $horas->estado=0;
        $horas->type=$type;
        $horas->update();
        }
        return 0;
    }
    public function deletefecha($id)
    {
        $asiste=Asistencia::select('id')->where('id_empleado','=',$id)->first();
        $asistencias=Asistencia::findOrFail($asiste->id);
        $asistencias->estado=1;
        $asistencias->update();

        $hor=Horas::select('id')->where('id_empleado','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $horas=Horas::findOrFail($hor->id);
        $horas->estado=1;
        $horas->update();
        return 0;
    }

    public function datatableAsistencia()
    {
        $id=request('id');
        
        if(request()->ajax()){
         $tipo=request()->get('dato1');


     
        $empleados=Empleado::leftjoin('equipos_empleados','equipos_empleados.id_empleado','=','empleado.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','empleado.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->where('empleado.estado','=',0)
        ->where('empleado.id_empresa','=',Auth::user()->id_empresa)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','empleado.horas','empleado.cedula','puesto.name as puesto','empleado.salario')
        ->GroupBy('equipos_empleados.id_empleado','empleado.nombre','empleado.id_empleado','empleado.cedula','empleado.horas','empleado.cargo','empleado.apellido','puesto','empleado.salario');
       

        if(!empty($tipo)){
            $empleados->where('equipos_empleados.equipos',$tipo);
        }
        
            return datatables()->of($empleados)
            ->editColumn('nombre',function($row){
                return $row->nombre." ".$row->apellido;

            })
            ->editColumn('equipos',function($row){
                $equipos=empleados_equipo::all();
                $tipo=request()->get('dato1');
                

                foreach($equipos as  $equipo){
                    if($equipo->equipos==$tipo){
                        return $tipo ;
                    }else{
                        return $tipo; 
                    }
                }
                

            })
            ->addColumn('btn',function($row){
                $tipo=request()->get('dato1');

                if($tipo==-1){
                $button='<div class="form-check"><label class="form-check-label"><input class="form-check-input check" name="Din[]"   type="checkbox" value="'.$row->id_empleado.'"><span class="form-check-sign"><span class="check"></span></span></label></div>';
                }else{
                $button='<div class="form-check"><label class="form-check-label"><input class="form-check-input check" name="Din[]"  checked type="checkbox" value="'.$row->id_empleado.'"><span class="form-check-sign"><span class="check"></span></span></label></div>';
                }

                return  $button;
                


            })->rawColumns(['btn'])
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id_empleado;    
                },
                ])->toJson();
    }
    }
    public function datatableHAS()
    {
        $id=request('id');
        $start=date(request()->start_date);
        $end=date(request()->end_date);
    

        // dd($start);
        
        
        if(request()->ajax()){
         

     
        $empleados=Empleado::leftjoin('asistencia','asistencia.id_empleado','=','empleado.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','asistencia.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->where('asistencia.estado','=',0)
        ->where('asistencia.id_empresa','=',Auth::user()->id_empresa)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','empleado.horas','empleado.cedula','puesto.name as puesto','asistencia.entrada','asistencia.salidad')->GroupBy('empleado.id_empleado','empleado.cedula','asistencia.entrada','asistencia.salidad','empleado.horas','empleado.cargo','empleado.nombre','empleado.apellido','puesto','empleado.salario');
       

        if(!empty($start)){
            $empleados->whereDate('asistencia.entrada','>=',$start)->whereDate('asistencia.salidad','<=',$end);
        }else{
            // $empleados->where('perfiles.id_perfiles',27);
            $empleados=  $empleados->whereNull('empleado.id_empleado');
        }
            return datatables()->of($empleados)
            ->editColumn('nombre',function($row){
                return $row->nombre." ".$row->apellido;

            })
            ->addColumn('btn',function($row){
                $button='<div class="form-check"><label class="form-check-label"><input class="form-check-input" name="dinamico[]" checked type="checkbox" value="'.$row->id_empleado.'"><span class="form-check-sign"><span class="check"></span></span></label></div>';
                return  $button;
                


            })->rawColumns(['btn'])
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id_empleado;
                },
                ])->toJson();
    }
    }

}

