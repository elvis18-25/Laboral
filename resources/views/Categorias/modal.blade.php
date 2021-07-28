
  <!-- Modal -->
  <div class="modal fade" id="Modalcategorias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="top: -78px; ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>NUEVA CATEGORIA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-sm-6 text-left">
                <label style="color: black"><b>{{ __('CATEGORIA:') }}</b></label>
                <input type="text" name="newcategoria" id="newcategoria" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control{{ $errors->has('newpago') ? ' is-invalid' : '' }}" placeholder="{{ __('Categoria') }}">
            </div>
            <div class="form-check" style="margin-left: 9px; top: 24px;">
              <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="todos" id="btnCheck"  >
                  <span class="form-check-sign">
                      <span class="check"></span>
                  </span> 
                  <h5><b>AÑADIR SUBCATEGORIAS</b></h5>
              </label>
          </div>
        </div>

          <div id="btnplus">
            <button type="button" class="btn btn-info redondo btn-sm"  data-toggle="modal" data-target="#Submodal"><i class="fas fa-plus"></i></button>
          </div>
          <div style="max-height: 277px; overflow-x: hidden; width: 100%; position: relative; overflow-y: auto; font-size:small; top:-1px; ">
            <table class="table" id="subcategorias">
              <thead>
                <tr>
                  <th style="text-align: left;">ID</th>
                  <th style="text-align: left;">NOMBRE</th>
                  <th style="text-align: left;">ACCION</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo btn-sm" id="btnclick" onclick="savecategoria();"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>

  <style>
    #subcategorias>tbody>tr>td{
      padding: 5px 7px;
    }
  </style>