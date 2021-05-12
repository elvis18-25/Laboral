<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Permisos;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Roles.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $roles=New Role();
        $roles->name=$request->get('descripcion');
        $roles->id_empresa=Auth::user()->id_empresa;
        $roles->estado=0;
        $roles->usuario=Auth::user()->name;
        $roles->save();


        $permi= new Permisos();
        $permisos=$request->get('dinamico');
        // $cont= count(collect($request)->get('dinamico'));

        if($request->get('descripcion')!=''){
            for($i = 0; $i < count($request->get('dinamico')); $i++){
                $permi->role_id=$roles->id;
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
                 $permi->listado=1;
                }
                if($permisos[$i]==9){
                 $permi->perfiles=1;
                }
                if($permisos[$i]==10){
                 $permi->nomina=1;
                }
                if($permisos[$i]==11){
                 $permi->formas_pagos=1;
                }
                $permi->save();
            }  
        } 

        return redirect('Roles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles=Role::findOrFail($id);
        $permisos=Permisos::where('role_id','=',$id)->get();
        return view('Roles.show',compact('roles','permisos'));
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
        $roles=Role::findOrFail($id);
        $roles->name=$request->get('descripcion');
        $roles->save();

        $permiall=Permisos::all();

        foreach($permiall as $permia){
            if( $permia->role_id==$roles->id){
                $permia->delete();
            }
        }
        $permisos=$request->get('dinamico');
        $permi= new Permisos();

        if($request->get('descripcion')!=''){
            for($i = 0; $i < count($request->get('dinamico')); $i++){
                $permi->role_id=$roles->id;
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
                 $permi->listado=1;
                }
                if($permisos[$i]==9){
                 $permi->perfiles=1;
                }
                if($permisos[$i]==10){
                 $permi->nomina=1;
                }
                if($permisos[$i]==11){
                 $permi->formas_pagos=1;
                }
                $permi->save();
            }  
        } 

        return redirect('Roles');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles=Role::findOrFail($id);
        $roles->estado=1;
        $roles->save();

        return redirect('Roles');
    }
    public function datatableRoles()
    {
        $roles=Role::
        leftjoin('role_user','role_user.role_id','=','roles.id')
        ->leftjoin('users','users.id','=','role_user.user_id')
        ->where('roles.estado','=',0)
        ->where('roles.id_empresa','=',Auth::user()->id_empresa,'OR','roles.id_empresa','=',0 )
        ->select('roles.id','roles.name','roles.created_at',DB::raw('count(role_user.user_id) as user'),'roles.usuario')
        ->GroupBy('roles.id','roles.name','roles.created_at','roles.usuario');
       
            return datatables()->of($roles)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })
            ->setRowAttr([
                'url'=>function($row){
                    return Route('Roles.show',[$row->id]);
                },
            ])->toJson();
    }
}
