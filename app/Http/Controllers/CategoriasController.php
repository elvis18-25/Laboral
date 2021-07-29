<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategorias;
use App\Models\categorias_sub;
use App\Models\Empresa;
use App\Models\sub_subcategory;
use Barryvdh\DomPDF\Facade as PDF;
class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $nombre=request('name');
        $count=0;
        if(sizeof(categorias::select('id_category')->where('id_empresa','=',Auth::user()->id_empresa)->get())==0){
            $count=1;
        }else{
            $cate=categorias::latest('id_category')->where('id_empresa','=',Auth::user()->id_empresa)->first();
            $count=$cate->id_category+1;
        }

        $categoria = new categorias();
        $categoria->nombre=$nombre;
        $categoria->user=Auth::user()->name;
        $categoria->estado=0;
        $categoria->id_category=$count;
        $categoria->id_empresa=Auth::user()->id_empresa;
        $categoria->save();



        $arreglo=request('arreglo');
        $arreglocode=request('arreglocode');

        if($arreglo!=""){
            for($i = 0; $i < count($arreglo); $i++){
                if(!empty(collect($arreglo)[$i])){

                $input['id_subed'] =$arreglocode[$i];
                $input['nombre'] = $arreglo[$i];
                $input['id_empresa'] = Auth::user()->id_empresa;
                $input['estado'] =0;
                $referencia=SubCategorias::create($input);
            }  
            }  
        }

        if($arreglo!=""){
        for($i = 0; $i < count($arreglo); $i++){
            if(!empty(collect($arreglo)[$i])){
            $sub=SubCategorias::where('nombre','=',$arreglo[$i])->where('id_empresa','=',Auth::user()->id_empresa)->first();
            $inputs['id_sub'] = $sub->id;
            $inputs['id_categorias'] = $categoria->id_category.".".$arreglocode[$i];
            $inputs['padres'] = $categoria->id_category;
            $inputs['id_empresa'] = Auth::user()->id_empresa;
            $inputs['estado'] =0;
            $referencia=categorias_sub::create($inputs);
        }  
        }
    }  


        return $nombre;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }
    public function updatesub($id)
    {
        $name=request('name');
        $categori=request('select');
        $code=request('code');
        $category=request('category');
        $count=0;

        if(sizeof(categorias::select('id_category')->where('id_empresa','=',Auth::user()->id_empresa)->get())==0){
            $count=1;
        }else{
            $cate=categorias::latest('id_category')->where('id_empresa','=',Auth::user()->id_empresa)->first();
            $count=$cate->id_category+1;
        }

        if($category==0){
        $sub=SubCategorias::findOrFail($id);
        $sub->nombre=$name;
        $sub->id_subed=$code;
        $sub->update();

        $sub_g=categorias_sub::select('id')->where('id_sub','=',$id)->first();
        $subs=categorias_sub::findOrFail($sub_g->id);

        if(sizeof(categorias_sub::select('padres')->where('id_categorias','=',$categori)->where('id_empresa','=',Auth::user()->id_empresa)->get())==0){
            $conts=$categori;
        }else{
            $cont=categorias_sub::select('padres')->where('id_categorias','=',$categori)->where('id_empresa','=',Auth::user()->id_empresa)->first();
            $conts=$cont->padres;
        }
       
        $subs->id_categorias=$categori.".".$code;
        $subs->padres=$conts;
        $subs->update();
    }
        else{
        $categoria=new categorias();
        $categoria->nombre=$name;
        $categoria->user=Auth::user()->name;
        $categoria->estado=0;
        $categoria->id_empresa=Auth::user()->id_empresa;
        $categoria->id_category=$count; 
        $categoria->save();

        $sub_g=categorias_sub::select('id_categorias')->where('id_sub','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $sub_Categorias=SubCategorias::where('id_empresa','=',Auth::user()->id_empresa)
        ->where('estado','=',0)
        ->get();
        $sub_idsubed=categorias_sub::where('id_empresa','=',Auth::user()->id_empresa)->get();

        foreach($sub_Categorias as $sub_Categoria){
            foreach($sub_idsubed as $sub_idsubeds){
                if($sub_idsubeds->id_sub==$sub_Categoria->id){
                    $floot= floatval($sub_idsubeds->id_categorias);
                    if($floot==$sub_g->id_categorias){
                        $sub_idsubeds->id_categorias=$categoria->id_category.".". $sub_Categoria->id_subed;
                        $sub_idsubeds->padres=$categoria->id_category;
                        $sub_idsubeds->update();
                    }
                }
            }
            }
        }

        $sub_g=categorias_sub::select('id_sub')->where('padres','=',$id)->get();
        $arreglo=[];
        $p=0;
        
        foreach($sub_g as $sub_gs){
            $arreglo[$p]=$sub_gs->id_sub;
            $p++;
        }
        $sub=SubCategorias::leftjoin('categorias_sub','categorias_sub.id_sub','=','sub_categorias.id')
        ->whereIn('sub_categorias.id',$arreglo)
        ->where('sub_categorias.id_empresa','=',Auth::user()->id_empresa)
        ->where('sub_categorias.estado','=',0)
        ->orderBy('categorias_sub.id_categorias')
        ->select('sub_categorias.id as ides','sub_categorias.nombre','categorias_sub.id_categorias')
        ->get();
     

        return view('Categorias.Plantillas.tablesub',compact('sub'));
        
    }
    public function showsub($id)
    {
        $sub=SubCategorias::findOrFail($id);
        $categoria=categorias::where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        return view('Categorias.Modales.subupdate',compact('sub','categoria'));
    }
    public function showcategorias($id)
    {
        $categorias=categorias::findOrFail($id);
        $count=0;

        // $sub=SubCategorias::all();
        if(sizeof(categorias_sub::select('padres')->where('padres','=',$categorias->id_category)->get())!=0){
            $count=count(categorias_sub::select('padres')->where('padres','=',$categorias->id_category)->get());

        }
        $sub_g=categorias_sub::select('id_sub')->where('padres','=',$categorias->id_category)->get();
        $arreglo=[];
        $p=0;
        
        foreach($sub_g as $sub_gs){
            $arreglo[$p]=$sub_gs->id_sub;
            $p++;
        }
        $sub=SubCategorias::leftjoin('categorias_sub','categorias_sub.id_sub','=','sub_categorias.id')
        ->whereIn('sub_categorias.id',$arreglo)
        ->where('sub_categorias.id_empresa','=',Auth::user()->id_empresa)
        ->where('sub_categorias.estado','=',0)
        ->orderBy('categorias_sub.id_categorias')
        ->select('sub_categorias.id as ides','sub_categorias.nombre','categorias_sub.id_categorias')
        ->get();
        return view('Categorias.edit',compact('categorias','sub','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }
    public function updatecategorias(Request $request, $id)
    {
        $name=request('name');
        $categorias=categorias::findOrFail($id);
        $categorias->nombre=$name;
        $categorias->update();

        return 0;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function CatalogoPdf()
    {
        // $categorias=categorias::where('id_empresa','=',Auth::user()->id_empresa)->where('estado','=',0)->get();
        $categorias=categorias::where('estado','=',0)->where('id_empresa','=',Auth::user()->id_empresa)->get();
        $empresa=Empresa::findOrFail(Auth::user()->id_empresa);

        $pdf =PDF::loadView('Categorias.catalogo',compact('categorias','empresa'));
        $pdf->setPaper("A4", "portrait");
        return $pdf->stream('gastos.pdf');
        // return view('Categorias.catalogo',compact('categorias','sub_g','empresa'));
    }
    public function savesub(Request $request,$id)
    {
        $name=request('name');
        $pertenece=request('pertenece');
        $code=request('code');

        $sub = new SubCategorias();
        $sub->nombre=$name;
        $sub->estado=0;
        $sub->id_empresa=Auth::user()->id_empresa;
        $sub->id_subed=$code;
        $sub->save();
        $categorias=categorias::findOrFail($id);

        $sub_g= new categorias_sub();
        $sub_g->id_sub=$sub->id;
        $sub_g->id_categorias=$pertenece.".".$code;
        $sub_g->padres=$categorias->id_category;
        $sub_g->estado=0;
        $sub_g->id_empresa=Auth::user()->id_empresa;
        $sub_g->save();

        

        $subs=categorias_sub::select('id_sub')->where('padres','=', $categorias->id_category)->get();
        $arreglo=[];
        $p=0;
        
        foreach($subs as $subss){
            $arreglo[$p]=$subss->id_sub;
            $p++;
        }
        $sub=SubCategorias::leftjoin('categorias_sub','categorias_sub.id_sub','=','sub_categorias.id')
        ->whereIn('sub_categorias.id',$arreglo)
        ->where('sub_categorias.id_empresa','=',Auth::user()->id_empresa)
        ->where('sub_categorias.estado','=',0)
        ->orderBy('categorias_sub.id_categorias')
        ->get();
        

        return view('Categorias.Plantillas.tablesub',compact('sub','pertenece'));
        // return $code;




    }
    public function showsubcategorias($id)
    {

        $categorias=categorias::findOrFail($id);
        $count=0;

        $sub_g=categorias_sub::select('id_sub')->where('padres','=', $categorias->id_category)->get();
        $arreglo=[];
        $p=0;
        
        foreach($sub_g as $sub_gs){
            $arreglo[$p]=$sub_gs->id_sub;
            $p++;
        }
        $sub=SubCategorias::leftjoin('categorias_sub','categorias_sub.id_sub','=','sub_categorias.id')
        ->whereIn('sub_categorias.id',$arreglo)
        ->where('sub_categorias.id_empresa','=',Auth::user()->id_empresa)
        ->where('sub_categorias.estado','=',0)
        ->orderBy('categorias_sub.id_categorias')
        ->get();

        
        return view('Categorias.Modales.subedit',compact('id','categorias','sub'));
    }
    public function deletecategorias($id)
    {
        $categorias=categorias::findOrFail($id);
        $categorias->estado=1;
        $categorias->update();

        return 0;
    }
    public function deletesubcategory($id)
    {
        $categorias=SubCategorias::findOrFail($id);
        $categorias->estado=1;
        $categorias->update();

        $sub=categorias_sub::where('id_sub','=',$id)->where('id_empresa','=',Auth::user()->id_empresa)->first();
        $sub->delete();

        return 0;
    }

    public function datatableCategorias()
    {
        $perfiles=categorias::leftjoin('categorias_gastos','categorias_gastos.id_categorias','=','categorias.id')
        ->leftjoin('categorias_sub','categorias_sub.id_categorias','=','categorias.id')
        ->where('categorias.id_empresa',Auth::user()->id_empresa)
        ->where('categorias.estado','=',0)
        ->select('categorias.id','categorias.nombre','categorias.id_category','categorias.user','categorias.created_at')
        ->GroupBy('categorias.id','categorias.nombre','categorias.id_category','categorias.user','categorias.created_at');
       
            return datatables()->of($perfiles)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })
            ->editColumn('count',function($row){
                $sub=categorias_sub::where('padres','=',$row->id_category)->where('id_empresa','=',Auth::user()->id_empresa)->get();
                $p=0;
                foreach($sub as $subs){
                    $p++;
                }
                return $p;
                
            })
            ->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'url'=>function($row){
                    return Route('Equipos.show',[$row->id]);
                },
                ])->toJson();
    }
}
