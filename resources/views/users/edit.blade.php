@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])
<style>

  .error{
    border-color: red !important;
  }
  .selec option{
    text:rgb(3, 3, 3);
    background-color:#525f7f;;
}

#canvas {
  height: 400px;
  width: 400px;
  background-color: #ffffff;
  cursor: default;
  border: 1px solid black;
}

img {
  max-width: 100%; /* This rule is very important, please do not ignore this! */
}

		.preview {
  			overflow: hidden;
  			width: 160px; 
  			height: 160px;
  			margin: 10px;
  			border: 1px solid red;
		}

    .modal-lg{
  			max-width: 1000px !important;
		}
    
    .card-header .fa {
  transition: .3s transform ease-in-out;
}
.card-header .collapsed .fa {
  transform: rotate(90deg);
}

#rol-error{
  top: 38px;
    position: absolute;
}

#silverfox {
  /* Asignamos una altura mínima */
  min-height: 500px;
  background-size: cover;
  background-position: center;
}
</style>
@section('content')
<link rel="stylesheet" href="{{asset('css/users.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link rel="stylesheet" href="{{asset('css/timepicker.min.css')}}">


<form  action="{{Route('user.update',$users->id)}}" method="POST" enctype="multipart/form-data" id="formulario"  >  
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
                            <input type="text" name="name" autofocus class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$users->name}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}" required >
                        
                        </div>
                        <div class="col-sm-4{{ $errors->has('apellido') ? ' has-danger' : '' }}">
                            <label>{{ __('APELLIDO') }}</label>
                            <input type="text" name="apellido" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" value="{{$users->apellido}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('apellido') }}" required>
                         
                        </div>
                        <div class="col-sm-4{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                            <label>{{ __('CÉDULA') }}</label>
                            <input type="text" name="cedula" class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" value="{{$users->cedula}}" id="cedula" placeholder="{{ __('Cedula') }}" required>
                       
                        </div>
                        <div class="col-sm-4 mb-2{{ $errors->has('edad') ? ' has-danger' : '' }}">
                            <label>{{ __('FECHA DE NACIMINETO') }}</label>
                            <input type="date" name="edad" class="form-control{{ $errors->has('edad') ? ' is-invalid' : '' }}" value="{{$users->edad}}">
                            
                        </div>
                        <div class="col-sm-7{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                            <label>{{ __('DIRECCIÓN') }}</label>
                            <input type="text" name="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" value="{{$users->direccion}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Direccion') }}">
                           
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
                            <input type="tel" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{$users->telefono}}" placeholder="{{ __('Télefono') }}" required>
                        
                        </div>

                        <div class="col-sm-5{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label>{{ __('EMAIL') }}</label>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$users->email}}" placeholder="{{ __('Email address') }}" required>
                    
                        </div>
                        <div class="col-sm-3{{ $errors->has('genero') ? ' has-danger' : '' }}">
                            <label>{{ __('GENERO') }}</label>
                            <select class="form-control{{ $errors->has('genero') ? ' is-invalid' : '' }} selec" name="genero" required>
                                <option selected disabled>ELEGIR...</option>
                              @foreach ($sexo as $sex)
                              @if($sex->name == str_replace(array('["', '"]'), '',$users->tienesSexoU()));
                                <option value="{{$sex->id}}" selected>{{$sex->name}}</option>							
                              @else
                                <option value="{{$sex->id}}">{{$sex->name}}</option>		
                             @endif
                                @endforeach
                              </select>
                        </div>
                        <div class="col-sm-3{{ $errors->has('rol') ? ' has-danger' : '' }}">
                          <label>{{ __('ROL') }}</label>
                          <select class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }} selec" name="rol" id="rol"  required>
                              <option selected value="">ELEGIR...</option>
                              @foreach ($roles as $role)
                              @if ($role->estado==0)
                              @if ($role->id_empresa==Auth::user()->id_empresa || $role->label=="rol")
                              @if($role->name == str_replace(array('["', '"]'), '',$users->tieneRol()));
                              <option value="{{$role->id}}" selected >{{$role->name}}</option>
                              @else
                              <option value="{{$role->id}}">{{$role->name}}</option>
                              @endif
                              @endif
                              @endif
                              @endforeach
                            </select>
                            {{-- <div class="input-group-append">
                              <button class="btn btn-outline-secondary btn-sm"  data-toggle="modal" data-target="#rolesmodal" type="button" id="button-addon2"><i class="fas fa-plus"></i></button>
                            </div> --}}
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
                <a data-toggle="collapse" href="#collapse-example" id="btncollapse" style="top: -33px;  position: relative;" aria-expanded="false" aria-controls="collapse-example" class="d-block">
                  <i class="fa fa-chevron-down pull-right"></i>
                  
              </a>
              </div>

              <div id="collapse-example" class="collapse">
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
                            <input type="date" name="entrada" value="{{$users->entrada}}" class="form-control{{ $errors->has('Fecha_Entrada') ? ' is-invalid' : '' }}" id="entrada" >
                           
                        </div>
                    

                        <div class="col-sm-3{{ $errors->has('fecha_salida') ? ' has-danger' : '' }}" id="salida">
                            <label>{{ __('FECHA DE SALIDA') }}</label>
                            <input type="date" name="salida" value="{{$users->salida}}" class="form-control{{ $errors->has('fecha_salida') ? ' is-invalid' : '' }}">
                           
                        </div>

                        <div class="col-sm-3{{ $errors->has('salario') ? ' has-danger' : '' }}">
                          <label>{{ __('SALARIO BRUTO') }}</label>
                          <input type="text" onkeyup="calcular();" value="{{number_format($users->salario,2)}}" class="form-control{{ $errors->has('salario') ? ' is-invalid' : '' }} money" id="salario" placeholder="{{ __('Salario') }}" >
                          <input type="text" name="salario" value="{{$users->salario}}" id="salarioOP" hidden>
                      </div>

                      <div class="col-sm-3{{ $errors->has('dias') ? ' has-danger' : '' }}">
                        <label>{{ __('SALARIO POR DIAS') }}</label>
                        <input type="text" name="horas" value="{{$users->horas}}"  class="form-control" id="salDias" placeholder="{{ __('$0.00') }}" >
                   
                    </div>

                        <div class="col-sm-3{{ $errors->has('pagos') ? ' has-danger' : '' }}">
                            <label>{{ __('FORMAS DE PAGOS') }}</label>
                            <div class="input-group mb-2">
                                <select class="form-control{{ $errors->has('pagos') ? ' is-invalid' : '' }} selec" name="pagos" id="forma" >
                                    <option selected disabled value="" >ELEGIR...</option>
                                    @foreach ($pago as $pag)      
                                    @if ($pag->estado==0)
                                    @if ($pag->id_empresa==Auth::user()->id_empresa)           
                                    @if($pag->pago == str_replace(array('["', '"]'), '',$users->tienesPagoU()));
                                    <option value="{{$pag->id}}" selected>{{$pag->pago}}</option>							
                                  @else
                                  <option value="{{$pag->id}}">{{$pag->pago}}</option>		
                                  @endif 
                                  @endif 
                                 @endif
                                    @endforeach
                                  </select>                               
                                  <div class="input-group-append">
                                  <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal" type="button" id="button-addon2"><i class="fas fa-plus"></i></button>
                                </div>
                              </div>
                            @include('Empleados.modalpago')
                        </div>

                        <div class="col-sm-4{{ $errors->has('cargo') ? ' has-danger' : '' }}">
                            <label>{{ __('CARGO') }}</label>
                            <input type="text" name="cargo" value="{{$users->cargo}}" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" id="cargo" placeholder="{{ __('Cargo') }}" required>
                       
                        </div>
                        <div class="col-sm-3{{ $errors->has('departa') ? ' has-danger' : '' }}">
                            <label>{{ __('DEPARTAMENTO') }}</label>
                            <div class="input-group mb-3">
                            <select class="form-control{{ $errors->has('departa') ? ' is-invalid' : '' }} selec" name="departa" id="depar"  required>
                                <option value="" selected disabled>ELEGIR...</option>
                                @foreach ($puesto as $puest)
                                @if ($puest->estado==0)
                                @if ($puest->id_empresa==Auth::user()->id_empresa)
                                    
                                @if($puest->name == str_replace(array('["', '"]'), '',$users->tienePuestoU()));
                                <option value="{{$puest->id}}" selected>{{$puest->name}}</option>							
                                @else
                                <option value="{{$puest->id}}">{{$puest->name}}</option>	
                               @endif
                               @endif
                               @endif
                                @endforeach
                              </select>
                              <div class="input-group-append">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#departament" type="button" id="button-addon2"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                        </div>
                        @include('Empleados.modaldepart')

                        <div class="col-sm-3{{ $errors->has('grupo') ? ' has-danger' : '' }}">
                          <label>{{ __('GRUPOS') }}</label>
                          <div class="input-group mb-3">
                          <select class="form-control{{ $errors->has('grupo') ? ' is-invalid' : '' }} selec" name="grupo" id="grupo"  >
                              <option selected disabled value="">ELEGIR...</option>
                              @foreach ($equipo as $equipos)

                              @if ($equipos->estado==0)
                              @if ($equipos->id_empresa==Auth::user()->id_empresa)

                              @if ($emple_equipo!=null)
                              @if ($emple_equipo->equipo==$equipos->id)
                              <option value="{{$equipos->id}}" selected>{{$equipos->descripcion}} {{$equipos->entrada."  "."A"."  ".$equipos->salida}}</option>
                              
                              @else
                              <option value="{{$equipos->id}}">{{$equipos->descripcion}} {{$equipos->entrada."  "."A"."  ".$equipos->salida}}</option>
                              @endif   
                              
                              @else
                              <option value="{{$equipos->id}}">{{$equipos->descripcion}} {{$equipos->entrada."  "."A"."  ".$equipos->salida}}</option>
                              @endif


                              @endif
                              @endif
                              @endforeach
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#group" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                          </div>
                        </div>

                    </div>
                    </div>
                </div>
        </div>


        <div class="card" style="top: -23px;">
            <div class="card-header">
                <h5 class="title">{{ __('DATOS OPCIONALES') }}</h5>
                <a data-toggle="collapse" href="#collapse-opcional"  style="top: -33px;  position: relative;" aria-expanded="false" aria-controls="collapse-example" class="d-block">
                  <i class="fa fa-chevron-down pull-right"></i>
              </a>   
              </div>
              <div id="collapse-opcional" class="collapse">
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
                                    @if ($users->id==$referen->user_id)
                                    <tr>
                                    <td>{{$referen->nombre}}</td>
                                    <td>{{$referen->telefono}}</td>
                                    <td>{{$referen->parentesco}}</td>
                                    <td>
                                     <button type="button" class="btn btn-danger btn-sm"  onclick="elimini({{$referen->id}},{{$users->id}})" ><i class="fas fa-minus"></i></button>
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
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      
                                      @foreach ($Adjunto as $Adjuntos)
                                      @if ($users->id==$Adjuntos->id_user)
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
                                            <button type="button" class="btn btn-danger btn-sm remf" value="{{$Adjuntos->id}}" action="{{$users->id}}" ><i class="fas fa-minus"></i></button>
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
                            <button type="button" onclick="openadjunto();" style="top: 84px;" class="btn btn-info float-right btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                        </div>
                        {{-- @include('Empleados.adjunto') --}}
                        </div>
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

                        @if ($users->imagen==null)
                        <img class="avatar" src="{{asset('black') }}/img/default-user-image.png" id="image" alt="">
                        @endif

                        @if ($users->imagen!=null)
                        <img class="avatar" src="{{ asset('img/'.$users->imagen)}}" id="image" alt="" >
                        @endif
                        
                        
                        <p class="description">
                            {{$users->name." ".$users->apellido}}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image"   aria-describedby="inputGroupFileAddon01" id="subirimaggen" hidden>
                                <label class="custom-file-label" for="inputGroupFile01" hidden>Choose file</label>
                              </div>
{{-- 
                              <div class="col-sm-8" style="top: -42px; margin-left: -27px;" >
                                <label class="float-left">{{ __('CONTRATO') }}</label>
                                <div class="input-group mb-3">
                                <select class="form-control selec" id="contra">
                                    <option selected >ELEGIR...</option>
                                    @foreach ($contrato as $contratos)
                                    <option value="{{$contratos->id}}">{{$contratos->name}}</option>	
                                    @endforeach
                                  </select> --}}
                                  {{-- <div class="input-group-append">
                                    <button type="button" class="btn btn-info btn-sm " data-toggle="modal" data-target="#contrato" ><i class="fas fa-plus"></i></button>
                                </div> --}}
                                {{-- </div>
                                
                            </div> --}}


                        </p>
                        


                      </div>
                </p>
                <div class="form-group" style="top: -49px; width: 61%;">
                  <label class="float-left"><b>{{ __('CONTRATO') }}</b></label>
                  <select class="form-control selec" id="contra">
                    <option selected >ELEGIR...</option>
                    @foreach ($contrato as $contratos)
                    <option value="{{$contratos->id}}">{{$contratos->name}}</option>	
                    @endforeach
                  </select> 
              </div>
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
        <button type="submit" id="subir" class="btn btn-fill btn-info btnholdon float-right"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
        <input type="text" name="imagen"  id="idphoto" hidden value="">

      </form>
      <form action="{{Route('user.destroy',$users->id)}}" id="deleempleado" method="POST">
        @csrf
        @method('DELETE');
     <button type="submit"  class="btn btn-fill btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
    </form>
    
    

    <form action="{{url('downloadContratouser')}}" method="POST" >
      @csrf
      <input type="text" name="id_user" id="id_user" value="{{$users->id}}"hidden>
      <input type="text" value=" " name="download" id="download" hidden>
      <button class="btn btn-fill btn-info btn-sm float-right btncontrato"   style="margin-left: 256px; position: relative; top: -377px;" type="submit"><i class="fas fa-download"></i></button>
    </form>
    


  </div>
  </div>
  </div>
