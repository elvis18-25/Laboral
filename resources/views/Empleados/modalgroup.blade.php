<div class="modal fade" id="group" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">NUEVO GRUPO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-row">
                <div class="col-sm-6">
                    <label style="color: black"><b>{{ __('DESCRIPCION ') }}</b></label>
                    <input type="text"  autofocus id="descr"   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                </div>
        
                <div class="col-sm-2">
                    <label style="color: black"><b>{{ __('HORA DE ENTRADA') }}</b></label>
                    <input type="text"  class="form-control bs-timepicker" value="" id="entradaH">
                </div>
        
                <div class="col-sm-2">
                    <label style="color: black"><b>{{ __('HORA DE SALIDA') }}</b></label>
                    <input type="text"  class="form-control bs-timepicker" value="" id="salidaH">
                </div>
        
                </div>

        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button> --}}
            <button type="button" onclick="savedgruop();" id="btndepartamento" class="btn btn-info"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  