<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Listado;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfiles;
use App\Models\Perfiles_empleado;
use Illuminate\Support\Carbon;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade as PDF;


class ListadoContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado=Listado::all();
        return view('Listado.index',compact('listado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Listado.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $nominas=Listado::findOrFail($id);
        $empleados=Empleado::all();

        return view('Listado.show',compact('nominas','empleados'));
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
        $nominas=Listado::findOrFail($id);

        $nominas->descripcion=$request->get('descripcion');
        $nominas->fecha=$request->get('fecha');
        $nominas->user=Auth::user()->name;
        $nominas->monto=$request->get('montototal');
        $nominas->id_perfiles=$request->get('perfil');
        $nominas->id_empresa=Auth::user()->id_empresa;
        $nominas->estado=0;

        $nominas->save();
        return redirect('Listado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nominas=Listado::findOrFail($id);
        $nominas->estado=1;

        $nominas->save();

        return redirect('Listado')->with('eliminado','ya');
    }

    public function listadopdf($id)
    {
  
        $nominas=Listado::findOrFail($id);
        $perfiles=Perfiles::where('id_perfiles','=',$nominas->id_perfiles)->get();
        $empleados=Empleado::all();

    $fecha=Carbon::now();
    $idempresa=Auth::user()->id_empresa;
    $empresa=Empresa::findOrFail($idempresa);
    // $empresa=Empresa::all();

  
      $pdf =PDF::loadView('Listado.recibo',compact('fecha','empresa','nominas','perfiles','empleados'));
      $pdf->setPaper("letter", "portrait");
      return $pdf->stream('Nomina.pdf');
    }
}
