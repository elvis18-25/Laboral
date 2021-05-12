<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use Illuminate\Http\Request;
use App\Models\Perfiles;
use App\Models\Empleado;
use App\Models\otros;
use Illuminate\Support\Facades\DB;
use App\Models\Asignaciones_empleado;
use App\Models\estado_asignaciones;
use App\Models\isr_empleado;
use App\Models\Puesto;
use App\Models\Perfiles_empleado;
use Illuminate\Support\Facades\Auth;
use App\Models\estados_isr;
use App\Models\Listado;




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
        return view('Nominas.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nominas= new Listado();

        $nominas->descripcion=$request->get('descripcion');
        $nominas->fecha=$request->get('fecha');
        $nominas->user=Auth::user()->name;
        $nominas->monto=$request->get('montototal');
        $nominas->id_perfiles=$request->get('perfil');
        $nominas->id_empresa=Auth::user()->id_empresa;
        $nominas->estado=0;

        $nominas->save();
        return redirect('Listado');

    }
    public function totalnominas($id,Request $request)
    {
        // $id=request("e");
        $perfiles=Perfiles_empleado::select('id')->where('id','=',$id)->first();
        $perf=Perfiles::all();
        $empleados=Empleado::all();
        $otro=Otros::all();
        $tss=Asignaciones::all();
        $estado=estado_asignaciones::all();

        $p=0;

        $cont2=0;
        $cont3=0;
        $cont=0;
        $rebajaisr=0;
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

            foreach($perf as $perfe){
                if($perfiles->id==$perfe->id_perfiles){
                   foreach($empleados as $emple){
                       if($emple->id_empleado==$perfe->id_empleado){
                        $salario= $salario+$emple->salario;
                        
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
                                    $totalbono=$tsse->Monto * $emple->salario;
                                    $totalbono=$totalbono/100;
                                    $contbono=$contbono+$totalbono;
                                    }
                                    else{
                                     $totalbono=$totalbono+$tsse->Monto;
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
                                             $totals=$totals+$tsse->Monto;
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

             $totaldeducion=$otrosD+$contdeducion+$cont2+$cont3-$rebajaisr;
             $totalincremento=$otrosI+$contbono-$desbonoCont;
             
             return  $salario+$totalincremento-$totaldeducion+$desdeucionCont;
            //  return  $contdeducion;
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
        //  $tipo=1;
         $cont=0;
     
        $empleados=Empleado::leftjoin('perfiles','perfiles.id_empleado','=','empleado.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','perfiles.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->leftjoin('asignaciones_empleado','asignaciones_empleado.empleado_id_empleado','=','perfiles.id_empleado')
        ->leftjoin('asignaciones','asignaciones.id','=','asignaciones_empleado.asignaciones_id')

        ->where('perfiles.estados','=',0)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','empleado.cedula','puesto.name as puesto','empleado.salario',DB::raw('sum(asignaciones_empleado.monto) as Asigna'))->GroupBy('empleado.id_empleado','empleado.cedula','empleado.cargo','empleado.nombre','empleado.apellido','puesto','empleado.salario');
       
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
            ->editColumn('amount',function($row){
                $cont=0;
                $cont2=0;
                $sum=0;
                $tipo=request()->get('dato1');
                $tss=Asignaciones::all();
                $perf=Perfiles::all();
                $estado=estado_asignaciones::all();
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
                                    }else{
                                     $cont=$tsse->Monto;
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
                                                            }else{
                                                             $cont2=$tsse->Monto;
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
                    return '$'.number_format($otrostotal+$cont-$cont2,2);
                // return 0;
            })
            ->editColumn('Asigna',function($row){
                $cont=0;
                $cont2=0;
                $cont3=0;
                $otrosCont=0;
                $tipo=request()->get('dato1');
                $otro=Otros::all();
                $tss=Asignaciones::all();
                $asigna=Asignaciones_empleado::all();
                $perf=Perfiles::all();
                $estado=estado_asignaciones::all();
                $estadoasigna=estados_isr::all();
                $isr=isr_empleado::all();

                // $otros=DB::table('otros')
                // ->select(DB::raw('sum(monto)'))
                // ->where('id_empleado',$row->id_empleado)
                // ->where('tipo_asigna','DEDUCIÓN')
                // ->value('monto');
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
                                    }else{
                                     $cont=$tsse->Monto;
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
                                        }else{
                                         $cont2=$cont2+$tsse->Monto;
                                        }
                                    }
                    
                                }
                                }
                               }
                            }
                            
                        }
                    return '$'.number_format($otrosCont+$cont2-$cont,2);
            })
            ->editColumn('total',function($row){
                $tducion=0;
                $tincremnt=0;
                $cont=0;
                $cont2=0;
                $cont3=0;
                $Cont4bono=0;
                $contbono=0;
                $otroI=0;
                $tipo=request()->get('dato1');
                $tss=Asignaciones::all();
                $asigna=Asignaciones_empleado::all();
                $perf=Perfiles::all();
                $otro=Otros::all();
                $estadoasigna=estado_asignaciones::all();
                $isr=isr_empleado::all();
                $estadosisr=estados_isr::all();
                $otroD=0;

                // $otroI=DB::table('otros')
                // ->select(DB::raw('sum(monto)'))
                // ->where('id_empleado',$row->id_empleado)
                // ->where('tipo_asigna','INCREMENTO')
                // ->value('monto');
                // $otroD=DB::table('otros')
                // ->select(DB::raw('sum(monto)'))
                // ->where('id_empleado',$row->id_empleado)
                // ->where('tipo_asigna','DEDUCIÓN')
                // ->value('monto');

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
                                        }else{
                                         $cont=$tsse->Monto;
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
                                            }else{
                                             $cont2=$cont2+$tsse->Monto;
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
                    }else{
                     $contbono=$tsse->Monto;
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
                                            }else{
                                             $Cont4bono=$tsse->Monto;
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
                            

                $tducion= $otroD+$cont2-$cont;
                $tincremnt=$otroI+$contbono-$Cont4bono;
                return '$'.number_format($row->salario+$tincremnt-$tducion,2);
            })->editColumn('salario',function($row){
                return '$'.number_format($row->salario,2);
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id_empleado;    
                },
                'name'=>function($row){
                    return $row->nombre." ".$row->apellido;    
                },
                'dedu'=>function($row){
                    $cont=0;
                $cont2=0;
                $cont3=0;
                $otrosCont=0;
                $tipo=request()->get('dato1');
                $otro=Otros::all();
                $tss=Asignaciones::all();
                $asigna=Asignaciones_empleado::all();
                $perf=Perfiles::all();
                $estado=estado_asignaciones::all();
                $estadoasigna=estados_isr::all();
                $isr=isr_empleado::all();

                // $otros=DB::table('otros')
                // ->select(DB::raw('sum(monto)'))
                // ->where('id_empleado',$row->id_empleado)
                // ->where('tipo_asigna','DEDUCIÓN')
                // ->value('monto');
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
                                    }else{
                                     $cont=$tsse->Monto;
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
                                        }else{
                                         $cont2=$cont2+$tsse->Monto;
                                        }
                                    }
                    
                                }
                                }
                               }
                            }
                            
                        }
                    return '$'.number_format($otrosCont+$cont2-$cont,2);
                },
                'bono'=>function($row){
                    $cont=0;
                    $cont2=0;
                    $sum=0;
                    $tipo=request()->get('dato1');
                    $tss=Asignaciones::all();
                    $perf=Perfiles::all();
                    $estado=estado_asignaciones::all();
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
                                        }else{
                                         $cont=$tsse->Monto;
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
                                                                }else{
                                                                 $cont2=$tsse->Monto;
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
                        return '$'.number_format($otrostotal+$cont-$cont2,2);
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
                        return '$'.number_format($otrosI-$otrosD,2);
                },
                
                ])->toJson();
        
        }

    }//fin de la funcion datatable
}
