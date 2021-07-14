<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Listado;
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
        // ->whereYear('fecha','>=',date('Y'))
        ->whereYear('fecha','>=',date('Y'))
        ->where('id_empresa',Auth::user()->id_empresa)
        ->where('estado',0)
        ->orderBy("fecha")
        ->groupBy(DB::raw("month(fecha)"))
        ->get();

        // $gasto->whereDate('empleado.created_at','>=',$start)->whereDate('empleado.created_at','<=',$end);

        $nominas = Listado::select(DB::raw("month(fecha) as moth"),DB::raw("SUM(monto) as count"))
        ->whereYear('fecha','>=',date('Y'))
        ->where('id_empresa',Auth::user()->id_empresa)
        ->where('estado',0)
        ->orderBy("fecha")
        ->groupBy(DB::raw("month(fecha)"))
        ->get();
        $mothes=array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        // $d=[0,0,0,0,0,0,0,0,0,0,0,0];
        $d=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $n=array(0,0,0,0,0,0,0,0,0,0,0,0);

        // $m=[];
        $i=0;
        $moth=[];
        $data=[];
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
                    $d[0]="$".$data[$i];
                    break;
                case 2:
                    $d[1]=$data[$i];
                    break;
                case 3:
                    $d[2]=$data[$i];
                    break;
                case 4:
                    $d[3]=$data[$i];
                    break;
                case 5:
                    
                    $d[4]=$data[$i];
                    break;
                case 6:
                    $d[5]=$data[$i];
                    break;
                case 7:
                    $d[6]=$data[$i];
                    break;
                case 8:
                    $d[7]=$data[$i];
                    break;
                case 9:
                    $d[8]=$data[$i];
                    break;
                case 10:
                    $d[9]=$data[$i];
                    break;
                case 11:
                    $d[10]=$data[$i];
                    break;
                case 12:
                    $d[11]=$data[$i];
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        $moth =[];  
        $data=[];
        $p=0;
        foreach($nominas as $nomina){
            $moth[$p]=(int)$nomina->moth;
            $data[$p]=$nomina->count;
            $p++;
        }
        $count=count($moth);
        
        for ($i=0; $i <$count; $i++) { 
            // dd($d);
            switch ($moth[$i]) {
                case 1:
                    $n[0]=$data[$i];
                    break;
                case 2:
                    $n[1]=$data[$i];
                    break;
                case 3:
                    $n[2]=$data[$i];
                    break;
                case 4:
                    $n[3]=$data[$i];
                    break;
                case 5:
                    
                    $n[4]=$data[$i];
                    break;
                case 6:
                    $n[5]=$data[$i];
                    break;
                case 7:
                    $n[6]=$data[$i];
                    break;
                case 8:
                    $n[7]=$data[$i];
                    break;
                case 9:
                    $n[8]=$data[$i];
                    break;
                case 10:
                    $n[9]=$data[$i];
                    break;
                case 11:
                    $n[10]=$data[$i];
                    break;
                case 12:
                    $n[11]=$data[$i];
                    break;
                
                default:
                    # code...
                    break;
            }
        }




        return Chartisan::build()
            ->labels($mothes)
            ->dataset('Gastos',$d)
            ->dataset('Nominas',$n);
            // ->dataset('Sample 2', [3, 2, 1]);
    }
}