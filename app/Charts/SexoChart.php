<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\sexo_empleado;
use Illuminate\Support\Facades\Auth;

class SexoChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

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

        return Chartisan::build()
            ->labels(['Hombres', 'Mujeres', 'Indefinido'])
            ->dataset('Hombres', [$count_hombres,0,0])
            ->dataset('Mujeres', [$count_mujeres,0,0])
            ->dataset('Indefinido',[$count_indefinido,0,0]);
    }
}