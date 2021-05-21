@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asistencia.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<form action="{{Route('Cooperativas.store')}}" method="POST" id="formularios" >
@csrf
{{ method_field('POST') }}
<div class="col-md-12">
    
    <div class="card " sty>
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>GESTION DE ASISTENCIAS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado a la cooperativa"  data-toggle="modal" data-target="#Empleados" class="btn btn-info btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Cooperativa.modalemple')
                </div>
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
        <div class="col-sm-6">
            <label style="color: black"><b>{{ __('DESCRIPCION ') }}</b></label>
            <input type="text" name="name" autofocus id="descr" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
        </div>

        <div class="col-sm-2">
            <label style="color: black"><b>{{ __('FORMA DEL DESCUENTO ') }}</b></label>
            <select  class="form-control selec" name="formae" required id="forma" >
                <option selected value="0" disabled >ElEGIR...</option>
                <option value="1">MONTO</option>
                <option value="2">PORCENTAJE</option>
              </select>
        </div>

        <div class="col-sm-2">
            <label style="color: black"><b>MONTO</b></label>
            <div class="input-group">
            <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                <div class="input-group-text" style="color: black"><span id="figura"></span></div>
              </div>
            <input type="text" name="monto" autofocus id="monto" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
        </div>
    </div>

        </div>

        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>MIEMBROS</b></h4>
                </div>
                {{-- <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado a la cooperativa"  data-toggle="modal" data-target="#Empleados" class="btn btn-info btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Cooperativa.modalemple')
                </div> --}}
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
            {{-- <div class="col-sm-4">
                <input type="text" name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
            </div> --}}
            {{-- <div class="col-sm-5">
                <input type="date" id="fech" name="fecha" class="form-control"  >
            </div> --}}
        </div>
        <br>
            <div class="">
                <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; ">
                <table class="table tablesorter table-hover" id="coop-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer">NOMBRE</th>
                        <th class="TitlePer">CEDULA</th>
                        <th class="TitlePer">CARGO</th>
                        <th class="TitlePer">DEPARTAMENTO</th>
                        <th class="TitlePer">SALARIO</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>
<input type="text" name="arreglo" value="" id="arreglo" hidden>

<button type="submit" id="subir" title="Guardar Perfil" class="btn btn-fill btn-info float-right">{{ __('Guardar') }}</button>
</form>

<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
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
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

</script>
@endsection