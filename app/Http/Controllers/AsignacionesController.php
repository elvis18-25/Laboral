<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\estado_asignaciones;
use App\Models\estados_isr;
use App\Models\Equipos;
use App\Models\Asignaciones_empleado;
use App\Models\Empleado;
use App\Models\Puesto;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipo=Equipos::all();
        $empleados=Empleado::all();
        return view('Asignaciones.index',compact('equipo','empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $asigna=new Asignaciones();
        $tipo=request('tipo');
        $forma=request('forma');
        $grupo=request('grupo');
        
        
        if($tipo==1){
            $asigna->tipo_asigna="DEDUCCIÓN";
        }else{
            $asigna->tipo_asigna="INCREMENTO";  
        }
        
        if($forma==3){
            $asigna->tipo="MONTO";
        }else{
            $asigna->tipo="PORCENTAJE"; 
        }

        $asigna->Nombre=request('name');
        $asigna->Monto=request('monto');
        $asigna->id_empresa=Auth::user()->id_empresa;
        $asigna->user=Auth::user()->name;
        $asigna->grupo=$grupo;
        $asigna->estado=0;
        $asigna->save();
        
        $arreglo=request('arreglo');
        $n=count($arreglo);
        
        for ($i=0; $i < $n; $i++) { 
            if(!empty($arreglo[$i])){
                $input['empleado_id_empleado']=$arreglo[$i];
                $input['asignaciones_id']=$asigna->id;
                $input['estado']=0;
                $input['id_empresa']=Auth::user()->id_empresa;
                $perfiles=Asignaciones_empleado::create($input);
            }
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    public function agregarEmpleado($id)
    {
        $empleado=Empleado::findOrFail($id);
        return view('Asignaciones.Plantilla',compact('empleado'));
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

    public function viewasigna($id)
    {
        $asigna=Asignaciones::findOrFail($id);
        $empleado_asigna=Asignaciones_empleado::where('asignaciones_id','=',$id)->get();
        $equipo=Equipos::all();
        $Arreglo=[];
        $p=0;

        foreach($empleado_asigna as $empleado_asignas){
            $Arreglo[$p]=$empleado_asignas->empleado_id_empleado;
            $p++;
        }
        $empleados=Empleado::whereIn('id_empleado',$Arreglo)->get();
        $puesto=Puesto::all();
        // $grupo=Equipos::where('grupo','=',$asigna->grupo)->first();
        return view('Asignaciones.edit',compact('asigna','equipo','empleados','puesto'));
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
    public function updateasignaciones(Request $request, $id)
    {
        $asigna=Asignaciones::findOrFail($id);
        $tipo=request('tipo');
        $forma=request('forma');


        $asigna->Nombre=request('name');

        if($tipo==1){
        $asigna->tipo_asigna="DEDUCCIÓN";
        }else{
        $asigna->tipo_asigna="INCREMENTO";  
        }

        
        if($forma==3){
            $asigna->tipo="MONTO";
        }else{
            $asigna->tipo="PORCENTAJE"; 
        }

        $asigna->Monto=request('monto');
        $asigna->id_empresa=Auth::user()->id_empresa;
        $asigna->user=Auth::user()->name;
        $asigna->estado=0;
        $asigna->save();

        $arreglo=request('arreglo');
        $asignaciones=Asignaciones_empleado::where('asignaciones_id','=',$id)->get();

        foreach($asignaciones as $asignacion){
            $asignacion->delete();
        }
        
        $n=count($arreglo);
        
        for ($i=0; $i < $n; $i++) { 
            if(!empty($arreglo[$i])){
                $input['empleado_id_empleado']=$arreglo[$i];
                $input['asignaciones_id']=$asigna->id;
                $input['estado']=0;
                $input['id_empresa']=Auth::user()->id_empresa;
                $perfiles=Asignaciones_empleado::create($input);
            }
        }

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
    public function allempleadoasignaciones(Request $request)
    {
        $emple=request('arreglo');
        $puesto=Puesto::all();

        if(!empty($emple)){
            $empleados=Empleado::whereNotIn('id_empleado',$emple)->where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        }else{
            $empleados=Empleado::where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        }

        return view('Asignaciones.PlantillasAll',compact('empleados','puesto'));

    }
    public function deleteasigna($id)
    {
        $asigna=Asignaciones::findOrFail($id);
        $asigna->estado=1;
        $asigna->save();

    }

    public function datatablesasigna()
    {
        if(request()->ajax()){
        $tipo=request()->get('dato1');
        $asigna=Asignaciones::
        leftjoin('asignaciones_empleado','asignaciones_empleado.asignaciones_id','=','asignaciones.id')
        ->where('asignaciones.id_empresa',Auth::user()->id_empresa)
        ->where('asignaciones.estado','=','0')
        ->select('asignaciones.id','asignaciones.Nombre','asignaciones.tipo_asigna','asignaciones.tipo','asignaciones.Monto','asignaciones.user',DB::raw('count(asignaciones_empleado.empleado_id_empleado) as emple',))
        ->GroupBy('asignaciones.id','asignaciones.Nombre','asignaciones.tipo_asigna','asignaciones.tipo','asignaciones.Monto','asignaciones.user');

        if(!empty($tipo)){
            $asigna->where('asignaciones.tipo_asigna',$tipo);
        }  
            return datatables()->of($asigna)
            ->editColumn('Monto',function($row){
                if($row->tipo=="PORCENTAJE"){
                    return $row->Monto.'%';
                }else{
                    return '$'.number_format($row->Monto,2);
                };
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;   
                },

            ])->toJson();
        }
    }
}
