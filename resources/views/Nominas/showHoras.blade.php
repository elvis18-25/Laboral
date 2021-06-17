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

         
          <div class="col-sm-12">
            <div class="form-inline">
            <div class="form-check form-check-radio">
              <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked >
                  AÑADIR MANUALMENTE
                  <span class="form-check-sign"></span>
              </label>
          </div>
          <div class="form-check form-check-radio" style="margin-left: 12px;">
              <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" >
                  AÑADIR POR GRUPO
                  <span class="form-check-sign"></span>
              </label>
          </div>
        </div>
        </div>
         <br>
          <br>


        <div class="form-group col-md-4">
          <label for="inputState"><b>JORNADA LABORAL</b></label>
          <select id="inputState" class="form-control">
            @if ($horas->jornada=="DIURNA")
            <option selected value="0">DIURNA</option>
            @else
            <option  value="0">DIURNA</option>
            @endif

            @if ($horas->jornada=="NOCTURNA")
            <option value="1" selected>NOCTURNA</option>
            
            @else
            <option value="1" >NOCTURNA</option>
                
            @endif
        </select>
        </div>

        <div class="col-sm-4">
          <label for=""><b>FECHA DE INICIO</b></label><br>
          <input type="text" name="datetimes" class="form-control" value="{{$horas->fechainicio}}" id="fechaentrada" style="cursor: pointer !important; " readonly />
        </div>

        <div class="col-sm-4">
          <label for=""><b> FECHA DE FINALIZADO</b></label><br>
          <input type="text" name="datetimes" class="form-control" value="{{$horas->fechafinalizado}}" id="fechasalidad" style="cursor: pointer !important; " readonly />
        </div>
        <input type="text" id="started" value="{{$horas->fechainicio}}" hidden>
        <input type="text" id="ended" value="{{$horas->fechafinalizado}}" hidden>
        {{-- <input type="text" id="ended" value="{{$horas->fechafinalizado}}" hidden> --}}
{{-- 
       <div class="col-sm-6">
            <input type="text" class="form-control" value="13:14" readonly>
            <span class="input-group-addon">
                <span ></span>
            </span>
        </div>
      </div> --}}


        </div>
      </div>
      <input type="text" name="" value="" id="equipos" hidden>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger redondo" onclick="deletehoras({{$horas->id}});"><i class="fas fa-trash"></i></button>   
        <button type="button" class="btn btn-info redondo" onclick="updatehoras({{$horas->id}});"><i class="fas fa-save"></i></button>
    </div>
  </div>

  <script>

startComes = new Date($("#started").attr('value'));
 endComes = new Date($("#ended").attr('value'));

 start = moment(startComes);
 end = moment(endComes);

   $(function() {
$("#fechaentrada").daterangepicker({
  timePicker: true,
  singleDatePicker: true,
  timePicker24Hour: true,
  startDate: start,
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
  startDate: end,
  locale: {
    format: 'DD/MM/YYYY H:mm '
  }
});
}); 

function updatehoras(e){

var jornada=$("#inputState").val();
var fechaentrada=$("#fechaentrada").data('daterangepicker').startDate.format('YYYY-MM-DD H:mm');
var fechasalidad=$("#fechasalidad").data('daterangepicker').startDate.format('YYYY-MM-DD H:mm');
var url="{{url('updatehoras')}}/"+e; 
var data={jornada:jornada,fechaentrada:fechaentrada,fechasalidad:fechasalidad};
$.ajax({
       method: "POST",
         data: data,
          url:url ,
          success:function(result){
            // $('#horasTables tbody').empty();
            // $('#horasTables tbody').append(result);
            $("#showhorasModal").trigger("click");
            $("#detalle").trigger("click");
            succesGneral();
            tabla.ajax.reload();
            totalnomi(idnomina);

            

         },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
              ErroresGeneral();
  }
           });

}

function deletehoras(e){
    Swal.fire({
  title: '¿Estás seguro?',
  text: "¡No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminarlo!'
}).then((result) => {
  if (result.isConfirmed) {
    var url="{{url('deletehoras')}}/"+e; 
var data='';
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
            // $('#horasTables tbody').empty();
            // $('#horasTables tbody').append(result);
            $("#showhorasModal").trigger("click");
            $("#detalle").trigger("click");
            succesEliminar();
            tabla.ajax.reload();
            totalnomi(idnomina);
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });

  }
}) 
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
function succesGneral(){
  Command: toastr["success"]("Se ha Actualizado Correctamente", "")
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
function succesEliminar(){
  Command: toastr["success"]("Se ha Eliminado Correctamente", "")
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

$('.clockpicker').clockpicker();
  </script>

  <style>
    .form-control[readonly]{
      background-color: rgb(255 255 255 / 50%);
    }



  </style>