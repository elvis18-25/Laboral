<?php

namespace App\Http\Controllers;

use App\Events\FormSubmited;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessegeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function send()
    {
        return view('Messeges.index');
    }
    public function showMesseges()
    {
        return view('Messeges.sender');
    }
    public function sender(Request $request)
    {
    
        // $text=$request->get('image');
        $file = $request->image;
        // dd($request->all());
        $file->move(public_path().'/recibo',$file->getClientOriginalName());
        $name=$file->getClientOriginalName();

        event(new FormSubmited($name));
        $user=User::where('id_empresa','=',Auth::user()->id_empresa)->Where('email','=',Auth::user()->email)->first();
        $myVariable =Auth::logout($user);
        return redirect('/');


    }
    public function phoneblade($id)
    {
        $users=User::findOrFail($id);
        $user=User::where('id_empresa','=',$users->id_empresa)->Where('email','=',$users->email)->first();
       
        $myVariable =Auth::login($user);
        // dd( $myVariable);
        // return redirect('/home');
        return view('Gastos.phone');
    }
}