</div>




<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

<input type="text" name="" id="searchState" value="{{$state}}" hidden>
<input type="text" name="" id="searchCiudad" value="{{$ciudades}}" hidden>

<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>
@include('Empleados.cropper')

<div class="modal fade" id="adjunnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@endsection

@section('js')
@include('Contrato.modal')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- <script src="{{asset('js/holdOn.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/holdOn.css')}}"> --}}
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="{{asset('js/timepicker.min.js')}}"></script>

<script>

  $(document).ready(function(){
    
    $("#pass").val('');
    $("#cedula").mask('000-0000000-0');
    $('#salario').mask('0#');
    $('.money').mask("#,##0.00", {reverse: true});

    // var saler=$("#salario").val();
    // $("#salarioOP").attr('value',saler);
    $("input[type='tel']").mask('(000) 000-0000');
    $("#descradjunto").val(" ");
    // $('.bs-timepicker').timepicker();


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
 

if (window.history && window.history.pushState) {

window.history.pushState('forward', null);

$(window).on('popstate', function() {
  backsave();

});

}

function backhome(){
  if (window.history && window.history.pushState) {

window.history.pushState('forward', null);

$(window).on('popstate', function() {
  backsave();
});

}
}

function backsave(){
  Swal.fire({
  title: 'Seguro que deseas salir?',
  text: "No se podra revertir,¿Deseas guardarlo? !",
  icon: 'warning',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Si, Guardar`,
  denyButtonText: `No, Salir`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $("#seave").trigger("click");
  } else if (result.isDenied) {
    history.back();
  }else{
    backhome();
  }
})

}

$("#SearcFormulario").on('submit',function(e){
e.preventDefault();
Swal.fire({
  title: 'Seguro que deseas salir?',
  text: "No se podra revertir,¿Deseas guardarlo? !",
  icon: 'warning',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Si, Guardar`,
  denyButtonText: `No, Salir`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $("#seave").trigger("click");
  } else if (result.isDenied) {
    this.submit();
  }else{
    backhome();
  }
})
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
     },
 
     errorPlacement: function(error, element) {
        var name = element.attr('name');
        element.addClass('error');
        var errorSelector = '.validation_error_message[for="' + name + '"]';
        var $element = $(errorSelector);
        if ($element.length) { 
          $(errorSelector).html(error.html());
        } else {
          
            error.insertAfter(element);

        }
        ErroresGeneral();
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


function ErroresGeneral(){
    Command: toastr["error"]("", "Error!")
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  }
    
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
                ErroresGeneral();
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
                ErroresGeneral();
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
                ErroresGeneral();
    }
             });
  }
});
}

