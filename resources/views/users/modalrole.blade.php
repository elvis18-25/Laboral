
  
  <!-- Modal -->
  <div class="modal fade" id="rolesmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #525f7f ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: white">NUEVO ROL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group{{ $errors->has('newrol') ? ' has-danger' : '' }}">
                <label style="color: white">{{ __('NUEVO ROL ') }}</label>
                <input type="text" name="newrol" autofocus id="newrol"  class="form-control{{ $errors->has('newrol') ? ' is-invalid' : '' }}" placeholder="{{ __('NUEVO ROL') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" onclick="savedrole();" id="btndepartamento" class="btn btn-primary"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  