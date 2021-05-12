@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">NUEVO ROL</h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <form action="{{Route('Roles.store')}}" method="POST">
        @csrf
        <div class="card-body">
    <div class="col-sm-6">
        <input type="text" name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Nombre">
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
            <div class="">
<div class="card-body" style="top: -35px; position: relative;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="1" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER EMPLEADOS</b></h5>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"  name="dinamico[]" value="2" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER USUARIOS</b></h5>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="3" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER DEPARTAMENTOS</b></h5>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="4" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER ROLES</b></h5>
                    </label>
                </div>
            </div>

            <div class="card-body" style="top: 153px; position: absolute; margin-left: 184px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="5" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER GASTOS</b></h5>
                    </label>
                </div>
            

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="6" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER ASIGNACIONES</b></h5>
                    </label>
                </div>



                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="8" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER LISTADO DE NOMINA</b></h5>
                    </label>
                </div>
            </div>

            <div class="card-body" style="position: absolute; top: 151px; margin-left: 397px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="9" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER PERFILES DE NOMINAS</b></h5>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="10" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER NOMINAS</b></h5>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="dinamico[]" value="11" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <h5><b>VER FORMA DE PAGO</b></h5>
                    </label>
                </div>
            </div>


                
            </div>
        </div>
        <button type="submit"  id="subir" class="btn btn-fill btn-info float-right" style="top: 47px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
    </form>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>

function toggle(source) {
  checkboxes = document.getElementsByName('dinamico[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

    var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

</script>
    
@endsection