<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Permisos;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\Weekend;
use App\Models\Weekend_empresa;
use App\Http\Controllers\Auth\LoginController;
use DateTime;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa=Empresa::findOrFail(Auth::user()->id_empresa);
        $contrato=Contrato::all();
        // $week=Weekend::all();
        $pais_start=0;
        $state_start=0;
        $city_start=0;
        $state=0;
        $city=0;
        
        $pais=Pais::select('id','name')->orderBy('name')->get();
        
        if($empresa->contry!=null){
            $pais_start=$empresa->contry;
        }
        if($empresa->state!=null){
            $state_start=$empresa->state;
            $state=Estado::select('id','name')->where('country_id','=',$pais_start)->orderBy('name')->get();
        }
        if($empresa->city!=null){
            $city_start=$empresa->city;
            $city=Ciudad::select('id','name')->where('state_id','=',$state_start)->orderBy('name')->get();
        }
        
        return view('Empresa.index',compact('empresa','contrato','pais','pais_start','state_start','city_start','state','city'));
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

    public function datatableHorario()
    {
        $hora=Weekend::
        leftjoin('weekend_empresa','weekend_empresa.id_weekend','=','weekend.id')
        ->select('weekend.id','weekend.day',DB::raw('count(weekend_empresa.id_weekend) as times'))
        ->GroupBy('weekend.id','weekend.day');
       
            return datatables()->of($hora)
            // ->editColumn('btn',function($row){
            //     // $button='<div class="form-check"><label class="form-check-label"><input class="form-check-input" name="dom[]"  type="checkbox" value="'.$row->id.'"><span class="form-check-sign"><span class="check"></span></span></label></div>';
            //     // return  $button;
            //     return ;
                
            // })
                
            ->editColumn('horas',function($row){
                $week=Weekend_empresa::where('id_weekend','=',$row->id)->get();
                $sum=0;

                foreach($week as $weeks){
                    $entrada=new datetime($weeks->start);
                    $salida=new datetime($weeks->end);

                    $extras = date_diff($entrada, $salida);
                    $sum=$sum+$extras->h;
                }

                return  $sum;

            })
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;
                },
            ])->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa= new Empresa();
        $empresa->nombre=$request->get('nombre');
        $empresa->telefono=$request->get('telefono');
        $empresa->direcion=$request->get('direcion');
        $empresa->email=$request->get('email');
        $empresa->color=$request->get('custom_color');
        $empresa->email=$request->get('archiveUP');
        $empresa->estado=0;
        $empresa->rnc=$request->get('rnc');
        $empresa->save();

        $user=new User();
        $user->name=Auth::user()->name;
        $user->apellido=Auth::user()->apellido;
        $user->email=Auth::user()->email;
        $user->password=Auth::user()->password;
        $user->cedula=Auth::user()->cedula;
        $user->telefono=Auth::user()->telefono;
        $user->direccion=Auth::user()->direccion;
        $user->edad=Auth::user()->edad;
        $user->imagen=Auth::user()->imagen;
        $user->entrada=Auth::user()->entrada;
        $user->salida=Auth::user()->salida;
        $user->salario=Auth::user()->salario;
        $user->cargo=Auth::user()->cargo;
        $user->id_empresa=$empresa->id;
        $user->estado=0;
        $user->save();

        $user->asignarRol(1);
        $roles=Role::findOrFail(1);

        Permisos::create([
            'role_id' =>$roles->id,
            'empleado'      => 1,
            'usuario'       => 1,
            'departamento'  => 1,
            'roles'         => 1,
            'gastos'        => 1,
            'asignaciones'  => 1,
            'listado'       => 1,
            'perfiles'      => 1,
            'nomina'        => 1,
        'nomina_empleador'  => 1,
            'formas_pagos'  => 1,
            'contrato'      => 1,      
            'id_empresa'     => $empresa->id,      
        ]);

        return redirect('Empresa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato=new Contrato();
        $contrato->save();
    
        return view('Emresa.plantilla',compact('contrato'));
    
      
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
    public function saveUpdate($id)
    {
        $week=weekend_empresa::findOrFail($id);
        $entrada=request('entrada');
        $salida=request('salida');

        $week->start=$entrada;
        $week->end=$salida;
        $week->update();

        return 0;

        
        
    }
    public function UpdateHorasEmpresa($id)
    {
        $week=weekend_empresa::findOrFail($id);
        
        return view('Empresa.updatehoras',compact('week'));
    }

    public function DeleteEmpresa($id)
    {
        $week=weekend_empresa::findOrFail($id);
        $week->delete();
        return 0;
    }

    public function HorarioEmpresa($id)
    {
        $weekend=Weekend::findOrFail($id);
        $week=Weekend_empresa::where('id_weekend','=',$id)->where('estado','=',0)->get();
        return view('Empresa.modalHorario',compact('week','weekend'));
    }

    public function Empresaphoto(Request $request)
    {
      if(isset($_POST['image']))
      {
          $data = $_POST['image'];
      
      
          $image_array_1 = explode(";", $data);
      
      
          $image_array_2 = explode(",", $image_array_1[1]);
      
      
          $data = base64_decode($image_array_2[1]);
          $b=time();
      
          $image_name = 'logo/' .$b. '.png';
  
  
          file_put_contents($image_name, $data);
      
          return  view('Empleados.Plantillas.image',compact('b','image_name'));
      }
    }
    public function SearchUser(Request $request)
    {
        $user=User::where('id_empresa','=',$request->get('selecet'))->Where('email','=',Auth::user()->email)->first();


       
        $myVariable =Auth::login($user);
        // dd( $myVariable);
        return redirect('/home');

    }

    public function guardar()
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
        // dd($request->all());
        $empresa=Empresa::findOrFail($id);
        $empresa->nombre=$request->get('nombreUP');
        $empresa->telefono=$request->get('telefonoUP');
        $empresa->direcion=$request->get('direcionUP');
        $empresa->rnc=$request->get('rncUP');
        $empresa->email=$request->get('emailUP');
        $empresa->color=$request->get('custom_color');
        if($request->get('imagen')!=null){
            $empresa->imagen=$request->get('imagen');
        }
        
        $empresa->update();
        return redirect('Empresa');
        
    }
    public function Empresaupdate(Request $request, $id)
    {
        // dd($request->all());
        // dd("llego");
        $empresa=Empresa::findOrFail($id);
        $empresa->zipcode=$request->get('zipcode');
        $empresa->contry=$request->get('pais');
        $empresa->state=$request->get('state');
        $empresa->city=$request->get('ciudad');
        $empresa->update();
        return redirect('Empresa');
        
    }
    public function harariosave()
    {
        $entrada=request('entrada');
        $salida=request('salida');
        $semana=request('add');
        $p=0;

        $n=count($semana);
        
        for ($i=0; $i < $n; $i++) { 
            if(!empty($semana[$i])){
                $input['id_weekend']=$semana[$i];
                $input['id_empresa']=Auth::user()->id_empresa;
                $input['start']=$entrada;
                $input['end']=$salida;
                $input['laboral']=0;
                $input['estado']=0;
                $perfiles=Weekend_empresa::create($input);
            }
        }


        return $p;


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->estado=1;
        $empresa->save();

        $user=User::where('id_empresa','=',$id)->Where('email','=',Auth::user()->email)->first();

        $myVariable =Auth::logout($user);

        return redirect('/');




    }
}
