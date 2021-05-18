<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilesUsuario;
use App\Models\Perfiles_Usuarios;
use App\Models\Puesto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PerfilesUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PerfilesUser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        $puesto=Puesto::all();
        return view('PerfilesUser.create',compact('users','puesto')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = explode(",", $request->get('arreglo'));
        $n=count($array);
        // dd($array);
        // dd($n);
        $perfil= new PerfilesUsuario();
    
        $perfil->descripcion=$request->get('descripcion');
        // $perfil->fecha=$request->get('fecha');
        $perfil->user=Auth::user()->name;
        $perfil->estado=0;
        $perfil->id_empresa=Auth::user()->id_empresa;

        $perfil->save();

        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($array[$i])){
            $input['id_perfil']=$perfil->id;
           $input['id_user']=$array[$i];
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estado']=0;
           $perfiles=Perfiles_Usuarios::create($input);

            }
        }

        return redirect('PerfilesUsuario');
    }

    public function agregarUsuario($ide){

        $user=User::findOrFail($ide);
        $puesto=Puesto::all();

        return view('PerfilesUser.Plantilla',compact('user','puesto'));
        // return "hola";
    } 
    public function agregarUsuarioEdit($ide){

        $user=User::findOrFail($ide);
        $puesto=Puesto::all();

        if(sizeof(Perfiles_Usuarios::select('id_user')->where('id_user','=',$ide)->get())!=0){
            return 0;

        }else{
            return view('PerfilesUser.Plantilla',compact('user','puesto'));

        }

        // return "hola";
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfiles=PerfilesUsuario::findOrFail($id);
        $perf=Perfiles_Usuarios::select('id_user')->where('id_perfil','=',$id)->get();
        $users=User::all();
        $puesto=Puesto::all();
        return view('PerfilesUser.edit',compact('perfiles','perf','users','puesto'));
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
    //    dd($request->all());
        $perfil=PerfilesUsuario::findOrFail($id);
        $perfiles=Perfiles_Usuarios::all();
    
        $perfil->descripcion=$request->get('descripcion');
        $perfil->user=Auth::user()->name;
        $perfil->id_empresa=Auth::user()->id_empresa;

        $perfil->update();

        $arrayadd = explode(",", $request->get('arreglo'));
        $arrayremo = explode(",", $request->get('arregloremo'));
        // dd(count($arrayremo));

        if($arrayadd!=''){
        $n=count($arrayadd);
        for ($i=0; $i<=$n ; $i++) { 
            if(!empty($arrayadd[$i])){
           $input['id_user']=$arrayadd[$i];
           $input['id_perfil']=$perfil->id;
           $input['id_empresa']=Auth::user()->id_empresa;
           $input['estado']=0;
           $perfiles=Perfiles_Usuarios::create($input);
            }
        }
    }

        if( $arrayremo!=''){
        $r=count($arrayremo);
            for ($i=0; $i <$r; $i++){ 
                foreach($perfiles as $perfil){
                if(!empty($arrayremo[$i])){
                    if($perfil->id_user==$arrayremo[$i]){
                        if($perfil->id_perfil==$id){
                            $perfil->delete();
                        }
                    }
                } 
            }
        }
    }



    return redirect('PerfilesUsuario');
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

    public function datatableperfilesUsuarios()
    {
        $perfiles=PerfilesUsuario::
        leftjoin('perfiles_usuarios','perfiles_usuarios.id_perfil','=','perfilesuser.id')
        ->leftjoin('users','users.id','=','perfiles_usuarios.id_user')
        ->where('perfilesuser.id_empresa',Auth::user()->id_empresa)
        ->where('perfilesuser.estado','!=','1')
        ->select('perfilesuser.id','perfilesuser.descripcion','perfilesuser.user','perfilesuser.created_at',DB::raw('count(perfiles_usuarios.id_user) as users'))
        ->GroupBy('perfilesuser.id','perfilesuser.descripcion','perfilesuser.user','perfilesuser.created_at');
       
            return datatables()->of($perfiles)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'url'=>function($row){
                    return Route('PerfilesUsuario.show',[$row->id]);
                },
                ])->toJson();
    }
}
