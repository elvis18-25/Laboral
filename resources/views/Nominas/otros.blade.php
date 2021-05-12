  
  <!-- Modal -->
  <div class="modal fade" id="otrosmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style=" margin-top: -95px; ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">OTROS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="col-sm-6">
                    <label style="color: black">{{ __('NOMBRE ') }}</label>
                    <input type="text" name="name" autofocus id="nameC"   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                </div>
    
                <div class="col-sm-6">
                    <label style="color: black">{{ __('TIPO ') }}</label>
                    <select id="inputStateC" class="form-control selec"  name="tipo" >
                        <option selected disabled>ElEGIR...</option>
                        <option value="1">DEDUCIÓN</option>
                        <option value="2">INCREMENTO</option>
                      </select>
                </div>
    
                <div class="col-sm-5">
                    <label style="color: black">{{ __('FORMA ') }}</label>
                    <select  class="form-control selec" name="formae"  id="formardC" >
                        <option selected disabled>ElEGIR...</option>
                        <option value="3">MONTO</option>
                        <option value="4">PORCENTAJE</option>
                      </select>
                </div>
              
                <div class="col-sm-6">
                    <label style="color: black"></label>
    
                    <div class="input-group" style="top: 5px;">
                    <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                        <div class="input-group-text" style="color: black"><span id="figures"></span></div>
                      </div>
                    <input type="text" name="monto" autofocus id="montoC"   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="text" id="empleotros" value="" hidden>
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-info" onclick="saveotros();"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  