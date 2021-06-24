<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Pagos;
use App\Models\Pais;
use App\Models\Puesto;
use App\Models\Sexo;
use Illuminate\Support\Facades\Auth;
use App\Models\asignaciones_user;
use App\Models\ciudades_user;
use App\Models\isr_user;
use App\Models\paises_user;
use App\Models\referencias_user;
use App\Models\Role;
use App\Models\state_user;
use App\Models\Contrato;
use App\Models\adjunto_user;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Equipos;
use App\Models\equipos_users;
use App\Models\Permisos;
use App\Models\Role_users;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $puesto=Puesto::all();
        $empresa=Empresa::select('id')->where('id','=',Auth::user()->id_empresa)->first();
        // dd($empresa);
        $empre=$empresa->id;

        $role=Role_users::where('user_id','=',Auth::user()->id)->first();
        $permisos=Permisos::where('role_id','=',$role->role_id)->first();
        return view('users.index',compact('users','puesto','empre','permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function create()
    {
        $pago=Pagos::all();
        $puesto=Puesto::all();
        $asignaciones=Asignaciones::all();
        $sexo=Sexo::all();
        $pais=Pais::select('id','name')->orderBy('name')->get();
        $roles=Role::all();
        $equipo=Equipos::all();

        return view('users.create',compact('pago','equipo','puesto','asignaciones','pais','sexo','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->all();
        // dd($inputs);

        if($request->get('checkasgina')!=''){

            $size = count(collect($request)->get('checkasgina'));
        }
        $user=User::create($inputs);
        $empresa=Empresa::select('id')->where('id','=',Auth::user()->id_empresa)->first();

        $user->password=bcrypt(($user->cedula));
        $user->estado=0;
        if($request->get('imagen')!=null){
            $user->imagen=$request->get('imagen');
        }
        $user->id_empresa=$empresa->id;
        $user->entrada=$request->get('entrada');
        $user->horas=$request->get('horas');
        $user->save();

        // if($request->get('checkasgina')!=''){
        //     for($i = 0; $i <= $size; $i++){
        //         if(!empty(collect($request)->get('checkasgina')[$i])){
        //           $input2['id_user']=$user->id;
        //           $input2['asignaciones_id']=$request->get('checkasgina')[$i];
        //           $input2['id_empresa'] =$empresa->id;
        //           if($request->get('checkasgina')[$i]==6){
        //            $input2['monto'] = $request->get('AFP');
        //           }
        //           if($request->get('checkasgina')[$i]==7){
        //            $input2['monto'] = $request->get('SFS');
        //           }
        //           $oneswui=asignaciones_user::create($input2);
        //         }
        //     }  
        // }


                if($request->get('grupo')!=null){
                    $equipos= new equipos_users();
                    $equipos->id_users=$user->id;
                    $equipos->equipo=$request->get('grupo');
                    $equipos->estado=0;
                    $equipos->id_empresa=Auth::user()->id_empresa;
                    $equipos->save();
                    }

                  //Pais
                  if(!empty($request->get('pais'))){
                    $pais= new paises_user();
                    $pais->user_id=$user->id;
                    $pais->pais=$request->get('pais');
                    $pais->id_empresa=$empresa->id;
                    $pais->save();
                  }  

                  //ciudad
                  if(!empty($request->get('ciudad'))){
                    $ciudad= new ciudades_user();
                     $ciudad->user_id=$user->id;
                     $ciudad->ciudad=$request->get('ciudad');
                     $ciudad->id_empresa=$empresa->id;
                     $ciudad->save();
                     }

                  //estado
                  if(!empty($request->get('state'))){
                    $state= new state_user();
                    $state->id_user=$user->id;
                    $state->state=$request->get('state');
                    $state->id_empresa=$empresa->id;
                    $state->save();
                    }

        if($request->get('nop')!=''){
            for($i = 0; $i < count($request->get('nop')); $i++){
                $input['user_id']=$user->id;
                $input['nombre'] = $request->get('nop')[$i];
                $input['telefono'] = $request->get('parentesco')[$i];
                $input['parentesco'] = $request->get('telp')[$i];
                $input['id_empresa'] = $empresa->id;
                $input['estado'] = 0;
                $referencia=referencias_user::create($input);
            }  
        }



        if($request->get('departa')!=null && $request->get('departa')!="ELEGIR..." ){
        $user->asignarPuestoU($request->get('departa'));
        }

        if($request->get('genero')!=null && $request->get('genero')!="ELEGIR..." ){
        $user->asignarSexoU($request->get('genero'));
        }

        if($request->get('pagos')!=null && $request->get('pagos')!="ELEGIR..." ){
        $user->asignarPagosU($request->get('pagos'));
        }

        if($request->get('rol')!=null && $request->get('rol')!="ELEGIR..."){
        $user->asignarRol($request->get('rol'));
        }
        
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users=User::findOrFail($id);
        $roles=Role::all();
        $sexo=Sexo::all();
        $pago=Pagos::all();
        $puesto=Puesto::all();
        $asignaciones=Asignaciones::all();
        $referencias=referencias_user::all();
        $contrato=Contrato::all();
        $Adjunto=adjunto_user::all();
        $equipo=Equipos::all();
        $emple_equipo=equipos_users::where('id_users','=',$id)->first();
       

        $pais=Pais::all(['id','name']);

        if(sizeof(paises_user::select('pais')->where('user_id','=',$id)->get())!=0){
            $pais_empleado=paises_user::select('pais')->where('user_id','=',$id)->first();
            $pais_emple=$pais_empleado->pais;
            
        }else{
            $pais_emple=0;
        }

        if(sizeof(state_user::select('state')->where('id_user','=',$id)->get())!=0){
            $state_empleado=state_user::select('state')->where('id_user','=',$id)->first();
            $state=$state_empleado->state;
            
        }else{
            $state=0;
        }

        if(sizeof(ciudades_user::select('ciudad')->where('user_id','=',$id)->get())!=0){
            $ciudad_empleado=ciudades_user::select('ciudad')->where('user_id','=',$id)->first();
            $ciudades=$ciudad_empleado->ciudad;
            
        }else{
            $ciudades=0;
        }

        

        return view('users.edit',compact('sexo','pago','roles',
        'puesto','asignaciones','emple_equipo','equipo','referencias','pais','pais_emple','state','Adjunto','users','ciudades','contrato'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $users=User::findOrFail($id);
        $users->fill($request->all());
        if($request->get('imagen')!=null){
        $users->imagen=$request->get('imagen');
        }
        $users->entrada=$request->get('entrada');
        $users->update();


        $empresa=Empresa::select('id')->where('id','=',Auth::user()->id_empresa)->first();  


        //Pais
        if(!empty($request->get('pais'))){
            $pa=paises_user::select('id')->where('user_id','=',$id)->first();
            if($pa!=null){
                $pais=paises_user::findOrFail($pa->id);
            }else{
                $pais=new paises_user();
            }
            $pais->user_id=$users->id;
            $pais->id_empresa=$empresa->id;
            $pais->pais=$request->get('pais');
            $pais->save();
            }

        //ciudad
        if(!empty($request->get('ciudad'))){
            $ci=ciudades_user::select('id')->where('user_id','=',$id)->first(); 
            if($ci!=null){
                $ciudad=ciudades_user::findOrFail($ci->id);
            }else{
                $ciudad= new ciudades_user();
            }
            $ciudad->user_id=$users->id;
            $ciudad->id_empresa=$empresa->id;
            $ciudad->ciudad=$request->get('ciudad');
            $ciudad->save();
            }

        //estado
        if(!empty($request->get('state'))){
            $st=state_user::select('id')->where('id_user','=',$id)->first(); 
            if($st!=null){
                $state=state_user::findOrFail($st->id);
            }else{
                $state= new state_user(); 
            }
            $state->id_user=$users->id;
            $state->id_empresa=$empresa->id;
            $state->state=$request->get('state');
            $state->save();
            
            }  

       if($request->get('checkasgina')!=''){
         $size = count(collect($request)->get('checkasgina'));
        }

        $pass= $request->get('pass');
        
        if($pass != null){
            $users->password=bcrypt(($request->get('pass')));
            $users->save();
        }

        if($request->get('no')!=''){
            for($i = 0; $i < count($request->get('no')); $i++){
                $input['user_id']=$users->id;
                $input['nombre'] = $request->get('no')[$i];
                $input['telefono'] = $request->get('parentesco')[$i];
                $input['parentesco'] = $request->get('tel')[$i];
                $input['id_empresa'] = $empresa->id;
                $input['estado'] = 0;
                $referencia=referencias_user::create($input);
            }  
        }


    if($request->get('pagos')!=null && $request->get('pagos')!="ELEGIR..."){
        $pagos=$users->pagosU;
        if(count($pagos)>0){
            $pagos_id=$pagos[0]->id;
            User::find($id)->pagosU()->updateExistingPivot($pagos_id, ['pagos_id'=>$request->get('pagos')]);
        }else{
            $users->asignarPagosU($request->get('pagos'));
        }
    }

    if($request->get('departa')!=null && $request->get('departa')!="ELEGIR..."){
        $puesto=$users->puestoU;
        if(count($puesto)>0){
            $puesto_id=$puesto[0]->id;
            User::find($id)->puestoU()->updateExistingPivot($puesto_id, ['puesto_id'=>$request->get('departa')]);
        }else{
            $users->asignarPuestoU($request->get('departa'));
        }
    }

    if($request->get('genero')!=null && $request->get('genero')!="ELEGIR..."){
        $sexo=$users->sexoU;
        if(count($sexo)>0){
            $sexo_id=$sexo[0]->id;
            User::find($id)->sexoU()->updateExistingPivot($sexo_id, ['sexo_id'=>$request->get('genero')]);
        }else{
            $users->asignarSexoU($request->get('genero'));
        }
    }

    if($request->get('rol')!=null && $request->get('rol')!="ELEGIR..."){
        $role=$users->roles;
        if(count($role)>0){
            $roles_id=$role[0]->id;
            User::find($id)->roles()->updateExistingPivot($roles_id, ['role_id'=>$request->get('rol')]);
        }else{
            $users->asignarRol($request->get('rol'));
        }
        return redirect('user');
    }
}

    public function openadjuntouser(Request $request)
    {
        $id=request('id');
        return view('users.adjuntouser',compact('id'));

    }

    public function newadjuntouser()
    {
        return view('users.adjuntosnewU');
    }

    public function savejuntouser(Request $request)
    {
        $user_num=sizeof(User::all());

        if($user_num!==0){
            $em=User::latest('id')->first();
            $user=$em->id+1;
        }else{
            $user=1;
        }
        

        $nombre=$user;
        $file = $request->archive;
        $Descr=request('descripsion');
        $file->move(public_path().'/document',$file->getClientOriginalName());
    
        $adjnuto= new adjunto_user();

        $adjnuto->id_user=$nombre;
        $adjnuto->name=$file->getClientOriginalName();
        $adjnuto->descripcion=$Descr;
        $adjnuto->id_empresa=Auth::user()->id_empresa;
        $adjnuto->estado=0;
    
        $adjnuto->save();
    
        return view('users.plantillas.adjuntosnew',compact('adjnuto')); 
    }

    public function Gadjuntouser($id,Request $request)
    {
        $file = $request->archive;
        $Descr=request('descripsion');
        $file->move(public_path().'/document',$file->getClientOriginalName());
    
        $adjnuto= new adjunto_user();
    
        $adjnuto->id_user=$id;
        $adjnuto->name=$file->getClientOriginalName();
        $adjnuto->descripcion=$Descr;
        $adjnuto->id_empresa=Auth::user()->id_empresa;
        $adjnuto->estado=0;
    
        $adjnuto->save();
    
        return view('users.plantillas.adjuntos',compact('adjnuto','id'));

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
    public function UserController($id)
    {

        $role=new Role();

        $role->name=request('namew');
        $role->estado=0;
        $role->id_empresa=Auth::user()->id_empresa;
        $role->usuario=Auth::user()->name;
        $role->save();

        return view('users.plantillas.roles',compact('role'));  
    }

    public function downloadContratouser(Request $request)
    {   
      
        $emple=$request->get('id_user');
        $d=$request->get('download');
        
        $contrato=Contrato::findOrFail($d);
        $user=User::findOrFail($emple);
        



            $nombre=collect($user)->get('name');
            $apellido=collect( $user)->get('apellido');
            $fecha=Carbon::now()->format('d/m/Y');
            $entrada=collect( $user)->get('fecha');
            $cedula=collect( $user)->get('cedula');
            $direccion=collect( $user)->get('direccion');
            $salario=collect( $user)->get('salario');
           //  $userepartamento
            $cargo=collect($user)->get('cargo');
            //Empresa
            $user=Auth::user();
            $empresa=Empresa::findOrFail($user->id_empresa);

            $euser=$user->name;
            $ecedula=$user->cedula;
            $Eempresa=$empresa->nombre;


            try{
              $template= new TemplateProcessor('modelo/'.$contrato->name);
              $template->setValue('ename',$Eempresa);
              $template->setValue('euser',$euser);
              $template->setValue('ecedula',$ecedula);
              $template->setValue('name',$nombre);
              $template->setValue('apellido',$apellido);
              $template->setValue('fecha',$fecha);
              $template->setValue('entrada',$entrada);
              $template->setValue('cedula',$cedula);
              $template->setValue('direccion',$direccion);
              $template->setValue('salario',number_format($salario,2));
            //  $template->setValue('departamento',$departamento);
              $template->setValue('cargo',$cargo);


              
    
              $tempFile=tempnam(sys_get_temp_dir(), 'PHPWord');
              $template->saveAS($tempFile);
    
              $headers=[
                      "Content-Type: application/octent-stream",
              ];
              
              return response()->download($tempFile,$nombre."_".$contrato->name,$headers)->deleteFileAfterSend(true);
            }catch(\phpoffice\PhpWord\Exception\Exception $e){
                    return back($e->getCode());
            }   
              
  }
}
