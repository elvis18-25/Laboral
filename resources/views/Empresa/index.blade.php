@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])
@section('content')
<link rel="stylesheet" href="{{asset('css/empresa.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">



<div class="row">

  <div class="col-sm-2">
    <div class="card" style="width: 100%;">
    <div class="col-12">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">CONFIGURACIÓN DEL SITIO</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#VLO" role="tab" aria-controls="v-pills-settings" aria-selected="false">AJUSTES DEL SISTEMA</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#HL" role="tab" aria-controls="v-pills-profile" aria-selected="false">HORARIO LABORALES</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">CONTRATO</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">NUEVA EMPRESA</a>
    </div>
  </div>
 </div>
</div>

<div class="col-sm-10">
  <div class="tab-content" id="v-pills-tabContent">

      <!---------------------------------------------------------------CONFIGURACIÓN DEL SITIO<------------------------------------------------------------------------------>
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
      <div class="card">
        <div class="card-header">
          <div class="row">
              <div class="col-8">
                  <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>CONFIGURACIÓN DEL SITIO</b></h4>
              </div>
              <div class="col-4 text-right">
                  {{-- <a href="{{url('Nominas')}}" class="btn btn-sm btn-info"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus"></i></a> --}}
              </div>
          </div>
        @php
        $color="";
            if($empresa->color==null){
             $color='#'.str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);;
            }else{
             $color=$empresa->color;
            }
        @endphp
        <div class="card-body" style="height: 400px; width: 100%;">
          <form action="{{Route('Empresa.update',$empresa->id)}}" method="POST"  enctype="multipart/form-data" id="formulario">
            @csrf
            @method('PUT')
        <div class="color" style=' background-color:<?php printf($color); ?>'>
          @if ($empresa->imagen!=null)
          <img class="Logo" src="{{ asset('logo/'.$empresa->imagen)}}"  id="image" alt="">
              
          @else
          <img src="{{asset('recuros/empresa.png')}}" width="50%" height="50%" id="image"  alt="">
          @endif
        </div>
            <div class="form-row">

             <div class="col-sm-5">
                 <label for=""><b>NOMBRE:</b></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-required">
                        <i class="fas fa-address-card" style="color: black"></i>
                    </div>
                </div>
                <input type="text" name="nombreUP" value="{{$empresa->nombre}}" autofocus class="form-control" required placeholder="Nombre de la Empresa" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
        </div>

        

        <div class="col-sm-3 wrap-input100 validate-input m-b-18" >
            <label for=""><b>TELÉFONO:</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text input-required" style="color: black">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                </div>
                <input type="tel" name="telefonoUP" required value="{{$empresa->telefono}}" class="form-control" placeholder="Télefono">
            </div>
            <span class="focus-input100"></span>
        </div>



        <div class="col-sm-3">
            <label for=""><b>RNC:</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="color: black">
                        <i class="tim-icons icon-paper"></i>
                    </div>
                </div>
                <input type="text" name="rncUP" class="form-control rnc" value="{{$empresa->rnc}}" placeholder="RNC">
            </div>
      </div>

        <div class="col-sm-4">
            <label for=""><b>DIRECCION:</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text input-required" style="color: black">
                        <i class="tim-icons icon-map-big"></i>
                    </div>
                </div>
                <input type="text" name="direcionUP" required class="form-control"value="{{$empresa->direcion}}" placeholder="Direccion" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
        </div>
        
        <div class="col-sm-4">
            <label for=""><b>EMAIL:</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text input-required" style="color: black">
                        <i class="fas fa-at"></i>
                    </div>
                </div>
                <input type="email" name="emailUP" required class="form-control"value="{{$empresa->email}}" placeholder="Email" >
            </div>
        </div>

        <div class="col-sm-4">
            <div class="color-wrapper">
              <label for=""><b>COLOR:</b></label><br>
              <input type="text" name="custom_color" readonly placeholder="#FFFFFF" id="pickcolor" class="call-picker form-control" value="{{$empresa->color}}">
              <div class="color-holder call-picker"></div>
              <div class="color-picker" id="color-picker" style="display: none"></div>
            </div>
          </div>




            <div class="form-group col-md-3">
              <label for="inputState"><b>PAIS</b></label>
              <select  class="form-control" value="{{old('pais')}}" id="countries" name="pais" required>
                <option selected disabled>ELEGIR...</option>
                @foreach ($pais as $paises)
                @if ($paises->id==$empresa->contry)
                <option value="{{$paises->id}}" selected>{{$paises->name}}</option >
                @else
                <option value="{{$paises->id}}">{{$paises->name}}</option >
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="inputState"><b>ESTADO</b></label>
              <select  class="form-control" value="{{old('state')}}" id="state" name="state" required>
                @if ($state_start!=0)

                @foreach ($state as $states)
                @if ($states->id==$state_start)
                <option value="{{$states->id}}" selected>{{$states->name}}</option >
                @else
                <option value="{{$states->id}}" >{{$states->name}}</option >
                 @endif
                    
                @endforeach
                    
                @else
                <option selected disabled value="{{old('state')}}">ELEGIR...</option>
                    
                @endif
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="inputState"><b>CIUDAD</b></label>
              <select  class="form-control" value="{{old('ciudad')}}"  name="ciudad" id="cities" required>
                @if ($city_start!=0)

                @foreach ($city as $cities)
                @if ($cities->id==$city_start)
                <option value="{{$cities->id}}" selected>{{$cities->name}}</option >
                  
                  @else
                  <option value="{{$cities->id}}" >{{$cities->name}}</option >
                    
                @endif
                    
                @endforeach
                    
                @else
                <option selected disabled value="{{old('ciudad')}}">ELEGIR...</option>
                    
                @endif
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="inputCity"><b>CODIGO POSTAL</b></label>
              <input type="text" class="form-control" id="inputCity" value="{{$empresa->zipcode}}" name="zipcode">
            </div>
            <div class="col-sm-4">
              <label for=""><b>IMAGEN:</b></label><br>
              <button type="button" type="button" id="btnuploa" for="actual-btn"  class="btn btn-success btn-sm"><i class="fas fa-folder-open"></i></button>
              <input type="file" id="actual-btn" max-file-size="1" accept=".png" name="archiveUP" hidden/>
              {{-- <label for="actual-btn" id="labides" style="color: black;"></label> --}}
              <span id="file-chosen" style="color: black">SIN ARCHIVO...</span>
            </div>


        </div>
        

        <button type="submit" class="btn btn-info btn-round btn-lg" id="btnnext" style="margin-left: 236px; top:-40px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
        <input type="text" name="imagen"  id="idphoto" hidden value="">
    </form>

    <form action="{{Route('Empresa.destroy',$empresa->id)}}" id="deleempleado" method="POST">
        @csrf
        @method('DELETE')
     <button type="submit"  class="btn btn-danger btn-round btn-lg" title="Eliminar Empresa" style="margin-left: 410px; top: -96px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>

    

        </div>
      </div>
    </div>



  </div>
  <!---------------------------------------------------------------CONFIGURACIÓN DEL SITIO------------------------------------------------------------------------------>

  <!---------------------------------------------------------------HORARIO LABORAL-------------------------------------------------------------------------------------->

  <div class="tab-pane fade" id="HL" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b></b></h4>
            </div>
            <div class="col-4 text-right">
              <button type="button" class="btn btn-info btn-sm redondo float-right" data-toggle="modal" data-target="#NewHoras" >
                <i class="fas fa-plus"></i>
              </button>
            </div>
        </div>
    </div>
    @include('Empresa.newhHoras')

      <table class="table tablesorter  table-hover" id="HL-Table">

              <thead class=" text-primary">
                  <tr> 
                    <th class="TitleP">HORARIOS</th>
                    <th class="TitleP">HORAS DE TRABAJO</th>
                    <th class="TitleP">INICIO</th>
                    <th class="TitleP">FINALIZACION</th>

                </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
        </div>
  </div>
  <!---------------------------------------------------------------HORARIO LABORAL-------------------------------------------------------------------------------------->

  <!-----------------------------------------------------------------CONTRATOS----------------------------------------------------------------------------------------->

  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>CONTRATOS</b></h4>
            </div>
            <div class="col-4 text-right">
              <button type="button" class="btn btn-info btn-sm float-right redondo" data-toggle="modal" data-target="#contrato"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body" >
        <table class="table tablesorter " id="contratos-table">
            <thead class=" text-primary">
                <tr> 
                <th scope="col">NOMBRE</th>
                <th scope="col">USUARIO</th>
                <th scope="col">FECHA</th>
                <th></th>

              </tr>
            </thead>
            <tbody>
                
                @foreach ($contrato as $contratos)
                
                @if ($contratos->estado==0) 
                @if ($contratos->id_empresa==$empresa->id)
                <tr >
                    <td>{{$contratos->name}}</td>
                    <td>{{$contratos->user}}</td>
                    <td>{{$contratos->created_at->format('d/m/Y')}}</td>
                    <td>
                        <button type="button" value="{{$contratos->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endif
              @endif
               
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
  <!------------------------------------------------------------------CONTRATOS-------------------------------------------------------------------------------------->


<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
  <div class="card">
    <div class="card-header">
      <div class="row">
          <div class="col-8">
              <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVA EMPRESA</b></h4>
          </div>
          <div class="col-4 text-right">
          </div>
      </div>
  </div>
  <div class="card-body"  style="height: 400px;">
      
        
          <form action="{{Route('Empresa.store')}}" method="POST">
              @csrf
              <div class="form-row">
              <div class="col-sm-5">
                  <label for=""><b>NOMBRE:</b></label>
                 <div class="input-group mb-3">
                     <div class="input-group-prepend">
                         <div class="input-group-text">
                         <i class="fas fa-address-card" style="color: black"></i>
                     </div>
                 </div>
                 <input type="text" name="nombre"  autofocus class="form-control" placeholder="Nombre de la Empresa" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
             </div>
         </div>

         <div class="col-sm-3 wrap-input100 validate-input m-b-18" >
             <label for=""><b>TELÉFONO:</b></label>
             <div class="input-group mb-3">
                 <div class="input-group-prepend">
                     <div class="input-group-text" style="color: black">
                         <i class="fas fa-mobile-alt"></i>
                     </div>
                 </div>
                 <input type="tel" name="telefono"  class="form-control" placeholder="Télefono">
             </div>
             <span class="focus-input100"></span>
         </div>

         <div class="col-sm-3">
             <label for=""><b>RNC:</b></label>
             <div class="input-group mb-3">
                 <div class="input-group-prepend">
                     <div class="input-group-text" style="color: black">
                         <i class="tim-icons icon-paper"></i>
                     </div>
                 </div>
                 <input type="text" name="rnc" class="form-control rnc"  placeholder="RNC">
             </div>
       </div>

         <div class="col-sm-4">
             <label for=""><b>DIRECCION:</b></label>
             <div class="input-group mb-3">
                 <div class="input-group-prepend">
                     <div class="input-group-text" style="color: black">
                         <i class="tim-icons icon-map-big"></i>
                     </div>
                 </div>
                 <input type="text" name="direcion" class="form-control" placeholder="Direccion" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
             </div>
         </div>

         <div class="col-sm-4">
             <label for=""><b>EMAIL:</b></label>
             <div class="input-group mb-3">
                 <div class="input-group-prepend">
                     <div class="input-group-text" style="color: black">
                         <i class="fas fa-at"></i>
                     </div>
                 </div>
                 <input type="email" name="email" class="form-control" placeholder="Email" >
             </div>
         </div>

         <div class="col-sm-4">
             <div class="color-wrapper">
               <label for=""><b>COLOR:</b></label><br>
               <input type="text" name="custom_color" placeholder="#FFFFFF" id="pickcolor" class="call-picker form-control" >
               <div class="color-holder call-picker"></div>
               <div class="color-picker" id="color-picker" style="display: none"></div>
             </div>
           </div>

         <div class="col-sm-4">
             <label for=""><b>IMAGEN:</b></label><br>
             <button type="button" type="button" id="btnuploa" for="actual-btn"  class="btn btn-success btn-sm"><i class="fas fa-folder-open"></i></button>
             <input type="file" id="actual-btn" max-file-size="1" accept=".png" name="archiveUP" hidden/>
             {{-- <label for="actual-btn" id="labides" style="color: black;"></label> --}}
             <span id="file-chosen" style="color: black">SIN ARCHIVO...</span>
           </div>

           <button type="submit" class="btn btn-info btn-round btn-lg" id="btnnext" style="margin-left: 197px; top:82px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
          </form>
     

  </div>
</div>
</div>
</div>

<!-----------------------------------------------------------------------AJUSTE DEL SISTEMA----------------------------------------------------------------------->
<div class="tab-pane fade" id="VLO" role="tabpanel" aria-labelledby="v-pills-messages-tab">
<form action="{{url('Savepermis')}}" method="post">

  
  <input type="text" value="{{$roles->id}}" name="rol" hidden>
  @csrf
  <div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>AJUSTES DEL SISTEMA</b></h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        @csrf
        <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#modulos" role="tab" aria-controls="home" aria-selected="true">MODULOS</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#dashboards" role="tab" aria-controls="profile" aria-selected="false">DASHBOARD</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#acciones" role="tab" aria-controls="contact" aria-selected="false">ACCIONES</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="modulos" role="tabpanel" aria-labelledby="home-tab">
              <table class="table table-striped rolesdws" id="roles">
                <thead>
                  <tr>
                    <th class="TitleP" style="font-size: 14px;"><b>ACCESO</b></th>
                    <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
                    <th class="TitleP"  style="font-size: 14px;"><b>
                        <div class="form-check" style="margin-left: -5px;">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggleDonm(this)' >
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                                {{-- <h5><b>TODOS</b></h5> --}}
                            </label>
                        </div>    
                    </b></th>
                  </tr>
                </thead>
                <tbody>
                  @include('Empresa.Plantillas.tablemodulo')
            </tbody>
        </table>
            </div>

            <div class="tab-pane fade" id="dashboards" role="tabpanel" aria-labelledby="profile-tab">
              <table class="table table-striped widfgets" id="Widget">
                <thead>
                  <tr>
                    <th class="TitleP" style="font-size: 14px;"><b>ACCESSO</b></th>
                    <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
                    <th class="TitleP"  style="font-size: 14px;"><b>
                        <div class="form-check" style="margin-left: 9px;">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="todos" id="todoWidget" onclick='toggleWidg(this)' >
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span> 
                                {{-- <h5><b>TODOS</b></h5> --}}
                            </label>
                        </div>    
                    </b></th>
                  </tr>
                </thead>
                <tbody>
                  @include('Empresa.Plantillas.table')
            </tbody>
        </table>
            </div>
            <div class="tab-pane fade" id="acciones" role="tabpanel" aria-labelledby="contact-tab">
              <table class="table table-striped rolesdws" id="accionsf">
                <thead>
                  <tr>
                    <th class="TitleP" style="font-size: 14px;"><b>ACCESO</b></th>
                    <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
                    <th class="TitleP"  style="font-size: 14px;"><b>
                        <div class="form-check" style="margin-left: 3px;">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggleAccion(this)' >
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span> 
                                {{-- <h5><b>TODOS</b></h5> --}}
                            </label>
                        </div>    
                    </b></th>
                  </tr>
                </thead>
                <tbody>
                  @include('Empresa.Plantillas.tableaccion')
            </tbody>
        </table>
            </div>
          </div>
   
{{-- </div> --}}

</div>
        </div>
              <button type="submit" class="btn btn-info btn-round btn-lg" id="btnnext" style="float: right;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>

            </form>
  </div>
</div>
</div>
</div>
<!-----------------------------------------------------------------------AJUSTE DEL SISTEMA----------------------------------------------------------------------->


    </div>
</div>
</div>
<div class="modal fade" id="HorasEmple" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="updatehours" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

  @include('Empresa.cropper')

<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner logotipo">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
  </div>

    @include('Contrato.modal')
@endsection

@section('js')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clockpicker.min.css')}}">
<script type="text/javascript" src="{{asset('js/bootstrap-clockpicker.min.js')}}"></script>

@if (session('guardado')=='ya')
<script>
  Command: toastr["success"]("Se ha guardado correctamente", "")
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
  </script>    
@endif
<script>

  $("#ColWeekendeEn").hide();
  $("#ColWeekendeSa").hide();

  $("#btnCheck").on('click',function(){
    if($(this).val()==0){
      $("#ColWeekendeEn").show();
      $("#ColWeekendeSa").show();
      $("#btnCheck").attr('value',1);
    }else{
      $("#ColWeekendeEn").hide();
      $("#ColWeekendeSa").hide();
      $("#btnCheck").attr('value',0);
    }
  });



  $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#HL-Table').DataTable({
        "searching": false,
        "paging":   false,
        "ordering": false,
        "info":     false,
        processing:true,
      

    serverSide:true,
    ajax:
    {
      url:"{{ url('datatableHorario') }}",
      
    },

    language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

      }, 


    columns:[
    {data:'day',name:'day', },
    {data:'horas', name:'horas', class: "TitleP", searchable:false},
    {data:'start', name:'start', class: "TitleP", searchable:false},
    {data:'end', name:'end', class: "TitleP", searchable:false},
    // {data:'btn',name:'btn', class: "TitleP",}
    ],

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
      ErroresCampo();
  }

});

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


