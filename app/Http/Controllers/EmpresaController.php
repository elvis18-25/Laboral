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
use App\Models\modulos;
use App\Models\widget;
use App\Models\permisos_widget;
use App\Models\Role_users;
use App\Models\Acciones;


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

        $modulos=modulos::all();
        $widget=widget::all();
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
        $user=Auth::user()->id;
        $rol=Role_users::where('user_id','=',$user)->first();

        $roles=Role::findOrFail($rol->role_id);
        $permisos_widget=permisos_widget::where('role_id','=',$rol->role_id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        
        $permisos=Permisos::where('role_id','=',$rol->role_id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        // dd($permisos);
        $acciones=Acciones::where('id_empresa','=',Auth::user()->id_empresa)->get();
        return view('Empresa.index',compact('empresa','contrato','roles','acciones','permisos_widget','permisos','pais','pais_start','state_start','city_start','state','city','modulos','widget'));
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
        ->select('weekend.id','weekend.day','weekend_empresa.start','weekend_empresa.end',DB::raw('count(weekend_empresa.id_weekend) as times'))
        ->GroupBy('weekend.id','weekend.day','weekend_empresa.start','weekend_empresa.end');
       
            return datatables()->of($hora)
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

        $roles= Role::create([
            'name' => "ADMINISTRADOR",
            'id_empresa'  =>$empresa->id,
            'estado'   =>0,
            'usuario'=>$user->name,
        ]);

        $user->asignarRol($roles->id);
        
        Permisos::create([
            'role_id' =>$roles->id,
            'empleado'      => 1,
            'usuario'       => 1,
            'departamento'  => 1,
            'roles'         => 1,
            'gastos'        => 1,
            'perfiles'      => 1,
            'nomina'        => 1,
            'formas_pagos'  => 1,
            'contrato'      => 1, 
            'asignaciones'  => 1,
            'perfilesuser'  => 1,
            'asistencia'    => 1,
            'empresa'       => 1,
            'grupo'          => 1,
            'id_empresa'     => $empresa->id,      
        ]);
        permisos_widget::create([
            'role_id'             =>$roles->id,
            'total_empleado'      => 1,
            'total_usuarios'      => 1,
            'total_departamentos' => 1,
            'formas_pago'         => 1,
            'totales_roles'       => 1,
            'reuniones'           => 1,
            'w_empleados'         => 1,
            'w_departamentos'     => 1,
            'w_generos'           => 1,
            'g_gasto'             => 1,
            'historial'           => 1,
            'calendario'          => 1, 
            'estado'              => 0,
            'id_empresa'          => $empresa->id,      
        ]);

        return redirect('Empresa')->with('guardado','ya');;
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

    public function Savepermis(Request $request)
    {
        $n=count($request->get('wingdt'));
        $p=count($request->get('donm'));
        // dd($p);
        $id=intval($request->get('rol'));
        // dd($id);
        $acciones=Acciones::whereIn('id',$request->get('accion'))->get();
        
        $permisos_widget=permisos_widget::where('role_id','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $permisos_widget->delete();
        // dd($permisos_widget);
        $permisoss=Permisos::where('role_id','=',$id)->where('id_empresa','=',intval(Auth::user()->id_empresa))->first();
        $permisoss->delete();
        
        // dd($acciones);
 


        foreach($acciones as  $accione ){
            if($accione->estado==0){
                $accione->estado=1;
                $accione->update();
            }else{
                $accione->estado=0;
                $accione->update(); 
            }
        }

        $permi_wigdet= new permisos_widget();
        $widget=$request->get('wingdt');
            for($i = 0; $i < $n; $i++){
                $permi_wigdet->role_id=$id;
                $permi_wigdet->id_empresa=Auth::user()->id_empresa;
                if($widget[$i]==1){
                 $permi_wigdet->total_empleado=1;
                }
                if($widget[$i]==2){
                 $permi_wigdet->total_usuarios=1;
                }
                if($widget[$i]==3){
                 $permi_wigdet->total_departamentos=1;
                }
                if($widget[$i]==4){
                 $permi_wigdet->formas_pago=1;
                }
                if($widget[$i]==5){
                 $permi_wigdet->totales_roles=1;
                }
                if($widget[$i]==6){
                 $permi_wigdet->reuniones=1;
                }
                if($widget[$i]==7){
                 $permi_wigdet->w_empleados=1;
                }
                if($widget[$i]==8){
                 $permi_wigdet->w_departamentos=1;
                }

                if($widget[$i]==9){
                 $permi_wigdet->w_generos=1;
                }
                if($widget[$i]==10){
                 $permi_wigdet->g_gasto=1;
                }
                if($widget[$i]==11){
                    $permi_wigdet->historial=1;
                   }
                if($widget[$i]==12){
                    $permi_wigdet->calendario=1;
                   }
                $permi_wigdet->save();
              
        } 


        $permi= new Permisos();
        $permisos=$request->get('donm');
            for($i = 0; $i < $p; $i++){
                $permi->role_id=$id;
                $permi->id_empresa=Auth::user()->id_empresa;
                if($permisos[$i]==1){
                 $permi->empleado=1;
                }
                if($permisos[$i]==2){
                 $permi->usuario=1;
                }
                if($permisos[$i]==3){
                 $permi->departamento=1;
                }
                if($permisos[$i]==4){
                 $permi->roles=1;
                }
                if($permisos[$i]==5){
                 $permi->gastos=1;
                }
                if($permisos[$i]==6){
                 $permi->asignaciones=1;
                }
                if($permisos[$i]==8){
                 $permi->perfiles=1;
                }

                if($permisos[$i]==9){
                 $permi->formas_pagos=1;
                }
                if($permisos[$i]==10){
                 $permi->perfilesuser=1;
                }
                if($permisos[$i]==11){
                    $permi->nomina=1;
                   }
                   if($permisos[$i]==12){
                    $permi->asistencia=1;
                   }
                if($permisos[$i]==13){
                    $permi->empresa=1;
                   }
                   if($permisos[$i]==14){
                    $permi->grupo=1;
                   }
                $permi->save();
        } 


        return redirect('Empresa')->with('guardado','ya');
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
        $empresa->zipcode=$request->get('zipcode');
        $empresa->contry=$request->get('pais');
        $empresa->state=$request->get('state');
        $empresa->city=$request->get('ciudad');
        if($request->get('imagen')!=null){
            $empresa->imagen=$request->get('imagen');
        }
        
        $empresa->update();
        return redirect('Empresa')->with('guardado','ya');;
        
    }
    // public function Empresaupdate(Request $request, $id)
    // {
    //     // dd($request->all());
    //     // dd("llego");
    //     $empresa=Empresa::findOrFail($id);

    //     $empresa->update();
    //     return redirect('Empresa');
        
    // }
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


        return $n;


        
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
