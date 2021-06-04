<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

class MultiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Multi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    public function MultiEmpresa(Request $request)
    {
        // dd($request->all());
        $all=$request->all();
        $user=User::where('email','=',$request->get('email'))->get();
        if(sizeof(User::where('email','=',$request->get('email'))->get())>1){
            $empresa=Empresa::where('estado','=',0)->get();
            return view('Multi.index',compact('user','empresa'));
        }else{
            $objeto = new LoginController();
            $myVariable = $objeto->authenticate($request);
            return redirect('/home');
           
        }
        
    }

    public function SeleccionEmpresa(Request $request)
    {
        
        $objeto = new LoginController();
        $myVariable = $objeto->authenticate2($request);
        return redirect('/home');

     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