document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});


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

$("#HL-Table tbody").on('click','tr',function(){
  var valor=$(this).attr('data-href');
  Horario(valor);
})


function Horario(e){
    var url = "{{url('HorarioEmpresa')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#HorasEmple").html(result).modal("show");
            // html(result).modal("show");

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 
}

// $("input[name='custom_color']").mask('0#');
$(".rnc").mask('0#');
$("input[type='tel']").mask('(000) 000-0000');



var colorList = [ '000000', '993300', '333300', '003300', '003366', '000066', '333399', '333333', 
'660000', 'FF6633', '666633', '336633', '336666', '0066FF', '666699', '666666', 'CC3333', 'FF9933', '99CC33', '669966', '66CCCC', '3366FF', '663366', '999999', 'CC66FF', 'FFCC33', 'FFFF66', '99FF66', '99CCCC', '66CCFF', '993366', 'CCCCCC', 'FF99CC', 'FFCC99', 'FFFF99', 'CCffCC', 'CCFFff', '99CCFF', 'CC99FF', 'FFFFFF' ];
		var picker = $('#color-picker');

		for (var i = 0; i < colorList.length; i++ ) {
			picker.append('<li class="color-item" data-hex="' + '#' + colorList[i] + '" style="background-color:' + '#' + colorList[i] + ';"></li>');
		}

		$('body').click(function () {
			picker.fadeOut();
		});

		$('.call-picker').click(function(event) {
			event.stopPropagation();
			picker.fadeIn();
			picker.children('li').hover(function() {
				var codeHex = $(this).data('hex');

				$('.color-holder').css('background-color', codeHex);
				$('#pickcolor').val(codeHex);
                $('.color').css('background-color', codeHex);
			});
		});

