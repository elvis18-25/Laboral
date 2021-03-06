<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Equipos;
use App\Models\empleados_equipo;
use App\Models\Puesto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\BinaryOp\Equal;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Equipos.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=Empleado::all();
        return view("Equipos.create",compact('empleados'));
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
        $array = explode(",", $request->get('arreglo'));
        $n=count($array);
        // dd($n);
        $perfil= new Equipos();
    
        $perfil->descripcion=$request->get('name');
        $perfil->entrada=$request->get('entrada');
        $perfil->salida=$request->get('salida');
        
        if($request->get('type')==1){
        $type="EXTRAS";
        }else{
        $type="ASISTENCIA";
        }

        $perfil->type=$type;
        $perfil->user=Auth::user()->name;
        $perfil->estado=0;
        $perfil->id_empresa=Auth::user()->id_empresa;
        $perfil->save();

    if($request->get('arreglo')!=""){
        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($array[$i])){
           $input['id_empleado']=$array[$i];
           $input['equipos']=$perfil->id;
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estado']=0;
           $perfiles=empleados_equipo::create($input);

            }
        }
    }

        return redirect('Equipos')->with('guardar','ya');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo=Equipos::findOrFail($id);
        // $perf=empleados_equipo::select('id_empleado')->where('equipos','=',$id)->get();
        $puesto=Puesto::all();
        $emple=Empleado::where('id_empresa','=',Auth::user()->id_empresa)->where('estado','=',0)->get();
        $empleado=empleados_equipo::leftjoin('empleado','empleado.id_empleado','=','equipos_empleados.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','equipos_empleados.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->where('equipos_empleados.equipos','=',$id)
        ->where('equipos_empleados.id_empresa','=',Auth::user()->id_empresa)
        ->where('equipos_empleados.estado','=',0)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cedula','empleado.cargo','empleado.salario','puesto.name')
        ->GroupBy('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cedula','empleado.cargo','empleado.salario','puesto.name')
        ->get();
        return view('Equipos.show',compact('equipo','empleado','emple','puesto'));
        
    }

    public function agregarGruop($ide){

        $empleado=Empleado::findOrFail($ide);
        $puesto=Puesto::all();

        return view('Equipos.plantillas',compact('empleado','puesto'));
        // return "hola";
    } 

    public function agregarGruopEdit($ide)
    {
        $empleado=Empleado::findOrFail($ide);
        $equipos=request('equipos');
        $puesto=Puesto::all();
        if(sizeof(empleados_equipo::select('id_empleado')->where('id_empleado','=',$ide)->where('equipos','=',$equipos)->get())!=0){
            return 0;

        }else{
            return view('Equipos.plantillas',compact('empleado','puesto'));

        }
        // return "hola";
    } 

    public function AllGroup(){

        $empleados=Empleado::where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $puesto=Puesto::all();

        return view('Equipos.AllPlantilla',compact('empleados','puesto'));
        // return "hola";
    } 
    public function AllGroupEDIT(Request $request){

        $arreglo=request('arreglo');
        // dd( $arreglo);
        $puesto=Puesto::all();
        $empleados=Empleado::whereNotIn('id_empleado',$arreglo)->get();
        if(sizeof($empleados)==0){
            return 0;
        }else{
            return view('Equipos.AllPlantilla',compact('empleados','puesto'));

        }

        // return "hola";
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
    public function destroyemploye()
    {
        $idempleado=request('id');
        $id=request('equipo');

        // $equipo=Equipos::findOrFail($id);
        $emple_eqi=empleados_equipo::where('equipos','=',$id)
        ->where('id_empleado','=',$idempleado)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->first();

        // $emple_eqi->estado=1;
        $emple_eqi->delete();

        $empleado=empleados_equipo::leftjoin('empleado','empleado.id_empleado','=','equipos_empleados.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','equipos_empleados.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->where('equipos_empleados.equipos','=',$id)
        ->where('equipos_empleados.id_empresa','=',Auth::user()->id_empresa)
        ->where('equipos_empleados.estado','=',0)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cedula','empleado.cargo','empleado.salario','puesto.name')
        ->GroupBy('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cedula','empleado.cargo','empleado.salario','puesto.name')
        ->get();

        return view('Equipos.Plantillas.update',compact('empleado'));
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

        $equipo=Equipos::findOrFail($id);
        $emple_eqi=empleados_equipo::all();
    
        $equipo->descripcion=$request->get('name');
        $equipo->entrada=$request->get('entrada');
        $equipo->salida=$request->get('salida');
        $equipo->user=Auth::user()->name;
        $equipo->id_empresa=Auth::user()->id_empresa;
        $equipo->update();

        $arrayadd = explode(",", $request->get('arreglo'));
        $arrayremo = explode(",", $request->get('arregloremo'));

        if($arrayadd!=''){
        $n=count($arrayadd);
        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($arrayadd[$i])){
                $input['id_empleado']=$arrayadd[$i];
                $input['equipos']=$equipo->id;
                $input['id_empresa']=Auth::user()->id_empresa;
                $input['estado']=0;
           $emple_eqi=empleados_equipo::create($input);
            }
        }
    }

    //     if( $arrayremo!=''){
    //     $r=count($arrayremo);
    //         for ($i=0; $i <$r; $i++){ 
    //             foreach($emple_eqi as $perfil){
    //             if(!empty($arrayremo[$i])){
    //                 if($perfil->id_empleado==$arrayremo[$i]){
    //                     if($perfil->id_perfiles==$id){
    //                         $perfil->delete();
    //                     }
    //                 }
    //             } 
    //         }
    //     }
    // }



        return redirect('Equipos')->with('actualizar','ya');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo=Equipos::findOrFail($id);
        $equipo->Estado=1;
        $equipo->save();
        return redirect('Equipos');

    }

    public function datatablEquipos()
    {
        if(request()->ajax()){
            $start=request()->start_date;
            $end=request()->end_date;
        $equipos=Equipos::
        leftjoin('equipos_empleados','equipos_empleados.equipos','=','equipos.id')
        ->leftjoin('empleado','empleado.id_empleado','=','equipos_empleados.id_empleado')
        ->where('equipos.id_empresa',Auth::user()->id_empresa)
        ->where('equipos.estado','=',0)
        ->where('equipos_empleados.estado','=',0)
        ->select('equipos.id','equipos.descripcion','equipos.user','equipos.created_at',DB::raw('count(equipos_empleados.id_empleado) as emple'))
        ->GroupBy('equipos.id','equipos.descripcion','equipos.user','equipos.created_at');
       
        if(!empty($start) && $start!="Invalid date"){
            $equipos->whereDate('equipos.created_at','>=',$start)->whereDate('equipos.created_at','<=',$end);
        } 
            return datatables()->of($equipos)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'url'=>function($row){
                    return Route('Equipos.show',[$row->id]);
                },
                ])->toJson();
            }
    }
}
