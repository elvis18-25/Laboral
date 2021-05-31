
  
  <!-- Modal -->
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black"><b>NUEVA FORMA DE PAGO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group{{ $errors->has('newpago') ? ' has-danger' : '' }} text-left">
                <label style="color: black">{{ __('FORMA DE PAGO') }}</label>
                <input type="text" name="newpago" id="newpago" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control{{ $errors->has('newpago') ? ' is-invalid' : '' }}" placeholder="{{ __('NUEVA FORMA DE PAGO') }}">
           
            </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button> --}}
          <button type="button" onclick="savepagos();" id="btnpago" class="btn btn-info float-right redondo"><i class="fas fa-save" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
        </div>
      </div>
    </div>
  </div>
  
