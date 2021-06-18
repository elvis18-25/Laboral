<div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>HORAS</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">

         <br>
          <br>
        
        <div class="form-group col-md-4" id="jornada">
          <label for="inputState"><b>JORNADA LABORAL</b></label>
          <select id="inputState" class="form-control">
            <option selected value="0">DIURNA</option>
            <option value="1">NOCTURNA</option>
          </select>
        </div>

        <div class="col-sm-4" id="inicio">
          <label for=""><b>FECHA DE INICIO</b></label><br>
          <input type="text" name="datetimes" class="form-control" id="fechaentrada" style="cursor: pointer !important; " readonly />
        </div>

        <div class="col-sm-4" id="salisa">
          <label for=""><b> FECHA DE FINALIZADO</b></label><br>
          <input type="text" name="datetimes" class="form-control" id="fechasalidad" style="cursor: pointer !important; " readonly />
        </div>
        <input type="text" id="empleado" value="{{$id}}" hidden>


        </div>
      </div>
      <input type="text" name="" value="" id="equipos" hidden>
      <div class="modal-footer">
        <button type="button" class="btn btn-info redondo" onclick="savehoras()"><i class="fas fa-save"></i></button>
      </div>
    </div>
  </div>

  <script>
   $(function() {
$("#fechaentrada").daterangepicker({
  timePicker: true,
  singleDatePicker: true,
  timePicker24Hour: true,

  startDate: moment().startOf('hour'),
  locale: {
    format: 'DD/MM/YYYY H:mm '
  }
});
}); 
   $(function() {
$("#fechasalidad").daterangepicker({
  timePicker: true,
  singleDatePicker: true,
  timePicker24Hour: true,

  startDate: moment().startOf('hour').add(7, 'd').add(7, 'hour'),
  locale: {
    format: 'DD/MM/YYYY H:mm '
  }
});
}); 

function savehoras(){


var jornada=$("#inputState").val();
var fechaentrada=$("#fechaentrada").data('daterangepicker').startDate.format('YYYY-MM-DD H:mm');
var fechasalidad=$("#fechasalidad").data('daterangepicker').startDate.format('YYYY-MM-DD H:mm');

var id=$("#empleado").val();
var id_nomina=$("#input").attr('value');
var url="{{url('savehorasListado')}}/"+id; 
var data={jornada:jornada,id_nomina:id_nomina,fechaentrada:fechaentrada,fechasalidad:fechasalidad};
$.ajax({
       method: "POST",
         data: data,
          url:url ,
          success:function(result){
            $('#horasTables tbody').append(result);
            $("#horassdd").trigger("click");
            $("#detalle").trigger("click");
            tabla.ajax.reload();
            totalnomi($("#input").attr('value'));

         },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
              ErroresGeneral();
  }
           });
}

function ErroreGrupo(){
  Command: toastr["error"]("Solo puede elegir una opcion a la vez", "Error!")
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
}
function ErroresGeneral(){
  Command: toastr["error"]("", "Error!")
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
}

$("#grupo").hide();
$("#exampleRadios1").change(function(){
if($(this).val()=="option1"){
    $("#grupo").hide();
    $("#inicio").show();
    $("#salisa").show();
}
});
$("#exampleRadios2").change(function(){
if($(this).val()=="option2"){
    $("#grupo").show();
    $("#inicio").hide();
    $("#salisa").hide();
}
});
$('.clockpicker').clockpicker();
  </script>

  <style>
    .form-control[readonly]{
      background-color: rgb(255 255 255 / 50%);
    }



  </style>