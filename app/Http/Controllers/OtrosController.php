<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\otros;
use Illuminate\Support\Facades\Auth;

class OtrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cont=0;
        $id=request('idempl');
        $name=request('name');
        $tipo=request('tipo');
        $forma=request('forma');
        $monto=request('monto');
        $idperfil=request('idperfil');

        $empleados=Empleado::findOrFail($id);

        $otros=new otros();
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
        $otros->id_empresa=Auth::user()->id_empresa;
        $otros->estado=0;
        $otros->id_perfiles=$idperfil;

        if($forma==4){
            $cont=$monto*$empleados->salario;
            $cont=$cont/100;
            $otros->p_monto=$cont;
        }

        $otros->save();

        return view('Nominas.Plantillas.otros',compact('otros','id'));

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
    public function otrosupdate($id,Request $request)
    {
        $otros=otros::findOrFail($id);

        $cont=0;
        $idempl=request('idempl');
        $name=request('name');
        $tipo=request('tipo');
        $forma=request('forma');
        $monto=request('monto');

        $empleados=Empleado::findOrFail($idempl);

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
            $cont=$monto*$empleados->salario;
            $cont=$cont/100;
            $otros->p_monto=$cont;
        }else{
            $otros->p_monto=0;
        }

        $otros->save();

        return view('Nominas.Plantillas.otros',compact('otros','id'));


    }
    public function otrosedit($id,Request $request)
    {
        $emple=request('p');

        $empleados=Empleado::findOrFail($emple);
        $otros=otros::findOrFail($id);

        return view('Nominas.otrosedit',compact('empleados','otros'));

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
    public function deleteotros($id)
    {
        $otro=otros::findOrFail($id);
        $otro->delete();
        
        $emple=request('p');
        $empleado=Empleado::findOrFail($emple);

        $otros=otros::all();
        
        return view('Nominas.Plantillas.OtrosEmple',compact('empleado','otros'));
    }
}
