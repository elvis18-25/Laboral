<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Puesto;
use Illuminate\Support\Facades\Auth;

class DepatamentoChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
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
        ->where('empleado.estado','=',0)
        ->where('puesto.id_empresa','=',Auth::user()->id_empresa)
        ->select('puesto.id',DB::raw('count(empleado_puesto.empleado_id_empleado) as emple',))
        ->groupBy('empleado_puesto.puesto_id','puesto.id')
        ->orderBy('puesto.id')
        ->get()->toArray();
        $puesto_empleado = array_column($puesto_empleado, 'emple');

        return Chartisan::build()
            ->labels($puesto)
            ->dataset('DEPARTAMENTOS',  $puesto_empleado);
  
    }
}