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
        $gasto = Gasto::select(DB::raw("month(fecha) as moth"),DB::raw("SUM(monto) as count"))
        ->where('id_empresa',Auth::user()->id_empresa)
        ->where('estado',0)
        ->orderBy("fecha")
        ->groupBy(DB::raw("month(fecha)"))
        ->get();
        $mothes=['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $d=[0,0,0,0,0,0,0,0,0,0,0,0];
        $moth =[];  
        $data=[];
        // $m=[];
        $i=0;
        $p=0;
        foreach($gasto as $gastos){
            $moth[$i]=(int)$gastos->moth;
            $data[$i]=$gastos->count;
            $i++;
        }
        
        $count=count($moth);
        
        for ($i=0; $i <$count; $i++) { 
            // dd($d);
            switch ($moth[$i]) {
                case 1:
                    $d[0]=$data[$i];
                    break;
                case 2:
                    $d[1]=$data[$i];
                    break;
                case 3:
                    $d[2]=$data[$i];
                    break;
                case 4:
                    $d[3]=$data[3];
                    break;
                case 5:
                    
                    $d[4]=$data[$i];
                    break;
                case 6:
                    $d[5]=$data[$i];
                    break;
                case 7:
                    $d[6]=$data[6];
                    break;
                case 8:
                    $d[7]=$data[7];
                    break;
                case 9:
                    $d[8]=$data[8];
                    break;
                case 10:
                    $d[9]=$data[9];
                    break;
                case 11:
                    $d[10]=$data[10];
                    break;
                case 12:
                    $d[11]=$data[11];
                    break;
                
                default:
                    # code...
                    break;
            }
        }


        // for ($i=1; $i < 13; $i++) { 
        //     if($moth[$p]==$i){
        //     $mothes[$i]=$m[$i];
        //     $dates[$i]=$data[$p]; 
        //         $p++;
        //     }else{
        //     $mothes[$i]=$m[$i];  
        //     $dates[$i]=0;  
        //     }
        // }


        return Chartisan::build()
            ->labels(['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'])
            ->dataset('Gastos', [$d]);
            // ->dataset('Sample 2', [3, 2, 1]);
    }
}