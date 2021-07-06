
  
  <!-- Modal -->
  <div class="modal fade" id="conceptomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 16px !important; font-weight: bold !important;"><b>AGREGAR NUEVO GASTO DEL PERIODO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
            <div class="form-group col-md-8" >
              <label for="inputEmail4"><b>CONCEPTO</b></label>
                <input type="text" onFocus="GanoFoco2();" onBlur="PierdoFoco2();"  value="" id="concepto" placeholder="Concepto" class="form-control datosInput focus" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>

            <div class="form-group col-md-4">
              <label for="inputEmail4"><b>MONTO</b></label>
                <input type="text" onFocus="GanoFoco();" style="text-align: left;"  onBlur="PierdoFoco();"  value="" id="monto"   class="form-control datosInput montro" placeholder="Monto">
            </div>
        </div>
          </div>
    
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button class="btn btn-info btn-sm redondo"  title="Agregar Gasto" type="button" style=" position: relative;margin-left: 3px; top:-4px" onclick=" capturar();"><i class="fas fa-plus"></i></button>
        </div>
      </div>
    </div>
  </div>