function openadjunto(){
    var id=$("#id_user").val();
    var url = "{{url('openadjuntouser')}}"; 
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
                ErroresGeneral();
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


document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
});

$("#image").on('click',function(){
 $("#subirimaggen").click();

});

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
                ErroresGeneral();
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
                ErroresGeneral();
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
                ErroresGeneral();
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
                ErroresGeneral();
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
                ErroresGeneral();
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
//                 ErroresGeneral();
//     }
//              });
// });

var $modal = $('#crpimg');

var image = document.getElementById('sample_image');

var cropper;

$('#subirimaggen').change(function(event){
  var files = event.target.files;

  var done = function(url){
    image.src = url;
    $modal.modal('show');
  };

  if(files && files.length > 0)
  {
    reader = new FileReader();
    reader.onload = function(event)
    {
      done(reader.result);
    };
    reader.readAsDataURL(files[0]);
  }
});

$modal.on('shown.bs.modal', function() {
  cropper = new Cropper(image, {
    aspectRatio: 1,
    viewMode: 3,
    preview:'.preview'
  });
}).on('hidden.bs.modal', function(){
  cropper.destroy();
     cropper = null;
     $('#subirimaggen').val("");
});

$('#crop').click(function(){
  canvas = cropper.getCroppedCanvas({
    width:400,
    height:400
  });

  canvas.toBlob(function(blob){
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function(){
      var base64data = reader.result;
      $.ajax({
        url:"{{url('Emplephoto')}}",
        method:'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{image:base64data},
        success:function(data)
        {
          $("#btnclose").trigger("click");
          var route=$(data).attr('value');
          var file=$(data).attr('action');

          var union="{{asset('')}}/"+route;
          $("#idphoto").attr('value',file+".png")
          $('#image').attr('src', union);
        }
      });
    };
  });
});
</script>
    
@endsection