$("#btnuploa").on('click',function(){
    $("#actual-btn").trigger("click");
  });     

var $modal = $('#crpimg');

var image = document.getElementById('sample_image');

var cropper;

$('#actual-btn').change(function(event){
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
        url:"{{url('Empresaphoto')}}",
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
  function SuccesGen(){
    Command: toastr["success"]("", "Exito!")
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
      "hideMethod": "fadeOut",
    }
  }
function ErroresCampo(){
    Command: toastr["error"]("Estos Campos son obligatorios", "Error!")
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

  function toggle(source) {
  checkboxes = document.getElementsByName('dinamico[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

function toggleDonm(source) {
  checkboxes = document.getElementsByName('donm[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}
function toggleWidg(source) {
  checkboxes = document.getElementsByName('wingdt[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}
function toggleAccion(source) {
  checkboxes = document.getElementsByName('accion[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

table=$('#roles').DataTable({
    "info": false,
    "paging":   false,
    "ordering": false,
    scrollY: 500,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group',
    },

    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],

        language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

      },    
   
});

$('div.dataTables_filter input', table.table().container()).focus();

var rowIdx = table.cell(':eq(0)').index().row;
      
table.row(rowIdx).select();

table.cell( ':eq(0)' ).focus();


document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16){
       
        var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();   
        
        
    } 
});

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 84) {
        $('#todos').trigger("click");
        $('#todoWidget').trigger("click");
    }
});

$('#roles').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#roles').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#roles').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 
            var colum=$('td', row_s).eq(2);

            var siz=$(colum).attr('value');
            $("#modulo"+siz).trigger("click");

            console.log(siz);

        }
        
    });


   $('div.dataTables_filter input', table.table().container()).on('click',function(){
    var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();
      
      table.cell( ':eq(0)' ).focus();

   });


   tab=$('#Widget').DataTable({
    "info": false,
    "paging":   false,
    "ordering": false,
    scrollY: 500,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group',
    },

    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
        language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

      },    
   
    });


