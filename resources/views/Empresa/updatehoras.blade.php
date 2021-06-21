
  <!-- Modal -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR HORARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-row">
            <div class="col-sm-6">
                <label for="inputZip"><b>HORA DE INICIO </b></label>
              <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i style="color: black !important;" class="fas fa-clock"></i>
                 </div>      
               </div>
              <input type="text" class="form-control" id="HoraUpdateEntrada" value="{{$week->start}}"  name="HoraUpdateEntrada" readonly style="cursor: pointer !important; " >
            </div>
            </div>
            </div>

            <div class="col-sm-6">
              <label for="inputZip"><b>HORA DE FINALIZACIÓN </b></label>
              <div class="input-group clockpicker" data-placement="left"  data-align="top" data-autoclose="true">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i style="color: black !important;" class="fas fa-clock"></i>
               </div>      
             </div>
            <input type="text" class="form-control" id="HoraUpdateSalida" value="{{$week->end}}" name="HoraUpdateSalida" readonly style="cursor: pointer !important; " >
          </div>
          </div>
          </div> 
        </div>

      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
        <button type="button" class="btn btn-info redondo btn-sm" onclick="saveUpdate({{$week->id}})"><i class="fas fa-save"></i></button> 
      </div>
    </div>
  </div>

  <script>
$('.clockpicker').clockpicker();

function saveUpdate(e){
    var entrada=$("#HoraUpdateEntrada").val();
    var salida=$("#HoraUpdateSalida").val();
    var url = "{{url('saveUpdate')}}/"+e; 
     var data ={entrada:entrada,salida:salida};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                $("#HorasEmple").trigger("click");
                $("#updatehours").trigger("click");
                tabla.ajax.reload();
                SuccesGen();
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 
}
  </script>