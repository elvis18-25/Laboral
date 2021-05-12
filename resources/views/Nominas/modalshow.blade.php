
  <!-- Modal -->
  <div class="modal fade" id="detalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" margin-top: -95px; ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">DETALLES DE: &nbsp;<span id="nameemple"></span> 
          
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-inline" style="color: gray">
          <div class="form-check">
            <label class="form-check-label">
              <label> NO APLICAR</label>
                <input class="form-check-input"  type="checkbox"  disabled >
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div> 
        &nbsp;
        <div class="form-check">
          <label class="form-check-label">
            <label>APLICAR</label>
              <input class="form-check-input"  type="checkbox" checked disabled >
              <span class="form-check-sign">
                  <span class="check"></span>
              </span>
          </label>
      </div>
    </div>
    <br>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">DEDUCIONES</a>
                  <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">INCREMENTOS</a>
                  <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">OTROS</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body" style="height: 276px;" >
                        <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                        <table class="table table-striped table-hover" id="Detalles">
                            <thead>
                              <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">TIPO</th>
                                <th scope="col">MONTO</th>
                                <th scope="col">P.MONTO</th>
                                <th scope="col">FECHA ASIGNADA</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>

                </div>
                </div>
                <div class="card-footer text-muted"  >
                    <b class="float-right" style="color: black">TOTAL: <span id="totald"></span></b>
                   </div>
            </div> 
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <div class="card-body" style="height: 276px;">
                    <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                      <table class="table table-striped table-hover" id="aumeto">
                  <thead>
                <tr>
                  <th scope="col">NOMBRE</th>
                  <th scope="col">TIPO</th>
                  <th scope="col">MONTO</th>
                  <th scope="col">P.MONTO</th>
                  <th scope="col">FECHA ASIGNADA</th>
                  <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                  </div>
                  </div>
                <div class="card-footer text-muted" >
                 <b class="float-right" style="color: black">TOTAL:<span id="totalI"></span></b>
                </div>
              </div>

              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                  <div class="card-body" style="height: 276px;">
                    <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                      <table class="table table-striped table-hover" id="ot">
                  <thead>
                    <tr>
                      <th scope="col">NOMBRE</th>
                      <th scope="col">TIPO</th>
                      <th scope="col">FORMA</th>
                      <th scope="col">MONTO</th>
                      <th scope="col">P.MONTO</th>
                      <th scope="col">FECHA ASIGNADA</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                  </div>
                </div>
                
                <div class="card-footer text-muted"  >
                  <button type="button" id="btnnew" class="btn btn-info btn-sm" style="position: absolute; margin-left: 679px; top: 308px;" data-toggle="modal" data-target="#otrosmodal"><i class="fas fa-plus"></i></button>

                  <b class="float-right" style="color: black">TOTAL:<span id="totalO"></span></b>
                </div>
              </div>

     <input type="text" name="" value="" id="idempleados" hidden>
              </div>      
          </div>
          <div class="modal-footer">
            <button type="button" onclick="eliminaremple();" class="btn btn-danger" style="position: absolute; top:402px;"><i class="fas fa-trash"></i>&nbsp;Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>
    #Detalles{
      width: 706px !important;
  margin-left: 0px !important;
    }
    #aumeto{
      width: 706px !important;
  margin-left: 0px !important;
    }
    #ot{
      width: 706px !important;
  margin-left: 0px !important;
    }
  </style>