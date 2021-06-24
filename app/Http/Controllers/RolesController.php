<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Permisos;
use Illuminate\Support\Facades\Auth;
use App\Models\modulos;
use App\Models\widget;
use App\Models\permisos_widget;

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
        $modulos=modulos::all();
        $widget=widget::all();
        return view('Roles.create',compact('modulos','widget'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $roles=New Role();
        $roles->name=$request->get('descripcion');
        $roles->id_empresa=Auth::user()->id_empresa;
        $roles->estado=0;
        $roles->usuario=Auth::user()->name;
        $roles->save();


        $permi_wigdet= new permisos_widget();
        $widget=$request->get('wingdt');
        if($request->get('descripcion')!=''){
            for($i = 0; $i < count($request->get('wingdt')); $i++){
                $permi_wigdet->role_id=$roles->id;
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
        } 


        $permi= new Permisos();
        $permisos=$request->get('dinamico');
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
        } 

       

        return redirect('Roles')->with('guardado','ya');

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
        $permisos_widget=permisos_widget::where('role_id','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        
        $permisos=Permisos::where('role_id','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        // dd($permisos);
        return view('Roles.show',compact('roles','permisos','permisos_widget'));
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
        // dd($request->all());
        $roles=Role::findOrFail($id);
        $roles->name=$request->get('descripcion');
        $roles->save();

        $permisoss=Permisos::where('role_id','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $permisoss->delete();

        $permisos_widget=permisos_widget::where('role_id','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $permisos_widget->delete();


        $permi_wigdet= new permisos_widget();
        $widget=$request->get('wingdt');
        if($request->get('descripcion')!=''){
            for($i = 0; $i < count($request->get('wingdt')); $i++){
                $permi_wigdet->role_id=$roles->id;
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
        } 


        $permi= new Permisos();
        $permisos=$request->get('dinamico');
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
        } 


        return redirect('Roles')->with('guardado','ya');


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

        return redirect('Roles')->with('eliminiado','ya');
    }
    public function datatableRoles()
    {
        $roles=Role::
        leftjoin('role_user','role_user.role_id','=','roles.id')
        ->leftjoin('users','users.id','=','role_user.user_id')
        ->where('roles.estado','=',0)
        ->where('roles.id_empresa','=',Auth::user()->id_empresa )
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
