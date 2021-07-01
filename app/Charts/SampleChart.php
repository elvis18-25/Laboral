<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Gasto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $gasto = Gasto::select(DB::raw("SUM(monto) as count"))
        ->whereYear('fecha',date('Y'))
        ->where('id_empresa',Auth::user()->id_empresa)
        ->where('estado',0)
        ->orderBy("fecha")
        ->groupBy(DB::raw("Month(fecha)"))
        ->pluck('count');

        $moths=Gasto::select(DB::raw("Month(fecha) as month"))
        ->whereYear('fecha',date('Y'))
        ->where('id_empresa',Auth::user()->id_empresa)
        ->where('estado',0)
        ->orderBy("fecha")
        ->groupBy(DB::raw("Month(fecha)"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($moths as $index =>$moth)
        {
            $data=[$month]=$gasto[$index];
        }
        $datao=['1','2'];
        $data1=['12','13'];
        return Chartisan::build()
            ->labels(['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'])
            ->dataset('1', $data1)
            ->dataset('2', $data1);;
            // ->dataset('Sample 2', [3, 2, 1]);
    }
}