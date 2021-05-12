
  
  <!-- Modal -->
  <form   id="createform" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black" >NUEVO ADJUNTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label style="color: black">{{ __('DESCRIPCION ') }}</label>
          <input type="text" class="form-control   mb-3" id="nameadjunto" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" name="descripsion" aria-describedby="emailHelp" placeholder="Descripcion">
          {{-- <input type="text" name="" id="idempel" value="{{$id}}" hidden> --}}
        <div class="custom-file col-sm-8">
          <input type="file" id="actual-btn" max-file-size="1" name="archive" hidden/>
          {{-- <label for="actual-btn" id="labides" style="color: black;"></label> --}}
          <span id="file-chosen" style="color: black">SIN ARCHIVO...</span>
          <button type="button" type="button" id="btnuploa" for="actual-btn"  class="btn btn-success btn-sm"><i class="fas fa-folder-open"></i></button>
        </div>
      </div>

        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button> --}}
            <button type="submit" id="btnadjunto"  class="btn btn-info submit"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>

</form>
  
<script>

$("#btnuploa").on('click',function(){
    $("#actual-btn").trigger("click");
  });
MAXIMO_TAMANIO_BYTES = 1000000; // 1MB = 1 millón de bytes
$miInput = document.querySelector("#actual-btn");

$miInput.addEventListener("change", function () {
	// si no hay archivos, regresamos
	if (this.files.length <= 0) return;

	// Validamos el primer archivo únicamente
	const archivo = this.files[0];
	if (archivo.size > MAXIMO_TAMANIO_BYTES) {
		const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;

		$miInput.value = "";
    Errores();
		// Limpiar
	} else {
		// Validación pasada. Envía el formulario o haz lo que tengas que hacer
	}
});

document.getElementById('actual-btn').onchange = function () {
  console.log(this.value);
  document.getElementById('file-chosen').innerHTML = document.getElementById('actual-btn').files[0].name;
}


$('#createform').on('submit',function(e){
  // agrego la data del form a formData
  e.preventDefault();
  var formData = new FormData(this);
  formData.append('_token', $('input[name=_token]').val());
 var url="{{url('savejuntouser')}}";
  $.ajax({
      type:'POST',
      url: url,
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      success:function(data){
        $('#Adjunto tbody').append(data);
        $("#adjunnowuser").trigger("click");
        
          // toastr.success('Validation true!', 'se pudo Añadir los datos<br>', {timeOut: 5000});
      },
      error: function(jqXHR, text, error){
          // toastr.error('Validation error!', 'No se pudo Añadir los datos<br>' + error, {timeOut: 5000});
      }
  });
});


  function Errores(){
    Command: toastr["error"]("El Tamaño maximo es un 1mb", "Error")
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


</script>

