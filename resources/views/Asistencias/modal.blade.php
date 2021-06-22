
  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ASISTENCIA DE:&nbsp;&nbsp;<b>{{$empleado->nombre." ".$empleado->apellido}}</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
              
        <div class="col-sm-6">
            <label for=""><b>FECHA DE ENTRADA</b></label>
            <input type="text" value="{{$asistencia->entrada}}" name="birthday" id="entrada" class="form-control" value="" />
        </div>

        <div class="col-sm-6 mb-3">
            <label for=""><b>FECHA DE SALIDA</b></label>
            <input type="text" value="{{$asistencia->salidad}}" name="birthday2s" id="salidad" class="form-control" value="" />
        </div>

        <div class="col-sm-12">
            <label for=""><b>NOTAS</b></label>
            <textarea class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" name="notas" id="notas" rows="3" style="font-size: 12px !important; font-weight: bold !important; color: black">{{$asistencia->notas}}</textarea>
        </div>
          </div>
          <input type="text" name="" value="{{$id}}" id="inputseEmple" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="saveFecha()" class="btn btn-info redondo" title="Guardar Asistencia"><i class="fas fa-save"></i></button>
          <button type="button" onclick="eliminar()" class="btn btn-danger redondo" title="Eliminar Asistencia"><i class="fas fa-trash"></i></button>
        </div>
      </div>
    </div>

<script>

    function saveFecha(){

var entrada=$('input[name="birthday"]').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm');
var salidad=$('input[name="birthday2s"]').data('daterangepicker').endDate.format('YYYY-MM-DD H:mm');
var notas=$("#notas").val();
var id=$("#inputseEmple").val();

var url="{{url('updatefecha')}}/"+id; 
var data={entrada:entrada,salidad:salidad,notas:notas};
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              // console.log(result);
              $("#horassdd").trigger("click");
              tabla.ajax.reload();

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
    }

    function eliminar(){
      Swal.fire({
  title: 'Encerio quieres Eliminarlo?',
  text: "No podras revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminarlo!'
}).then((result) => {
  if (result.isConfirmed) {
    var id=$("#inputseEmple").val();
var url="{{url('deletefecha')}}/"+id; 
var data='';
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              $("#horassdd").trigger("click");
              tabla.ajax.reload();
              Extio();

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
  }
})


    }

    function Extio(){
      Swal.fire(
      'Eliminado!',
      'La asistencia se ha eliminado exitosamente.',
      'success'
    )
  }

  var entrada=new Date($("#entrada").val());
  var salida=new Date($("#salidad").val());

    $(function() {
  $('input[name="birthday"]').daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    timePicker24Hour: true,

    startDate: moment(entrada),
    locale: {
      format: 'DD/MM/YYYY H:mm '
    },
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {

  });
});
$(function() {
  $('input[name="birthday2s"]').daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    timePicker24Hour: true,

    startDate: moment(salida),
    locale: {
      format: 'DD/MM/YYYY H:mm '
    },
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {

  });
});
</script>
