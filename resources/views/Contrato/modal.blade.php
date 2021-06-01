{{-- <button type='button' id="modal-contra" class='btn btn-info float-right'  style="margin-left:10px;" hidden>Crear Nuevo Contrato&nbsp;<i class="fas fa-plus"></i></button> --}}

<!-- Modal -->
<div class="modal fade" id="contrato" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="color: black">CONTRATO</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar bg-info"  role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <br>
            <form id="regiration_form" enctype="multipart/form-data" method="POST">
            @csrf
              <fieldset>
                <div class="card-body" style="height: 150px">
            <h4 style="color: black">PASO 1: DESCARGAR EL MODELO DEL CONTRATO</h4>
            <div class="form-group">
            
              <a href="{{url('donwload/Contrato.docx')}}"><button type="button" id="btndown" class="btn btn-success">Descargar Contrato &nbsp;<i class="fas fa-download"></i></button></a>
            
              
            </div>
            </div>
            <input type="button" name="data[password]" class="next btn btn-info" value="Siguiente" style="margin-left: 332px;" />
            </fieldset>
            <fieldset>
              <div class="card-body" style="height: 150px">
            <h4 style="color: black"> PASO 2: MODIFICAR EL CONTRATO A SU PREFERENCIA</h4>
            <div class="form-group">
             <h5 style="color: black">PUEDE A PRODECEDER A MODIFICAR SU <b>CONTRATO</b> A SU PREFERENCIA, 
                SOLAMENTE QUE NO PUEDE QUITAR, REMPLAZAR O ELIMINAR SON LAS PALABRAS 
                QUE CONTENGAN ESTOS SIMBOLOS <b>${ }</b>, PARA QUE LA INFORMACIÓ DEL EMPLEADO SE CONTEMPLE EN ELLA.
               <b> NOTA: SOLO SE PERMITE ARCHIVO DE WORD CON EXTENCIONES .DOC, .DOCX</b>
            </h5>
            <br>
            </div>
            </div>
            <input type="button" name="previous" class="previous btn btn-default" value="Previo" style="margin-left: 267px;" />
            <input type="button" name="next" class="next btn btn-info" value="Siguiente" style="margin-left: -1px;" />
            </fieldset>
            <fieldset>
              <div class="card-body" style="height: 150px">
            <h4 style="color: black">PASO 3: SUBIR EL ARCHIVO MODIFICADO</h4>
            <div class="form-group">
            <input type="file" name="archivo" id="file" accept=".doc, .docx" hidden>
            <button class="btn btn-fill btn-success" id="btnupload"  type="button"><i class="fas fa-upload"></i></button>
            <label id="fichero" style="color: black;">SIN ARCHIVO</label>
            </div>
            </div>
            <input type="button" name="previous" class="previous btn btn-default" value="Previo"style="margin-left: 267px;" />
            <input type="submit" name="submit" class="submit btn btn-info" value="Enviar" style="margin-left: -1px;" id="submit_data" />
            </fieldset>
            </form>
       
        </div>
      </div>
    </div>
  </div>



@section('js2')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

  <style type="text/css">
  #regiration_form fieldset:not(:first-of-type) {
    display: none;
  }

  </style>


<script>
  
$(document).ready(function(){
  // HoldOn.close();
var current = 1,current_step,next_step,steps;
steps = $("fieldset").length;
$(".next").click(function(){
current_step = $(this).parent();
next_step = $(this).parent().next();
next_step.show();
current_step.hide();
setProgressBar(++current);
});
$(".previous").click(function(){
current_step = $(this).parent();
next_step = $(this).parent().prev();
next_step.show();
current_step.hide();
setProgressBar(--current);
});
setProgressBar(current);
// Change progress bar action
function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
.html(percent+"%");
}

$("#btnupload").on('click',function(){
$("#file").trigger("click");

});


// const inputElement = document.querySelector('input[type="file"]');
// const pond = FilePond.create( inputElement );



i=0;
const MAXIMO_TAMANIO_BYTES = 1000000; // 1MB = 1 millón de bytes
$miInput = document.querySelector("#file");

$miInput.addEventListener("change", function () {
	// si no hay archivos, regresamos
	if (this.files.length <= 0) return;

	// Validamos el primer archivo únicamente
	const archivo = this.files[0];
	if (archivo.size > MAXIMO_TAMANIO_BYTES) {
		const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
		$miInput.value = "";
    Errores();
    i=0;
	} 
  
  document.getElementById('file').onchange = function () {
  console.log(this.value);
  document.getElementById('fichero').innerHTML = document.getElementById('file').files[0].name;
}

  if(archivo.size < MAXIMO_TAMANIO_BYTES) {
		i=1;

	}
});

$('#regiration_form').on('submit',function(e){
  if(i==1){
    e.preventDefault();
      var formdata= new FormData(this);
      formdata.append('_token', $('input[name=_token]').val());

  var url="{{url('guardar')}}";

   $.ajax({
      type:'POST',
      url:url, 
      data:formdata,
      cache:false,
      contentType: false,
      processData: false,
      success:function(data){
        $("#contrato").modal("toggle");
        $("#contratos-table tbody").append(data);
        correcto();
          // toastr.success('Validation true!', 'se pudo Añadir los datos<br>', {timeOut: 5000});
      },
      error: function(jqXHR, text, error){
          // toastr.error('Validation error!', 'No se pudo Añadir los datos<br>' + error, {timeOut: 5000});
      }
     });
  }else{
    return false;
  }
});

});

function Errores(){
    Command: toastr["error"]("El Tamaño maximo es  de un 1mb", "Error")
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

function correcto(){
  Command: toastr["success"]("Se ha subido su contrato exitosamente", "Exito!")
  toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
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
// $("#btndown").on('click',function(e){
     
      

</script>
@endsection