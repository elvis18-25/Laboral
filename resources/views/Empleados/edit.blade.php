@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/empleado.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<form  action="{{Route('Empleados.update',$empleados->id_empleado)}}" method="POST" enctype="multipart/form-data" id="formulario"  >  
@csrf
@method('PUT')

<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('DATOS PERSONALES') }}</h5>
            </div>
                
                <div class="card-body">
                    
                    <div class="form-row">

                        @include('alerts.success')

                        <div class="col-sm-4 mb-2{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('NOMBRE') }}</label>
                            <input type="text" name="nombre" autofocus class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$empleados->nombre}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}" required >
                        
                        </div>
                        <div class="col-sm-4{{ $errors->has('apellido') ? ' has-danger' : '' }}">
                            <label>{{ __('APELLIDO') }}</label>
                            <input type="text" name="apellido" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" value="{{$empleados->apellido}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('apellido') }}" required>
                         
                        </div>
                        <div class="col-sm-4{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                            <label>{{ __('CÉDULA') }}</label>
                            <input type="text" name="cedula" class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" value="{{$empleados->cedula}}" id="cedula" placeholder="{{ __('Cedula') }}" required>
                       
                        </div>
                        <div class="col-sm-4 mb-2{{ $errors->has('edad') ? ' has-danger' : '' }}">
                            <label>{{ __('FECHA DE NACIMINETO') }}</label>
                            <input type="date" name="edad" class="form-control{{ $errors->has('edad') ? ' is-invalid' : '' }}" value="{{$empleados->edad}}">
                            
                        </div>
                        <div class="col-sm-7{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                            <label>{{ __('DIRECCIÓN') }}</label>
                            <input type="text" name="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" value="{{$empleados->direccion}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Direccion') }}">
                           
                        </div>

                        <div class="col-sm-3{{ $errors->has('pais') ? ' has-danger' : '' }}">
                            <label>{{ __('PAIS') }}</label>
                            <select class="form-control{{ $errors->has('pais') ? ' is-invalid' : '' }} selec" name="pais" id="countries">
                                <option selected disabled value="">ELEGIR...</option>
                                @foreach ($pais as $paises)
                                @if ($paises->id==$pais_emple)
                                    <option selected value="{{$paises->id}}">{{$paises->name}}</option>
                                @else
                                <option value="{{$paises->id}}">{{$paises->name}}</option>
                                @endif               
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-3 mb-2{{ $errors->has('state') ? ' has-danger' : '' }}">
                              <label>{{ __('ESTADO') }}</label>
                              <select class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }} selec" id="state" name="state">
                                  <option selected disabled value="{{old('estado')}}">ELEGIR...</option>
  
                                </select>
                          </div>
                          <div class="col-sm-3 mb-2{{ $errors->has('Ciudad') ? ' has-danger' : '' }}">
                              <label>{{ __('CIUDAD') }}</label>
                              <select class="form-control{{ $errors->has('Ciudad') ? ' is-invalid' : '' }} selec" name="ciudad" id="cities" >
                                  <option selected disabled value="{{old('cities')}}">ELEGIR...</option>
                                  <option></option>
                                </select>
                          </div>
                        <div class="col-sm-3{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                            <label>{{ __('TÉLEFONO') }}</label>
                            <input type="tel" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{$empleados->telefono}}" placeholder="{{ __('Télefono') }}" required>
                        
                        </div>

                        <div class="col-sm-6{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label>{{ __('EMAIL') }}</label>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$empleados->email}}" placeholder="{{ __('Email address') }}" required>
                    
                        </div>
                        <div class="col-sm-3{{ $errors->has('genero') ? ' has-danger' : '' }}">
                            <label>{{ __('GENERO') }}</label>
                            <select class="form-control{{ $errors->has('genero') ? ' is-invalid' : '' }} selec" name="genero" required>
                                <option selected >ELEGIR...</option>
                              @foreach ($sexo as $sex)
                              @if($sex->name == str_replace(array('["', '"]'), '',$empleados->tienesSexo()));
                                <option value="{{$sex->id}}" selected>{{$sex->name}}</option>							
                              @else
                                <option value="{{$sex->id}}">{{$sex->name}}</option>		
                             @endif
                                @endforeach
                              </select>
                        </div>
                    </div>

                </div>
                {{-- <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                </div> --}}
            
        </div>
        <div class="card" style="top: -12px;">
            <div class="card-header">
                <h5 class="title">{{ __('DATOS LABORALES') }}</h5>
            </div>

                <div class="card-body">

                    <div class="form-inline" style="top: -20px; position:relative">
                        <label id="tipo">{{ __('TIPO DE CONTRATO:') }}&nbsp;</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1" style="margin-left: -22px;">
                          CONTRATO FIJO
                        </label>
                      </div>
                      <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2" style="margin-left: -22px;">
                          CONTRATO TEMPORAL
                        </label>
                      </div>
                    </div>


                    <div class="form-row">
                        <div class="col-sm-3 mb-2{{ $errors->has('Fecha_Entrada') ? ' has-danger' : '' }}">
                            <label>{{ __('FECHA DE ENTRADA') }}</label>
                            <input type="date" name="Fecha_Entrada" value="{{$empleados->Fecha_Entrada}}" class="form-control{{ $errors->has('Fecha_Entrada') ? ' is-invalid' : '' }}" id="entrada" required>
                           
                        </div>
                    

                        <div class="col-sm-3{{ $errors->has('fecha_salida') ? ' has-danger' : '' }}" id="salida">
                            <label>{{ __('FECHA DE SALIDA') }}</label>
                            <input type="date" name="fecha_salida" value="{{$empleados->fecha_salida}}" class="form-control{{ $errors->has('fecha_salida') ? ' is-invalid' : '' }}">
                           
                        </div>

                        <div class="col-sm-3{{ $errors->has('salario') ? ' has-danger' : '' }}">
                            <label>{{ __('SALARIO BRUTO') }}</label>
                            <input type="text" onkeyup="calcular();"  value="{{number_format($empleados->salario,2)}}" class="form-control{{ $errors->has('salario') ? ' is-invalid' : '' }} money" id="salario" placeholder="{{ __('Salario') }}" required>
                            <input type="text" name="salario" value="" id="salarioOP" hidden>
                       
                        </div>
                      {{-- </div> --}}
                      <div class="col-sm-3{{ $errors->has('dias') ? ' has-danger' : '' }}">
                          <label>{{ __('SALARIO POR DIAS') }}</label>
                          <input type="text" name="horas" value="{{$empleados->horas}}"  class="form-control  " id="salDias" placeholder="{{ __('$0.00') }} money" required>
                     
                      </div>
                        <div class="col-sm-3{{ $errors->has('pagos') ? ' has-danger' : '' }}">
                            <label>{{ __('FORMAS DE PAGOS') }}</label>
                            <div class="input-group mb-2">
                                <select class="form-control{{ $errors->has('pagos') ? ' is-invalid' : '' }} selec" name="pagos" id="forma" required>
                                    <option selected disabled value="" >ELEGIR...</option>
                                    @foreach ($pago as $pag)   
                                    @if ($pag->estado==0)
                                    @if ($pag->id_empresa==Auth::user()->id_empresa)                           
                                    @if($pag->pago == str_replace(array('["', '"]'), '',$empleados->tienesPago()));
                                    <option value="{{$pag->id}}" selected>{{$pag->pago}}</option>							
                                  @else
                                  <option value="{{$pag->id}}">{{$pag->pago}}</option>
                                  @endif
                                  @endif		
                                 @endif
                                    @endforeach
                                  </select>                               
                                  <div class="input-group-append">
                                  <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModal" type="button" id="button-addon2"><i class="fas fa-plus"></i></button>
                                </div>
                              </div>
                            @include('Empleados.modalpago')
                        </div>
                        <div class="col-sm-3{{ $errors->has('cargo') ? ' has-danger' : '' }}">
                            <label>{{ __('CARGO') }}</label>
                            <input type="text" name="cargo" value="{{$empleados->cargo}}" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" id="cargo" placeholder="{{ __('Cargo') }}" required>
                       
                        </div>
                        <div class="col-sm-3{{ $errors->has('departa') ? ' has-danger' : '' }}">
                            <label>{{ __('DEPARTAMENTO') }}</label>
                            <div class="input-group mb-3">
                            <select class="form-control{{ $errors->has('departa') ? ' is-invalid' : '' }} selec" name="departa" id="depar"  required>
                                <option  value="">ELEGIR...</option>
                                @foreach ($puesto as $puest)
                                @if ($puest->estado==0)
                                @if ($puest->id_empresa==Auth::user()->id_empresa)
                                @if($puest->name == str_replace(array('["', '"]'), '',$empleados->tienePuesto()));
                                <option value="{{$puest->id}}" selected>{{$puest->name}}</option>							
                                @else
                                <option value="{{$puest->id}}">{{$puest->name}}</option>	
                               @endif
                               @endif
                               @endif
                                @endforeach
                              </select>
                              <div class="input-group-append">
                                <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#departament" type="button" id="button-addon2"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                        </div>
                        @include('Empleados.modaldepart')

                        <div class="col-sm-4{{ $errors->has('grupo') ? ' has-danger' : '' }}">
                          <label>{{ __('GRUPOS') }}</label>
                          <div class="input-group mb-3">
                          <select class="form-control{{ $errors->has('grupo') ? ' is-invalid' : '' }} selec" name="grupo" id="grupo"  required>
                              <option selected value="">ELEGIR...</option>
                              @foreach ($equipo as $equipos)
                              @if ($equipos->estado==0)
                              @if ($equipos->id_empresa==Auth::user()->id_empresa)
                              @if ($emple_equipo->equipos==$equipos->id)
                              <option value="{{$equipos->id}}" selected>{{$equipos->descripcion}} {{$equipos->entrada."  "."A"."  ".$equipos->salida}}</option>
                              
                              @else
                              <option value="{{$equipos->id}}">{{$equipos->descripcion}} {{$equipos->entrada."  "."A"."  ".$equipos->salida}}</option>
                              @endif
                              @endif
                              @endif
                              @endforeach
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#group" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                          </div>
                        </div>
                        @include('Empleados.modalgroup') 
                       

                    </div>
                </div>

            
        </div>


        <div class="card" style="top: -23px;">
            <div class="card-header">
                <h5 class="title">{{ __('DATOS OPCIONALES') }}</h5>
            </div>

                <div class="card-body" >
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">REFERENCIAS</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ASIGNACIONES</a>
                        </li> --}}
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">ADJUNTO</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contra" role="tab" aria-controls="contact" aria-selected="false">CONTRATO</a>
                        </li> --}}
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body" style="height: 250px;" >
                               <div class="form-row">
                                <div class="col-sm-4"><input type="text" name="nop" class="form-control datosInput" id="NN" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" ></div>
                                <div class="col-sm-3"><input type="tel" name="telp" class="form-control datosInput" id="tt" placeholder="{{ __('Telefono') }}" ></div>
                                <div class="col-sm-3"><input type="text" name="parp" class="form-control datosInput" id="parentesco" placeholder="{{ __('Parentesco') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" ></div>
                                <button type="button" onclick="capturar();" class="btn btn-info btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                               </div>
                               <div style=" max-height:189px; overflow:auto; position: relative; top: -10px; position: relative; top:-12px; ">
                            <table class="table tablesorter " id="transTable">
                                <thead class=" text-primary">
                                    <tr>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">TÉLEFONO</th>
                                    <th scope="col">PARENTESCO</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($referencias as $referen)
                                    @if ($empleados->id_empleado==$referen->empleado_id_empleado)
                                    <tr>
                                    <td>{{$referen->nombre}}</td>
                                    <td>{{$referen->telefono}}</td>
                                    <td>{{$referen->parentesco}}</td>
                                    <td>
                                     <button type="button" class="btn btn-danger btn-sm"  onclick="elimini({{$referen->id}},{{$empleados->id_empleado}})" ><i class="fas fa-minus"></i></button>
                                    </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card-body" style="height: 250px;" >
                                <div style=" max-height:189px; overflow:auto; position: relative; top: -10px; position: relative; top:-12px; ">
                                <table class="table tablesorter " id="Asigna">
                                    <thead class=" text-primary">
                                        <tr>
                                          <th scope="col">NOMBRE</th>
                                          <th scope="col">POCENTAJE</th>
                                          <th scope="col">MONTO</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($asignaciones as $asigna)
                                    <tr>
                                        <td>{{$asigna->id}}</td>
                                        <td>{{$asigna->Nombre}}</td>
                                        <td>{{$asigna->tipo_de_Asignacion}}</td>
                                        <td>${{number_format($asigna->Monto,2)}}</td>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" name="checkasgina[] " type="checkbox" value="{{$asigna->id}}" >
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                            
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                </div>
                                <button type="button" data-toggle="modal" data-target="#newasigna" style="top: 11px;" class="btn btn-success float-right btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                                @include('Empleados.asignamodal')
                            </div>
                        </div>
                        @php
                            $user=Auth::user()->id_empresa;
                        @endphp
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="card-body" style="height: 250px;" >
                                <div style=" max-height:189px; overflow:auto; position: relative; top: -10px; position: relative; top:-12px; ">
                                <table class="table tablesorter " id="Adjunto">
                                    <thead class=" text-primary">
                                        <tr>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">ADJUNTO</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      
                                      @foreach ($Adjunto as $Adjuntos)
                                      @if ($empleados->id_empleado==$Adjuntos->id_empleado)
                                      @if ($Adjuntos->id_empresa==$user)
                                       @if ($Adjuntos->estado!=1)
                                           
                                       
                                      <tr>
                                        <td>{{$Adjuntos->descripcion}}</td>
                                    
                                       <td>
                                        <a href="{{asset('document/'. $Adjuntos->name)}}" target="_blank" rel="noopener noreferrer">
                                            {{$Adjuntos->name}}
                                          </a>
                                       </td>
                                       
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remf" value="{{$Adjuntos->id}}" action="{{$empleados->id_empleado}}" ><i class="fas fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    @endif
                                      @endif    
                                      @endif
                                      @endforeach
                                    </tbody>
                                </table>
                                </div>
                                
                            {{-- <button type="button"data-toggle="modal" data-target="#adjunnew" style="top: 137px;" class="btn btn-success float-right btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button> --}}
                            <button type="button" onclick="openadjunto();" style="top: 84px;" class="btn btn-success float-right btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                        </div>
                        {{-- @include('Empleados.adjunto') --}}
                        </div>
                      </div>
                      
                      
                    

                </div>
 
        </div>

    </div>
    

    <div class="col-md-4 ">
      <div class="position-fixed col-md-4" style="margin-left: -25px">
        <div class="card card-user" style="height: 274px;">
            <div class="card-body">
                <p class="card-text">
                    <div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>

                        @if ($empleados->imagen==null)
                        <div class="avatar mx-auto"  id="image" ></div>
                        @endif

                        @if ($empleados->imagen!=null)
                        <img class="avatar" src="{{ asset('img/'.$empleados->imagen)}}" >
                        @endif
                        
                        
                        <p class="description">
                            {{$empleados->nombre." ".$empleados->apellido}}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image"   aria-describedby="inputGroupFileAddon01" id="subirimaggen" hidden>
                                <label class="custom-file-label" for="inputGroupFile01" hidden>Choose file</label>
                              </div>

                              <div class="col-sm-8" style="top: -42px; margin-left: -27px;" >
                                <label class="float-left">{{ __('CONTRATO') }}</label>
                                <div class="input-group mb-3">
                                <select class="form-control selec" id="contra">
                                    <option selected >ELEGIR...</option>
                                    @foreach ($contrato as $contratos)
                                    <option value="{{$contratos->id}}">{{$contratos->name}}</option>	
                                    @endforeach
                                  </select>
                                  {{-- <div class="input-group-append">
                                    <button type="button" class="btn btn-info btn-sm " data-toggle="modal" data-target="#contrato" ><i class="fas fa-plus"></i></button>
                                </div> --}}
                                </div>
                                
                            </div>


                        </p>
                        


                      </div>
                </p>
            </div>
        </div>
        <div class="card" style="top: -4px;">
            <div class="card-header">
                <h5 class="title">{{ __('DATOS ACCESO') }}</h5>
            </div>

                <div class="card-body">
                    

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label>{{ __('CONTRASEÑA') }}</label>
                        <input type="password" name="pass" id="pass" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}"  >
                    </div>
                    <div class="form-group">
                        <label>{{ __('CONFIRMAR CONTRASEÑA') }}</label>
                        <input type="password" name="password_confirmation"  class="form-control" placeholder="{{ __('Confirmar Contraseña') }}"  >
                    </div>
                </div>
                
        </div>
        
        <div class="button" style="margin-right: 68px">
        <button type="submit"  title="Guardar Datos" class="btn btn-fill btn-info btnholdon  float-right"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
      </form>
      <form action="{{Route('Empleados.destroy',$empleados->id_empleado)}}" id="deleempleado" method="POST">
        @csrf
        @method('DELETE');
     <button type="submit"  class="btn btn-fill btn-danger float-right" title="Eliminar Empleado" style="margin-right: 5px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
    </form>
    
    

    
      <form action="{{url('downloadContrato')}}" method="POST" id="formcontroato" >
        @csrf
        <input type="text" name="idempleados" id="idempleados" value="{{$empleados->id_empleado}}"hidden>
        <input type="text" value=" " name="download" id="download" hidden>
        <button class="btn btn-fill btn-info btn-sm btncontrato  float-right" id="btncontrato"   style="margin-left: 256px; position: relative; top: -377px;" type="submit"><i class="fas fa-download"></i></button>
      </form>



      
<div class="btnmove" style="margin-right: -51px; position: relative;">
  <button class="btn btn-fill btn-warning btn-sm btncontrato  float-right" title="Agregar este empleado como usuario" data-toggle="modal" data-target="#converteuser" style="margin-right: -253px; top: -376px; position: relative;" type="button"><i class="fas fa-user-tag"></i></button>
</div>

  </div>
  </div>
  </div>
</div>

@include('Empleados.converteuser')

<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

<input type="text" name="" id="searchState" value="{{$state}}" hidden>
<input type="text" name="" id="searchCiudad" value="{{$ciudades}}" hidden>



<div class="modal fade" id="adjunnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>


<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>
@endsection

@section('js')
@include('Contrato.modal')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
{{-- <script src="{{asset('js/holdOn.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/holdOn.css')}}"> --}}
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
  $(document).ready(function(){
    // HoldOn.close();
    $("#pass").val('');
    $("#cedula").mask('000-0000000-0');
    $('#salario').mask('0#');
    $('.money').mask("#,##0.00", {reverse: true});

    $("input[type='tel']").mask('(000) 000-0000');
    $("#descradjunto").val(" ");


    $('#adjunnew').keyup(function(e){
    if(e.keyCode==13)
    {
      e.preventDefault();
      $('#btnadjunto').trigger("click");
      
    }
    if(e.keycode!=13)
    {
        $("#nameadjunto").focus();
    }
});
      


    if($("#countries").val()!=''){
     var pais=$("#countries").val()
      estado(pais);

    }
    

    $("#formulario").validate({
           rules: {
            pass: { 
                    minlength: 6,
                    maxlength: 10,

               } , 

               password_confirmation: { 
                    equalTo: "#pass",
                     minlength: 6,
                     maxlength: 10
               }


           },
     messages:{
      password: { 
                 minlength:"El Contraseña debe tener minimo 6 caracteres",
                 maxlength: ""
               },
               password_confirmation: { 
         equalTo: "No coincide",
         minlength:"El Contraseña debe tener minimo 6 caracteres",
         maxlength: ""
       }
     }
 

});

// var validar=$("#formulario").validate();
jQuery.extend(jQuery.validator.messages, {
    required: "",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});


    
 $("#exampleRadios1").attr("checked",true);
  $("#salida").hide();
 

 $("#exampleRadios1").change(function(){
  if($(this).val()=="option1"){
      $("#salida").hide();
      $("#entrada").show();
      $("#salario").show();
      $("#cargo").show();
      $("#depar").show();
      $("#forma").show();
  }
 });

 $("#exampleRadios2").change(function(){
  if($(this).val()=="option2"){
      $("#salida").show();
      $("#entrada").show();
      $("#salario").show();
      $("#cargo").show();
      $("#depar").show();
      $("#forma").show();
  }
 });

 $("#password").prop('disabled',true);
 $("#password_confirmation").prop('disabled',true);

 $("#exampleRadios1").change(function(){
  if($(this).val()=="option3"){
      $("#password").attr('disabled',false);
      $("#password_confirmation").attr('disabled',false);
  }
});


$("#exampleRadios2").change(function(){
  if($(this).val()=="option4"){
      $("#password").attr('disabled',true);
      $("#password_confirmation").attr('disabled',true);
  }
});  
document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 13) {
        $("#subir").trigger("click");
        p=0;
    } 
});
  }); 
  
  function capturar(){
    function  Persona(nombre,preferencia,telefono,eliminar){
     this.nombre=nombre;
     this.preferencia=preferencia;
     this.telefono=telefono;
     this.eliminar=eliminar
    }
    var nombreCapturar=document.getElementById("NN").value;
    var preferenciaCapturar=document.getElementById("tt").value;
    var telefonoCapturar=document.getElementById("parentesco").value;
     
    

    nuevoSujeto= new Persona(nombreCapturar,preferenciaCapturar,telefonoCapturar,);
 
 agregar();
}
var baseDatos=[];

