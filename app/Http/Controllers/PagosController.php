<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('Pagos.index');
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
        $pagos=new Pagos();

        $pagos->pago=request('namew');
        $pagos->estado=0;
        $pagos->id_empresa=Auth::user()->id_empresa;
        $pagos->usuario=Auth::user()->name;
        $pagos->save();
        
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
    public function Pagosshow($id)
    {
        $pagos=Pagos::findOrFail($id);

       return view('Pagos.modalshow',compact('pagos'));
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
    public function PagoUpdate(Request $request, $id)
    {
        $pagos=Pagos::findOrFail($id);
        $pagos->pago=request('name');
        $pagos->save();
        return;
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
    public function eliminipagos($id)
    {
        $pagos=Pagos::findOrFail($id);
        $pagos->estado=1;
        $pagos->save();
        return;
    }

    public function datatablePagos()
    {
        $pagos=Pagos::
        leftjoin('empleado_pagos','empleado_pagos.pagos_id','=','pagos.id')
        ->where('pagos.estado','=',0)
        ->where('pagos.id_empresa','=',Auth::user()->id_empresa)
        ->leftjoin('empleado','empleado.id_empleado','=','empleado_pagos.empleado_id_empleado')
        ->select('pagos.id','pagos.pago','pagos.usuario','pagos.created_at',DB::raw('count(empleado_pagos.empleado_id_empleado) as emple'))
        ->GroupBy('pagos.id','pagos.pago','pagos.created_at','pagos.usuario');
       
            return datatables()->of($pagos)
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
