<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use Illuminate\Http\Request;
use App\Models\Perfiles;
use App\Models\Empleado;
use App\Models\otros;
use Illuminate\Support\Facades\DB;
use App\Models\Asignaciones_empleado;
use App\Models\empleados_equipo;
use App\Models\estado_asignaciones;
use App\Models\isr_empleado;
use App\Models\Perfiles_empleado;
use Illuminate\Support\Facades\Auth;
use App\Models\estados_isr;
use App\Models\Listado;
use App\Models\empleados_nominas;
use App\Models\Equipos;
use DateTime;
use App\Models\nomina_asignaciones;
use App\Models\nomina_otros;
use App\Models\nomina_empleados;
use App\Models\nomina_horas;
use App\Models\Empresa;
use App\Models\Horas;
use App\Models\Weekend_empresa;
use App\Models\sueldo_aumento;


class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=Empleado::all();
        $equipos=Equipos::all();
        return view('Nominas.index',compact('empleados','equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }
    public function savegrupos($id)
    {
        $empleado=Empleado::findOrFail($id);
        
        $elegir=request('elegir');

        if($elegir!=0){
            $emple_equipos= New empleados_equipo();
            $emple_equipos->id_empleado=$id;
            $emple_equipos->equipos=$elegir;
            $emple_equipos->id_empresa=Auth::user()->id_empresa;
            $emple_equipos->estado=0;
            $emple_equipos->save();
            return  $emple_equipos->id;
        
        }else{
        $equipos= New Equipos();
        $equipos->descripcion=request('name');
        $equipos->entrada=request('entrada');
        $equipos->salida=request('salida');
        $equipos->user=Auth::user()->name;
        $equipos->estado=0;
        $equipos->id_empresa=Auth::user()->id_empresa;
        $equipos->save();

        $emple_equipos= New empleados_equipo();
        $emple_equipos->id_empleado=$id;
        $emple_equipos->equipos=$equipos->id;
        $emple_equipos->id_empresa=Auth::user()->id_empresa;
        $emple_equipos->estado=0;
        $emple_equipos->save();
        return $equipos->id;
    }



   
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

        $arrayID = explode(",", $request->get('arregloID'));
        $arregloSalario = explode(",", $request->get('arregloSalario'));
        $arregloHoras = explode(",", $request->get('arregloHoras'));
        $arregloDedu = explode(",", $request->get('arregloDedu'));
        $arregloBono = explode(",", $request->get('arregloBono'));
        $arreglonNeto = explode(",", $request->get('arregloSalarioNeto'));
        
        
        $nominas= new Listado();
        $nominas->descripcion=$request->get('descripcion');
        $nominas->fecha=$request->get('fecha');
        $nominas->user=Auth::user()->name;
        $nominas->monto=$request->get('montototal');
        $nominas->id_perfiles=$request->get('perfil');
        $nominas->id_empresa=Auth::user()->id_empresa;
        $nominas->estado=0;
        $nominas->start=$request->get('start');
        $nominas->end=$request->get('end');
        $nominas->id_horas=$request->get('inputCheckBox');
        $nominas->save();

        $n=count($arrayID);

        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($arrayID[$i])){
               $input['id_empleado']=$arrayID[$i];
               $input['id_nomina']=$nominas->id;
               $input['deducion']=$arregloDedu[$i];
               $input['salarioBruto']=$arregloSalario[$i];
               $input['salarioneto']=$arreglonNeto[$i];
               $input['incremento']=$arregloBono[$i];
               $input['horas']=$arregloHoras[$i];
               $input['estado']=0;
               $input['id_empresa']=Auth::user()->id_empresa;
               $perfiles=nomina_empleados::create($input);
            }
        }
        
        $empleado=Empleado::whereIn('id_empleado',$arrayID)->get();
        $horas=Horas::all();

        foreach($horas as $hora){
            foreach($empleado as $empleados){
            if($empleados->id_empleado==$hora->id_empleado){
            $inputs['id_empleado']=$empleados->id_empleado;
            $inputs['id_nomina']=$nominas->id;
            $inputs['jornada']=$hora->jornada;
            $inputs['fechainicio']=$hora->fechainicio;
            $inputs['fechafinalizado']=$hora->fechafinalizado;
            $inputs['monto']=$hora->monto;
            $inputs['type']=$hora->type;
            $inputs['horas']=$hora->horas;
            $inputs['id_empresa']=Auth::user()->id_empresa;
            $inputs['estado']=0;
            nomina_horas::create($inputs);   
            }
          }
        }
        $asigna=Asignaciones::where('id_empresa','=',Auth::user()->id_empresa)->get();
        $estado=estado_asignaciones::all();
        
        foreach($asigna as $asignas){
            foreach($empleado as $empleados){
                if($asignas->estado==0){
            $input['id_empleado']=$empleados->id_empleado;
            $input['id_nomina']=$nominas->id;
            $input['id_asignaciones']= $asignas->id;
            $input['salarioBruto']= $empleados->salario;
            $input['nombre']=$asignas->Nombre;
            $input['tipo_asigna']=$asignas->tipo_asigna;
            $input['tipo']=$asignas->tipo;
            $input['montos']=$asignas->Monto;
            $input['id_empresa']=Auth::user()->id_empresa;
            $input['estado']=0;
            nomina_asignaciones::create($input);   
          }
          }
        }

        $nominasAsigna=nomina_asignaciones::where('id_nomina','=',$nominas->id)->get();
        $otro=otros::all();

        foreach($nominasAsigna as $nominasAsignas){
            foreach( $estado as  $estados){
                if($estados->id_asignaciones==$nominasAsignas->id_asignaciones && $estados->id_empleado==$nominasAsignas->id_empleado ){
                    $nominasAsignas->estado_asigna=$estados->estado;
                }
                $nominasAsignas->save();
            }
        }

        foreach($otro as $otros){
            foreach($empleado as $empleados){
            if($empleados->id_empleado== $otros->id_empleado){
            $inputs['id_empleado']=$empleados->id_empleado;
            $inputs['id_nomina']=$nominas->id;
            $inputs['descripcion']= $otros->descripcion;
            $inputs['tipo']=$otros->tipo;
            $inputs['tipo_asigna']=$otros->tipo_asigna;
            $inputs['monto']=$otros->monto;
            $inputs['p_monto']=$otros->p_monto;
            $inputs['id_empresa']=Auth::user()->id_empresa;
            $inputs['estado']=0;
            nomina_otros::create($inputs);   
            }
          }
        }
    





        return redirect('Listado')->with('guardar','ya');

    }
    public function totalnominas($id,Request $request)
    {
        // $id=request("e");

        $start =new DateTime(request('start'));
        $end =new DateTime(request('end'));
        $valor=request('valor');

        $perfiles=Perfiles_empleado::select('id')->where('id','=',$id)->first();
        $perf=Perfiles::all();
        $empleados=Empleado::all();
        $otro=Otros::all();
        $tss=Asignaciones::all();
        $estado=estado_asignaciones::all();
        $hora=Horas::all();
        $sumHoraDescontada=0;
        $sumHoraExtra=0;

        $cont2=0;
        $cont3=0;
        $cont=0;
        $contbono=0;
        $contdeducion=0;
        $desbono=0;
        $desdeucionCont=0;
        $desbonoCont=0;
        $salario=0;
        $totals=0;
        $totalbono=0;
        $otrosD=0;
        $otrosI=0;
        $salarioDias=0;

        $p=0;
             
        if($valor==0){
        for($i = $start; $i <= $end; $i->modify('+1 day')){
            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
            
        switch($nombre_dia)
        {
            case 1: $p=$p+8;
            break;
            case 2: $p=$p+8;
            break;
            case 3: $p=$p+8;
            break;
            case 4: $p=$p+8;
            break;
            case 5: $p=$p+8;
            break;
            case 6: $p=$p+4;
            break;
        }
        
        }
        foreach($perf as $perfe){
            if($perfiles->id==$perfe->id_perfiles){
               foreach($empleados as $emple){
                   if($emple->id_empleado==$perfe->id_empleado){

                    if($emple->horas!=null){
                        $salarioDias=$emple->horas*$p;
                    }else{
                        $sumer=$emple->salario/23.83/8;
                        $salarioDias=$sumer*$p;
                    }

                    $salario=$salario+$salarioDias;
                    
                    }
                   }
               }
            }
    }
    else{
        foreach($perf as $perfe){
            if($perfiles->id==$perfe->id_perfiles){
               foreach($empleados as $emple){
                   if($emple->id_empleado==$perfe->id_empleado){

                    $salarioDias=$emple->salario;

                    $salario=$salario+$salarioDias;
                    
                    }
                   }
               }
            }
    }



                foreach($perf as $perfe){
                    if($perfiles->id==$perfe->id_perfiles){
                        foreach($empleados as $emple){
                        if($emple->id_empleado==$perfe->id_empleado){
                            foreach($hora as $horas){
                                if($horas->id_empleado==$emple->id_empleado){
                                    if($horas->type=="EXTRAS"){
                                        $sumHoraExtra= $sumHoraExtra+$horas->monto;
                                    }else{
                                        $sumHoraDescontada=$sumHoraDescontada+$horas->monto;
                                    }
                                }
                             }
                            }
                            }
                           }
                       }
                foreach($perf as $perfe){
                    if($perfiles->id==$perfe->id_perfiles){
                        foreach($empleados as $emple){
                        if($emple->id_empleado==$perfe->id_empleado){
                        foreach( $tss as $tsse){
                            if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                if($tsse->tipo_asigna=="INCREMENTO"){
                                    if($tsse->tipo=="PORCENTAJE"){
                                    $totalbono=$tsse->Monto*$emple->salario;
                                    $totalbono=$totalbono/100;
                                    $contbono=$contbono+$totalbono;
                                    }
                                    else{
                                     $totalbono=$tsse->Monto;
                                     $contbono=$contbono+$totalbono;
                                    }
                              }  
                            }
                            }
                            }
                            }
                           }
                       }



                        foreach($perf as $perfe){
                            if($perfiles->id==$perfe->id_perfiles){
                                foreach($empleados as $emple){
                                if($emple->id_empleado==$perfe->id_empleado){
                                foreach( $tss as $tsse){
                                    if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                    if($tsse->tipo_asigna=="INCREMENTO"){
                                      foreach( $estado as $esta){
                                            if($esta->id_empleado==$emple->id_empleado){
                                                if($esta->id_asignaciones==$tsse->id){
                                                    if($esta->estado==1){
                                                        if($tsse->tipo=="PORCENTAJE"){
                                                            $desbono=$tsse->Monto*$emple->salario;
                                                            $desbono=$desbono/100;
                                                            $desbonoCont=$desbonoCont+$desbono;
                                                            
                                                            }else{
                                                             $desbono=$tsse->Monto;
                                                             $desbonoCont=$desbonoCont+$desbono;
                                                            }
                                                    }
                                                }
                                              }
                                              

                                        }
                                        }
                                        }
                                      }  
                                    }
                                    }
                                   }
                               }


            

                    foreach($perf as $perfe){
                        if($perfiles->id==$perfe->id_perfiles){
                            foreach($empleados as $emple){
                            if($emple->id_empleado==$perfe->id_empleado){
                            foreach( $tss as $tsse){
                                if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                    foreach($estado as $estados)
                                    if($estados->id_empleado==$emple->id_empleado){
                                    if($estados->id_asignaciones==$tsse->id){
                                        if($estados->estado==1){
                                    if($tsse->tipo=="PORCENTAJE"){
                                        $cont=$tsse->Monto*$emple->salario;
                                        $cont=$cont/100;
                                        $desdeucionCont=$desdeucionCont+$cont;
                                        }else{
                                         $cont=$tsse->Monto;
                                         $desdeucionCont=$desdeucionCont+$cont;
                                        }
                                    }
                                   }
                                 }
                                }
                    
                                }
                            }
                           }
                       }
                            }
                            
                        }
    
                        foreach($perf as $perfe){
                            if($perfiles->id==$perfe->id_perfiles){
                                foreach($empleados as $emple){
                                if($emple->id_empleado==$perfe->id_empleado){
                                foreach( $tss as $tsse){
                                    if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                    if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                        if($tsse->tipo=="PORCENTAJE"){
                                            $totals=$tsse->Monto*$emple->salario;
                                            $totals=$totals/100;
                                            $contdeducion=$contdeducion+$totals;
                                            }else{
                                             $totals=$tsse->Monto;
                                             $contdeducion=$contdeducion+$totals;
                                            }
                                        }
                        
                                    }
                                    }
                                   }
                                   }
                                }
                                
                            }






                    foreach($perf as $perfe){
                        if($perfiles->id==$perfe->id_perfiles){
                            foreach($empleados as $emple){
                            if($emple->id_empleado==$perfe->id_empleado){
                                foreach($otro as $otros){
                                    if($otros->id_empresa==Auth::user()->id_empresa){
                                    if($otros->id_empleado==$emple->id_empleado){
                                 if($otros->tipo_asigna=="DEDUCIÓN"){
                                        if($otros->p_monto!=null){
                                            $otrosD=$otrosD+$otros->p_monto;
                                        }else{
                                            $otrosD=$otrosD+$otros->monto;
                                        }
                                    }else{
                                        if($otros->p_monto!=null){
                                            $otrosI=$otrosI+$otros->p_monto;
                                        }else{
                                            $otrosI=$otrosI+$otros->monto;
                                        }
                                    }
                                     }
                                  }
                                  }
                                  }
                                }
                            }  
                        }

             $totaldeducion=0;
             $totalincremento=0;
             $totaldeducion=$otrosD+$contdeducion+$cont2+$cont3+$sumHoraDescontada;
             $totalincremento=$otrosI+$contbono-$desbonoCont+$sumHoraExtra;
             
             return  $salario+$totalincremento-$totaldeducion+$desdeucionCont;
            //  return  $salario;
            //  return $p;
    }

    //265,127

    //16,370.70
    //

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
    public function showHoras($id)
    {
        $horas=Horas::findOrFail($id);
        return view('Nominas.showHoras',compact('horas'));
    }

    public function savehoras($id)
    {
        $empleado=Empleado::findOrFail($id);
        $empresa=Empresa::findOrFail(Auth::user()->id_empresa);


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
            break;
            case 2: 
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
            break;
            case 3: 
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
            break;
            case 4: 
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
            break;
            case 5: 
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
            break;
            case 6: 
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
        $horas=new Horas();
        $horas->id_empleado=$id;
        $horas->jornada=$jorni;
        $horas->fechainicio= request('fechaentrada');
        $horas->fechafinalizado=request('fechasalidad');
        $horas->monto=round($sum,2);
        $horas->horas=(int)$p;
        $horas->id_empresa=Auth::user()->id_empresa;
        $horas->estado=0;
        $horas->type=$type;
        $horas->save();
        }

        return view('Nominas.Plantillas.horas',compact('horas'));
        // return   $salida->format("H:i");
        // return $b;

    }
    public function deleteemple($id)
    {
        $idperfiles=request('idperfi');

        $perfiles=Perfiles::all();

        foreach($perfiles as $perfil){
            if($perfil->id_perfiles==$idperfiles){
                if($perfil->id_empleado==$id){
                    $perfil->delete();
                }
            }
        }


        
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
    public function horasemple($id)
    {
        $empleado=Empleado::findOrFail($id);
        $hora=Horas::where('id_empleado','=',$id)->where('estado','=',0)->get();
        
        return view('Nominas.Plantillas.horasEmple',compact('empleado','hora'));
    }

    public function addempleado($id, Request $request)
    {
        $perfiles=new Perfiles();

        $tipo=$request->get('idPerfiles');
        $Cambio=intval($tipo);

        
        if(sizeof(Perfiles::select('id_empleado')->where('id_empleado','=',$id)->get())!=0){
            return 2;
            
        }else{
            $perfiles->id_perfiles=$Cambio;
            $perfiles->id_empleado=$id;
            $perfiles->id_empresa=Auth::user()->id_empresa;
            $perfiles->estados=0;
    
            $perfiles->save();
            return 1;
            
        }
        

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
    public function modalhours($id)
    {
        $equipo=Equipos::
        leftjoin('equipos_empleados','equipos_empleados.equipos','=','equipos.id')
        ->leftjoin('empleado','empleado.id_empleado','=','equipos_empleados.id_empleado')
        ->where('equipos.id_empresa',Auth::user()->id_empresa)
        ->where('equipos.estado','!=','1')
        ->where('equipos_empleados.id_empleado','=',$id)
        ->select('equipos.id','equipos.descripcion','equipos.user','equipos.created_at','equipos.entrada','equipos.salida')
        ->GroupBy('equipos.id','equipos.descripcion','equipos.user','equipos.created_at','equipos.entrada','equipos.salida')
        ->get();
        // dd($equipo);
        $p=0;
        $b=0;



           return view("Nominas.modalhoras",compact('equipo','id','b'));

    }
    public function VerificateHours($id)
    {
        // $empleado=Empleado::findOrFail();

        if(sizeof(empleados_equipo::select('id_empleado')->where('id_empleado','=',$id)->get())==0){
            return 0;
        }else{
            return 1;
        }


        
    }

    public function switchetss($id,Request $request)
    {
        $estado= new estado_asignaciones();
        $Verificar=estado_asignaciones::all();

        $tss=Asignaciones::findOrFail($id);
        $empleado=request("p");

        foreach($Verificar as $ver){
            if($ver->id_empleado==$empleado){
                if($tss->id==$ver->id_asignaciones){
                    $idest=$ver->id;
                    $esta=estado_asignaciones::findOrFail($idest);
                    if($ver->estado==1){
                        $esta->estado=2;
                    }else{
                        $esta->estado=1;
                    }
                    
                    $esta->update();
                    return"se cambio";

                }

            }
            
        }
        $estado->id_asignaciones=$tss->id;
        $estado->id_empleado=$empleado;
        $estado->id_empresa=Auth::user()->id_empresa;
        $estado->estado=1;
        $estado->save();
        return "si";

        

    }
    public function switchetssisr($id,Request $request)
    {
        $estado= new estados_isr();
        $Verificar=estados_isr::all();

        $isr=isr_empleado::findOrFail($id);
        $empleado=request("p");

        foreach($Verificar as $ver){
            if($ver->id_empleado==$empleado){
                if($isr->id==$ver->id_isr){
                   
                    $idest=$ver->id;

                    $esta=estados_isr::findOrFail($idest);
                    if($ver->estado==1){
                        $esta->estado=2;
                    }else{
                        $esta->estado=1;
                    }
                    
                    $esta->update();

                }

            }
            
        }

    
        return "si";
    }
    public function switchetssbono($id,Request $request)
    {
        $estado= new estado_asignaciones();
        $Verificar=estado_asignaciones::all();

        $tss=Asignaciones::findOrFail($id);
        $empleado=request("p");

        foreach($Verificar as $ver){
            if($ver->id_empleado==$empleado){
                if($tss->id==$ver->id_asignaciones){
                    $idest=$ver->id;
                    $esta=estado_asignaciones::findOrFail($idest);
                    if($ver->estado==1){
                        $esta->estado=2;
                    }else{
                        $esta->estado=1;
                    }
                    
                    $esta->update();
                    return"se cambio";

                }

            }
            
        }
        $estado->id_asignaciones=$tss->id;
        $estado->id_empleado=$empleado;
        $estado->id_empresa=Auth::user()->id_empresa;
        $estado->estado=1;
        $estado->save();
        return "si";
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

    function Detalle($ide){
        $empleado=Empleado::findOrFail($ide);
        $tss=Asignaciones::all();
        $asigna=Asignaciones_empleado::all();
        $estado=estado_asignaciones::all();
        $isr=isr_empleado::all();
        $estadoasigna=estados_isr::all();
        $p=0;
        
        return view('Nominas.Plantillas.detalles',compact('empleado','estadoasigna','tss','asigna','estado','isr','p'));
    }

    function incremento($ide){
        $empleado=Empleado::findOrFail($ide);
        $tss=Asignaciones::all();
        $estado=estado_asignaciones::all();
        $p=0;

        
        return view('Nominas.Plantillas.incremento',compact('empleado','tss','estado','p'));
    }
    function otros($ide){
        $empleado=Empleado::findOrFail($ide);
        $otros=otros::all();
        
        return view('Nominas.Plantillas.OtrosEmple',compact('empleado','otros'));
    }
    public function verEmpleado($id)
    {
        $empleado=Empleado::findOrFail($id);

        return view('Nominas,modalshow');
    }
    public function datatable(Request $request)
    {
        $id=request('id');
        
        if(request()->ajax()){
         $tipo=request()->get('dato1');



     
        $empleados=Empleado::leftjoin('perfiles','perfiles.id_empleado','=','empleado.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','perfiles.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->leftjoin('horas','horas.id_empleado','=','empleado.id_empleado')
        ->leftjoin('asignaciones_empleado','asignaciones_empleado.empleado_id_empleado','=','perfiles.id_empleado')
        ->leftjoin('asignaciones','asignaciones.id','=','asignaciones_empleado.asignaciones_id')
        ->where('perfiles.estados','=',0)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','empleado.horas','empleado.cedula','puesto.name as puesto','empleado.salario',DB::raw('sum(asignaciones_empleado.monto) as Asigna'))->GroupBy('empleado.id_empleado','empleado.cedula','empleado.horas','empleado.cargo','empleado.nombre','empleado.apellido','puesto','empleado.salario');
       
        if(!empty($tipo)){
            $empleados->where('perfiles.id_perfiles',$tipo);

        }else{
            // $empleados->where('perfiles.id_perfiles',27);

            $empleados=  $empleados->whereNull('empleado.id_empleado');

        }
            return datatables()->of($empleados)
            ->editColumn('nombre',function($row){
                return $row->nombre." ".$row->apellido;

            })
            ->editColumn('horas',function($row){
                $valor=request()->get('valor');
                $start=request()->start_date;
                $end=request()->end_date;

                $begin = new DateTime($start);
                $end   = new DateTime($end);
                $p=0;
                
                if($valor==0){
                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
                    
                switch($nombre_dia)
                {
                    case 1: $p=$p+8;
                    break;
                    case 2: $p=$p+8;
                    break;
                    case 3: $p=$p+8;
                    break;
                    case 4: $p=$p+8;
                    break;
                    case 5: $p=$p+8;
                    break;
                    case 6: $p=$p+4;
                    break;
                }
                
                }
            }

                return  $p;

            })
            ->editColumn('amount',function($row){
                $cont=0;
                $cont2=0;
                $sum=0;
                $sum2=0;
                $sumHoras=0;
                $tipo=request()->get('dato1');
                $tss=Asignaciones::all();
                $perf=Perfiles::all();
                $estado=estado_asignaciones::all();
                $horas=Horas::where('type','=','EXTRAS')->get();
                $otro=Otros::all();
                $otrostotal=0;

                foreach($perf as $perfe){
                    if($tipo==$perfe->id_perfiles){
                        if($row->id_empleado==$perfe->id_empleado){
                        foreach( $tss as $tsse){
                            if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0 ){
                            if($tsse->tipo_asigna=="INCREMENTO"){
                                    if($tsse->tipo=="PORCENTAJE"){
                                    $cont=$tsse->Monto * $row->salario;
                                    $cont=$cont/100;
                                    $sum=$sum+$cont;
                                    }else{
                                     $cont=$tsse->Monto;
                                     $sum=$sum+$cont;
                                    }
                              }  
                            }
                            }
                            }
                           }
                       }

                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                                foreach($otro as $otros){
                                    if($otros->id_empresa==Auth::user()->id_empresa){
                                    if($otros->id_empleado==$row->id_empleado){
                                 if($otros->tipo_asigna=="INCREMENTO"){
                                        if($otros->p_monto!=null){
                                            $otrostotal=$otrostotal+$otros->p_monto;
                                        }else{
                                            $otrostotal=$otrostotal+$otros->monto;
                                        }
                                    }
                                     }
                                  }
                                  }
                                }
                            }  
                        }
                        foreach($horas as $hora){
                            if($hora->id_empleado==$row->id_empleado){
                                $sumHoras=$sumHoras+$hora->monto;
                            }
                        }

                        foreach($perf as $perfe){
                            if($tipo==$perfe->id_perfiles){
                                if($row->id_empleado==$perfe->id_empleado){
                                foreach( $tss as $tsse){
                                    if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                    if($tsse->tipo_asigna=="INCREMENTO"){

                                      foreach( $estado as $esta){
                                            if($esta->id_empleado==$row->id_empleado){
                                                if($esta->id_asignaciones==$tsse->id){
                                                    if($esta->estado==1){
                                                        if($tsse->tipo=="PORCENTAJE"){
                                                            $cont2=$tsse->Monto*$row->salario;
                                                            $cont2=$cont2/100;
                                                            $sum2=$sum2+$cont2;
                                                            }else{
                                                             $cont2=$tsse->Monto;
                                                             $sum2=$sum2+$cont2;
                                                            }
                                                    }
                                                }
                                              }
                                            }
                                        
                                              

                                        }
                                      }  
                                    }
                                    }
                                   }
                               }
                    return '$'.number_format($otrostotal-$sum2+$sum+$sumHoras,2);
                // return $sumHoras;
            })
            ->editColumn('Asigna',function($row){
                $cont=0;
                $cont2=0;
                $sum=0;
                $sum2=0;
                $otrosCont=0;
                $tipo=request()->get('dato1');
                $horas=Horas::where('type','=','DESCONTADA')->get();
                $sumHoras=0;
                $otro=Otros::all();
                $tss=Asignaciones::all();
                $perf=Perfiles::all();
                $estado=estado_asignaciones::all();

                foreach($perf as $perfe){
                    if($tipo==$perfe->id_perfiles){
                        if($row->id_empleado==$perfe->id_empleado){
                            foreach($otro as $otros){
                                if($otros->id_empresa==Auth::user()->id_empresa){
                                if($otros->id_empleado==$row->id_empleado){
                             if($otros->tipo_asigna=="DEDUCIÓN"){
                                    if($otros->p_monto!=null){
                                        $otrosCont=$otrosCont+$otros->p_monto;
                                    }else{
                                        $otrosCont=$otrosCont+$otros->monto;
                                    }
                                }
                                 }
                              }
                              }
                            }
                        }  
                    }

                foreach($perf as $perfe){
                    if($tipo==$perfe->id_perfiles){
                        if($row->id_empleado==$perfe->id_empleado){
                        foreach( $tss as $tsse){
                            if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                            if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                foreach($estado as $estados)
                                if($estados->id_empleado==$row->id_empleado){
                                if($estados->id_asignaciones==$tsse->id){
                                    if($estados->estado==1){
                                if($tsse->tipo=="PORCENTAJE"){
                                    $cont=$tsse->Monto*$row->salario;
                                    $cont=$cont/100;
                                    $sum2=$sum2+$cont;
                                    }else{
                                     $cont=$tsse->Monto;
                                     $sum2=$sum2+$cont;
                                    }
                                }
                                }
                                }
                                }
                                }
                
                            }
                           }
                        }
                        
                    }

                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                            foreach( $tss as $tsse){
                                if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                    if($tsse->tipo=="PORCENTAJE"){
                                        $cont2=$tsse->Monto*$row->salario;
                                        $cont2=$cont2/100;
                                        $sum=$sum+$cont2;
                                        }else{
                                         $cont2=$tsse->Monto;
                                         $sum=$sum+$cont2;
                                        }
                                    }
                    
                                }
                                }
                               }
                            }
                            
                        }

                        foreach($horas as $hora){
                            if($hora->id_empleado==$row->id_empleado){
                                $sumHoras=$sumHoras+$hora->monto;
                            }
                        }
                    return '$'.number_format($otrosCont+$sum-$sum2+$sumHoras,2);
                    // return $sumHoras ;
            })
            ->editColumn('total',function($row){
                $tducion=0;
                $tincremnt=0;
                $cont=0;
                $cont2=0;
                $Cont4bono=0;
                $contbono=0;
                $otroI=0;

                $tipo=request()->get('dato1');
                $valor=request()->get('valor');

                $tss=Asignaciones::all();
                $perf=Perfiles::all();
                $otro=Otros::all();
                $estadoasigna=estado_asignaciones::all();
                $horasDescontada=Horas::where('type','=','DESCONTADA')->get();
                $horasExtras=Horas::where('type','=','EXTRAS')->get();
                $sumHorasDescontada=0;
                $sumHorasExtras=0;

                $otroD=0;
                $sum=0;
                $sum2=0;
                $sumEstado=0;
                $sumBono=0;
                $salarioDias=0;

                $start=request()->start_date;
                $end=request()->end_date;

                $begin = new DateTime($start);
                $end   = new DateTime($end);
                $p=0;
                
                if($valor==0){
                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
                    
                switch($nombre_dia)
                {
                    case 1: $p=$p+8;
                    break;
                    case 2: $p=$p+8;
                    break;
                    case 3: $p=$p+8;
                    break;
                    case 4: $p=$p+8;
                    break;
                    case 5: $p=$p+8;
                    break;
                    case 6: $p=$p+4;
                    break;
                }
                
                }
           
                if($row->horas!=null){
                    $salarioDias=$row->horas*$p;
                }else{
                    $sumer=$row->salario/23.83/8;
                    $salarioDias=$sumer*$p;
                }
            }else{
                $salarioDias=$row->salario;
            }

                foreach($perf as $perfe){
                    if($tipo==$perfe->id_perfiles){
                        if($row->id_empleado==$perfe->id_empleado){
                            foreach($otro as $otros){
                                if($otros->id_empresa==Auth::user()->id_empresa){
                                if($otros->id_empleado==$row->id_empleado){
                             if($otros->tipo_asigna=="DEDUCIÓN"){
                                    if($otros->p_monto!=null){
                                        $otroD=$otroD+$otros->p_monto;
                                    }else{
                                        $otroD=$otroD+$otros->monto;
                                    }
                                }else{
                                    if($otros->p_monto!=null){
                                        $otroI=$otroI+$otros->p_monto;
                                    }else{
                                        $otroI=$otroI+$otros->monto;
                                    }
                                }
                                 }
                              }
                              }
                            }
                        }  
                    }

                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                            foreach( $tss as $tsse){
                                if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                    foreach($estadoasigna as $estados)
                                    if($estados->id_empleado==$row->id_empleado){
                                    if($estados->id_asignaciones==$tsse->id){
                                        if($estados->estado==1){
                                    if($tsse->tipo=="PORCENTAJE"){
                                        $cont=$tsse->Monto*$row->salario;
                                        $cont=$cont/100;
                                        $sumEstado=$sumEstado+$cont;
                                        }else{
                                         $cont=$tsse->Monto;
                                         $sumEstado=$sumEstado+$cont;
                                        }
                                    }
                                    }
                                    }
                                    }
                                    }
                    
                                }
                               }
                            }
                            
                        }
    
                        
                        foreach($perf as $perfe){
                            if($tipo==$perfe->id_perfiles){
                                if($row->id_empleado==$perfe->id_empleado){
                                foreach( $tss as $tsse){
                                    if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                    if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                        if($tsse->tipo=="PORCENTAJE"){
                                            $cont2=$tsse->Monto*$row->salario;
                                            $cont2=$cont2/100;
                                            $sum=$sum+$cont2;
                                            }else{
                                             $cont2=$tsse->Monto;
                                             $sum=$sum+$cont2;
                                            }
                                        }
                        
                                    }
                                    }
                                   }
                                }
                                
                            }

