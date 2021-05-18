<button type="button" class="btn btn-primary" id="opnemodal" data-toggle="modal" data-target="#createevent" hidden>
  Launch demo modal
</button>
  <!-- Modal -->
  <div class="modal fade" id="createevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;"><b>CREAR NUEVO EVENTO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-sm-5 mb-3">
              <label for=""><b>TITULO:</b></label>
              <input type="text" id="txttitulo" name="txttitulo" class="form-control" placeholder="Titulo">
            </div>
            <div class="col-sm-3 mb-3">
              <label for=""><b>HORA:</b></label>
              <input type="text" class="form-control bs-timepicker" value="" id="horas">
            </div>
            <div class="col-sm-4">
              <label for=""><b>COLOR:</b></label>
              {{-- <input type="text" id="txtcolor" name="txtcolor" class="form-control" /> --}}
              <input value="#3399FF80" data-jscolor="{}" id="txtcolor">
            </div>
          
          {{-- <div class="col-sm-8 md-3">
            <label for="exampleFormControlTextarea1"><b>DESCRIPCION:</b></label>
            <textarea class="form-control" id="textarea" rows="3"></textarea>
          </div> --}}
 

        @php
            $user=Auth::user()->id_empresa;
        @endphp
        <input type="text" id="empresa" value="{{$user}}" hidden>
        <input type="text" id="estado" value="0" hidden>
      </div>
      </div>
        <input type="text" id="txtfecha" value="" hidden >
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-danger" id="btndelete"><i class="fas fa-trash"></i></button> --}}
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