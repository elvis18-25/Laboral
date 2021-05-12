
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">NUEVA FORMA DE PAGO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group{{ $errors->has('newpago') ? ' has-danger' : '' }}">
                <label style="color: black">{{ __('NUEVA FORMA DE PAGO') }}</label>
                <input type="text" name="newpago" id="newpago" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control{{ $errors->has('newpago') ? ' is-invalid' : '' }}" placeholder="{{ __('NUEVA FORMA DE PAGO') }}">
           
            </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button> --}}
          <button type="button" onclick="savepago();" id="btnpago" class="btn btn-info"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  