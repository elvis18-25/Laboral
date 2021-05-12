 
  <!-- Modal -->
  <div class="modal fade" id="newasigna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"  style="background-color: #525f7f ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: white">NUEVA ASIGNACION</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
            <div class="col-sm-4{{ $errors->has('noms') ? ' has-danger' : '' }}">
                <label style="color: white">{{ __('NOMBRE') }}</label>
                <input type="text" name="noms" id="noms" class="form-control{{ $errors->has('noms') ? ' is-invalid' : '' }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}" >
            </div>
            <div class="col-sm-4{{ $errors->has('tipos') ? ' has-danger' : '' }}">
                <label style="color: white">{{ __('TIPO') }}</label>
                <select class="form-control{{ $errors->has('departa') ? ' is-invalid' : '' }} selec" name="tipos" id="tipos"  required>
                  <option selected value="">ELEGIR...</option>
                  <option selected value="1">PORCENTAJE</option>
                  <option selected value="2">MONTO</option>
                </select>
                {{-- <input type="text"   class="form-control{{ $errors->has('tipos') ? ' is-invalid' : '' }}" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Tipo') }}" > --}}
            
              </div>
            <div class="col-sm-4{{ $errors->has('monts') ? ' has-danger' : '' }}">
                <label style="color: white">{{ __('MONTO') }}</label>
                <input type="text" name="monts" id="monts" class="form-control{{ $errors->has('monts') ? ' is-invalid' : '' }}" placeholder="{{ __('Monto') }}" >
            </div>
        </div>
        </div>
        <div class="modal-footer">
            {{-- <button type="button"  class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button> --}}
            <button type="button" onclick="saveasignar();" class="btn btn-primary"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  