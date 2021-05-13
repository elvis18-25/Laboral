<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\estado_asignaciones;
use App\Models\estados_isr;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Asignaciones.index');
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
        $asigna=new Asignaciones();
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
        return view('Asignaciones.edit',compact('asigna'));
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
    public function deleteasigna($id)
    {
        $asigna=Asignaciones::findOrFail($id);
        $asigna->estado=1;
        $asigna->save();

    }

    public function datatablesasigna()
    {
        $asigna=Asignaciones::
        leftjoin('asignaciones_empleado','asignaciones_empleado.asignaciones_id','=','asignaciones.id')
        ->where('asignaciones.id_empresa',Auth::user()->id_empresa)
        ->where('asignaciones.estado','=','0')
        ->select('asignaciones.id','asignaciones.Nombre','asignaciones.tipo_asigna','asignaciones.tipo','asignaciones.Monto','asignaciones.user',DB::raw('count(asignaciones_empleado.empleado_id_empleado) as emple',))
        ->GroupBy('asignaciones.id','asignaciones.Nombre','asignaciones.tipo_asigna','asignaciones.tipo','asignaciones.Monto','asignaciones.user');

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
