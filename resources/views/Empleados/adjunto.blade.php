
  
  <!-- Modal -->
  <form id="createforme" enctype="multipart/form-data">
    @csrf
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
            
            <input type="text" name="" id="idempel" value="{{$id}}" hidden>
        </div>
        <div class="modal-footer">
            <button type="submit" id="btnajunto"  class="btn btn-info"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
    {{-- <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}"> --}}
</form>
<script>

i=0;

$("#btnuploa").on('click',function(){
    $("#actual-btn").trigger("click");
  });

  const MAXIMO_TAMANIO_BYTES = 1000000; // 1MB = 1 millón de bytes
$miInput = document.querySelector("#actual-btn");;

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
		// Limpiar
	} else {
		i=1;
	}
});

document.getElementById('actual-btn').onchange = function () {
  console.log(this.value);
  document.getElementById('file-chosen').innerHTML = document.getElementById('actual-btn').files[0].name;
}

  $('#createforme').on('submit',function(e){
    if(i==1){
    e.preventDefault();
      var formdata= new FormData(this);
      console.log(formdata);
      var id=$("#idempel").val();
      formdata.append('_token', $('input[name=_token]').val());

var url="{{url('Gadjunto')}}/"+id;

   $.ajax({
      type:'POST',
      url:url, 
      data:formdata,
      cache:false,
      contentType: false,
      processData: false,
      success:function(data){
        $('#Adjunto tbody').append(data);
        $("#adjunnew").trigger("click");
        $miInput.value = "";
          // toastr.success('Validation true!', 'se pudo Añadir los datos<br>', {timeOut: 5000});
      },
      error: function(jqXHR, text, error){
          // toastr.error('Validation error!', 'No se pudo Añadir los datos<br>' + error, {timeOut: 5000});
      }
     });
    }
    else{
      return false;
    }
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

</script>