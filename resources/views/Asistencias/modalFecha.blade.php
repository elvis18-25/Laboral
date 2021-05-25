
  <!-- Modal -->
  <div class="modal fade" id="horas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>HORAS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
              
        <div class="col-sm-6">
            <label for=""><b>FECHA DE ENTRADA</b></label>
            <input type="text" name="birthday" class="form-control" value="" />
        </div>

        <div class="col-sm-6 mb-3">
            <label for=""><b>FECHA DE SALIDA</b></label>
            <input type="text" name="birthday2s" class="form-control" value="" />
        </div>

        <div class="col-sm-12">
            <label for=""><b>NOTAS</b></label>
            <textarea class="form-control" name="notas" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" style="font-size: 12px !important; font-weight: bold !important; color: black" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info sseve" ><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>