function agregar(){
  $('.datosInput').val('');

baseDatos.push(nuevoSujeto);
console.log(baseDatos);
var button = '<button type="button"class="btn btn-danger borrar btn-sm"><i class="fas fa-minus"></i></button';
$('transTable').append(button);




document.getElementById("transTable").innerHTML += '<tr class="reducir"><td><input type="text" name="no[]" value="'+nuevoSujeto.nombre+'"/ hidden>'+nuevoSujeto.nombre+'</td><td><input type="text" name="parentesco[]" value="'+nuevoSujeto.preferencia+'"/hidden>'+nuevoSujeto.preferencia+'</td><td><input type="text" name="tel[]" value="'+nuevoSujeto.telefono+'"/ hidden>'+nuevoSujeto.telefono+'</td><td>'+button+'</td></tr>';


}

function calcular(){
   var salario=$("#salario").val();
   
   var sum=0;

   var montoFormat = toInt(salario);
 


   sum=montoFormat/23.83/8;

   $("#salarioOP").attr('value',montoFormat);
   $("#salDias").attr('value',financial(sum));


 }
 
 function financial(x) {
   var sala=Number.parseFloat(x).toFixed(2);
  return sala;
}


String.prototype.toInt = function (){    
    return parseInt(this.split(' ').join('').split(',').join('') || 0);
}

