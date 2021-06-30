<?php

namespace App\Charts;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Listado;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends BaseChart
{
    // public ?string $routeName = 'chart_route_name';
    /**
     * Initializes the chart.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }
    // public ?array $middlewares = ['auth'];

    public function handler(Request $request): Chartisan
    {


        return Chartisan::build()
            ->labels(['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'])
            ->dataset('GASTOS', [5,6,10])
            ->dataset('NOMINAS', [3, 2, 1]);
    }

}
