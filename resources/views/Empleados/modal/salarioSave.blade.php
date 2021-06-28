
  
  <!-- Modal -->
  <div class="modal fade" id="modalsalario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>DETALLE DEL SUELDO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="col-sm-8">
                    <label>{{ __('DESCRIPCIÓN') }}</label>
                    <input type="text" name="" id="SalarioName" value="" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}">
                </div>
                <div class="col-sm-4">
                    <label>{{ __('MONTO') }}</label>
                    <input type="text" name="" onkeyup="calcular();" id="salario" value="" class="form-control money">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo"><i class="fas fa-save" onclick="savesalario();" style="margin-left: -1px;"></i></button>
        </div>
      </div>
    </div>
  </div>

  <style>
      .redondo{
          width: 40px !important;
      }
  </style>