// Incluso pensándolo como algo más genérico:

toInt = function(val){
  var result;
  if (typeof val === "string")
    result = parseInt(val.split(' ').join('').split(',').join('') || 0);
  else if (typeof val === "number")
    result = parseInt(val);
  else if (typeof val === "object")
    result = 0;
  return result;
}

// var options = {
//      theme:"sk-cube-grid",
//      message:'Cargando.... ',
// };

// p=0;
// $(document).on('click', '.btncontrato', function (event) {
//   p=1;
//   HoldOn.close();
// });
// $(document).on('click', '.btnholdon', function (event) {
  
//   p=0;
// });

// window.onbeforeunload = function(e) {
//   if(p==0){
//     HoldOn.open(options);
//   }
// };


HayFoco=false;
HayFoco2=false;
document.addEventListener ("keydown", function (e) {
        $('input[type=submit]').attr('disabled', 'disabled');
  if(HayFoco2==true ){
    if (e.keyCode== 13) {
        capturar();
        event.preventDefault();
    } 
  } 
});


function PierdoFoco(){
   HayFoco = false;

}

function GanoFoco(){
   HayFoco = true;
}
function PierdoFoco2(){
  HayFoco2 = false;

}

function GanoFoco2(){
  HayFoco2 = true;
  
}