//--------------------------------------------------------------------------------------------------------------------------
foreach($perf as $perfe){
    if($tipo==$perfe->id_perfiles){
        if($row->id_empleado==$perfe->id_empleado){
        foreach( $tss as $tsse){
            if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
            if($tsse->tipo_asigna=="INCREMENTO"){
                    if($tsse->tipo=="PORCENTAJE"){
                    $contbono=$tsse->Monto * $row->salario;
                    $contbono=$contbono/100;
                    $sum2=$sum2+$contbono;
                    }else{
                     $contbono=$tsse->Monto;
                     $sum2=$sum2+$contbono;
                    }
              }  
            }
            }
            }
           }
       }



        foreach($perf as $perfe){
            if($tipo==$perfe->id_perfiles){
                if($row->id_empleado==$perfe->id_empleado){
                foreach( $tss as $tsse){
                    if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                    if($tsse->tipo_asigna=="INCREMENTO"){
                      foreach( $estadoasigna as $esta){
                            if($esta->id_empleado==$row->id_empleado){
                                if($esta->id_asignaciones==$tsse->id){
                                    if($esta->estado==1){
                                        if($tsse->tipo=="PORCENTAJE"){
                                            $Cont4bono=$tsse->Monto*$row->salario;
                                            $Cont4bono=$Cont4bono/100;
                                            $sumBono=$sumBono+$Cont4bono;
                                            }else{
                                             $Cont4bono=$tsse->Monto;
                                             $sumBono=$sumBono+$Cont4bono;
                                            }
                                    }
                                }
                              }
                              

                        }
                        }
                      }  
                    }
                    }
                   }
               }
                            
               foreach($horasDescontada as $hora){
                if($hora->id_empleado==$row->id_empleado){
                    $sumHorasDescontada=$sumHorasDescontada+$hora->monto;
                }
            }
               foreach($horasExtras as $hora){
                if($hora->id_empleado==$row->id_empleado){
                    $sumHorasExtras=$sumHorasExtras+$hora->monto;
                }
            }

                $tducion= $otroD+$sum-$sumEstado+$sumHorasDescontada;
                $tincremnt=$otroI+$sum2-$sumBono+$sumHorasExtras;
                return '$'.number_format($salarioDias+$tincremnt-$tducion,2);
                // return $begin;

            })->editColumn('salario',function($row){
                $sueldoMonto=sueldo_aumento::where("id_empleado",'=',$row->id_empleado)
                ->where('estado','=',0)
                ->where('id_empresa','=',Auth::user()->id_empresa)
                ->select(DB::raw('sum(sueldo_increment) as amount'))
                ->first();
                return '$'.number_format($row->salario+ $sueldoMonto->amount,2);
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id_empleado;    
                },
                'name'=>function($row){
                    return $row->nombre." ".$row->apellido;    
                },
                'salario'=>function($row){
                    return $row->salario;    
                },
                'horas'=>function($row){
                    return $row->horas;

                },
                'times'=>function($row){
                    $horasDescontada=Horas::where('type','=','DESCONTADA')->get();
                    $horasExtras=Horas::where('type','=','EXTRAS')->get();
                    $sumHorasDescontada=0;
                    $sumHorasExtras=0;

                    foreach($horasDescontada as $hora){
                        if($hora->id_empleado==$row->id_empleado){
                            $sumHorasDescontada=$sumHorasDescontada+$hora->monto;
                        }
                    }
                       foreach($horasExtras as $hora){
                        if($hora->id_empleado==$row->id_empleado){
                            $sumHorasExtras=$sumHorasExtras+$hora->monto;
                        }
                    }

                    return $sumHorasDescontada+$sumHorasExtras;

                },
                'total'=>function($row){
                    $tducion=0;
                    $tincremnt=0;
                    $cont=0;
                    $cont2=0;
                    $Cont4bono=0;
                    $contbono=0;
                    $otroI=0;
                    $tipo=request()->get('dato1');
                    $valor=request()->get('valor');
                    $tss=Asignaciones::all();
                    $perf=Perfiles::all();
                    $otro=Otros::all();
                    $estadoasigna=estado_asignaciones::all();
                    $otroD=0;
                    $sum=0;
                    $sum2=0;
                    $sumEstado=0;
                    $sumBono=0;
                    $salarioDias=0;
    
                    $start=request()->start_date;
                    $end=request()->end_date;
    
                    $begin = new DateTime($start);
                    $end   = new DateTime($end);
                    $p=0;
                    
   
                    if($valor==0){
                        for($i = $begin; $i <= $end; $i->modify('+1 day')){
                            $nombre_dia=date('w', strtotime($i->format("Y-m-d")));
                            
                        switch($nombre_dia)
                        {
                            case 1: $p=$p+8;
                            break;
                            case 2: $p=$p+8;
                            break;
                            case 3: $p=$p+8;
                            break;
                            case 4: $p=$p+8;
                            break;
                            case 5: $p=$p+8;
                            break;
                            case 6: $p=$p+4;
                            break;
                        }
                        
                        }
                   
                        if($row->horas!=null){
                            $salarioDias=$row->horas*$p;
                        }else{
                            $sumer=$row->salario/23.83/8;
                            $salarioDias=$sumer*$p;
                        }
                    }else{
                        $salarioDias=$row->salario;
                    }
        
    
                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                                foreach($otro as $otros){
                                    if($otros->id_empresa==Auth::user()->id_empresa){
                                    if($otros->id_empleado==$row->id_empleado){
                                 if($otros->tipo_asigna=="DEDUCIÓN"){
                                        if($otros->p_monto!=null){
                                            $otroD=$otroD+$otros->p_monto;
                                        }else{
                                            $otroD=$otroD+$otros->monto;
                                        }
                                    }else{
                                        if($otros->p_monto!=null){
                                            $otroI=$otroI+$otros->p_monto;
                                        }else{
                                            $otroI=$otroI+$otros->monto;
                                        }
                                    }
                                     }
                                  }
                                  }
                                }
                            }  
                        }
    
                        foreach($perf as $perfe){
                            if($tipo==$perfe->id_perfiles){
                                if($row->id_empleado==$perfe->id_empleado){
                                foreach( $tss as $tsse){
                                    if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                    if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                        foreach($estadoasigna as $estados)
                                        if($estados->id_empleado==$row->id_empleado){
                                        if($estados->id_asignaciones==$tsse->id){
                                            if($estados->estado==1){
                                        if($tsse->tipo=="PORCENTAJE"){
                                            $cont=$tsse->Monto*$row->salario;
                                            $cont=$cont/100;
                                            $sumEstado=$sumEstado+$cont;
                                            }else{
                                             $cont=$tsse->Monto;
                                             $sumEstado=$sumEstado+$cont;
                                            }
                                        }
                                        }
                                        }
                                        }
                                        }
                        
                                    }
                                   }
                                }
                                
                            }
        
                            
                            foreach($perf as $perfe){
                                if($tipo==$perfe->id_perfiles){
                                    if($row->id_empleado==$perfe->id_empleado){
                                    foreach( $tss as $tsse){
                                        if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                        if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                            if($tsse->tipo=="PORCENTAJE"){
                                                $cont2=$tsse->Monto*$row->salario;
                                                $cont2=$cont2/100;
                                                $sum=$sum+$cont2;
                                                }else{
                                                 $cont2=$tsse->Monto;
                                                 $sum=$sum+$cont2;
                                                }
                                            }
                            
                                        }
                                        }
                                       }
                                    }
                                    
                                }
    
    //--------------------------------------------------------------------------------------------------------------------------
    foreach($perf as $perfe){
        if($tipo==$perfe->id_perfiles){
            if($row->id_empleado==$perfe->id_empleado){
            foreach( $tss as $tsse){
                if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                if($tsse->tipo_asigna=="INCREMENTO"){
                        if($tsse->tipo=="PORCENTAJE"){
                        $contbono=$tsse->Monto * $row->salario;
                        $contbono=$contbono/100;
                        $sum2=$sum2+$contbono;
                        }else{
                         $contbono=$tsse->Monto;
                         $sum2=$sum2+$contbono;
                        }
                  }  
                }
                }
                }
               }
           }
    
    
    
            foreach($perf as $perfe){
                if($tipo==$perfe->id_perfiles){
                    if($row->id_empleado==$perfe->id_empleado){
                    foreach( $tss as $tsse){
                        if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                        if($tsse->tipo_asigna=="INCREMENTO"){
                          foreach( $estadoasigna as $esta){
                                if($esta->id_empleado==$row->id_empleado){
                                    if($esta->id_asignaciones==$tsse->id){
                                        if($esta->estado==1){
                                            if($tsse->tipo=="PORCENTAJE"){
                                                $Cont4bono=$tsse->Monto*$row->salario;
                                                $Cont4bono=$Cont4bono/100;
                                                $sumBono=$sumBono+$Cont4bono;
                                                }else{
                                                 $Cont4bono=$tsse->Monto;
                                                 $sumBono=$sumBono+$Cont4bono;
                                                }
                                        }
                                    }
                                  }
                                  
    
                            }
                            }
                          }  
                        }
                        }
                       }
                   }
                                
    
                    $tducion= $otroD+$sum-$sumEstado;
                    $tincremnt=$otroI+$sum2-$sumBono;
                    return round($salarioDias+$tincremnt-$tducion,2);

                },
                'dedu'=>function($row){
                $cont=0;
                $cont2=0;
                $otrosCont=0;
                $tipo=request()->get('dato1');
                $otro=Otros::all();
                $tss=Asignaciones::all();
                $perf=Perfiles::all();
                $estado=estado_asignaciones::all();
                $sum=0;
                $sumEstado=0;


                foreach($perf as $perfe){
                    if($tipo==$perfe->id_perfiles){
                        if($row->id_empleado==$perfe->id_empleado){
                        foreach( $tss as $tsse){
                            if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                            if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                foreach($estado as $estados)
                                if($estados->id_empleado==$row->id_empleado){
                                if($estados->id_asignaciones==$tsse->id){
                                    if($estados->estado==1){
                                if($tsse->tipo=="PORCENTAJE"){
                                    $cont=$tsse->Monto*$row->salario;
                                    $cont=$cont/100;
                                    $sumEstado=$sumEstado+$cont;
                                    }else{
                                     $cont=$tsse->Monto;
                                     $sumEstado=$sumEstado+$cont;
                                    }
                                }
                                }
                                }
                                }
                                }
                
                            }
                           }
                        }
                        
                    }

                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                            foreach( $tss as $tsse){
                                if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                if($tsse->tipo_asigna=="DEDUCCIÓN"){
                                    if($tsse->tipo=="PORCENTAJE"){
                                        $cont2=$tsse->Monto*$row->salario;
                                        $cont2=$cont2/100;
                                        $sum=$sum+$cont2;
                                        }else{
                                         $cont2=$tsse->Monto;
                                         $sum=$sum+$cont2;
                                        }
                                    }
                    
                                }
                                }
                               }
                            }
                            
                        }
                    return $sum-$sumEstado;
                },
                'bono'=>function($row){
                    $cont=0;
                    $cont2=0;
                    $tipo=request()->get('dato1');
                    $tss=Asignaciones::all();
                    $perf=Perfiles::all();
                    $estado=estado_asignaciones::all();
                    $otro=Otros::all();
                    $otrostotal=0;
                    $sum=0;
                    $sumEstado=0;
    
                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                            foreach( $tss as $tsse){
                                if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0 ){
                                if($tsse->tipo_asigna=="INCREMENTO"){
                                        if($tsse->tipo=="PORCENTAJE"){
                                        $cont=$tsse->Monto * $row->salario;
                                        $cont=$cont/100;
                                        $sum=$sum+$cont;
                                        }else{
                                         $cont=$tsse->Monto;
                                         $sum=$sum+$cont;
                                        }
                                  }  
                                }
                                }
                                }
                               }
                           }
    

                            foreach($perf as $perfe){
                                if($tipo==$perfe->id_perfiles){
                                    if($row->id_empleado==$perfe->id_empleado){
                                    foreach( $tss as $tsse){
                                        if($tsse->id_empresa==Auth::user()->id_empresa && $tsse->estado==0){
                                        if($tsse->tipo_asigna=="INCREMENTO"){
    
                                          foreach( $estado as $esta){
                                                if($esta->id_empleado==$row->id_empleado){
                                                    if($esta->id_asignaciones==$tsse->id){
                                                        if($esta->estado==1){
                                                            if($tsse->tipo=="PORCENTAJE"){
                                                                $cont2=$tsse->Monto*$row->salario;
                                                                $cont2=$cont2/100;
                                                                $sumEstado=$sumEstado+$cont2;
                                                                }else{
                                                                 $cont2=$tsse->Monto;
                                                                 $sumEstado=$sumEstado+$cont2;
                                                                }
                                                        }
                                                    }
                                                  }
                                                }
                                            
                                                  
    
                                            }
                                          }  
                                        }
                                        }
                                       }
                                   }
                        return $sum-$sumEstado;
                },

                'otros'=>function($row){
                    $otrosD=0;
                    $otrosI=0;
                    $tipo=request()->get('dato1');
                    $otro=Otros::all();
                    $perf=Perfiles::all();


                    foreach($perf as $perfe){
                        if($tipo==$perfe->id_perfiles){
                            if($row->id_empleado==$perfe->id_empleado){
                                foreach($otro as $otros){
                                    if($otros->id_empleado==$row->id_empleado){
                                 if($otros->tipo_asigna=="DEDUCIÓN"){
                                        if($otros->p_monto!=null){
                                            $otrosD=$otrosD+$otros->p_monto;
                                        }else{
                                            $otrosD=$otrosD+$otros->monto;
                                        }
                                    }else{
                                        if($otros->p_monto!=null){
                                            $otrosI=$otrosI+$otros->p_monto;
                                        }else{
                                            $otrosI=$otrosI+$otros->monto;
                                        }
                                    }
                                     }
                                  }
                                  }
                                
                            }  
                        }
                        return $otrosI-$otrosD;
                },
                
                ])->toJson();
        
        }

    }//fin de la funcion datatable
}
