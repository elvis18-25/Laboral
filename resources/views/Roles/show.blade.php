@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>EDITAR ROL</b></h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <form action="{{Route('Roles.update',$roles->id)}}" method="POST">
            @csrf
            @method('PUT')
        <div class="card-body">
    <div class="col-sm-6">
        <input type="text" name="descripcion" value="{{$roles->name}}" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Nombre">
    </div>
<br>
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggle(this)' >
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
            <h5><b>TODOS</b></h5>
        </label>
    </div>
    <br>
            
<div class="card-body" style="top: -35px; position: relative;">

@if ($permisos->empleado==1)
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="1" >
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
            <h5><b>VER EMPLEADOS</b></h5>
        </label>
    </div>
    @else 
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox"  name="dinamico[]" value="1" >
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
            <h5><b>VER EMPLEADOS</b></h5>
        </label>
    </div>
@endif 

@if ($permisos->usuario==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked  name="dinamico[]" value="2" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER USUARIOS</b></h5>
    </label>
</div>   
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked  name="dinamico[]" value="2" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER USUARIOS</b></h5>
    </label>
</div> 
@endif

@if ($permisos->departamento==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="3" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER DEPARTAMENTOS</b></h5>
    </label>
</div> 
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox"  name="dinamico[]" value="3" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER DEPARTAMENTOS</b></h5>
    </label>
</div>  
@endif


@if ($permisos->roles==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="4" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER ROLES</b></h5>
    </label>
</div>
</div>   
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="4" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER ROLES</b></h5>
    </label>
</div>
@endif
  

<div class="card-body" style="top: 153px; position: absolute; margin-left: 184px;">
@if ($permisos->gastos==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="5" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER GASTOS</b></h5>
    </label>
</div>   
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="5" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER GASTOS</b></h5>
    </label>
</div> 
@endif


@if ($permisos->asignaciones==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="6" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER ASIGNACIONES</b></h5>
    </label>
</div>   
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="6" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER ASIGNACIONES</b></h5>
    </label>
</div>  
@endif


@if ($permisos->listado==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="8" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER LISTADO DE NOMINA</b></h5>
    </label>
</div>  
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="8" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER LISTADO DE NOMINA</b></h5>
    </label>
</div> 
@endif


@if ($permisos->perfiles==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked  name="dinamico[]" value="9" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER PERFILES DE NOMINAS</b></h5>
    </label>
</div>  
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="9" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER PERFILES DE NOMINAS</b></h5>
    </label>
</div>   
@endif

</div>

<div class="card-body" style="position: absolute; top: 151px; margin-left: 397px;">


    @if ($permisos->nomina==1)
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="10" >
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
            <h5><b>VER NOMINAS</b></h5>
        </label>
    </div>   
    @else
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="dinamico[]" value="10" >
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
            <h5><b>VER NOMINAS</b></h5>
        </label>
    </div>    
    @endif

@if ($permisos->formas_pagos==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="11" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER FORMA DE PAGO</b></h5>
    </label>
</div> 
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="11" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER FORMA DE PAGO</b></h5>
    </label>
</div>  
@endif

@if ($permisos->perfilesuser==1)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" checked name="dinamico[]" value="12" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER PERFILES DE USUARIOS</b></h5>
    </label>
</div>  
@else
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="dinamico[]" value="12" >
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        <h5><b>VER PERFILES DE USUARIOS</b></h5>
    </label>
</div>  
@endif

</div>


                
            </div>
        </div>
        <button type="submit"  id="subir" class="btn btn-fill btn-info float-right" style="top: 96px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
    </form>

    <form action="{{Route('Roles.destroy',$roles->id)}}" id="deleteroles" method="POST">
        @csrf
        @method('DELETE');
     <button type="submit"  class="btn btn-fill btn-danger float-right" style="top: 98px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
    </form>

        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>

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
    var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

$("#deleteroles").submit(function(e){
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
</script>
    
@endsection