$("#newdepart").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#newpago").on('keypress', function(e) { return e.keyCode != 13; }); 


$('#exampleModal').keyup(function(e){
    if(e.keyCode==13)
    {
      
      $('#btnpago').trigger("click");
      

      
    }
    if(e.keycode!=13)
    {
        
        $("#newpago").focus();
       
    }
});
  $('#departament').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btndepartamento').trigger("click");
      

      
    }
    if(e.keycode!=13)
    {
       
        $("#newdepart").focus();
        
    }
});

$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    // ($(this).closest('tr').val());
});  

function savedepart(){
    var name=$("#newdepart").val();
    var url = "{{url('savedepart')}}"; 
     var data ={name:name};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#departament").modal("toggle");
              $("#depar").append(result);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
}
function savepago(){
    var namew=$("#newpago").val();
    var url = "{{url('savepago')}}"; 
     var data ={namew:namew};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#exampleModal").modal("toggle");
              $("#forma").append(result);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
}



$i=0;
function elimini(e,p){
    Swal.fire({
  title: 'Estas Seguro que quieres eliminarlo?',
  text: "¡No podrás revertir esto!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si,Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    var url="{{url('eliminirefern')}}/"+e
    var data={p:p};
      $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
             $("#transTable").empty();
             $("#transTable").append(result);
             Swal.fire(
            'Eliminado!',
            'Se ha eliminado exitosamente.',
            'success'
          )

              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
  }
});
}

