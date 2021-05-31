<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use App\Models\empleados_equipo;
use App\Models\Equipos;
use App\Models\Puesto;
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
        $entrada=$request->get('birthday');

        $size = count(collect($request)->get('Din'));
        
        for ($i=0; $i<=$size ; $i++) { 
            if(!empty(collect($request)->get('Din')[$i])){
           $input['id_empleado']=$request->get('Din')[$i];
           $input['notas']= $notas;
           $input['entrada']=$request->get('birthday');
           $input['salidad']=$request->get('birthday2s');
           $input['user']=Auth::user()->name;
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estado']=0;
           $perfiles=Asistencia::create($input);

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
        $asiste=Asistencia::select('id')->where('id_empleado','=',$id)->first();
        $asistencias=Asistencia::findOrFail($asiste->id);
        $asistencias->entrada=request('entrada');
        $asistencias->salidad=request('salidad');
        $asistencias->notas=request('notas');
        $asistencias->update();
        return 0;
    }
    public function deletefecha($id)
    {
        $asiste=Asistencia::select('id')->where('id_empleado','=',$id)->first();
        $asistencias=Asistencia::findOrFail($asiste->id);
        $asistencias->estado=1;
        $asistencias->update();
        return 0;
    }

    public function datatableAsistencia()
    {
        $id=request('id');
        
        if(request()->ajax()){
         $tipo=request()->get('dato1');


     
        $empleados=Empleado::leftjoin('equipos_empleados','equipos_empleados.id_empleado','=','empleado.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','equipos_empleados.id_empleado')
        ->leftjoin('horas','horas.id_empleado','=','empleado.id_empleado')
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

