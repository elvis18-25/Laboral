<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfiles;
use App\Models\Perfiles_empleado;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\estado_empleado;
use Illuminate\Support\Facades\Auth;




class PerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Perfiles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=Empleado::all();
        $puesto=Puesto::all();
        return view('Perfiles.create',compact('empleados','puesto'));
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
        $perfil= new Perfiles_empleado();
    
        $perfil->descripcion=$request->get('descripcion');
        // $perfil->fecha=$request->get('fecha');
        $perfil->user=Auth::user()->name;
        $perfil->estado=0;
        $perfil->id_empresa=Auth::user()->id_empresa;

        $perfil->save();

        



        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($array[$i])){
           $input['id_empleado']=$array[$i];
           $input['id_perfiles']=$perfil->id;
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estados']=0;
           $perfiles=Perfiles::create($input);

            }
        }

        return redirect('Perfiles')->with('guardar','ya');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfiles=Perfiles_empleado::findOrFail($id);
        // $perf=Perfiles::select('id_empleado')->where('id_perfiles','=',$id)->get();
        $puesto=Puesto::all();

        $empleado=Empleado::leftjoin('perfiles','perfiles.id_empleado','=','empleado.id_empleado')
        ->leftjoin('empleado_puesto','empleado_puesto.empleado_id_empleado','=','empleado.id_empleado')
        ->leftjoin('puesto','puesto.id','=','empleado_puesto.puesto_id')
        ->where('perfiles.estados','=',0)
        ->where('empleado.estado','=',0)
        ->where('perfiles.id_perfiles',$id)
        ->select('empleado.id_empleado','empleado.nombre','empleado.apellido','empleado.cargo','empleado.cedula','puesto.name as puesto','empleado.salario',)
        ->GroupBy('empleado.id_empleado','empleado.cedula','empleado.cargo','empleado.nombre','empleado.apellido','puesto','empleado.salario')
        ->get();
       
        $emple=Empleado::where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();

        
        return view('Perfiles.show',compact('perfiles','empleado','puesto','emple'));
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
        
    public function agregar($ide){

        $empleado=Empleado::findOrFail($ide);
        $puesto=Puesto::all();

        return view('Perfiles.plantilla',compact('empleado','puesto'));
        // return "hola";
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
        $perfil=Perfiles_empleado::findOrFail($id);
        $perfiles=Perfiles::all();
    
        $perfil->descripcion=$request->get('descripcion');
        $perfil->user=Auth::user()->name;
        $perfil->id_empresa=Auth::user()->id_empresa;

        $perfil->update();

        $arrayadd = explode(",", $request->get('arreglo'));
        $arrayremo = explode(",", $request->get('arregloremo'));

        if($arrayadd!=''){
        $n=count($arrayadd);
        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($arrayadd[$i])){
           $input['id_empleado']=$arrayadd[$i];
           $input['id_perfiles']=$perfil->id;
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estados']=0;
           $perfiles=Perfiles::create($input);
            }
        }
    }

        if( $arrayremo!=''){
        $r=count($arrayremo);
            for ($i=0; $i <$r; $i++){ 
                foreach($perfiles as $perfil){
                if(!empty($arrayremo[$i])){
                    if($perfil->id_empleado==$arrayremo[$i]){
                        if($perfil->id_perfiles==$id){
                            $perfil->delete();
                        }
                    }
                } 
            }
        }
    }



        return redirect('Perfiles')->with('actualizar','ya');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil=Perfiles_empleado::findOrFail($id);

        $perfil->estado=1;
        $perfil->update();

        return redirect('Perfiles')->with('eliminado','ya');


 
    }
    public function datatableperfiles()
    {
        $perfiles=Perfiles_empleado::
        leftjoin('perfiles','perfiles.id_perfiles','=','perfiles_empleado.id')
        ->leftjoin('empleado','empleado.id_empleado','=','perfiles.id_empleado')
        ->where('perfiles_empleado.id_empresa',Auth::user()->id_empresa)
        ->where('perfiles_empleado.estado','=',0)
        ->where('perfiles.estados','=',0)
        ->select('perfiles_empleado.id','perfiles_empleado.descripcion','perfiles_empleado.user','perfiles_empleado.created_at',DB::raw('count(perfiles.id_empleado) as emple'))
        ->GroupBy('perfiles_empleado.id','perfiles_empleado.descripcion','perfiles_empleado.user','perfiles_empleado.created_at');
       
            return datatables()->of($perfiles)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'url'=>function($row){
                    return Route('Perfiles.show',[$row->id]);
                },
                ])->toJson();
    }
}