function openadjunto(){
    var id=$("#idempleados").val();
    var url = "{{url('openadjunto')}}"; 
     var data ={id:id};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#adjunnew").html(result).modal("show");
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
}

$("#deleempleado").submit(function(e){
    e.preventDefault();
    Swal.fire({
  title: 'Estas seguro?',
  text: "Ya no se podra revertir los cambios!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    this.submit();
  }
})
})
// $("#formcontroato").submit(function(e){
//     e.preventDefault();
//     HoldOn.close();
//     startte();
// });

// function startte(){
//   this.submit();
// }



// $("#btncontrato").on('click',function(){
//   HoldOn.close();
// });

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
});

$("#image").on('click',function(){
 $("#subirimaggen").click();

});

document.getElementById("subirimaggen").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('image'),
            image = document.createElement('img');

    image.src = reader.result;

    preview.innerHTML = '';
    preview.append(image);
  };
}

$('#adjunnew').keyup(function(e){
    if(e.keyCode==13)
    {
      e.preventDefault();
      $('#btnajunto').trigger("click");
      
    }
    if(e.keycode!=13)
    {
      $("#nameadjunto").focus();
    }
});

$(document).on('click', '.remf', function (event) {
  var e=$(this).val();
      var url = "{{url('deleteEadjuto')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){;
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 


  $(this).closest('tr').remove();

});

