<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventos;
use App\Models\Empleado;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class EventosController extends Controller
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
        $datos=request()->except(['_token','_method']);
        eventos::insert($datos);
        print_r($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $data['eventos']=eventos::all();
        // return response()->json($data['eventos']);
        $data=[];
        $empleado=Empleado::all();
        $eventos=eventos::all();

        foreach($empleado as $empleados){
        if($empleados->id_empresa==Auth::user()->id_empresa && $empleados->estado==0){
        $separa = explode("-", $empleados->edad);
        $ano = $separa[0];
        $mes = $separa[1];
        $dia = $separa[2];

            $data[] = array(
                'title'   => "Cumpleado de"." ".$empleados->nombre, 
                'start'   => Carbon::now()->format('Y')."-".$mes."-".$dia,
                'end'   => Carbon::now()->format('Y')."-".$mes."-".$dia,
                'color' =>"#00FF2AFF",
                'textColor'=> "#FFFFFF"
            );
        }
        }

            foreach($eventos as  $evento){
            if($evento->id_empresa==Auth::user()->id_empresa && $evento->estado==0){
                $data[] = array(
                    'title'   => $evento->title, 
                    'start'   => $evento->start,
                    'end'   => $evento->end,
                    'color' =>$evento->color,
                    'textColor'=> $evento->textColor

                );
            
            }
            }

            
        
            
            
            return response()->json($data);
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

    public function SerchEventos(Request $request)
    {
        $data=[];

        // $hoy=Carbon::now();

        $start=request('Istart');
        $end=request('Iend');

        // $dt = new DateTime($start);

        $empleado=Empleado::all();
        $eventos=eventos::all();

        foreach($empleado as $empleados){
        if($empleados->id_empresa==Auth::user()->id_empresa && $empleados->estado==0){
        $separa = explode("-", $empleados->edad);
        $ano = $separa[0];
        $mes = $separa[1];
        $dia = $separa[2];

            $data[] = array(
                'title'   => "Cumpleaño de"." ".$empleados->nombre, 
                'start'   => Carbon::now()->format('Y')."-".$mes."-".$dia,
                'end'   => Carbon::now()->format('Y')."-".$mes."-".$dia,
                'color' =>"#00FF2AFF",
                'textColor'=> "#FFFFFF"
            );
        }
    }

            foreach($eventos as  $evento){
            if($evento->id_empresa==Auth::user()->id_empresa && $evento->estado==0){
                $data[] = array(
                    'title'   => $evento->title, 
                    'start'   => $evento->start,
                    'end'   => $evento->end,
                    'color' =>$evento->color,
                    'textColor'=> $evento->textColor
                );
            
              }
            }

            // $data=whereDate('start','>=',$start)->whereDate('end','<=',$end);
                // dd($data);
                // $data=array_diff($start, $end);
                // dd(date($start));

            return view('Eventos.index',compact('data','start','end'));
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
}
