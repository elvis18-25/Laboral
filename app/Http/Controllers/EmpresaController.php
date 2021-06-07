<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Permisos;
use App\Http\Controllers\Auth\LoginController;

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
        return view('Empresa.index',compact('empresa','contrato'));
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
  
        // if($request->hasFile('archivo')){
        //     $file=$request->archivo;
        //     $file->move(public_path(). '/modelo', $file->getClientOriginalName());
        //     $contrato->name=$file->getClientOriginalName();   
        //     $contrato->id_empresa=Auth::user()->id_empresa;   
        // }else{
        //     dd("No Hay Archivo");
        // }
    
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
        $empresa->imagen=$request->get('imagen');
        

        // if($request->hasFile('archiveUP')){

        //     $file=$request->archiveUP;
        //     // dd($file);
        //     $file->move(public_path().'/logo', $file->getClientOriginalName());
        //     $empresa->imagen=$file->getClientOriginalName();
            
        // }

        $empresa->update();
        return redirect('Empresa');
        
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