$("#countries").on('change',function(){
    var id=$(this).val();
    $("#state").empty(); 
    $("#cities").empty(); 
    var url = "{{url('emplepaises')}}/"+id; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#state").empty();    
            $("#state").append(result);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
});

$("#contra").on('change',function(){
  var id=$(this).val();
   $("#download").attr('value',id);
});

$("#state").on('change',function(){
    var id=$(this).val();
    var url = "{{url('empleciudad')}}/"+id; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#cities").empty();    
            $("#cities").append(result);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
});

function estado(e){
  var state=$("#searchState").val();
    var url = "{{url('emplepaises')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#state").empty();    
            $("#state").append(result);
            $("#state option[value="+state+"]").attr("selected",true);
            ciudad(state);


           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}


function ciudad(e){
  var ciudad=$("#searchCiudad").val();
    var url = "{{url('empleciudad')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#cities").empty();    
            $("#cities").append(result);
            $("#cities option[value="+ciudad+"]").attr("selected",true);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

// $("#download").on('click',function(){
// var contrato=$(this).val();
// var empleado=$("#idempleados").val();
//     var url = "{{url('downloadContrato')}}/"+contrato; 
//      var data ={empleado:empleado};
//         $.ajax({
//          method: "POST",
//            data: data,
//             url:url ,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success:function(result){
//               window.location='downloadContrato';

            

//            },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) { 
//                 alert("Status: " + textStatus); alert("Error: " + errorThrown); 
//     }
//              });
// });
</script>
    
@endsection