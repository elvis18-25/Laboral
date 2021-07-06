
  <!-- Modal -->
  <div class="modal fade" id="detalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" margin-top: -95px; ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;">DETALLES DE: &nbsp;<span id="nameemple"></span> 
          
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">DEDUCIONES</a>
                  <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">INCREMENTOS</a>
                  <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">OTROS</a>
                  <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#horas" role="tab" aria-controls="nav-contact" aria-selected="false">HORAS</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body" style="height: 276px;" >
                        <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                        <table class="table table-striped table-hover" id="Detalles">
                            <thead>
                              <tr>
                                <th class="TitleP">DESCRIPCIÓN</th>
                                <th class="TitleP">TIPO</th>
                                <th class="TitleP">MONTO</th>
                                <th class="TitleP">P.MONTO</th>
                                <th class="TitleP">FECHA ASIGNADA</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>

                </div>
                </div>
                <div class="card-footer text-muted"  >
                    <b class="float-right" style="color: black;
                    font-size: 16px;
                    position: relative;
                    top: -12px;">TOTAL: <span id="totald"></span></b>
                   </div>
            </div> 
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <div class="card-body" style="height: 276px;">
                    <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                      <table class="table table-striped table-hover" id="aumeto">
                  <thead>
                <tr>
                  <th class="TitleP">DESCRIPCIÓN</th>
                  <th class="TitleP">TIPO</th>
                  <th class="TitleP">MONTO</th>
                  <th class="TitleP">P.MONTO</th>
                  <th class="TitleP">FECHA ASIGNADA</th>
                  <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                  </div>
                  </div>
                <div class="card-footer text-muted" >
                 <b class="float-right" style="color: black;
                 font-size: 16px;
                 position: relative;
                 top: -12px;">TOTAL:<span id="totalI"></span></b>
                </div>
              </div>


              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                  <div class="card-body" style="height: 276px;">
                    <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                      <table class="table table-striped table-hover" id="ot">
                  <thead>
                    <tr>
                      <th class="TitleP">DESCRIPCIÓN</th>
                      <th class="TitleP">TIPO</th>
                      <th class="TitleP">FORMA</th>
                      <th class="TitleP">MONTO</th>
                      <th class="TitleP">P.MONTO</th>
                      <th class="TitleP">FECHA ASIGNADA</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                  </div>
                </div>
                
                <div class="card-footer text-muted"  >
                  <button type="button" id="btnnew" class="btn btn-info btn-sm redondo" style="position: absolute; margin-left: 679px; top: 308px;" data-toggle="modal" data-target="#otrosmodal"><i class="fas fa-plus" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>

                  <b class="float-right" style="color: black;
                  font-size: 16px;
                  position: relative;
                  top: -12px;">TOTAL:<span id="totalO"></span></b>
                </div>
              </div>

              <div class="tab-pane fade" id="horas" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card-body" style="height: 276px;">
                  <div style="max-height: 214px; font-size: small; top: -12px; overflow-y: auto;  overflow-x: hidden; max-width: 755px; ">
                    <table class="table table-striped table-hover" id="horasTables">
                <thead>
              <tr>
                <th class="TitleP">FECHA DE ENTRADA</th>
                <th class="TitleP">FECHA DE SALIDA</th>
                <th class="TitleP">HORA EXTRA</th>
                <th class="TitleP">HORA DESCONTADA</th>
                <th class="TitleP">JORNADA</th>
                <th class="TitleP">MONTO</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
                </div>
                </div>
                
                <div class="card-footer text-muted" >
                <button type="button" id="btnnew" class="btn btn-info btn-sm redondo" style="position: absolute; margin-left: 679px; top: 308px;" onclick="modalhours();"><i class="fas fa-plus"></i></button>
               <b class="float-right" style="color: black;
               font-size: 16px;
               position: relative;
               top: -12px;">TOTAL:<span id="totalTimes"></span></b>
              </div>
            </div>

     <input type="text" name="" value="" id="idempleados" hidden>
              </div>      
          </div>
          <div class="modal-footer">
            <button type="button" onclick="eliminaremple();" class="btn btn-danger redondo" style="position: absolute; top: 388px;"><i class="fas fa-trash"></i></button>
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