@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
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
<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>
<link rel="stylesheet" href="{{asset('css/users.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  


<form  action="{{Route('user.store')}}" method="POST" enctype="multipart/form-data" id="formulario"  >  
@csrf


<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('DATOS PERSONALES') }}</h5>
            </div>
                
                <div class="card-body">
                    
                    <div class="form-row">

                        @include('alerts.success')

                        <div class="col-sm-4 mb-2{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                            <label>{{ __('NOMBRE') }}</label>
                            <input type="text" name="name" autofocus class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}" required >
                        
                        </div>
                        <div class="col-sm-4{{ $errors->has('apellido') ? ' has-danger' : '' }}">
                            <label>{{ __('APELLIDO') }}</label>
                            <input type="text" name="apellido" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('apellido') }}" required>
                         
                        </div>
                        <div class="col-sm-4{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                            <label>{{ __('CÉDULA') }}</label>
                            <input type="text" name="cedula" class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" id="cedula" placeholder="{{ __('Cedula') }}" required>
                       
                        </div>
                        <div class="col-sm-4 mb-2{{ $errors->has('edad') ? ' has-danger' : '' }}">
                            <label>{{ __('FECHA DE NACIMINETO') }}</label>
                            <input type="date" name="edad" class="form-control{{ $errors->has('edad') ? ' is-invalid' : '' }}" required>
                            
                        </div>
                        <div class="col-sm-7{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                            <label>{{ __('DIRECCIÓN') }}</label>
                            <input type="text" name="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Direccion') }}">
                           
                        </div>

                        <div class="col-sm-3{{ $errors->has('pais') ? ' has-danger' : '' }}">
                            <label>{{ __('PAIS') }}</label>
                            <select class="form-control{{ $errors->has('pais') ? ' is-invalid' : '' }} selec" id="countries" name="pais" required >
                                <option selected disabled value="{{old('pais')}}">ELEGIR...</option>
                                @foreach ($pais as $paises)
                                <option value="{{$paises->id}}">{{$paises->name}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-sm-3 mb-2{{ $errors->has('state') ? ' has-danger' : '' }}">
                            <label>{{ __('ESTADO') }}</label>
                            <select class="form-control{{ $errors->has('Ciudad') ? ' is-invalid' : '' }} selec" id="state" name="state" required>
                                <option selected disabled value="{{old('state')}}">ELEGIR...</option>

                              </select>
                        </div>
                        <div class="col-sm-3 mb-2{{ $errors->has('Ciudad') ? ' has-danger' : '' }}">
                            <label>{{ __('CIUDAD') }}</label>
                            <select class="form-control{{ $errors->has('Ciudad') ? ' is-invalid' : '' }} selec" name="ciudad" id="cities" required >
                                <option selected disabled value="{{old('cities')}}">ELEGIR...</option>
                                <option>...</option>
                              </select>
                        </div>
                        <div class="col-sm-3{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                            <label>{{ __('TÉLEFONO') }}</label>
                            <input type="tel" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Télefono') }}" >
                        
                        </div>

                        <div class="col-sm-5{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label>{{ __('EMAIL') }}</label>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" required>
                    
                        </div>
                        <div class="col-sm-3{{ $errors->has('genero') ? ' has-danger' : '' }}">
                            <label>{{ __('GENERO') }}</label>
                            <select class="form-control{{ $errors->has('genero') ? ' is-invalid' : '' }} selec" name="genero" required>
                                <option selected value="" >ELEGIR...</option>
                              @foreach ($sexo as $sex)
                                <option value="{{$sex->id}}">{{$sex->name}}</option>
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
                              <option value="{{$role->id}}">{{$role->name}}</option>
                              @endif
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
        <div class="card" style="top: -10px;">
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
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="fijo" checked>
                        <label class="form-check-label" for="exampleRadios1" style="margin-left: -22px;">
                          CONTRATO FIJO
                        </label>
                      </div>
                      <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="temporal">
                        <label class="form-check-label" for="exampleRadios2" style="margin-left: -22px;">
                          CONTRATO TEMPORAL
                        </label>
                      </div>
                    </div>


                    <div class="form-row">
                        <div class="col-sm-3 mb-2{{ $errors->has('Fecha_Entrada') ? ' has-danger' : '' }}">
                            <label>{{ __('FECHA DE ENTRADA') }}</label>
                            <input type="date" name="entrada"  class="form-control{{ $errors->has('Fecha_Entrada') ? ' is-invalid' : '' }}" id="entrada" >
                           
                        </div>
                    

                        <div class="col-sm-3{{ $errors->has('fecha_salida') ? ' has-danger' : '' }}" id="salida">
                            <label>{{ __('FECHA DE SALIDA') }}</label>
                            <input type="date" name="salida" class="form-control{{ $errors->has('fecha_salida') ? ' is-invalid' : '' }}">
                           
                        </div>

                        <div class="col-sm-3{{ $errors->has('salario') ? ' has-danger' : '' }}">
                          <label>{{ __('SALARIO BRUTO') }}</label>
                          <input type="text"  onkeyup="calcular();"  class="form-control money" id="salario"  placeholder="{{ __('Salario') }}" >
                          <input type="text" name="salario"   class="form-control money" id="recisalario"   hidden>
                      </div>
                        <div class="col-sm-3{{ $errors->has('dias') ? ' has-danger' : '' }}">
                          <label>{{ __('SALARIO POR DIAS') }}</label>
                          <input type="text" name="horas"  class="form-control  " id="salDias" placeholder="{{ __('$0.00') }}" >
                     
                      </div>
                        <div class="col-sm-3{{ $errors->has('pagos') ? ' has-danger' : '' }}">
                            <label>{{ __('FORMAS DE PAGOS') }}</label>
                            <div class="input-group mb-2">
                                <select class="form-control{{ $errors->has('pagos') ? ' is-invalid' : '' }} selec" name="pagos" id="forma" >
                                    <option selected disabled >ELEGIR...</option>
                                    @foreach ($pago as $pag)
                                    @if ($pag->estado==0)
                                    @if ($pag->id_empresa==Auth::user()->id_empresa) 
                                    <option value="{{$pag->id}}">{{$pag->pago}}</option>
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
                        <div class="col-sm-3{{ $errors->has('cargo') ? ' has-danger' : '' }}">
                            <label>{{ __('CARGO') }}</label>
                            <input type="text" name="cargo" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" id="cargo" placeholder="{{ __('Cargo') }}" >
                       
                        </div>
                        <div class="col-sm-3{{ $errors->has('departa') ? ' has-danger' : '' }}">
                            <label>{{ __('DEPARTAMENTO') }}</label>
                            <div class="input-group mb-3">
                            <select class="form-control{{ $errors->has('departa') ? ' is-invalid' : '' }} selec" name="departa" id="depar"  >
                                <option selected disabled value="">ELEGIR...</option>
                                @foreach ($puesto as $puest)
                                @if ($puest->estado==0)
                                @if ($puest->id_empresa==Auth::user()->id_empresa)
                                <option value="{{$puest->id}}">{{$puest->name}}</option>
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

                        <div class="col-sm-4{{ $errors->has('grupo') ? ' has-danger' : '' }}">
                          <label>{{ __('GRUPOS') }}</label>
                          <div class="input-group mb-3">
                          <select class="form-control{{ $errors->has('grupo') ? ' is-invalid' : '' }} selec" name="grupo" id="grupo">
                              <option selected value="">ELEGIR...</option>
                              @foreach ($equipo as $equipos)
                              @if ($equipos->estado==0)
                              @if ($equipos->id_empresa==Auth::user()->id_empresa)
                                  
                              <option value="{{$equipos->id}}">{{$equipos->descripcion}} {{$equipos->entrada."  "."A"."  ".$equipos->salida}}</option>
                              @endif
                              @endif
                              @endforeach
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#group" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                          </div>
                        </div>
                        @include('Empleados.modalgroup') 


                        {{-- @include('users.modalrole') --}}
                    </div>
                </div>
              </div>

            
        </div>


        <div class="card" style="top: -20px;">
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
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ASIGNACIONES</a>
                        </li>
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
                                <div class="col-sm-4"><input type="text"   name="nop" class="form-control datosInput" id="NN" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" ></div>
                                <div class="col-sm-3"><input type="tel"   name="telp" class="form-control datosInput" id="tt" placeholder="{{ __('Telefono') }}" ></div>
                                <div class="col-sm-3"><input type="text"  onFocus="GanoFoco2();" onBlur="PierdoFoco2();"  name="parp" class="form-control datosInput" id="parentesco" placeholder="{{ __('Parentesco') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" ></div>
                                <button type="button" onclick="capturar();" class="btn btn-info btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                               </div>
                               <div style=" max-height:189px; overflow:auto; position: relative; top: -10px; position: relative; top:-12px; ">
                            <table class="table tablesorter " id="transTable">
                                <thead class=" text-primary">
                                    <tr>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">TÉLEFONO</th>
                                    <th scope="col">PARENTESCO</th>
                                  </tr>
                                </thead>
                                <tbody>
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
                                 @foreach ($asignaciones as $asigna)
                                 @if ($asigna->id_empresa==0)
                                    <tr>
                                        <td>{{$asigna->Nombre}}</td>
                                        <td>{{$asigna->Monto}}%</td>
                                        <td><span id="seguro{{$asigna->id}}"></span></td>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" name="checkasgina[] " type="checkbox"  value="{{$asigna->id}}" >
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                  @endforeach
                                  <tr>
                                    <td>ISR</td>
                                    <td><span id="porcentaje"></span></td>
                                    <td><span id="monto"></span></td>
                                    <td>
                                      <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="isres" id="exent" value="1" disabled type="checkbox" >
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    </td>
                                  </tr>
                                    </tbody>
                                </table>
                                </div>
                                <button type="button" data-toggle="modal" data-target="#newasigna" style="top: 11px;" class="btn btn-success float-right btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                                <div class="card-footer text-muted ">
                                  
                                  @include('Empleados.asignamodal')
                                  <b class="float-left">SUELDO NETO: <span id="totalnomina"></span></b>
                                  <b class="float-right">TOTAL DEDUCCIÓN: <span id="totaldedu"></span></b>
                          </div>
                            </div>
                        </div>
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
                                    </tbody>
                                </table>
                                </div>
                            <button type="button" onclick="newadjunto();" style="top: 307px; position: absolute; margin-left: 574px;" class="btn btn-info float-right btn-sm redondo" id="limpiar" ><i class="fas fa-plus"></i></button>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="contra" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="card-body" style="height: 250px;" >
                                
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggle(this)'>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                            <h5><b>TODOS</b></h5>
                                        </label>
                                    </div>
                            </div>       
                        </div>
                      </div>
                </div>
                </div>
        </div>

    </div>
    <div class="col-md-4">
    <div class="position-fixed col-md-4" style="margin-left: -25px">
        <div class="card card-user" style="height: 274px;">
            <div class="card-body">
                <p class="card-text">
                    <div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>

                      {{-- <div class="avatar mx-auto " id="image" ></div> --}}
                      <img class="avatar" src="{{asset('black') }}/img/default-user-image.png" id="image" alt="">
                            

                        <p class="description">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image"   aria-describedby="inputGroupFileAddon01" id="subirimaggen" hidden>
                                <label class="custom-file-label" for="inputGroupFile01" hidden>Choose file</label>
                              </div>
                        </p>
                      </div>
                    </p>
                    
                  </div>
        </div>


    <input type="text" name="porcentaje" value="" id="porcen" hidden>
    <input type="text" name="AFP" value="" id="AFP" hidden>
    <input type="text" name="SFS" value="" id="SFS" hidden>
    <input type="text" name="ISR" value="" id="ISR" hidden>


    <button type="submit" id="seave"  class="btn btn-fill btn-info mx-auto"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
    <input type="text" name="imagen"  id="idphoto" hidden value="">
  </form>
    </div>
    </div>
</div>



<div class="modal fade" id="adjunnowuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

@include('Empleados.cropper')
@endsection


@section('js2')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script> --}}
{{-- <script src="{{asset('js/holdOn.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/holdOn.css')}}"> --}}
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="{{asset('js/timepicker.min.js')}}"></script>
<script>
  $(document).ready(function(){
// $("#btncollapse").trigger("click");

// $("#btncollapse").on('click',function(){
//   $("#collapse-example").attr('hidden',false);
// });
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


$("#cedula").mask('000-0000000-0');
    $('#salario').mask('0#');
    $("input[type='tel']").mask('(000) 000-0000');
    $('.money').mask("#,##0.00", {reverse: true});
    $("#pass").val('');
    $('.bs-timepicker').timepicker();



 $("#exampleRadios1").attr("checked",true);
  $("#salida").hide();
  // $("#btncollapse").trigger("click");

 $("#exampleRadios1").change(function(){
  if($(this).val()=="fijo"){
      $("#salida").hide();
      $("#entrada").show();
      $("#salario").show();
      $("#cargo").show();
      $("#depar").show();
      $("#forma").show();
  }
 });

 $("#exampleRadios2").change(function(){
  if($(this).val()=="temporal"){
      $("#salida").show();
      $("#entrada").show();
      $("#salario").show();
      $("#cargo").show();
      $("#depar").show();
      $("#forma").show();
  }
 });


 

// document.addEventListener ("keydown", function (e) {
//     if (e.keyCode== 13) {
//         $("#subir").trigger("click");
//     } 
// });


  }); 

  HayFoco=false;
