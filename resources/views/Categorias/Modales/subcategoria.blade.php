
  <!-- Modal -->
  <div class="modal fade" id="Submodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>SUBCATEGORIAS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <div class="col-sm-11 text-left">
                <input type="text" name="newcategoria" id="subcat" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control datosInput" placeholder="{{ __('SUBCATEGORIAS') }}">
            </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo btn-sm" id="btnclicksub" onclick="capturar();"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
