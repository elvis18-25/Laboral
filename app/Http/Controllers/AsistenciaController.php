<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use App\models\Equipos;

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
        return view('Asistencias.index',compact('asistencia'));
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
        return view('Asistencias.create',compact('empleados','asistencia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

//     public function datatableAsistencia()
//     {
//         $id=request('id');
        
//         if(request()->ajax()){
//          $tipo=request()->get('dato1');


     
//         $empleados=Empleado::leftjoin('equipos_empleados','equipos_empleados.id_empleado','=','empleado.id_empleado')
//         ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','equipos_empleados.id_empleado')
//         ->leftjoin('horas','horas.id_empleado','=','empleado.id_empleado')
//         ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
//         ->where('equipos_empleados.estados','=',0)
//         ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','empleado.horas','empleado.cedula','puesto.name as puesto','empleado.salario',DB::raw('sum(asignaciones_empleado.monto) as Asigna'))->GroupBy('empleado.id_empleado','empleado.cedula','empleado.horas','empleado.cargo','empleado.nombre','empleado.apellido','puesto','empleado.salario');
       
//         if(!empty($tipo)){
//             $empleados->where('equipos_empleados.id_equipos_empleados',$tipo);

//         }else{
//             // $empleados->where('perfiles.id_perfiles',27);

//             $empleados=  $empleados->whereNull('empleado.id_empleado');

//         }
//             return datatables()->of($empleados)
//             ->editColumn('nombre',function($row){
//                 return $row->nombre." ".$row->apellido;

//             })->toJson();
//     }
// }
}

