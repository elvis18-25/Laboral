<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;



class EmpleadosCharts extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $count_empleado=Empleado::where('id_empresa',Auth::user()->id_empresa)->where('estado',0)->count();
        $count=[];
        $count2=[];
        $count3=[];
        $p=0;
        $count[$p]=$count_empleado;
        $p++;
        $count[$p]=0;
        $p++;
        $count[$p]=0;

        

        return Chartisan::build()
            ->labels(['Activos','Vacaciones','Licencia'])
            ->dataset('EMPLEADOS',  $count);
    }
}