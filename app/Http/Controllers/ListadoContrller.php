<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Listado;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfiles;
use App\Models\Perfiles_empleado;
use Illuminate\Support\Carbon;
use App\Models\Empresa;
use App\Models\estado_asignaciones;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Models\nomina_asignaciones;
use App\Models\nomina_otros;
use App\Models\nomina_empleados;
use App\Models\nomina_horas;
use App\Models\otros;
use DateTime;
use App\Models\Permisos;
use App\Models\Role_users;

class ListadoContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado=Listado::all();
        $role=Role_users::where('user_id','=',Auth::user()->id)->first();
        $permisos=Permisos::where('role_id','=',$role->role_id)->first();
        return view('Listado.index',compact('listado','permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Listado.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $nominas=Listado::findOrFail($id);
        $empleados=Empleado::all();

        return view('Listado.show',compact('nominas','empleados'));
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

    function DetalleListado($ide)
    {
        $p=0;
        $nomina=request('nomina');
        $NominaAsigna=nomina_asignaciones::where('id_empleado','=',$ide)->where('id_nomina','=',$nomina)->get();
        $empleado=nomina_empleados::where('id_empleado','=',$ide)->where('id_nomina','=',$nomina)->first();
        
        return view('Listado.Plantillas.detalles',compact('NominaAsigna','empleado'));
    }

    function incrementoListado($ide)
    {
        $p=0;
        $NominaAsigna=nomina_asignaciones::where('id_empleado','=',$ide)->get();
        $empleado=nomina_empleados::where('id_empleado','=',$ide)->first();
        
        return view('Listado.Plantillas.incremento',compact('NominaAsigna','empleado'));
    }

    function otrosListado($ide)
    {
        $p=0;
        $NominaOtros=nomina_otros::where('id_empleado','=',$ide)->get();
        $empleado=nomina_empleados::where('id_empleado','=',$ide)->first();
        
        return view('Listado.Plantillas.otro',compact('NominaOtros','empleado'));
    }

    public function switchetssListado($id,Request $request)
    {

        $tss=nomina_asignaciones::findOrFail($id);

                    if($tss->estado_asigna==1){
                        $tss->estado_asigna=2;

                    }else if($tss->estado_asigna==2){
                        $tss->estado_asigna=1;
                    }else{
                        $tss->estado_asigna=1; 
                    }
                    $tss->update();
                    return"se cambio";
    }
    public function switchetssbonoListado($id,Request $request)
    {

        $tss=nomina_asignaciones::findOrFail($id);

                    if($tss->estado_asigna==1){
                        $tss->estado_asigna=2;

                    }else if($tss->estado_asigna==2){
                        $tss->estado_asigna=1;
                    }else{
                        $tss->estado_asigna=1; 
                    }
                    $tss->update();
                    return"se cambio";
    }

    public function otroseditListado($id,Request $request)
    {
        $emple=request('p');
        $nomina=request('idperfil');


        $empleados=nomina_empleados::where('id_empleado','=',$emple)->where('id_nomina','=',$nomina)->first();
        $otros=nomina_otros::findOrFail($id);

        return view('Listado.otrosedit',compact('empleados','otros'));

    }

    public function horasempleListado($id)
    {
        $id_nomina=request('id');
        $empleado=Empleado::findOrFail($id);
        $hora=nomina_horas::where('id_empleado','=',$id)->where('id_nomina','=',$id_nomina)->get();
        
        return view('Listado.Plantillas.horasemple',compact('empleado','hora'));
    }
    public function Otrosstorea(Request $request)
    {
        $cont=0;
        $id=request('idempl');
        $name=request('name');
        $tipo=request('tipo');
        $forma=request('forma');
        $monto=request('monto');
        $idperfil=request('idperfil');

        $empleados=nomina_empleados::where('id_empleado','=',$id)->where('id_nomina','=',$idperfil)->first();

        $otros=new nomina_otros();
        $otros->descripcion=$name;

        if($tipo==1){
            $otros->tipo_asigna="DEDUCIÓN";
            }else{
            $otros->tipo_asigna="INCREMENTO";  
            }

            if($forma==3){
                $otros->tipo="MONTO";
            }else{
                $otros->tipo="PORCENTAJE"; 
            }

            $otros->monto=$monto;
            $otros->id_empleado=$id;
            $otros->id_nomina=$empleados->id_nomina;
            $otros->id_empresa=Auth::user()->id_empresa;
            $otros->estado=0;

        if($forma==4){
            $cont=$monto*$empleados->salarioBruto;
            $cont=$cont/100;
            $otros->p_monto=$cont;
        }


        $otros->save();

        return view('Listado.Plantillas.otrosnew',compact('otros','id'));

    }

    public function otrosupdateListado($id,Request $request)
    {
        $otros=nomina_otros::findOrFail($id);

        $cont=0;
        $idempl=request('idempl');
        $name=request('name');
        $tipo=request('tipo');
        $forma=request('forma');
        $monto=request('monto');
        $nomina=request('perfil');

        $empleados=nomina_empleados::where('id_empleado','=',$idempl)->where('id_nomina','=',$nomina)->first();

        $otros->descripcion=$name;

        if($tipo==1){
            $otros->tipo_asigna="DEDUCIÓN";
            }else{
            $otros->tipo_asigna="INCREMENTO";  
            }

            if($forma==3){
                $otros->tipo="MONTO";
            }else{
                $otros->tipo="PORCENTAJE"; 
            }
        $otros->monto=$monto;



        if($forma==4){
            $cont=$monto*$empleados->salarioBruto;
            $cont=$cont/100;
            $otros->p_monto=$cont;
        }else{
            $otros->p_monto=0;
        }

        $otros->save();

        return view('Listado.Plantillas.otrosnew',compact('otros','id'));


    }

    public function deleteotrosListado($id)
    {
        $otro=nomina_otros::findOrFail($id);
        $otro->delete();
        
        $emple=request('p');
        $nomina=request('perfil');
        $empleado=nomina_empleados::where('id_empleado','=',$emple)->where('id_nomina','=',$nomina)->first();

        $NominaOtros=nomina_otros::all();
        
        return view('Listado.Plantillas.otro',compact('empleado','NominaOtros'));
    }

    public function addempleadoListado($id, Request $request)
    {
        $nomina=new nomina_empleados();
        $nominaEmpleado=nomina_empleados::all();
        $tipo=$request->get('id');
        $Cambio=intval($tipo);

        $empleado=Empleado::findOrFail($id);

        $emp=nomina_empleados::where('id_nomina','=',$Cambio)->latest('id_empleado')->first();
        // return $emp->id_empleado;



        
        
        if(sizeof(nomina_empleados::select('id_empleado')->where('id_empleado','=',$id)->get())!=0){
            return 2;
            
        }else{
            $nominAsignaci=nomina_asignaciones::where('id_empleado','=',$emp->id_empleado)
            ->where('id_nomina','=',$Cambio)
            ->get();

            $nomina->id_nomina=$Cambio;
            $nomina->id_empleado=$id;
            $nomina->salarioBruto=$empleado->salario;
            $nomina->horas=round($empleado->salario/23.83/8, 2);
            $nomina->id_empresa=Auth::user()->id_empresa;
            $nomina->estado=0;
            $nomina->save();

            foreach($nominAsignaci as $nominAsignacion){
                $input['id_empleado']=$id;
                $input['id_nomina']=$Cambio;
                $input['id_asignaciones']= $nominAsignacion->id_asignaciones;
                $input['nombre']=$nominAsignacion->nombre;
                $input['tipo_asigna']=$nominAsignacion->tipo_asigna;
                $input['tipo']=$nominAsignacion->tipo;
                $input['montos']=$nominAsignacion->montos;
                $input['id_empresa']=Auth::user()->id_empresa;
                $input['estado']=0;
                nomina_asignaciones::create($input);   
            }

            return 1;
            
        }
    }

    public function deleteempleListado($id)
    {
        $nomina=request('idperfi');

        $perfiles=Perfiles::all();

        $nominaEmpleado=nomina_empleados::where('id_empleado','=',$id)->where('id_nomina','=',$nomina)->first();
        $NominaOtros=nomina_otros::where('id_empleado','=',$id)->where('id_nomina','=',$nomina)->get();
        $NominaAsigna=nomina_asignaciones::where('id_empleado','=',$id)->where('id_nomina','=',$nomina)->get();

        $nominaEmpleado->delete();

        foreach($NominaOtros as $NominaOtro){
            if($NominaOtro->id_nomina==$nomina){
                $NominaOtro->delete();   
            }
        }
        foreach($NominaAsigna as $NominaAsignas){
            if($NominaAsignas->id_nomina==$nomina){
                $NominaAsignas->delete();   
            }
        }

        return 0;

        
    }

    public function totalnominasListado($id,Request $request)
    {
        // $id=request("e");

        $start =new DateTime(request('start'));
        $end =new DateTime(request('end'));
        $valor=request('valor');

        $nomina=Listado::findOrFail($id);
        $nominaEmpleado=nomina_empleados::where('id_nomina','=',$id)->where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $NominaOtros=nomina_otros::where('id_nomina','=',$id)->where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $NominaAsigna=nomina_asignaciones::where('id_nomina','=',$id)->where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $NominaHoras=nomina_horas::where('id_nomina','=',$id)->where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $sumHoraExtra=0;
        $sumHoraDescontada=0;

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

            foreach($nominaEmpleado as $nominaEmpleados){
                    if($nomina->id==$nominaEmpleados->id_nomina){
                if($nominaEmpleados->horas!=null){
                    $salarioDias=$nominaEmpleados->horas*$p;
                }else{
                    $sumer=$nominaEmpleados->salarioBruto/23.83/8;
                    $salarioDias=$sumer*$p;
                }
                $salario=$salario+$salarioDias;
                }
            }
        }else{
        foreach($nominaEmpleado as $nominaEmpleados){
                if($nomina->id==$nominaEmpleados->id_nomina){
                $salarioDias=$nominaEmpleados->salarioBruto;
  
            $salario=$salario+$salarioDias;
            }
        }
        }


                foreach($NominaAsigna as $NominaAsignas){
                     if($NominaAsignas->tipo_asigna=="INCREMENTO"){
                         if($NominaAsignas->tipo=="PORCENTAJE"){
    
                            $totalbono=$NominaAsignas->montos*$NominaAsignas->salarioBruto;
                            $totalbono=$totalbono/100;
                             $contbono=$contbono+$totalbono;
                            }else{
                        $totalbono=$NominaAsignas->montos;
                       $contbono=$contbono+$totalbono;
                         }
                        }
                              
                  }
                        
                        

              

                            foreach($NominaAsigna as $NominaAsignas){
                                
                                    if($NominaAsignas->tipo_asigna=="INCREMENTO"){
                                    if($NominaAsignas->estado_asigna==1){
                                        if($NominaAsignas->tipo=="PORCENTAJE"){
                                            $desbono=$NominaAsignas->montos*$NominaAsignas->salarioBruto;
                                            $desbono=$desbono/100;
                                            $desbonoCont=$desbonoCont+$desbono;

                                            }else{
                                             $desbono=$NominaAsignas->montos;
                                             $desbonoCont=$desbonoCont+$desbono;
                                            }
                                  }  
                                  
                                }
                                }
                            foreach($NominaHoras as $NominaHora){
                                    if($NominaHora->type=="EXTRAS"){
                                        $sumHoraExtra= $sumHoraExtra+$NominaHora->monto;
                                    }else{
                                        $sumHoraDescontada=$sumHoraDescontada+$NominaHora->monto;
                                    }
                                    
                                  }  
                   




            
                                foreach($NominaAsigna as $NominaAsignas){
                                        if($NominaAsignas->tipo_asigna=="DEDUCCIÓN"){
                                            if($NominaAsignas->estado_asigna==1){
                                                if($NominaAsignas->tipo=="PORCENTAJE"){
                                                    $cont=$NominaAsignas->montos*$NominaAsignas->salarioBruto;
                                                    $cont=$cont/100;
                                                    $desdeucionCont=$desdeucionCont+$cont;
                                                    }else{
                                                     $cont=$NominaAsignas->montos;
                                                     $desdeucionCont=$desdeucionCont+$cont;
                                                    }
                                                }
                                            
                                        }
                                    }


                                    foreach($NominaAsigna as $NominaAsignas){
                                            if($NominaAsignas->tipo_asigna=="DEDUCCIÓN"){
                                                if($NominaAsignas->tipo=="PORCENTAJE"){
                                                $totals=$NominaAsignas->montos*$NominaAsignas->salarioBruto;
                                                $totals=$totals/100;
                                                $contdeducion=$contdeducion+$totals;
                                                  
                                                }else{
                                                 $totals=$NominaAsignas->montos;
                                                 $contdeducion=$contdeducion+$totals;
                                                }
                                          }  
                                        
                                        }

                                       
                                        foreach($NominaOtros as $nominaOtro){
                                                    if($nominaOtro->tipo_asigna=="DEDUCIÓN"){
                                                    if($nominaOtro->p_monto!=null){
                                                        $otrosD=$otrosD+$nominaOtro->p_monto;
                                                    }else{
                                                        $otrosD=$otrosD+$nominaOtro->monto;
                    
                                                    }
                                                    }else{
                                                        if($nominaOtro->p_monto!=null){
                                                            $otrosI=$otrosI+$nominaOtro->p_monto;
                                                        }else{
                                                            $otrosI=$otrosI+$nominaOtro->monto;
                                                        }
                                                    }
                                                
            
                                        }
                                    
    


             $totaldeducion=0;
             $totalincremento=0;
             $totaldeducion=$otrosD+$contdeducion+$cont2+$cont3+$sumHoraDescontada-$desdeucionCont;
             $totalincremento=$otrosI+$contbono-$desbonoCont+$sumHoraExtra;

            // return $otrosD;

             return  $salario+$totalincremento-$totaldeducion;
            //  return $sumHoraExtra;
    }

    public function modalhoursListado($id)
    {
        // $equipo=Equipos::
        // leftjoin('equipos_empleados','equipos_empleados.equipos','=','equipos.id')
        // ->leftjoin('empleado','empleado.id_empleado','=','equipos_empleados.id_empleado')
        // ->where('equipos.id_empresa',Auth::user()->id_empresa)
        // ->where('equipos.estado','!=','1')
        // ->where('equipos_empleados.id_empleado','=',$id)
        // ->select('equipos.id','equipos.descripcion','equipos.user','equipos.created_at','equipos.entrada','equipos.salida')
        // ->GroupBy('equipos.id','equipos.descripcion','equipos.user','equipos.created_at','equipos.entrada','equipos.salida')
        // ->get();
        // dd($equipo);

        return view("Listado.modalhoras",compact('id'));


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
        // dd($request->all());
        $nominas=Listado::findOrFail($id);
        $empleados=nomina_empleados::where('id_nomina','=',$id)->where('estado','=',0)->orderBy('id_empleado')->get();

        // dd($empleados);
        $arrayID = explode(",", $request->get('arregloID'));
        $arregloSalario = explode(",", $request->get('arregloSalario'));

        $nominas->descripcion=$request->get('descripcion');
        $nominas->fecha=$request->get('fecha');
        $nominas->user=Auth::user()->name;
        $nominas->monto=$request->get('montototal');
        $nominas->id_perfiles=$request->get('perfil');
        $nominas->start=$request->get('st');
        $nominas->end=$request->get('en');
        $nominas->id_empresa=Auth::user()->id_empresa;
        $nominas->id_horas=$request->get('inputCheckBox');

        $i=0;
        foreach($empleados as $empleado){
        $nomi=nomina_empleados::findOrFail($empleado->id);
        $nomi->salarioneto=$arregloSalario[$i];
        $nomi->update();
        $i++;
        }

        $nominas->save();
        return redirect('Listado')->with('actualizar','ya');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nominas=Listado::findOrFail($id);
        $nominas->estado=1;

        $nominas->save();

        return redirect('Listado')->with('Eliminado','ya');
    }
    public function datatableListado()
    {
        $id=request('id');
        
        if(request()->ajax()){
         $tipo=request()->get('dato1');

        $listado=Listado::leftjoin('nomina_empleador','nomina_empleador.id_nomina','=','nomina.id')
        ->leftjoin('nomina_asignaciones','nomina_asignaciones.id_nomina','=','nomina.id')
        ->leftjoin('nomina_otros','nomina_otros.id_nomina','=','nomina.id')
        ->leftjoin('empleado','empleado.id_empleado','=','nomina_empleador.id_empleado')
        ->where('nomina.estado','=',0)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','nomina_empleador.horas','empleado.cedula','nomina_empleador.salarioBruto')->GroupBy('empleado.id_empleado','nomina_empleador.horas','empleado.cedula','nomina_empleador.salarioBruto','empleado.cargo','empleado.nombre','empleado.apellido');
       
        if(!empty($tipo)){
            $listado->where('nomina_empleador.id_nomina',$tipo);

        }else{
            // $empleados->where('perfiles.id_perfiles',27);

            $listado=  $listado->whereNull('empleado.id_empleado');

        }
            return datatables()->of($listado)
            ->editColumn('nombre',function($row){
                return $row->nombre." ".$row->apellido;

            })
            ->editColumn('salarioBruto',function($row){
            return '$'.number_format($row->salarioBruto,2);
            
            })
            ->editColumn('amount',function($row){
                $tipo=request()->get('dato1');
                $nominaAsignaciones=nomina_asignaciones::all();
                $nominaOtros=nomina_otros::all();
                $horas=nomina_horas::where('type','=','EXTRAS')->where('id_nomina','=', $tipo)->get();
                $sumHoras=0;
                $otro=otros::all();
                $otrosCont=0;
                $cont=0;
                $cont2=0;
                $sum=0;
                $sum2=0;
                $p=0;

                foreach($nominaOtros as $nominaOtro){
                    if($tipo==$nominaOtro->id_nomina){
                        if($nominaOtro->tipo_asigna=="INCREMENTO"){
                            if($nominaOtro->id_empleado==$row->id_empleado){
                            if($nominaOtro->p_monto!=null){
                                $otrosCont=$otrosCont+$nominaOtro->p_monto;
                            }else{
                                $otrosCont=$otrosCont+$nominaOtro->monto;

                            }
                            }
                        }
                    }
                }

                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                    if($nominaAsignacione->estado_asigna==1){
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $cont=$nominaAsignacione->montos*$row->salarioBruto;
                                            $cont=$cont/100;
                                            $sum2=$sum2+$cont;
                                            }else{
                                             $cont=$nominaAsignacione->montos;
                                             $sum2=$sum2+$cont;
                                            }
                                        }
                                }
                            }
     
                            }
                        }
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                    if($nominaAsignacione->tipo=="PORCENTAJE"){
                                      
                                        $cont2=$nominaAsignacione->montos*$row->salarioBruto;
                                        $cont2=$cont2/100;
                                        $sum=$sum+$cont2;
                                        }else{
                                         $cont2=$nominaAsignacione->montos;
                                         $sum=$sum+$cont2;
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
                        
                            return '$'.number_format($otrosCont-$sum2+$sum+$sumHoras,2);
            
            })
            ->editColumn('time',function($row){
                $start=request()->start_date;
                $end=request()->end_date;
                $valor=request()->get('valor');

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
            // return $row->time;

            })
            ->editColumn('total',function($row){
                $tipo=request()->get('dato1');
                $valor=request()->get('valor');
                
                $nominaAsignaciones=nomina_asignaciones::all();
                $nominaOtros=nomina_otros::all();
                $horasDescontada=nomina_horas::where('type','=','DESCONTADA')->where('id_nomina','=', $tipo)->get();
                $horasExtras=nomina_horas::where('type','=','EXTRAS')->where('id_nomina','=', $tipo)->get();
                $sumHorasExtras=0;
                $sumHorasDescontada=0;
                //Asignaciones
                $otrosContAsigna=0;
                $contAsigna=0;
                $contAsignaEstado=0;
                $sum=0;
                $sum2=0;
                //Bonos
                $otrosContBono=0;
                $contBono=0;
                $contBonoEstado=0;
                $sumbono=0;
                $sum2bono=0;

                $totalBono=0;
                $totalAsigna=0;
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
                    $sumer=$row->salarioBruto/23.83/8;
                    $salarioDias=$sumer*$p;
                }
            }else{
                $salarioDias=$row->salarioBruto;
            }
             
                foreach($nominaOtros as $nominaOtro){
                    if($tipo==$nominaOtro->id_nomina){
                        if($nominaOtro->tipo_asigna=="DEDUCIÓN"){
                        if($nominaOtro->id_empleado==$row->id_empleado){
                            if($nominaOtro->p_monto!=null){
                                $otrosContAsigna=$otrosContAsigna+$nominaOtro->p_monto;
                            }else{
                                $otrosContAsigna=$otrosContAsigna+$nominaOtro->monto;
                            }
                            }
                        }
                    }
                }

                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                    if($nominaAsignacione->estado_asigna==1){
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $contAsignaEstado=$nominaAsignacione->montos*$row->salarioBruto;
                                            $contAsignaEstado=$contAsignaEstado/100;
                                            $sum2=$sum2+$contAsignaEstado;
                                            }else{
                                             $contAsignaEstado=$nominaAsignacione->montos;
                                             $sum2=$sum2+$contAsignaEstado;
                                            }
                                        }
                                }
                            }
     
                            }
                        }
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                    if($nominaAsignacione->tipo=="PORCENTAJE"){
                                        $contAsigna=$nominaAsignacione->montos*$row->salarioBruto;
                                        $contAsigna=$contAsigna/100;
                                        $sum=$sum+$contAsigna;
                                        }else{
                                         $contAsigna=$nominaAsignacione->montos;
                                         $sum=$sum+$contAsigna;
                                        }
                                    }
                                        
                                }
                            }
     
                            }
            //---------------------------------------------------------------------------------------------------------------
            foreach($nominaOtros as $nominaOtro){
                if($tipo==$nominaOtro->id_nomina){
                    if($nominaOtro->tipo_asigna=="INCREMENTO"){
                        if($nominaOtro->id_empleado==$row->id_empleado){
                        if($nominaOtro->p_monto!=null){
                            $otrosContBono=$otrosContBono+$nominaOtro->p_monto;
                        }else{
                            $otrosContBono=$otrosContBono+$nominaOtro->monto;

                        }
                        }
                    }
                }
            }

            foreach($nominaAsignaciones as $nominaAsignacione){
                if( $tipo==$nominaAsignacione->id_nomina){
                    if($row->id_empleado==$nominaAsignacione->id_empleado){
                        if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                            if($nominaAsignacione->estado_asigna==1){
                               
                                if($nominaAsignacione->tipo=="PORCENTAJE"){
                                    $contBonoEstado=$nominaAsignacione->montos*$row->salarioBruto;
                                    $contBonoEstado=$contBonoEstado/100;
                                    $sum2bono=$sum2bono+$contBonoEstado;
                                    }else{
                                     $contBonoEstado=$nominaAsignacione->montos;
                                     $sum2bono=$sum2bono+$contBonoEstado;
                                    }
                                }
                        }
                    }

                    }
                }
            foreach($nominaAsignaciones as $nominaAsignacione){
                if($tipo==$nominaAsignacione->id_nomina){
                    if($row->id_empleado==$nominaAsignacione->id_empleado){
                        if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                            if($nominaAsignacione->tipo=="PORCENTAJE"){
                                $p=1;
                                $contBono=$nominaAsignacione->montos*$row->salarioBruto;
                                $contBono=$contBono/100;
                                $sumbono=$sumbono+$contBono;
                                }else{
                                 $contBono=$nominaAsignacione->montos;
                                 $sumbono=$sumbono+$contBono;
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
            
            
            $totalAsigna=$otrosContAsigna-$sum2+$sum+$sumHorasDescontada;
            $totalBono=$otrosContBono-$sum2bono+$sumbono+$sumHorasExtras;

            return '$'.number_format($salarioDias+$totalBono-$totalAsigna,2);

            })
            ->editColumn('Asigna',function($row){
                $tipo=request()->get('dato1');
                $nominaAsignaciones=nomina_asignaciones::all();
                $nominaOtros=nomina_otros::all();
                $otro=otros::all();
                $horas=nomina_horas::where('type','=','DESCONTADA')->where('id_nomina','=', $tipo)->get();
                $sumHoras=0;
                $otrosCont=0;
                $cont=0;
                $cont2=0;
                $sum=0;
                $sum2=0;
                $p=0;

                foreach($nominaOtros as $nominaOtro){
                    if($tipo==$nominaOtro->id_nomina){
                        if($nominaOtro->tipo_asigna=="DEDUCIÓN"){
                            if($nominaOtro->id_empleado==$row->id_empleado){
                            if($nominaOtro->p_monto!=null){
                                $otrosCont=$otrosCont+$nominaOtro->p_monto;
                            }else{
                                $otrosCont=$otrosCont+$nominaOtro->monto;

                            }
                            }
                        }
                    }
                }

                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                    if($nominaAsignacione->estado_asigna==1){
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $cont=$nominaAsignacione->montos*$row->salarioBruto;
                                            $cont=$cont/100;
                                            $sum2=$sum2+$cont;
                                            }else{
                                             $cont=$cont+$nominaAsignacione->montos;
                                             $sum2=$sum2+$cont;
                                            }
                                        }
                                }
                            }
     
                            }
                        }
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                    if($nominaAsignacione->tipo=="PORCENTAJE"){
                                      
                                        $cont2=$nominaAsignacione->montos*$row->salarioBruto;
                                        $cont2=$cont2/100;
                                        $sum=$sum+$cont2;
                                        }else{
                                         $cont2=$nominaAsignacione->montos;
                                         $sum=$sum+$cont2;
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
                        
                            return '$'.number_format($otrosCont-$sum2+$sum+$sumHoras,2);

            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id_empleado;    
                },
                'name'=>function($row){
                    return $row->nombre." ".$row->apellido;    
                },
                'times'=>function($row){
                    $tipo=request()->get('dato1');
                    $horasDescontada=nomina_horas::where('type','=','DESCONTADA')->where('id_nomina','=', $tipo)->get();
                    $horasExtras=nomina_horas::where('type','=','EXTRAS')->where('id_nomina','=', $tipo)->get();
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
                'dedu'=>function($row){
                    $tipo=request()->get('dato1');
                    $nominaAsignaciones=nomina_asignaciones::all();
                    $nominaOtros=nomina_otros::all();
                    $otro=otros::all();
                    $otrosCont=0;
                    $cont=0;
                    $cont2=0;
                    $sum=0;
                    $sum2=0;
                    $p=0;
    

    
                        foreach($nominaAsignaciones as $nominaAsignacione){
                            if($tipo==$nominaAsignacione->id_nomina){
                                if($row->id_empleado==$nominaAsignacione->id_empleado){
                                    if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                        if($nominaAsignacione->estado_asigna==1){
                                           
                                            if($nominaAsignacione->tipo=="PORCENTAJE"){
                                                $cont=$nominaAsignacione->montos*$row->salarioBruto;
                                                $cont=$cont/100;
                                                $sum2=$sum2+$cont;
                                                }else{
                                                 $cont=$nominaAsignacione->montos;
                                                 $sum2=$sum2+$cont;
                                                }
                                            }
                                    }
                                }
         
                                }
                            }
                        foreach($nominaAsignaciones as $nominaAsignacione){
                            if($tipo==$nominaAsignacione->id_nomina){
                                if($row->id_empleado==$nominaAsignacione->id_empleado){
                                    if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $p=1;
                                            $cont2=$nominaAsignacione->montos*$row->salarioBruto;
                                            $cont2=$cont2/100;
                                            $sum=$sum+$cont2;
                                            }else{
                                             $cont2=$nominaAsignacione->montos;
                                             $sum=$sum+$cont2;
                                            }
                                        }
                                            
                                    }
                                }
         
                                }
                            
                                return $sum-$sum2;
                    },
                    'bono'=>function($row){
                        $tipo=request()->get('dato1');
                        $nominaAsignaciones=nomina_asignaciones::all();
                        $nominaOtros=nomina_otros::all();
                        $otro=otros::all();
                        $otrosCont=0;
                        $cont=0;
                        $cont2=0;
                        $sum=0;
                        $sum2=0;
                        $p=0;
        
    
        
                            foreach($nominaAsignaciones as $nominaAsignacione){
                                if($tipo==$nominaAsignacione->id_nomina){
                                    if($row->id_empleado==$nominaAsignacione->id_empleado){
                                        if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                            if($nominaAsignacione->estado_asigna==1){
                                               
                                                if($nominaAsignacione->tipo=="PORCENTAJE"){
                                                    $cont=$nominaAsignacione->montos*$row->salarioBruto;
                                                    $cont=$cont/100;
                                                    $sum2=$sum2+$cont;
                                                    }else{
                                                     $cont=$nominaAsignacione->montos;
                                                     $sum2=$sum2+$cont;
                                                    }
                                                }
                                        }
                                    }
             
                                    }
                                }
                            foreach($nominaAsignaciones as $nominaAsignacione){
                                if($tipo==$nominaAsignacione->id_nomina){
                                    if($row->id_empleado==$nominaAsignacione->id_empleado){
                                        if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                            if($nominaAsignacione->tipo=="PORCENTAJE"){
                                                $p=1;
                                                $cont2=$nominaAsignacione->montos*$row->salarioBruto;
                                                $cont2=$cont2/100;
                                                $sum=$sum+$cont2;
                                                }else{
                                                 $cont2=$nominaAsignacione->montos;
                                                 $sum=$sum+$cont2;
                                                }
                                            }
                                                
                                        }
                                    }
             
                                    }
                                
                                    return $sum-$sum2;
                    },
    
                    'otros'=>function($row){
                        $otrosD=0;
                        $otrosI=0;
                        $tipo=request()->get('dato1');
                        $otro=nomina_otros::all();
    
                                    foreach($otro as $otros){
                                        if($otros->id_nomina==$tipo){
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
                                      
             
                            return $otrosI+$otrosD;
                    },
                    'total'=>function($row){
                        $tipo=request()->get('dato1');
                        $nominaAsignaciones=nomina_asignaciones::all();
                        $nominaOtros=nomina_otros::all();
                        //Asignaciones
                        $otrosContAsigna=0;
                        $contAsigna=0;
                        $contAsignaEstado=0;
                        $sum=0;
                        $sum2=0;
                        //Bonos
                        $otrosContBono=0;
                        $contBono=0;
                        $contBonoEstado=0;
                        $sumbono=0;
                        $sum2bono=0;
        
                        $totalBono=0;
                        $totalAsigna=0;
                        $salarioDias=0;
        
                        $start=request()->start_date;
                        $end=request()->end_date;
        
                        $begin = new DateTime($start);
                        $end   = new DateTime($end);
                        $p=0;
                        
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
                            $sumer=$row->salarioBruto/23.83/8;
                            $salarioDias=$sumer*$p;
                        }
        
                     
                        foreach($nominaOtros as $nominaOtro){
                            if($tipo==$nominaOtro->id_nomina){
                                if($nominaOtro->tipo_asigna=="DEDUCCIÓN"){
                                if($nominaOtro->id_empleado==$row->id_empleado){
                                    if($nominaOtro->p_monto!=null){
                                        $otrosContAsigna=$otrosContAsigna+$nominaOtro->p_monto;
                                    }else{
                                        $otrosContAsigna=$otrosContAsigna+$nominaOtro->monto;
                                    }
                                    }
                                }
                            }
                        }
        
                            foreach($nominaAsignaciones as $nominaAsignacione){
                                if($tipo==$nominaAsignacione->id_nomina){
                                    if($row->id_empleado==$nominaAsignacione->id_empleado){
                                        if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                            if($nominaAsignacione->estado_asigna==1){
                                                if($nominaAsignacione->tipo=="PORCENTAJE"){
                                                    $contAsignaEstado=$nominaAsignacione->montos*$row->salarioBruto;
                                                    $contAsignaEstado=$contAsignaEstado/100;
                                                    $sum2=$sum2+$contAsignaEstado;
                                                    }else{
                                                     $contAsignaEstado=$nominaAsignacione->montos;
                                                     $sum2=$sum2+$contAsignaEstado;
                                                    }
                                                }
                                        }
                                    }
             
                                    }
                                }
                            foreach($nominaAsignaciones as $nominaAsignacione){
                                if($tipo==$nominaAsignacione->id_nomina){
                                    if($row->id_empleado==$nominaAsignacione->id_empleado){
                                        if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                            if($nominaAsignacione->tipo=="PORCENTAJE"){
                                                $contAsigna=$nominaAsignacione->montos*$row->salarioBruto;
                                                $contAsigna=$contAsigna/100;
                                                $sum=$sum+$contAsigna;
                                                }else{
                                                 $contAsigna=$nominaAsignacione->montos;
                                                 $sum=$sum+$contAsigna;
                                                }
                                            }
                                                
                                        }
                                    }
             
                                    }
                    //---------------------------------------------------------------------------------------------------------------
                    foreach($nominaOtros as $nominaOtro){
                        if($tipo==$nominaOtro->id_nomina){
                            if($nominaOtro->tipo_asigna=="INCREMENTO"){
                                if($nominaOtro->id_empleado==$row->id_empleado){
                                if($nominaOtro->p_monto!=null){
                                    $otrosContBono=$otrosContBono+$nominaOtro->p_monto;
                                }else{
                                    $otrosContBono=$otrosContBono+$nominaOtro->monto;
        
                                }
                                }
                            }
                        }
                    }
        
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if( $tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                    if($nominaAsignacione->estado_asigna==1){
                                       
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $contBonoEstado=$nominaAsignacione->montos*$row->salarioBruto;
                                            $contBonoEstado=$contBonoEstado/100;
                                            $sum2bono=$sum2bono+$contBonoEstado;
                                            }else{
                                             $contBonoEstado=$nominaAsignacione->montos;
                                             $sum2bono=$sum2bono+$contBonoEstado;
                                            }
                                        }
                                }
                            }
        
                            }
                        }
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($tipo==$nominaAsignacione->id_nomina){
                            if($row->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                    if($nominaAsignacione->tipo=="PORCENTAJE"){
                                        $p=1;
                                        $contBono=$nominaAsignacione->montos*$row->salarioBruto;
                                        $contBono=$contBono/100;
                                        $sumbono=$sumbono+$contBono;
                                        }else{
                                         $contBono=$nominaAsignacione->montos;
                                         $sumbono=$sumbono+$contBono;
                                        }
                                    }
                                        
                                }
                            }
        
                            }
                    
                    
                    $totalAsigna=$otrosContAsigna-$sum2+$sum;
                    $totalBono=$otrosContBono-$sum2bono+$sumbono;
        
                    return round($salarioDias+$totalBono-$totalAsigna,2);
                    },
                    
                    ])->toJson();
            
        };
    }

    public function listadopdf($id)
    {
  
        $nominas=Listado::findOrFail($id);
        $nomina_empleador=nomina_empleados::where('id_nomina','=',$id)->where('estado','=',0)->get();
        $nominaAsignaciones=nomina_asignaciones::where('id_nomina','=',$id)->where('estado','=',0)->get();
        $nominaOtros=nomina_otros::where('id_nomina','=',$id)->where('estado','=',0)->get();
        $db=[];
        
        $begin=new DateTime($nominas->start);
        $end=new DateTime($nominas->end);
        $p=0;

                        
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

            $i=0;
        foreach($nomina_empleador as $nomina_empleadores){
            $db[$i]=$nomina_empleadores->id_empleado;
            $i++;
        }

        $empleados=Empleado::whereIn('id_empleado',$db)->get();

        $fecha=Carbon::now();
        $idempresa=Auth::user()->id_empresa;
        $empresa=Empresa::findOrFail($idempresa);

      $pdf =PDF::loadView('Listado.recibo',compact('fecha','p','empresa','nominaAsignaciones','nominaOtros','nominas','nomina_empleador','empleados'));
      $pdf->setPaper("letter", "portrait");
      return $pdf->stream('Nomina.pdf');
    }

    public function EmpleRecibopdf($id)
    {
  
        $nominas=Listado::findOrFail($id);
        $nomina_empleador=nomina_empleados::where('id_nomina','=',$id)->where('estado','=',0)->get();
        $nominaAsignaciones=nomina_asignaciones::where('id_nomina','=',$id)->where('estado','=',0)->get();
        $nominaOtros=nomina_otros::where('id_nomina','=',$id)->where('estado','=',0)->get();
        $db=[];
        
        $begin=new DateTime($nominas->start);
        $end=new DateTime($nominas->end);
        $p=0;

                        
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

            $i=0;
        foreach($nomina_empleador as $nomina_empleadores){
            $db[$i]=$nomina_empleadores->id_empleado;
            $i++;
        }

        $empleados=Listado::leftjoin('nomina_empleador','nomina_empleador.id_nomina','=','nomina.id')
        ->leftjoin('empleado','empleado.id_empleado','=','nomina_empleador.id_empleado')
        ->where('nomina_empleador.id_nomina',$id)
        ->get();


        $fecha=Carbon::now();
        $idempresa=Auth::user()->id_empresa;
        $empresa=Empresa::findOrFail($idempresa);

      $pdf =PDF::loadView('Listado.ReciboEmpleado',compact('fecha','p','empresa','nominaAsignaciones','nominaOtros','nominas','nomina_empleador','empleados'));
      $pdf->setPaper("letter", "portrait");
      return $pdf->stream('Nomina.pdf');
    }
}
