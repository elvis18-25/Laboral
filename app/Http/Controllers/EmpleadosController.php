<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\sexo;
use App\Models\empleado_puesto;
use App\Models\Pagos;
use App\Models\Asignaciones;
use App\Models\Contrato;
use App\Http\Requests\EmpleadoFormRequest;
use App\Models\Adjuntos;
use App\Models\Referencias;
use Illuminate\Support\Facades\Input as input;
use App\Models\Asignaciones_empleado;
use App\Models\TipContrato;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Estado;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use App\Models\state_empleado;
use App\Models\ciudades_empleado;
use App\Models\paises_empleado;
use App\Models\isr_empleado;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\estado_asignaciones;
use App\Models\estados_isr;
use App\Models\User;
use App\Models\Role;
use App\Models\Equipos;
use App\Models\empleados_equipo;


class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=Empleado::all();
        $puesto=Puesto::all();
        
        
       
        return view('Empleados.index',compact('empleados','puesto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexo=Sexo::all();
        $pago=Pagos::all();
        $puesto=Puesto::all();
        $asignaciones=Asignaciones::all();
        $contrato=Contrato::all();
        $equipo=Equipos::all();

        $pais=Pais::select('id','name')->orderBy('name')->get();
        
        // $estado=Estado::all();
        return view('Empleados.create',compact('sexo','equipo','pago','puesto','asignaciones','pais','contrato'));
    }

    public function emplepaises($id)
    {
        $estado=Estado::where('country_id','=',$id)->orderBy('name')->get();

     return view('Empleados.Plantillas.estado',compact('estado'));
    }
    public function empleciudad($id)
    {
    $ciudad=Ciudad::where('state_id','=',$id)->orderBy('name')->get();

     return view('Empleados.Plantillas.ciudad',compact('ciudad'));
    }

    public function savedepart(Request $request)
    {
        $namw=request('name');

        $puesto=new Puesto();

        $puesto->name=$namw;
        $puesto->estado=0;
        $puesto->id_empresa=Auth::user()->id_empresa;
        $puesto->usuario=Auth::user()->name;
        $puesto->save();

        return view('Empleados.Plantillas.departa',compact('puesto'));     
    }
    public function savegroup(Request $request)
    {

        $equipos= new Equipos(); 
        
        $equipos->descripcion=request('name');
        $equipos->entrada=request('entrada');
        $equipos->salida=request('salida');
        $equipos->user=Auth::user()->name;
        $equipos->estado=0;
        $equipos->id_empresa=Auth::user()->id_empresa;
        $equipos->save();

        return view('Empleados.Plantillas.grupo',compact('equipos'));  

    }
    public function savepago(Request $request)
    {
        $pagos=new Pagos();
        $pagos->pago=request('namew');
        $pagos->estado=0;
        $pagos->id_empresa=Auth::user()->id_empresa;
        $pagos->usuario=Auth::user()->name;;
        $pagos->save();
        
        return view('Empleados.Plantillas.pagos',compact('pagos'));     
    }
    public function saveasignar(Request $request)
    {
        $asignar=new Asignaciones();
        

        $asignar->Nombre=request('noms');
        $asignar->tipo=request('tipos');
        $asignar->Monto=request('monts');
        $asignar->save();

        return view('Empleados.Plantillas.asignar',compact('asignar'));     
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

        $inputs=$request->all();

        if($request->get('checkasgina')!=''){

            $size = count(collect($request)->get('checkasgina'));
        }
        $empleados=Empleado::create($inputs);

        $empleados->password=bcrypt($empleados->cedula);
        $empleados->estado=0;
        if($request->get('imagen')!=null){
        $empleados->imagen=$request->get('imagen');
        }
        $empleados->save();

        if($request->get('grupo')!=" "){
        $equipos= new empleados_equipo();
        $equipos->id_empleado=$empleados->id_empleado;
        $equipos->equipos=$request->get('grupo');
        $equipos->estado=0;
        $equipos->id_empresa=Auth::user()->id_empresa;
        $equipos->save();
        }

        

        if($request->get('checkasgina')!=''){
            for($i = 0; $i <= $size; $i++){
                if(!empty(collect($request)->get('checkasgina')[$i])){
                  $input2['empleado_id_empleado']=$empleados->id_empleado;
                  $input2['asignaciones_id']=$request->get('checkasgina')[$i];
                  $input2['id_empresa'] = Auth::user()->id_empresa;
                  if($request->get('checkasgina')[$i]==6){
                   $input2['monto'] = $request->get('AFP');
                  }
                  if($request->get('checkasgina')[$i]==7){
                   $input2['monto'] = $request->get('SFS');
                  }
                  $oneswui=Asignaciones_empleado::create($input2);
                }
            }  
        }

        // if($request->get('isres')!=''){
        //     $isr= new isr_empleado();
        //     $isr->porcentaje=$request->get('porcentaje');
        //     $isr->id_empleado=$empleados->id_empleado;
        //     $isr->id_empresa=Auth::user()->id_empresa;
        //     $isr->moto=$request->get('ISR');
        //     $isr->save();
        // }

        // if($request->get('isres')!=''){
        //     $estado= new estados_isr();
        //     $estado->estado=2;
        //     $estado->id_isr=$isr->id;
        //     $estado->id_empleado=$empleados->id_empleado;
        //     $estado->id_empresa=Auth::user()->id_empresa;
        //     $estado->save();
        // }

                  //Pais
                  if(!empty($request->get('pais'))){
                    $pais= new paises_empleado();
                    $pais->id_empleado=$empleados->id_empleado;
                    $pais->pais=$request->get('pais');
                    $pais->id_empresa=Auth::user()->id_empresa;
                    $pais->save();
                  }

        
                  //ciudad
                if(!empty($request->get('ciudad'))){
                 $ciudad= new ciudades_empleado();
                  $ciudad->empleado_id_empleado=$empleados->id_empleado;
                  $ciudad->ciudad=$request->get('ciudad');
                  $ciudad->id_empresa=Auth::user()->id_empresa;
                  $ciudad->save();
                  }
        
                  //estado
                  if(!empty($request->get('state'))){
                  $state= new state_empleado();
                  $state->id_empleado=$empleados->id_empleado;
                  $state->state=$request->get('state');
                  $state->save();
                  }

 




        if($request->get('no')!=''){
            for($i = 0; $i < count($request->get('no')); $i++){
                $input['empleado_id_empleado']=$empleados->id_empleado;
                $input['nombre'] = $request->get('no')[$i];
                $input['telefono'] = $request->get('parentesco')[$i];
                $input['parentesco'] = $request->get('tel')[$i];
                $input['id_empresa'] = Auth::user()->id_empresa;
                $input['estado'] = 0;
                $referencia=Referencias::create($input);
            }  
        }


        // if($request->hasFile('image')){

        //     $file=$request->image;
        //     $file->move(public_path().'/img', $file->getClientOriginalName());
        //     $empleados->imagen=$file->getClientOriginalName();
        //     $empleados->save();

        // }



        if(!empty($request->get('exampleRadios'))){   
        if($request->get('exampleRadios')=="fijo"){
           $empleados->tipcontratoAsignar(1);
        }else{
            $empleados->tipcontratoAsignar(2);
        }
    }






        $empleados->asignarPuesto($request->get('departa'));

        $empleados->asignarSexo($request->get('genero'));

        $empleados->asignarPagos($request->get('pagos'));

        if($request->get('dinamico')==null){
            return redirect('Empleados');
        }
       
        return redirect('Empleados')->with('guardar','ya');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados=Empleado::findOrFail($id);
        $sexo=Sexo::all();
        $pago=Pagos::all();
        $puesto=Puesto::all();
        $asignaciones=Asignaciones::all();
        $contrato=Contrato::all();
        $tipo=TipContrato::all();
        $referencias=Referencias::all();
        $Adjunto=Adjuntos::all();
        $role=Role::all();
        $equipo=Equipos::all();
        $emple_equipo=empleados_equipo::where('id_empleado','=',$id)->first();



        $pais=Pais::all(['id','name']);

        if(sizeof(paises_empleado::select('pais')->where('id_empleado','=',$id)->get())!=0){
            $pais_empleado=paises_empleado::select('pais')->where('id_empleado','=',$id)->first();
            $pais_emple=$pais_empleado->pais;
            
        }else{
            $pais_emple=0;
        }

        if(sizeof(state_empleado::select('state')->where('id_empleado','=',$id)->get())!=0){
            $state_empleado=state_empleado::select('state')->where('id_empleado','=',$id)->first();
            $state=$state_empleado->state;
            
        }else{
            $state=0;
        }
        if(sizeof(ciudades_empleado::select('ciudad')->where('empleado_id_empleado','=',$id)->get())!=0){
            $ciudad_empleado=ciudades_empleado::select('ciudad')->where('empleado_id_empleado','=',$id)->first();
            $ciudades=$ciudad_empleado->ciudad;
            
        }else{
            $ciudades=0;
        }

        

        return view('Empleados.edit',compact('empleados','sexo','pago','puesto','asignaciones','contrato','tipo','referencias','Adjunto','pais','pais_emple','state','ciudades','emple_equipo','equipo','role'));
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

    public function deleteEadjuto($id,Request $request)
    {

        $Adjuntos=Adjuntos::findOrFail($id);
        $Adjuntos->estado=1;
        $Adjuntos->update();
  

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

        $empleados=Empleado::findOrFail($id);
        $empleados->fill($request->all());
        if($request->get('imagen')!=null){
          $empleados->imagen=$request->get('imagen');
        }
        $empleados->update();
        
        //Pais
        if(!empty($request->get('pais'))){
        $pa=paises_empleado::select('id')->where('id_empleado','=',$id)->first();
        if($pa!=null){
            $pais=paises_empleado::findOrFail($pa->id);
        }else{
            $pais=new paises_empleado();
        }

        $pais->pais=$request->get('pais');
        $pais->save();
        }

        //ciudad
        if(!empty($request->get('ciudad'))){
        $ci=ciudades_empleado::select('id')->where('empleado_id_empleado','=',$id)->first(); 
        if($ci!=null){
            $ciudad=ciudades_empleado::findOrFail($ci->id);
        }else{
            $ciudad= new ciudades_empleado();
        }
        $ciudad->ciudad=$request->get('ciudad');
        $ciudad->save();
        }
        
        //estado
        if(!empty($request->get('state'))){
        $st=state_empleado::select('id')->where('id_empleado','=',$id)->first(); 
        if($st!=null){
            $state=state_empleado::findOrFail($st->id);
        }else{
            $state= new state_empleado(); 
        }
        $state->id_empleado=$empleados->id_empleado;
        $state->state=$request->get('state');
        $state->save();
        
        }        

        if($request->get('checkasgina')!=''){

            $size = count(collect($request)->get('checkasgina'));
        }

        $pass= $request->get('pass');
        
        if($pass != null){
            $empleados->password=bcrypt(($request->get('pass')));
            $empleados->save();
        }

        if($request->get('no')!=''){
            for($i = 0; $i < count($request->get('no')); $i++){
                $input['empleado_id_empleado']=$empleados->id_empleado;
                $input['nombre'] = $request->get('no')[$i];
                $input['telefono'] = $request->get('parentesco')[$i];
                $input['parentesco'] = $request->get('tel')[$i];
                $input['id_empresa'] = Auth::user()->id_empresa;
                $input['estado'] = 0;
                $referencia=Referencias::create($input);
            }  
        }
        
        // if($request->hasFile('image')){

        //     $file=$request->image;
        //     $file->move(public_path().'/img', $file->getClientOriginalName());
        //     $empleados->imagen=$file->getClientOriginalName();
        //     $empleados->save();

        // }

        $pagos=$empleados->pagos;
        if(count($pagos)>0){
            $pagos_id=$pagos[0]->id;
            Empleado::find($id)->pagos()->updateExistingPivot($pagos_id, ['pagos_id'=>$request->get('pagos')]);
        }else{
            $empleados->asignarPagos($request->get('pagos'));
        }

        $puesto=$empleados->puesto;
        if(count($puesto)>0){
            $puesto_id=$puesto[0]->id;
            Empleado::find($id)->puesto()->updateExistingPivot($puesto_id, ['puesto_id'=>$request->get('departa')]);
        }else{
            $empleados->asignarPuesto($request->get('departa'));
        }

        if($request->get('genero')!="ELEGIR..." && $request->get('genero')!=null){
        $sexo=$empleados->sexo;
        if(count($sexo)>0){
            $sexo_id=$puesto[0]->id;
            Empleado::find($id)->sexo()->updateExistingPivot($sexo_id, ['sexo_id'=>$request->get('genero')]);
        }else{
            $empleados->asignarSexo($request->get('genero'));
        }
    }

        // =$request->get('grupo');

        if($request->get('grupo')!=null){
            if(sizeof(empleados_equipo::select('id_empleado')->where('id_empleado','=',$id)->get())!=0){
            $equipo=empleados_equipo::where('id_empleado','=',$id)->first();
            $emple_equipo=empleados_equipo::findOrFail($equipo->id);
            $emple_equipo->equipos=$request->get('grupo');
            $emple_equipo->update();
            }else{
                $equipo= new empleados_equipo();
                $equipo->equipos=$request->get('grupo');
                $equipo->id_empleado=$id;
                $equipo->id_empresa=Auth::user()->id_empresa;
                $equipo->estado=0;
                $equipo->save();
            }
        }

        
    

        return redirect('Empleados')->with('guardar','ya');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    

        $empleado=Empleado::findOrFail($id);
        $empleado->estado=1;
        $empleado->save();

        return redirect('Empleados')->with('eliminiado','ya');
        
    }
    public function newadjunto()
    {
        return view('Empleados.adjuntonew');
    }
    public function Gadjunto($id,Request $request)
    {
        // $nombre=$id;
        
        $file = $request->archive;
        $Descr=request('descripsion');
        $file->move(public_path().'/document',$file->getClientOriginalName());
    
        $adjnuto= new Adjuntos();
    
        $adjnuto->id_empleado=$id;
        $adjnuto->name=$file->getClientOriginalName();
        $adjnuto->descripcion=$Descr;
        $adjnuto->id_empresa=Auth::user()->id_empresa;
    
        $adjnuto->save();
    
        return view('Empleados.Plantillas.adjunto',compact('adjnuto','id')); 
//    return view('Empleados.Plantillas.adjuntonew',compact('adjnuto')); 
    }
    public function savejunto(Request $request)
    {
        $empleado_num=sizeof(Empleado::all());
        
        if($empleado_num!=0){
            $emp=Empleado::latest('id_empleado')->first();
            $empleados=$emp->id_empleado+1;
        }else{
            $empleados=1;
        }
        
        $file = $request->archive;
        $Descr=request('descripsion');
        $file->move(public_path().'/document',$file->getClientOriginalName());
    
        $adjnuto= new Adjuntos();
    
        $adjnuto->id_empleado=$empleados;
        $adjnuto->name=$file->getClientOriginalName();
        $adjnuto->descripcion=$Descr;
        $adjnuto->id_empresa=Auth::user()->id_empresa;
    
        $adjnuto->save();
    
        return view('Empleados.Plantillas.adjuntonew',compact('adjnuto')); 
//    return view('Empleados.Plantillas.adjuntonew',compact('adjnuto')); 
    }

    public function openadjunto()
    {
        $id=request('id');
        return view('Empleados.Adjunto',compact('id'));
    }



    public function eliminirefern($id)
    {
        $referen=Referencias::all();
        $emple=request('p');

        $referencia=Referencias::findOrFail($id);
        $referencia->delete();

        return view('Empleados.Plantillas.referencia',compact('referen','emple'));
    }

    public function subir(Request $request)
    {
     $contrato=new Contrato();
  
      if($request->hasFile('archivo')){
          $file=$request->archivo;
          $file->move(public_path(). '/modelo', $file->getClientOriginalName());
          $contrato->name=$file->getClientOriginalName();   
          $contrato->id_empresa=Auth::user()->id_empresa;   
          $contrato->user=Auth::user()->name;   
          $contrato->estado=0;   
      }else{
          dd("No Hay Archivo");
      }
  
      $contrato->save();
  
      return view('Empresa.plantilla',compact('contrato'));
  
    }
  

public function downloadContrato(Request $request)
    {   
      
        $emple=$request->get('idempleados');
        $d=$request->get('download');
        
        $contrato=Contrato::findOrFail($d);
        $empleado=Empleado::findOrFail($emple);



            $nombre=collect($empleado)->get('nombre');
            $apellido=collect( $empleado)->get('apellido');
            $fecha=Carbon::now()->format('d/m/Y');
            $entrada=collect( $empleado)->get('fecha');
            $cedula=collect( $empleado)->get('cedula');
            $direccion=collect( $empleado)->get('direccion');
            $salario=collect( $empleado)->get('salario');
           //  $empleadoepartamento
            $cargo=collect($empleado)->get('cargo');
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

  public function listadopdf()
  {

    $empleados=Empleado::all();
    $puesto=Puesto::all();
    $fecha=Carbon::now();

    $pdf =PDF::loadView('Empleados.listadopdf',compact('empleados','puesto','fecha'));
    $pdf->setPaper("letter", "portrait");
    return $pdf->stream('Empleado.pdf');
  }
  public function Emplephoto(Request $request)
  {

    if(isset($_POST['image']))
    {
        $data = $_POST['image'];
    
    
        $image_array_1 = explode(";", $data);
    
    
        $image_array_2 = explode(",", $image_array_1[1]);
    
    
        $data = base64_decode($image_array_2[1]);
        $b=time();
    
        $image_name = 'img/' .$b. '.png';


        file_put_contents($image_name, $data);
    
        return  view('Empleados.Plantillas.image',compact('b','image_name'));
    }
  }
  public function ConverterUsuario(Request $request)
  {
      $id=$request->get('idempleado');
      
      $empleados=Empleado::findOrFail($id);
    //   dd($request->all());
      $user=new User();

      $user->name=$empleados->nombre;
      $user->apellido=$empleados->apellido;
      $user->email=$empleados->email;
      $user->password=$empleados->password;
      $user->cedula=$empleados->cedula;
      $user->telefono=$empleados->telefono;
      $user->direccion=$empleados->direccion;
      $user->edad=$empleados->edad;
      $user->imagen=$empleados->imagen;
      $user->entrada=$empleados->Fecha_Entrada;
      $user->salida=$empleados->fecha_salida;
      $user->salario=$empleados->salario;
      $user->cargo=$empleados->cargo;
      $user->id_empresa=Auth::user()->id_empresa;
      $user->estado=0;

      $user->save();

      $user->asignarRol($request->get('rol'));

      return redirect('user');

  }

}
