@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title"><b>SUBIR ARCHIVO</b></h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">
                {{-- <form action="{{url('savephone')}}" method="POST"> --}}
                  <form action="{{url('sender')}}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" id="actual-btn" style="color: black;">ELEGIR ARCHIVO</label>
                    </div>
                    {{-- <input type="text" name="text" id="" placeholder="Enviar" class="form-control"> --}}
                  </div>

                  <button type="submit" class="btn btn-info"><i class="fas fa-save"></i></button>
                </form>
            </div>
            <div class="">
            </div>
        </div>
    </div>
</div>
<div id="adcls" >
  <div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
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
		// Limpiar
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
    
@endsection