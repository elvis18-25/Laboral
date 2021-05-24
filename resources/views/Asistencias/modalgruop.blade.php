

<!-- Modal -->
<div class="modal fade" id="Mnomina" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" width: 931px; width: 931px; margin-top:-100px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black !important" ><b>GRUPOS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body" style="height: 335px;">
          {{-- <div style="max-height: 436px;font-size: small; top: -12px; overflow-y: auto; overflow-x: hidden; "> --}}
            <table class="table tablesorter table-striped table-hover" style="margin-left: -22px !important;  width: 106% !important;   position: relative;"  id="equipo-table">
                <thead class=" text-primary">
                    <tr> 
                      <th class="TitleP">DESCRIPCION</th>
                      <th class="TitleP">FECHA CREADA</th>
                      <th class="TitleP">EMPLEADOS</th>
                      <th class="TitleP">USUARIO</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          {{-- </div> --}}
        </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <style>
    .display{
      margin-left: 0px;
      width: 844px !important;
    }
    .dataTables_scrollBody{
      width: 104% !important;
      position: relative !important;
      overflow: auto !important;
      max-height: 449px !important;
      height: 473px !important;
    }
    .dataTables_scrollHeadInner{
      box-sizing: content-box !important;
    width: 860px !important;
    padding-right: 17px !important;
    }
  
    .table-striped{
      width: 935px !important;
    margin-left: 0px !important;
    }
    .dataTables_scrollHead{
      overflow: hidden !important;
    position: relative !important;
    border: 0px !important;
    width: 100% !important;
    }

    .dataTables_filter{
    margin-left: 45px !important;
  }
  </style>