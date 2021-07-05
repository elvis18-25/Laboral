<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Gasto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use App\Charts\SampleChart;
// use Charts;
use App\Models\sexo_empleado;
use Illuminate\Support\Facades\Auth;
use App\Models\Puesto;
use App\Models\empleado_puesto;
use App\Models\Listado;
use App\Models\eventos;
use App\Models\User;
use App\Models\Pagos;
use App\Models\Role;
use App\Models\Role_users;
use App\Models\permisos_widget;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use App\Charts\UserChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $puesto=Puesto::where('id_empresa',Auth::user()->id_empresa)
        ->where('estado',0)
        ->select('name')
        ->orderBy('id')
        ->get()->toArray();
        $puesto = array_column($puesto, 'name');

        $puesto_empleado=Puesto::
        leftjoin('empleado_puesto','empleado_puesto.puesto_id','=','puesto.id')
        ->leftjoin('empleado','empleado.id_empleado','=','empleado_puesto.empleado_id_empleado')
        ->where('puesto.estado','=',0)
        ->where('puesto.id_empresa','=',Auth::user()->id_empresa)
        ->select('puesto.id',DB::raw('count(empleado_puesto.empleado_id_empleado) as emple',))
        ->groupBy('empleado_puesto.puesto_id','puesto.id')
        ->orderBy('puesto.id')
        ->get()->toArray();
        $puesto_empleado = array_column($puesto_empleado, 'emple');
        // dd($puesto_empleado);

        $eventos=eventos::all();



        $count_puesto=Puesto::where('id_empresa',Auth::user()->id_empresa)->where('estado',0)->count();
        $count_pagos=Pagos::where('id_empresa',Auth::user()->id_empresa)->where('estado',0)->count();

        // dd($puesto);
    
        $count_empleado=Empleado::where('id_empresa',Auth::user()->id_empresa)->where('estado',0)->count();

        $count_users=User::where('id_empresa',Auth::user()->id_empresa)->where('estado',0)->count();
        $count_roles=Role::where('id_empresa',Auth::user()->id_empresa)->where('estado',0)->count();



                    $gasto = Gasto::select(DB::raw("month(fecha) as moth"),DB::raw("SUM(monto) as count"))
                    ->where('id_empresa',Auth::user()->id_empresa)
                    ->where('estado',0)
                    ->orderBy("fecha")
                    ->groupBy(DB::raw("month(fecha)"))
                    ->get();


                    $nomina = Listado::select(DB::raw("month(fecha) as moth"),DB::raw("SUM(monto) as count"))
                    ->where('id_empresa',Auth::user()->id_empresa)
                    ->where('estado',0)
                    ->orderBy("fecha")
                    ->groupBy(DB::raw("month(fecha)"))
                    ->get();
                    // $gasto = array_column($gasto, 'count');
                    // dd($gasto);
                


                    //  $gasto = Gasto::select(DB::raw("SUM(monto) as count"))
                    //  ->whereYear('fecha',date('Y'))
                    //  ->where('id_empresa',Auth::user()->id_empresa)
                    //  ->where('estado',0)
                    //  ->orderBy("fecha")
                    //  ->groupBy(DB::raw("Month(fecha)"))
                    //  ->pluck('count');
             
                    //  $moths=Gasto::select(DB::raw("Month(fecha) as month"))
                    //  ->whereYear('fecha',date('Y'))
                    //  ->where('id_empresa',Auth::user()->id_empresa)
                    //  ->where('estado',0)
                    //  ->orderBy("fecha")
                    //  ->groupBy(DB::raw("Month(fecha)"))
                    //  ->pluck('month');
             
                    //  $data=array(0,0,0,0,0,0,0,0,0,0,0,0);
             
                    //  foreach($moths as $index =>$moth)
                    //  {
                    //      $data=[$month]=$gasto[$index];
                    //  }

                     $moth =[];  
                     $data=[];
                     $i=0;
                     foreach($gasto as $gastos){
                        $moth[$i]=(int)$gastos->moth;
                        $data[$i]=$gastos->count;
                        $i++;
                     }

                     $mothnom=[];
                     $datanom=[];
                     $p=0;
                     
                     foreach($nomina as $nominas){
                        $mothnom[$p]=(int)$nominas->moth;
                        $datanom[$p]=$nominas->count;
                        $p++;

                     }


        // dd(date('Y'));
        $count_mujeres=sexo_empleado::leftjoin('empleado','empleado.id_empleado','=','empleado_sexo.empleado_id_empleado')
        ->where('empleado_sexo.sexo_id','=',2)
        ->where('empleado.id_empresa','=',Auth::user()->id_empresa)
        ->count();

        $count_hombres=sexo_empleado::leftjoin('empleado','empleado.id_empleado','=','empleado_sexo.empleado_id_empleado')
        ->where('empleado_sexo.sexo_id','=',1)
        ->where('empleado.id_empresa','=',Auth::user()->id_empresa)
        ->count();

        $count_indefinido=sexo_empleado::leftjoin('empleado','empleado.id_empleado','=','empleado_sexo.empleado_id_empleado')
        ->where('empleado_sexo.sexo_id','=',4)
        ->where('empleado.id_empresa','=',Auth::user()->id_empresa)
        ->count();

        $role_user=Role_users::where('user_id','=',Auth::user()->id)->first();
        // dd($role_user->role_id);
        $permisos=permisos_widget::where('role_id','=',$role_user->role_id)->first();


        // $usersChart = new UserChart;
        // $usersChart->labels(['Jan', 'Feb', 'Mar']);
        // $usersChart->dataset('Users by trimester', 'bar', [10, 25, 13]);
        // return view('users', [ 'usersChart' => $usersChart ] );

        return view('dashboard',compact('count_empleado','count_mujeres','data','count_hombres','count_indefinido','permisos','count_roles','count_puesto','count_users','count_pagos'))
        ->with('puesto',json_encode($puesto,JSON_NUMERIC_CHECK))
        ->with('data',json_encode($data,JSON_NUMERIC_CHECK))
        ->with('moth',json_encode($moth,JSON_NUMERIC_CHECK))
        // ->with('mothes',json_encode($mothes,JSON_NUMERIC_CHECK))
        // ->with('d',json_encode($dsta,JSON_NUMERIC_CHECK))
        ->with('puesto_empleado',json_encode($puesto_empleado,JSON_NUMERIC_CHECK));
    }




    

}
