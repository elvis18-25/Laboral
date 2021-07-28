
  
  <!-- Modal -->
  <div class="modal fade" id="conceptomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 16px !important; font-weight: bold !important;"><b>AGREGAR NUEVO GASTO DEL PERIODO </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            

              <ul class="nav nav-tabs" id="myTab" role="tablist" >
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" tabindex="0" role="tab" aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#phone" tabindex="1" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#upload" tabindex="2" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="form-row">
                  <div class="form-group col-md-8" >
                    <label for="inputEmail4"><b>CONCEPTO</b></label>
                      <input type="text" onFocus="GanoFoco2();" onBlur="PierdoFoco2();"  value="" id="concepto" placeholder="Concepto" class="form-control datosInput focus" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                  </div>
      
                  <div class="form-group col-md-4">
                    <label for="inputEmail4"><b>MONTO</b></label>
                      <input type="text" onFocus="GanoFoco();" style="text-align: right;" onkeyup="calcular();"  onBlur="PierdoFoco();"  value="" id="montoOPS"   class="form-control datosInput money" placeholder="Monto">
                      <input type="text" name="" id="monto" value="" hidden>
                  </div>
                </div>

                {{-- <form action="/upload-target" class="dropzone"></form> --}}
                <form action="/file-upload"
                class="dropzone"
                id="my-awesome-dropzone"></form>

                </div>
                <div class="tab-pane fade" id="phone" role="tabpanel" aria-labelledby="profile-tab">
                  <div id="qrcode" style="margin-left: 36%"></div>

                </div>
                <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="contact-tab">

                  <form id="createforme" enctype="multipart/form-data">
                  <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" style="cursor: pointer;" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" style="color: black; cursor: pointer;" id="actual-btn">ELEGIR ARCHIVO</label>
                    </div>
                  </div>
                  <button type="submit" id="btnadjuntos" hidden></button>
                </form>

                </div>
              </div>
              
                <input type="text" name="" id="files" value="" hidden>
          </div>
    
        <div class="modal-footer" style="display: flow-root !important;">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-success redondo float-left" id="btnphone" title="Agregar Fotos por el cell"><i class="fas fa-mobile-alt" style="font-size: 18px;"></i></button>
          {{-- <button type="button" class="btn btn-warning redondo float-left" id="btnpc" title="Agregar Fotos por la Pc" style="margin-left: 5px;"><i class="fas fa-image" style="font-size: 17px;  margin-left: -3px;"></i></button> --}}
          <button class="btn btn-info redondo float-left" id="btnsave"  title="Agregar Gasto" type="button" style=" position: relative;margin-left: 5px; top:-1px" onclick=" capturar();"><i class="fas fa-save"></i></button>
          <button type="button" class="btn btn-success redondo" id="back" hidden><i class="fas fa-arrow-left"></i></button>
        </div>
      </div>
    </div>
  </div>


  <script>



// $("#btnconceptrs").on('click',function(){
//   $("#btnphone").attr('hidden',false);
// });


$("#btnphone").on('click',function(){

  $('a[tabindex=1]').trigger("click");
  $("#back").attr('hidden',false);
  $("#btnpc").attr('hidden',true);
  $("#btnsave").attr('hidden',true);
  $("#btnphone").attr('hidden',true);

});

$("#back").on('click',function(){
  $('a[tabindex=0]').trigger("click");
  $("#back").attr('hidden',true);
  $("#btnpc").attr('hidden',false);
  $("#btnsave").attr('hidden',false);
  $("#btnphone").attr('hidden',false);

});

$("#btnpc").on('click',function(){
  $('a[tabindex=2]').trigger("click");
  $("#back").attr('hidden',false);
  $("#btnpc").attr('hidden',true);
  $("#btnsave").attr('hidden',true);
  $("#btnphone").attr('hidden',true);

});

const MAXIMO_TAMANIO_BYTES = 1000000; // 1MB = 1 millón de bytes
$miInput = document.querySelector("#inputGroupFile01");

$miInput.addEventListener("change", function () {
	// si no hay archivos, regresamos
	if (this.files.length <= 0) return;

	// Validamos el primer archivo únicamente
	const archivo = this.files[0];
	if (archivo.size > MAXIMO_TAMANIO_BYTES) {
		const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;

		$miInput.value = "";

        document.getElementById('inputGroupFile01').onchange = function () {
  console.log(this.value);
  document.getElementById('actual-btn').innerHTML = document.getElementById('inputGroupFile01').files[0].name;
}
    Errores();
	} else {
		// Validación pasada. Envía el formulario o haz lo que tengas que hacer
	}
});

document.getElementById('inputGroupFile01').onchange = function () {
  console.log(this.value);
  document.getElementById('actual-btn').innerHTML = document.getElementById('inputGroupFile01').files[0].name;
}



function Errores() {
  Command: toastr["error"]("El Tamoño maximo es de un 1MB", "Error")
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