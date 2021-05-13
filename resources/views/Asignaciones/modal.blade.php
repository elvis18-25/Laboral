
  
  <!-- Modal -->
  <div class="modal fade" id="asignacionesmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVA ASIGNACIÓN</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="form-row">
            <div class="col-sm-6">
                <label style="color: black"><b>{{ __('NOMBRE ') }}</b></label>
                <input type="text" name="name" autofocus id="name" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>

            <div class="col-sm-6">
                <label style="color: black"><b> {{ __('TIPO ') }}</b></label>
                <select id="inputState" class="form-control selec" required name="tipo" >
                    <option selected disabled>ElEGIR...</option>
                    <option value="1">DEDUCIÓN</option>
                    <option value="2">INCREMENTO</option>
                  </select>
            </div>

            <div class="col-sm-5">
                <label style="color: black"><b>{{ __('FORMA ') }}</b></label>
                <select  class="form-control selec" name="formae" required id="forma" >
                    <option selected disabled>ElEGIR...</option>
                    <option value="3">MONTO</option>
                    <option value="4">PORCENTAJE</option>
                  </select>
            </div>
          
            <div class="col-sm-6">
                <label style="color: black"></label>

                <div class="input-group" style="top: 5px;">
                <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                    <div class="input-group-text" style="color: black"><span id="figura"></span></div>
                  </div>
                <input type="text" name="monto" autofocus id="monto" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
        </div>

    </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo" id="saver" onclick="saveasignaciones();"><i class="fas fa-save" ></i></button>
        </div>
      </div>
    </div>
  </div>
  