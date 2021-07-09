<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategorias;
use App\Models\categorias_sub;

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

        $categoria = new categorias();
        $categoria->nombre=$nombre;
        $categoria->user=Auth::user()->name;
        $categoria->estado=0;
        $categoria->id_empresa=Auth::user()->id_empresa;
        $categoria->save();

        $arreglo=request('arreglo');

        if($arreglo!=""){
            for($i = 0; $i < count($arreglo); $i++){
                if(!empty(collect($arreglo)[$i])){
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
            $input['id_sub'] = $sub->id;
            $input['id_categorias'] = $categoria->id;
            $input['id_empresa'] = Auth::user()->id_empresa;
            $input['estado'] =0;
            $referencia=categorias_sub::create($input);
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
        $sub=SubCategorias::findOrFail($id);
        $sub->nombre=$name;
        $sub->update();

        $sub_g=categorias_sub::select('id_categorias')->where('id_sub','=',$id)->first();
        $subcategory=categorias_sub::select('id_sub')->where('id_categorias','=',$sub_g->id_categorias)->get();
        $arreglo=[];
        $p=0;
        
        foreach($subcategory as $sub_gs){
            $arreglo[$p]=$sub_gs->id_sub;
            $p++;
        }
        $sub=SubCategorias::whereIn('id',$arreglo)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->where('estado','=',0)
        ->where('estado','=',0)
        ->get();

        return view('Categorias.Plantillas.tableall',compact('sub'));
        
    }
    public function showsub($id)
    {
        $sub=SubCategorias::findOrFail($id);
        return view('Categorias.Modales.subupdate',compact('sub'));
    }
    public function showcategorias($id)
    {
        $categorias=categorias::findOrFail($id);
        $count=0;

        // $sub=SubCategorias::all();
        if(sizeof(categorias_sub::select('id_categorias')->where('id_categorias','=',$id)->get())!=0){
            $count=count(categorias_sub::select('id_categorias')->where('id_categorias','=',$id)->get());

        }
        $sub_g=categorias_sub::select('id_sub')->where('id_categorias','=',$id)->get();
        $arreglo=[];
        $p=0;
        
        foreach($sub_g as $sub_gs){
            $arreglo[$p]=$sub_gs->id_sub;
            $p++;
        }
        $sub=SubCategorias::whereIn('id',$arreglo)
        ->where('id_empresa','=',Auth::user()->id_empresa)
        ->where('estado','=',0)
        ->where('estado','=',0)
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
    public function savesub(Request $request,$id)
    {
        $name=request('name');
        $sub = new SubCategorias();
        $sub->nombre=$name;
        $sub->estado=0;
        $sub->id_empresa=Auth::user()->id_empresa;
        $sub->save();

        $sub_g= new categorias_sub();
        $sub_g->id_sub=$sub->id;
        $sub_g->id_categorias=$id;
        $sub_g->estado=0;
        $sub_g->id_empresa=Auth::user()->id_empresa;
        $sub_g->save();

        return view('Categorias.Plantillas.tablesub',compact('sub'));




    }
    public function showsubcategorias($id)
    {
        return view('Categorias.modales.subedit',compact('id'));
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
        ->select('categorias.id','categorias.nombre','categorias.user','categorias.created_at',DB::raw('count(categorias_sub.id_categorias) as gasto'))
        ->GroupBy('categorias.id','categorias.nombre','categorias.user','categorias.created_at');
       
            return datatables()->of($perfiles)
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d/m/Y');
                
            })->setRowAttr([
                'data-href'=>function($row){
                    return $row->id;    
                },
                'url'=>function($row){
                    return Route('Equipos.show',[$row->id]);
                },
                ])->toJson();
    }
}
