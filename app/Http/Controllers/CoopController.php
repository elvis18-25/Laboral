<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Cooperativa;
use App\Models\empleado_coop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Cooperativa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=Empleado::all();
        return view('Cooperativa.create',compact('empleados'));
    }
    public function agregarCoop($id)
    {
        $empleado=Empleado::findOrFail($id);
        $puesto=Puesto::all();

        return view('Cooperativa.plantilla',compact('empleado','puesto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('arreglo')!=""){
            $array = explode(",", $request->get('arreglo'));
            $n=count($array);
        }
        // dd($n);
        $coop= new Cooperativa();
        $coop->descripcion=$request->get('name');
        $coop->monto=$request->get('monto');
        
        if($request->get('formae')==1){
            $coop->tipo="MONTO";
        }else{
            $coop->tipo="PORCENTAJE";
        }

        $coop->user=Auth::user()->name;
        $coop->estado=0;
        $coop->id_empresa=Auth::user()->id_empresa;
        $coop->save();


        if($request->get('arreglo')!=""){
        for ($i=0; $i<=$n ; $i++) { 
            $p=0;
            if(!empty($array[$i])){
           $input['id_empleado']=$array[$i];
           $input['id_coop']=$coop->id;
           if($coop->tipo=="MONTO"){
            $input['monto']=$coop->monto;   
            }else{
                $empleado=Empleado::where('id_empleado','=',$array[$i])->first();
              $p=$coop->monto*$empleado->salario;
              $p=$p/100;
            $input['monto']=$p; 
            }
            $input['balance']=0;
            $input['id_empresa']=Auth::user()->id_empresa;
            $input['estado']=0;
           $perfiles=empleado_coop::create($input);

            }
        }
    }

        return redirect('Cooperativas');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coop=Cooperativa::findOrFail($id);
        $perf=empleado_coop::select('id_empleado')->where('id_coop','=',$id)->get();
        $empleado=Empleado::all();
        $puesto=Puesto::all();
        return view('Cooperativa.edit',compact('coop','perf','empleado','puesto'));

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

    public function datatableCoop()
    {
        $coop=Cooperativa::
        leftjoin('empleados_coop','empleados_coop.id_coop','=','cooperativas.id')
        ->leftjoin('empleado','empleado.id_empleado','=','empleados_coop.id_empleado')
        ->where('cooperativas.id_empresa',Auth::user()->id_empresa)
        ->where('cooperativas.estado','!=','1')
        ->select('cooperativas.id','cooperativas.descripcion','cooperativas.user','cooperativas.created_at',DB::raw('count(empleados_coop.id_empleado) as emple'))
        ->GroupBy('cooperativas.id','cooperativas.descripcion','cooperativas.user','cooperativas.created_at');
       
            return datatables()->of($coop)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'url'=>function($row){
                    return Route('Cooperativas.show',[$row->id]);
                },
                ])->toJson();
    }
}