HayFoco2=false;
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
  // alert(HayFoco2);
  
}
  
  $('#exampleModal').keyup(function(e){
    if(e.keyCode==13)
    {
      
      $('#btnpago').trigger("click");
      return false;
      
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
      return false;

      
    }
    if(e.keycode!=13)
    {
       
        $("#newdepart").focus();
    }
});

document.addEventListener ("keydown", function (e) {
  // alert(HayFoco2);
  if(HayFoco2==true ){
    if (e.keyCode== 13) {
      capturar();
      event.preventDefault();
    } 
  } 
});


$("#formulario").validate({

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

jQuery.extend(jQuery.validator.messages, {
    required: "",
    remote: "Please fix this field.",
    email: "Ingrese un Correo Electronico valido.",
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


$("#newdepart").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#newpago").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#parentesco").on('keypress', function(e) {   return e.keyCode != 13; }); 
$('#adjunnow').keyup(function(e){
    if(e.keyCode==13)
    {
      return false
      $('#btnadjunto').trigger("click");
      
    }
    if(e.keycode!=13)
    {
        $("#nameadjunto").focus();
    }
});

options2 = { style: 'currency', currency: 'USD' };
 numberFormat2 = new Intl.NumberFormat('en-US', options2);

 

//  function calcular(){
//  var  total=0;
//  var templeado=0;
//  var afp=0;
//   var sfs=0;
//   var isr=0;
// var final=0;
//   var porcentaje="";
//   var monto="";

//   var checker=0;
//   var escala=0;

// var verficar =0;
//   var id=6;
//   var id1=7
//   var tdeducion=0;
 
//         if(!isNaN(total)){
//           $("#salario").each(function() {
//             var sub=$(this).val();
            
            
//             if(sub!=''){

//               total=parseInt($(this).val(),10);
//               sfs=total*3.04;
//               sfs=sfs/100;

//               afp=total*2.87;
//               afp=afp/100;
              
              
//               $("#AFP").attr('value',afp);
//               $("#SFS").attr('value',sfs);

//               templeado=total-afp-sfs;
              
              

//               if(templeado<34685){
//                 porcentaje="Exento";
//                 monto="Exento";
//                 verficar=0;
//                 final=total-afp-sfs;
//                 tdeducion=afp+sfs+escala;
//                 $("#exent").prop('checked',false);
                
//                 $("#exent").attr('disabled',true);
                
//               }
              
//               if(templeado>34685){
//                 isr=templeado*12;
//                 final=0;
//                 escala=0;

//                 if (isr>867123){
//                  escala=isr-867123;
//                  isr=escala*25;
//                  escala=isr/100;
//                  escala=escala+79776;
//                  escala=escala/12;
//                   porcentaje="25%";
//                   $("#porcen").attr('value',porcentaje);
//                   verficar=1;
//                   final=total-afp-sfs-escala;
//                   tdeducion=afp+sfs+escala;
//                   $("#exent").attr('disabled',false);
                  
//                 }

                
//                 if (isr>416220 && isr<624329){
//                   escala=isr-416220.01;
//                   isr=escala*15;
//                   escala=isr/100;
//                   escala=escala/12;
//                   porcentaje="15%";
//                   $("#porcen").attr('value',porcentaje);
//                   verficar=1;
//                   final=total-afp-sfs-escala;
//                   tdeducion=afp+sfs+escala;
//                   $("#exent").attr('disabled',false);

//                 }
        

//                 if (isr>624329 && isr<867123){
//                  escala=isr-624329;
//                  isr=escala*20;
//                  escala=isr/100;
//                  escala=escala+31216;
//                  escala=escala/12;
//                   porcentaje="20%";
//                   $("#porcen").attr('value',porcentaje);
//                   verficar=1;
//                   final=total-afp-sfs-escala;
//                   tdeducion=afp+sfs+escala;
//                   $("#exent").attr('disabled',false);
//                 }



//               }

              
              
//             }
//           });
//           $("#ISR").attr('value',escala);
//           res= numberFormat2.format(sfs);
//           res1= numberFormat2.format(afp);
//           res2= numberFormat2.format(escala);
//           res3= numberFormat2.format(final);
//           res4=numberFormat2.format(tdeducion);
//         // $("#totl").attr('value',total);
          
//         $("#seguro"+id).empty();
//         $("#seguro"+id).append(res)

//         $("#seguro"+id1).empty();
//         $("#seguro"+id1).append(res1)
        
//         $("#totalnomina").empty();
//         $("#totalnomina").append(res3)

//         $("#porcentaje").empty();
//         $("#porcentaje").append(porcentaje);

//         $("#totaldedu").empty();
//         $("#totaldedu").append(res4);




//         if(verficar==0){
//         $("#monto").empty();
//         $("#monto").append(monto);
//         }

//         if(verficar==1){
//          $("#monto").empty();
//         $("#monto").append(res2);
//         }

        


//         }
// }

function calcular(){
   var salario=$("#salario").val();
   
   var sum=0;

   var montoFormat = toInt(salario);
 


   sum=montoFormat/23.83/8;

   $("#recisalario").attr('value',montoFormat);
   $("#salDias").attr('value',financial(sum));


 }
 
 function financial(x) {
   var sala=Number.parseFloat(x).toFixed(2);
  return sala;
}


String.prototype.toInt = function (){    
    return parseInt(this.split(' ').join('').split(',').join('') || 0);
}

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


// window.onbeforeunload = function(e) {
//     HoldOn.open(options);
// };

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
  $("#NN").focus();

baseDatos.push(nuevoSujeto);
console.log(baseDatos);
var button = '<button type="button"class="btn btn-danger borrar btn-sm"><i class="fas fa-minus"></i></button';
$('transTable').append(button);




document.getElementById("transTable").innerHTML += '<tr class="reducir"><td><input type="text" name="no[]" value="'+nuevoSujeto.nombre+'"/ hidden>'+nuevoSujeto.nombre+'</td><td><input type="text" name="parentesco[]" value="'+nuevoSujeto.preferencia+'"/hidden>'+nuevoSujeto.preferencia+'</td><td><input type="text" name="tel[]" value="'+nuevoSujeto.telefono+'"/ hidden>'+nuevoSujeto.telefono+'</td><td>'+button+'</td></tr>';


}

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
              $("#depar option[value="+ $(result).val() +"]").attr("selected",true);
            

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
              $("#forma option[value="+ $(result).val() +"]").attr("selected",true);
            //   $("#forma").attr('selected',true);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 
}

// function savedrole(){
//     var namew=$("#newrol").val();
//     var url = "{{url('savedrole')}}"; 
//      var data ={namew:namew};
//         $.ajax({
//          method: "POST",
//            data: data,
//             url:url ,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success:function(result){
//               $("#rolesmodal").modal("toggle");
//               $("#rol").append(result);
//               $("#rol option[value="+ $(result).val() +"]").attr("selected",true);

            

//            },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) { 
//                 ErroresGeneral();
//     }
//              }); 
// }

function saveasignar(){
    var noms=$("#noms").val();
    var tipos=$("#tipos").val();
    var monts=$("#monts").val();
    var url = "{{url('saveasignar')}}"; 
     var data ={noms:noms,tipos:tipos,monts:monts};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#newasigna").modal("toggle");
              $("#Asigna tbody").append(result);
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 
}

function toggle(source) {
  checkboxes = document.getElementsByName('dinamico[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

$("#image").on('click',function(){
 $("#subirimaggen").click();

});

// $("#subirimaggen").on('change',function(){
//     $("#image").append()
// });




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




function newadjunto(){
    var url = "{{url('newadjuntouser')}}"; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#adjunnowuser").html(result).modal("show");
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 
}

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
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
