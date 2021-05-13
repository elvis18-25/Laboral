<button type="button" class="btn btn-primary" id="opnemodal" data-toggle="modal" data-target="#createevent" hidden>
  Launch demo modal
</button>
  <!-- Modal -->
  <div class="modal fade" id="createevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>CREAR NUEVO EVENTO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="width: 152%;">
          <div class="form-row">
            <div class="col-sm-5 md-1">
              <label for="">TITULO:</label>
              <input type="text" id="txttitulo" name="txttitulo" class="form-control" placeholder="Titulo">
            </div>
            <div class="col-sm-2 md-8">
              <label for="">HORA:</label>
              <input type="text"  name="hora" class="form-control" id="timepicker"/>
            </div>
            <br><br>
          
          <div class="col-sm-8 md-3">
            <label for="exampleFormControlTextarea1">DESCRIPCION:</label>
            <textarea class="form-control" id="textarea" rows="3"></textarea>
          </div>
        <br><br>
        <div class="col-sm-5">
          <label for=""> COLOR:</label>
          <input type="text" id="txtcolor" name="txtcolor" class="form-control" />
        </div>
      </div>
      </div>
        <input type="text" id="txtfecha" value="" hidden >
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="btndelete"><i class="fas fa-trash"></i></button>
          <button type="button" id="btnsave" class="btn btn-info  redondo"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  
  <style>
    .redondo{
    display: block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
  }

  .form-control[readonly]{
    cursor: pointer  !important;
  }
  </style>