$('#Widget').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tab.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#Widget').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tab.cell(this).index().row;

        
        // Select row
        tab.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Widget').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = tab.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 
            var colum=$('td', row_s).eq(2);

            var siz=$(colum).attr('value');
            $("#widgdt"+siz).trigger("click");

            console.log(siz);

        }
        
    });


    
   $('div.dataTables_filter input', tab.table().container()).on('click',function(){
    var rowIdx = tab.cell(':eq(0)').index().row;
      
    tab.row(rowIdx).select();
      
    tab.cell( ':eq(0)' ).focus();

   });
   

   tabes=$('#accionsf').DataTable({
    "info": false,
    "paging":   false,
    "ordering": false,
    scrollY: 500,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group',
    },

    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
        language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

      },    
   
    });


$('#accionsf').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tabes.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#accionsf').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tabes.cell(this).index().row;

        
        // Select row
        tabes.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#accionsf').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = tabes.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 
            var colum=$('td', row_s).eq(2);

            var siz=$(colum).attr('value');
            $("#acciones"+siz).trigger("click");

            console.log(siz);

        }
        
    });

    $('div.dataTables_filter input', tabes.table().container()).on('click',function(){
    var rowIdx = tabes.cell(':eq(0)').index().row;
      
    tabes.row(rowIdx).select();
      
    tabes.cell( ':eq(0)' ).focus();

   });


$('.clockpicker').clockpicker();

$('#inputCity').mask('0#');
    </script>

    <style>
      .form-control[readonly]{
        background-color: rgb(255 255 255 / 50%);
      }

      .TitleP{
        text-align: center;
      }
      .TitleL{
        text-align: left;
    }
      #HL-Table{
        width: -webkit-fill-available !important; 
      }
      #HL-Table tbody tr{
        cursor: pointer;
      }

      .dataTables_scrollHeadInner{
        width: 105% !important;
      }
      .rolesdws{
        width: 100% !important;
      }
      .widfgets{
        width: 100% !important;
      }
      #roles>tbody>tr>td{
        padding: 5px 7px !important;
      }
      #Widget>tbody>tr>td{
        padding: 5px 7px !important;
      }
      #accionsf>tbody>tr>td{
        padding: 5px 7px !important;
      }
    </style>
@endsection