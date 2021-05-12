
  
  <!-- Modal -->
  <div class="modal fade" id="departament" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">NUEVO DEPARTAMENTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group{{ $errors->has('newdepart') ? ' has-danger' : '' }}">
                <label style="color: black">{{ __('NUEVO DEPARTAMENTO ') }}</label>
                <input type="text" name="newdepart" autofocus id="newdepart"  class="form-control{{ $errors->has('newdepart') ? ' is-invalid' : '' }}" placeholder="{{ __('NUEVO DEPARTAMENTO') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
           
            </div>
        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button> --}}
            <button type="button" onclick="savedepart();" id="btndepartamento" class="btn btn-info"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  