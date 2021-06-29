<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Permisos;
use App\Models\Role;
use App\Models\permisos_widget;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        
        $empresa=Empresa::create([
            'nombre'   => $data['nombre'],
            'telefono' => $data['telefono'],
            'direcion' => $data['direcion'],
            'estado'   =>0,
              'rnc'    => $data['rnc'],
        ]);

        $roles= Role::create([
            'name' => "ADMINISTRADOR",
            'id_empresa'  =>$empresa->id,
            'estado'   =>0,
            'usuario'=>$data['name'],
        ]);

          $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'id_empresa'  =>$empresa->id,
            'password' => Hash::make($data['password']),
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

        return $user;
    }
}
