<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Puesto.index');
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

        $puesto=new Puesto();

        $puesto->name=request('namew');
        $puesto->estado=0;
        $puesto->id_empresa=Auth::user()->id_empresa;
        $puesto->usuario=Auth::user()->name;
        $puesto->save();

        return; 
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
    public function departshow($id)
    {
        $puesto=Puesto::findOrFail($id);
        return view('Puesto.modalshow',compact('puesto'));
        
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
    public function puestoUpdate(Request $request, $id)
    {
        $puesto=Puesto::findOrFail($id);

        $puesto->name=request('name');

        $puesto->save();
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
    public function eliminipuesto($id)
    {
        $puesto=Puesto::findOrFail($id);

        $puesto->estado=1;

        $puesto->save();
    }

    public function datatabledepart()
    {
        $puesto=Puesto::
        leftjoin('empleado_puesto','empleado_puesto.puesto_id','=','puesto.id')
        ->leftjoin('empleado','empleado.id_empleado','=','empleado_puesto.empleado_id_empleado')
        ->where('puesto.estado','=',0)
        ->where('puesto.id_empresa','=',Auth::user()->id_empresa)
        ->select('puesto.id','puesto.name','puesto.usuario','puesto.created_at',DB::raw('count(empleado_puesto.empleado_id_empleado) as emple'))
        ->GroupBy('puesto.id','puesto.name','puesto.created_at','puesto.usuario');
       
            return datatables()->of($puesto)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;
                },
            ])->toJson();
    }






}
