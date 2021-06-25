<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Concepto_gasto;
use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\Listado;
use Illuminate\Support\Facades\Auth;
use App\Models\gasto_fijo;
use App\Models\Perfiles;
use App\Models\Perfiles_empleado;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use App\Models\gasto_nomina;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gasto=Gasto::all();
        return view('Gastos.index',compact('gasto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nominas=Listado::where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $gasto=gasto_fijo::all();
        return view('Gastos.create',compact('nominas','gasto'));
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

        $strings=implode(",",$request->get('elimiarrelgo'));
        $concp=implode(",", $request->get('concepter'));
        $monter=implode(",", $request->get('monter'));
        // $nomi=implode(",", $request->get('arreglo'));

        $concepArry=explode(",", $concp);
        $monterpArry=explode(",", $monter);
        $nomipArry=explode(",", $request->get('arreglo'));
        
        // dd( $nomipArry);
        $array = explode(",", $strings);
        // dd("llego");
        $n=count($array);
        $fijo=gasto_fijo::whereNotIn('id',$array)->get();

        $nomina=Listado::whereIn('id',$nomipArry)->get();






        $gasto=new Gasto();
        $gasto->descripcion=$request->get('descripn');
        $gasto->fecha=$request->get('fec');
        $gasto->monto=$request->get('total');
        $gasto->observaciones=$request->get('textarea');
        $gasto->id_empresa=Auth::user()->id_empresa;
        $gasto->user=Auth::user()->name;
        $gasto->estado=0;
        $gasto->save();

        foreach($nomina as $nominas){
            $input['id_gasto']=$gasto->id;
            $input['id_nomina'] = $nominas->id;
            $input['descripcion'] = $nominas->descripcion;
            $input['monto'] = $nominas->monto;
            $input['id_empresa'] = Auth::user()->id_empresa;
            $input['estado'] =0;
            $referencia=gasto_nomina::create($input);
        }

        $i=0;
        if($request->get('concepter')!=''){
            for($i = 0; $i < count($concepArry); $i++){
                if(!empty(collect($concepArry)[$i])){
                $input['id_gasto']=$gasto->id;
                $input['concepto'] = $concepArry[$i];
                $input['monto'] = $monterpArry[$i];
                $input['id_empresa'] = Auth::user()->id_empresa;
                $input['estado'] =0;
                $referencia=concepto_gasto::create($input);
            }  
            }   
        }
        foreach($fijo as $fijos){
        if($fijos->id_empresa==Auth::user()->id_empresa &&$fijos->estado==0){
            $input['id_gasto']=$gasto->id;
            $input['concepto'] = $fijos->concepto; 
            $input['monto'] = $fijos->monto; 
            $input['id_empresa'] = Auth::user()->id_empresa;
            $input['estado'] =0;
            $referencia=concepto_gasto::create($input);
           }
        }




        return redirect('Gasto')->with('guardar','ya');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function totalgastoConcepto($id)
    {
        $gasto=Gasto::findOrFail($id);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $totalconcepto=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){

            if($gasto->id==$conceptos->id_gasto){
                $totalconcepto+=$conceptos->monto;

            }
        }
    }

    return $totalconcepto;
    }
    public function totalgastoFijo($id)
    {
        $gasto=Gasto::findOrFail($id);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->where('estado','=',0)->get();

        // dd($concepto);
        // $fijo=gasto_fijo::whereNotIn('id',$array)->get();
        $totalconcepto=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){

            if($gasto->id==$conceptos->id_gasto){
                $totalconcepto+=$conceptos->monto;

            }
        }
        
        }
        $totalfijo=0;
        foreach($gastofijos as $gastofijo){
            if($gasto->id==$gastofijo->id_gasto){
                $totalfijo+=$gastofijo->monto;

            }
        }



    return $totalfijo;

    }
    public function show($id)
    {
        $gasto=Gasto::findOrFail($id);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->get();

        // dd($concepto);
        // $fijo=gasto_fijo::whereNotIn('id',$array)->get();
        $totalconcepto=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){

            if($gasto->id==$conceptos->id_gasto){
                $totalconcepto+=$conceptos->monto;

            }
        }
        
        }
        $totalfijo=0;
        foreach($gastofijos as $gastofijo){
            if($gasto->id==$gastofijo->id_gasto){
                $totalfijo+=$gastofijo->monto;

            }
        }

        

        $total=0;
        foreach($concepto as $concep){
            if($gasto->id==$concep->id_gasto){
                $total+=$concep->monto;

            }
        }
        $totalmonto=$gasto->monto-$total;


        $arraynomina=[];
        $b=0;
        $gasto_nomina=gasto_nomina::where('id_gasto','=',$id)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();

        foreach($gasto_nomina as $gasto_nominas){
            $arraynomina[$b]=$gasto_nominas->id_nomina;
            $b++;
    }

        $nominas=Listado::whereNotIn('id',$arraynomina)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();

        

        return view('Gastos.show',compact('gasto','totalconcepto','concepto','nominas','totalmonto','gastofijos','totalfijo','gasto_nomina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refreshSelect($id)
    {
        $arraynomina=[];
        $b=0;
        $gasto_nomina=gasto_nomina::where('id_gasto','=',$id)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();

        foreach($gasto_nomina as $gasto_nominas){
            $arraynomina[$b]=$gasto_nominas->id_nomina;
            $b++;
    }

    $nominas=Listado::whereNotIn('id',$arraynomina)
    ->where('estado','=',0)
    ->where('id_empresa','=',Auth::user()->id_empresa)
    ->get();
    
    return view('Gastos.Plantillas.refresh',compact('nominas'));
}

    public function refreshSelectCreate()
    {
        $arraynomina=request('e');
        
    
        $nominas=Listado::whereNotIn('id',$arraynomina)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();
        
        return view('Gastos.Plantillas.refresh',compact('nominas'));
        // return $arraynomina;
    }
    public function edit($id)
    {
        //
    }
    public function listmonto($id)
    {
        $nominaDescr=Listado::findOrFail($id);
        $gasto=request('id');

        if(sizeof(gasto_nomina::where('id_gasto','=',$gasto)->where('id_nomina','=',$id)->get())==0){
            $gasto_nomina= new gasto_nomina();
            $gasto_nomina->id_gasto=$gasto;
            $gasto_nomina->id_nomina=$id;
            $gasto_nomina->monto=$nominaDescr->monto;
            $gasto_nomina->descripcion=$nominaDescr->descripcion;
            $gasto_nomina->estado=0;
            $gasto_nomina->id_empresa=Auth::user()->id_empresa;
            $gasto_nomina->save();
        }else{
            $nominas_Gast=gasto_nomina::where('id_gasto','=',$gasto)
            ->where('id_nomina','=',$id)
            ->where('id_empresa','=',Auth::user()->id_empresa)
            ->first();
            if($nominas_Gast->estado==1){
                $nominas_Gast->estado=0;
            }
            $nominas_Gast->update();
        }

        $nominas=gasto_nomina::where('id_gasto','=',$gasto)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();
    
         return view("Gastos.lista",compact('nominas'));
        
    }
    public function listmontoCreate($id)
    {
        $nomina=Listado::findOrFail($id);
         return view("Gastos.Plantillas.lista",compact('nomina'));
        
    }
    public function totalnomina($id)
    {
        $gasto_nomina=gasto_nomina::where('id_gasto','=',$id)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();
        $totalnomina=0;

        foreach($gasto_nomina as $gasto_nominas){
            $totalnomina= $totalnomina+$gasto_nominas->monto;
        }

        return $totalnomina;

    
         return view("Gastos.lista",compact('nominas','nominaDescr'));
        
    }


    public function eliminarnomina($id,Request $request)
    {
        $idgasto=request('id');

        $gasto_nomina=gasto_nomina::where('id_nomina','=',$id)
        ->where('id_gasto','=',$idgasto)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->first();

        $gasto_nomina->estado=1;
        $gasto_nomina->update();

        $nominas=gasto_nomina::where('id_gasto','=',$idgasto)
        ->where('estado','=',0)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->get();
       
        return view("Gastos.lista",compact('nominas'));
        
    }
    public function vernomina($id)
    {
        $nomina=Listado::findOrFail($id);
        $perfiles=Perfiles_empleado::select('id')->where('id','=', $nomina->id_perfiles)->first();
        $perf=$perfiles->id;
        return view('Gastos.listamodal',compact('perf','nomina'));
        
    }
    public function vernominaCreate($id)
    {
        $nomina=Listado::findOrFail($id);
        $perfiles=Perfiles_empleado::select('id')->where('id','=', $nomina->id_perfiles)->first();
        $perf=$perfiles->id;
        return view('Gastos.listamodalCreate',compact('perf','nomina'));
        
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

        $gasto=Gasto::findOrFail($id);
        $gasto->descripcion=$request->get('descripn');
        $gasto->fecha=$request->get('fec');
        $gasto->monto=$request->get('total');
        $gasto->user=Auth::user()->name;
        $gasto->observaciones=$request->get('textarea');
        $gasto->update();



        return redirect('Gasto')->with('actualizar','ya');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $gasto=Gasto::findOrFail($id);
       $gasto->estado=1;
       $gasto->save();

       return redirect('Gasto')->with('eliminado','ya');

    }
    public function GastosFijo()
    {
        return view('Gastos.fijo');

    }
    public function modalcreatefijo()
    {
        return view('Gastos.modalcreatefijo');

    }
    public function modalcreateedit($id)
    {
        $gasto=Gasto::findOrFail($id);
        $concepto=concepto_gasto::all();

        $data=[];
        $i=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
                if($gasto->id==$conceptos->id_gasto){
                $data[$i]=$conceptos->concepto;
                $i++;
            }
        }
        }
        $gastofijos=gasto_fijo::whereNotIn('concepto',$data)->get();
        // $gastofijos=gasto_fijo::all();
        return view('Gastos.modalfijoscreateR',compact('gastofijos','gasto'));

    }
    public function deletegasto($id)
    {
        $gasto=gasto_fijo::findOrFail($id);
        $gasto->estado=1;
        $gasto->save();
 

    }
    public function totalgasto()
    {
        $sum=0;
        $gasto=gasto_fijo::all();
        

        foreach($gasto as $gast){
            if($gast->id_empresa==Auth::user()->id_empresa &&$gast->estado==0){
                if($gast->estado==0){
                $sum=$sum+$gast->monto;
            }
        }
        }
        return $sum;

    }
    public function totalgastoshow($id)
    {
        $sum=0;
        $monto=0;
        $gasto=Gasto::findOrFail($id);
        $concepto=concepto_gasto::all();
        if($gasto->id_nomina!=0){
            $nomina=Listado::where('id','=',$gasto->id_nomina)->first();
            $monto=$nomina->monto;
        }

        foreach($concepto as $conceptos){
            if($conceptos->id_empresa==Auth::user()->id_empresa && $conceptos->id_gasto==$gasto->id && $conceptos->estado==0) {
                if($conceptos->estado==0){
                $sum=$sum+$conceptos->monto;
            }
        }
        }
        return $sum+$monto;

    }
    public function Gastossavefijo($id,Request $Request)
    {
        
        $concep=request('name');
        $monto=request('monto');
        $sele=request('elegir');
        $verificateGastoFijo=gasto_fijo::all();


        $p=0;
        foreach($verificateGastoFijo as $verificateGastoFijos){
            if($verificateGastoFijos->id_empresa==Auth::user()->id_empresa && $verificateGastoFijos->estado==0) {
            if($verificateGastoFijos->concepto==$concep){
                $p=1;
            }
        }
        }

        if($sele!=0){
            $gasto=gasto_fijo::findOrFail($sele);
            $concept=new concepto_gasto();
            $concept->id_gasto=$id;
            $concept->concepto=$gasto->concepto;
            $concept->monto=$gasto->monto;
            $concept->estado=0;
            $concept->id_empresa=Auth::user()->id_empresa;
            $concept->save();

            $gasto=Gasto::findOrFail($id);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->get();

         return view('Gastos.updategasto',compact('gastofijos','p','gasto'));

        }else{

            if($p==0){
            $gasto=new gasto_fijo();
            $gasto->concepto=$concep;
            $gasto->monto=$monto;
            $gasto->estado=0;
            $gasto->id_empresa=Auth::user()->id_empresa;
            $gasto->save();

            $concept=new concepto_gasto();
            $concept->id_gasto=$id;
            $concept->concepto=$gasto->concepto;
            $concept->monto=$gasto->monto;
            $concept->estado=0;
            $concept->id_empresa=Auth::user()->id_empresa;
            $concept->save();

                    $gasto=Gasto::findOrFail($id);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->get();

         return view('Gastos.updategasto',compact('gastofijos','p','gasto'));
            }else{
                return 0;
            }
        }


    }
    public function saveconconcepto($id,Request $Request)
    {

        $gastos=Gasto::findOrFail($id);
        $concep=request('concepto');
        $monto=request('monto');

        $verificateGastoFijo=gasto_fijo::all();
        $p=0;
        foreach($verificateGastoFijo as $verificateGastoFijos){
            if($verificateGastoFijos->id_empresa==Auth::user()->id_empresa && $verificateGastoFijos->estado==0) {
            if($verificateGastoFijos->concepto==$concep){
                $p=1;
            }
        }
        }

        if($p==0){
            
            $gasto=new concepto_gasto();
            $gasto->id_gasto=$id;
            $gasto->concepto=$concep;
            $gasto->monto=$monto;
            $gasto->estado=0;
            $gasto->id_empresa=Auth::user()->id_empresa;
            $gasto->save();

            $gasto=Gasto::findOrFail($id);
            $gastofijos=gasto_fijo::all();
            $array=[];
            $array2=[];
            
            $i=0;
            foreach($gastofijos as $gastofijo){
                if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
                $array[$i]=$gastofijo->concepto;
                $i++;
            }
         }
            
            $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();
    
    
             return view('Gastos.Plantillas.updateconcept',compact('concepto','gasto'));
        }else{
            return 0;
        }




    }


    public function datatableconcept()
    {
        if(request()->ajax()){
            $tipo=request()->get('dato1');
        $gastos=concepto_gasto::leftjoin( 'gasto','gasto.id','=','conceptos_gastos.id_gasto')
        ->leftjoin( 'gastos_fijo','gastos_fijo.concepto','=','conceptos_gastos.concepto')
        // ->where('conceptos_gastos.concepto','=','gastos_fijo.id')
        ->where('conceptos_gastos.id_empresa','=',Auth::user()->id_empresa)
        ->where('conceptos_gastos.estado','=','0')
        ->select('conceptos_gastos.id','conceptos_gastos.nomina','conceptos_gastos.concepto','conceptos_gastos.monto')
        ->GroupBy('conceptos_gastos.id','conceptos_gastos.nomina','conceptos_gastos.concepto','conceptos_gastos.monto');
       
        if(!empty($tipo)){
            $gastos->where('gasto.id',$tipo);

        }else{
            // $gastos->where('perfiles.id_perfiles',27);

            $gastos= $gastos->whereNull('conceptos_gastos.id_gasto');

        }
        
            return datatables()->of($gastos)
            ->editColumn('monto',function($row){
                $gast=gasto_fijo::all();

                foreach($gast as $gastoses){
                    if($gastoses->concepto == $row->concepto){
                        return '$'.number_format($row->monto,2);
                    }
                }

            })
            ->editColumn('concepto',function($row){
                $gast=gasto_fijo::all();

                foreach($gast as $gastoses){
                    if($gastoses->concepto == $row->concepto){
                        return $row->concepto;
                    }
                }
                
            })
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'nomi'=>function($row){
                    if($row->nomina!=null){
                        return $row->nomina;    
                    }else{
                        return 0;
                    }
                }

                
                ])->toJson();
            }
    }
    public function  datatablegastos()
    {
        $gastos=gasto_fijo::
        where('gastos_fijo.id_empresa',Auth::user()->id_empresa)
        ->where('gastos_fijo.estado','!=','1')
        ->select('gastos_fijo.id','gastos_fijo.concepto','gastos_fijo.monto')
        ->GroupBy('gastos_fijo.id','gastos_fijo.concepto','gastos_fijo.monto');
       
            return datatables()->of($gastos)
            ->editColumn('monto',function($row){
                return '$'.number_format($row->monto,2);
                
            })
            
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                
                ])->toJson();
    }
    // public function  datatablegastosshowfijo()
    // {
    //     $gastos=concepto_gasto::
    //     where('concepto_gasto.id_empresa',Auth::user()->id_empresa)
    //     ->where('concepto_gasto.estado','!=','1')
    //     ->select('concepto_gasto.id','concepto_gasto.concepto','concepto_gasto.monto')
    //     ->GroupBy('concepto_gasto.id','concepto_gasto.concepto','concepto_gasto.monto');
       
    //         return datatables()->of($gastos)
    //         ->editColumn('monto',function($row){
    //         return '$'.number_format($row->monto,2);

                
    //         })

    //         ->setRowAttr([
    //             'data-href'=>function($row){
    //                 return $row->id;    
    //             },
                
    //             ])->toJson();
    // }
    

    public function phoneblade()
    {
        return view('Gastos.phone');
    }
    public function savephone(Request $request)
    {
        dd($request->all());
        $file=$request->image;
         
    }
    public function conceptelimini($id,Request $request)
    {
        $concepto=concepto_gasto::findOrFail($id);
        $concepto->estado=1;
        $concepto->save();
         
    }
    public function deleteconceptFijo($id,Request $request)
    {
        $concepto=concepto_gasto::findOrFail($id);
        $concepto->estado=1;
        $concepto->save();
        $gasto_fijo=request('gasto');


        $gasto=Gasto::findOrFail($gasto_fijo);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->get();

        return view('Gastos.updategasto',compact('gastofijos','p','gasto'));


    }
    public function deleteconcept($id,Request $request)
    {
        $concepto=concepto_gasto::findOrFail($id);
        $concepto->estado=1;
        $concepto->save();
        $gasto_fijo=request('gasto');


        $gasto=Gasto::findOrFail($gasto_fijo);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->get();

        return view('Gastos.Plantillas.updateconcept',compact('concepto','gasto'));
    }
    public function buscarnomina($id,Request $request)
    {
        $concepto=gasto_fijo::findOrFail($id);
        $concepto->estado=1;
        $concepto->save();

        return $concepto->id;
    }
    public function modalfijo($id,Request $request)
    {
        $concepto=gasto_fijo::findOrFail($id);
        return view('Gastos.modalfijo',compact('concepto'));
         
    }
    public function saveGastosfijo($id,Request $request)
    {

        $concep=request('name');
        $monto=request('monto');

        $gasto=new gasto_fijo();
        $gasto->concepto=$concep;
        $gasto->monto=$monto;
        $gasto->estado=0;
        $gasto->id_empresa=Auth::user()->id_empresa;
        $gasto->save();

        $concepto=new Concepto_gasto();
        $concepto->concepto=$concep;
        $concepto->id_gasto=$id;
        $concepto->monto=$monto;
        $concepto->estado=0;
        $concepto->id_empresa=Auth::user()->id_empresa;
        $concepto->save();

        return view('Gastos.Plantillas.Pmodalfijo',compact('concepto'));



         
    }
    public function saveFijos(Request $request)
    {

        $concep=request('conce');
        $monto=request('monto');

        $gasto=new gasto_fijo();
        $gasto->concepto=$concep;
        $gasto->monto=$monto;
        $gasto->estado=0;
        $gasto->id_empresa=Auth::user()->id_empresa;
        $gasto->save();

         
    }
    // public function Vernomina($id)
    // {
    //     $concepto=gasto_fijo::findOrFail($id);
    //     return view('Gastos.modalfijo',compact('concepto'));
         
    // }
    public function modalshowmodificar($id,Request $request)
    {
        $concepto=Concepto_gasto::findOrFail($id);
        return view('Gastos.modalshow',compact('concepto'));
         
    }
    public function modalmodificarFijo($id,Request $request)
    {
        $concepto=Concepto_gasto::findOrFail($id);
        return view('Gastos.modalmodificarFijo',compact('concepto'));
         
    }
    public function modalmodificar($id,Request $request)
    {
        $concepto=Concepto_gasto::findOrFail($id);
        return view('Gastos.modalmo',compact('concepto'));
         
    }
    public function updateconcept($id,Request $request)
    {
        $concepto=Concepto_gasto::findOrFail($id);
        $nombre=request('name');
        $monto=request('monto');
        $gasto_fijo=request('gasto');

         $concepto->concepto=$nombre;
         $concepto->monto=$monto;
         $concepto->update();

         $gasto=Gasto::findOrFail($gasto_fijo);
         $gastofijos=gasto_fijo::all();
         $array=[];
         $array2=[];
         
         $i=0;
         foreach($gastofijos as $gastofijo){
             if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
             $array[$i]=$gastofijo->concepto;
             $i++;
         }
      }
         
         $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();
 
 
          return view('Gastos.Plantillas.updateconcept',compact('concepto','gasto'));

    }
    public function updateconceptFijo($id,Request $request)
    {
        $concepto=Concepto_gasto::findOrFail($id);
        $nombre=request('name');
        $monto=request('monto');
        $gasto_fijo=request('gasto');

        $concepto->concepto=$nombre;
        $concepto->monto=$monto;
        $concepto->update();

        $gasto=Gasto::findOrFail($gasto_fijo);
        $gastofijos=gasto_fijo::all();
        $array=[];
        $array2=[];
        
        $i=0;
        foreach($gastofijos as $gastofijo){
            if($gastofijo->estado==0 && $gastofijo->id_empresa==Auth::user()->id_empresa){
            $array[$i]=$gastofijo->concepto;
            $i++;
        }
     }
        
        $concepto=concepto_gasto::whereNotIn('concepto',$array)->get();

        $p=0;
        foreach($concepto as $conceptos){
            if($conceptos->estado==0 && $conceptos->id_empresa==Auth::user()->id_empresa){
            $array2[$p]=$conceptos->concepto;
            $p++;
        }
    }
        
        $gastofijos=concepto_gasto::whereNotIn('concepto',$array2)->get();

         return view('Gastos.updategasto',compact('gastofijos','p','gasto'));


    }
    public function updateconceptedit($id,Request $request)
    {
        $concepto=Concepto_gasto::findOrFail($id);
        $nombre=request('name');
        $monto=request('monto');

         $concepto->concepto=$nombre;
         $concepto->monto=$monto;
         $concepto->update();

         return 0;
    }
    public function updategastoFijos($id,Request $request)
    {
        $concepto=gasto_fijo::findOrFail($id);
        $nombre=request('name');
        $monto=request('monto');

         $concepto->concepto=$nombre;
         $concepto->monto=$monto;
         $concepto->update();

         return 0;
    }

    // public function observacion($id,Request $request)
    // {
    //     $nombre=request('name');
    //     $gastos=Gasto::findOrFail($id);
    //     if( $gastos->observaciones!=null){
    //         $gastos->observaciones=$nombre;
    //         $gastos->save();
    //     }else{
    //      $gastos->observaciones=$nombre;
    //      $gastos->save();
    //     }

    //      return $gastos->observaciones;
    // }
    // public function buscarobs($id,Request $request)
    // {
    //     $gastos=Gasto::findOrFail($id);
    //      return $gastos->observaciones;
    // }

    public function listadopdfgasto($id)
    {
  
      $concepto=Concepto_gasto::where('id_gasto','=',$id)->get();
      $gasto=Gasto::findOrFail($id);
    $fecha=Carbon::now();
    $idempresa=Auth::user()->id_empresa;
    $empresa=Empresa::findOrFail($idempresa);

    $nominas=gasto_nomina::where('id_gasto','=',$id)
    ->where('estado','=',0)
    ->where('id_empresa','=',Auth::user()->id_empresa)
    ->get();
    // $empresa=Empresa::all();

  
      $pdf =PDF::loadView('Gastos.recibo',compact('fecha','nominas','concepto','gasto','empresa'));
      $pdf->setPaper("A4", "portrait");
      return $pdf->stream('gastos.pdf');
    }
    public function donwloadgasto($id)
    {
  
      $concepto=Concepto_gasto::where('id_gasto','=',$id)->get();
      $gasto=Gasto::findOrFail($id);
    $fecha=Carbon::now();
    $idempresa=Auth::user()->id_empresa;
    $empresa=Empresa::findOrFail($idempresa);
    // $empresa=Empresa::all();
    $nominas=gasto_nomina::where('id','=',$gasto->id_nomina)
    ->where('estado','=',0)
    ->where('id_empresa','=',Auth::user()->id_empresa)
    ->get();

  
      $pdf =PDF::loadView('Gastos.recibo',compact('fecha','nominas','concepto','gasto','empresa'));
      $pdf->setPaper("letter", "portrait");
      return $pdf->download($gasto->descripcion.'.pdf');
    }

}
