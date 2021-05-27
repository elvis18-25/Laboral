<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
{{-- <link href="" rel="stylesheet">  --}}
    <link rel="icon" type="image/png" href="{{ asset('black') }}/img/Favicon.png">
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
    <title>Laboral</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          {{-- <form  class="sign-in-form" method="post" action="{{ route('login') }}"> --}}
          <form  class="sign-in-form" method="POST" action="{{url('MultiEmpresa')}}">
            @csrf
            @method('POST')
            <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="logotipo">
            <h2 class="title">Iniciar Sesión</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" name="email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="password" />
            </div>

            <input type="submit" value="Entrar" class="btn solid" />

          </form>

		  

          <form method="post" id="formulario" action="{{ route('register') }}" class="sign-up-form register">
            @csrf
            
            <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="logotipo">

            <h2 class="title">Registro</h2>
            <div style="max-height: 357px; overflow: hidden; font-size:small; top:-12px; " id="scroll">

            <span><b>Datos de la Empresa</b></span>
            <section class="section" id="empresa">
            <div class="input-field">
              <i class="fas fa-store-alt"></i>
              <input  type="text" name="nombre" id="nom" placeholder="Nombre de la Empresa" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" />
            </div>
            <div class="input-field">
              <i class="fas fa-mobile-alt"></i>
              <input type="tel" placeholder="Telefono" name="telefono" id="tel"  />
            </div>
            <div class="input-field">
              <i class="fas fa-road"></i>
              <input type="text" name="direcion" id="direc" placeholder="Direccion" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" name="rnc" id="rns" placeholder="RNC" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" />
            </div>
          </section>
           <a href="#usuario" class="btn empresa" ><input type="button" class="btn empresa" value="Siguiente" /></a>
            <br>

            <section class="section" id="usuario">

            <span><b>Datos del Usuario</b></span>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input  type="text" name="name"id="username" placeholder="Nombre del Usuario" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" />
            </div>
            <div class="input-field">
              <i class="fas fa-at"></i>
              <input  type="email" name="email" placeholder="Email"   />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input  type="password" name="password" placeholder="Contraseña"  id="Password" minlength="8" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password"  name="password_confirmation" minlength="8" id="password_confirmation" placeholder="Confirmar Contraseña" />
            </div>

            <input type="submit" class="btn" value="Registrar" />
           <a href="#empresa" class="btn user" ><input type="button" class="btn" value="Volver" /></a>
          </div>
            </div>

          </section>
        </form>
      </div>

	  
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Aun no te has Registrado?</h3>
            <p>
				Es tu oportunidad de tener tu empresa más organizada y administrarla aún mejor, que esperas!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Registrate
            </button>
          </div>
          <img src="{{asset('img/lust.svg')}}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Ya tienes una Cuenta?</h3>
            <p>
				Es tu oportunidad de tener tu empresa más organizada y administrarla aún mejor, que esperas!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Iniciar Sesión
            </button>
          </div>
          <img src="{{asset('img/register.svg')}}" class="image" alt="" />
        </div>
      </div>
    </div>
    <div class="o-page-loader">
      <div class="o-page-loader--content">
        <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner logotipo">
          {{-- <div class=""></div> --}}
          <div class="o-page-loader--message">
              <span>Cargando...</span>
          </div>
      </div>
    </div>

    <script src="{{asset('js/login.js')}}"></script>
	<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
  <script src="{{asset('js/pageLoader.js')}}"></script>
  </body>
</html>
{{-- <script src="{{asset('logincss/bootstrap/js/bootstrap.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('logincss/bootstrap/css/bootstrap.min.css')}}"> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous"></script>


<script>


$(".empresa").on("click", function (e) {
  var name=$("#nom").val();
  var phone=$("#tel").val();
  var street=$("#direc").val();
  if(name!=''&& phone!='' && street!='' ){
  // 1
  e.preventDefault();
  // 2
  const href = $(this).attr("href");
  // 3
  $("#scroll").animate({ scrollTop: $(href).offset().top }, 800);
  }else{
    e.preventDefault();
    Errores();
  }
});


$(".user").on("click", function (e) {

  // 1
  e.preventDefault();
  // 2
  const href = $(this).attr("href");
  // 3
  $("#scroll").animate({ scrollTop: $(href).offset().top }, 800);

 
});

$("input[type='tel']").mask('(000) 000-0000');
$("#nom").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#tel").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#direc").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#rns").on('keypress', function(e) { 
  event.preventDefault();
  next();
}); 


function next(){
  // 1
  event.preventDefault();
  // 2
  const href = $(".empresa").attr("href");
  // 3
  $("#scroll").animate({ scrollTop: $(href).offset().top }, 800);
}

function Errores(){
    Command: toastr["error"]("LLene los campos obligatorios!", "Error")
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

<style>
	/* body{
		overflow-x: hidden;
		overflow-y: hidden;
		
	}

  .logotipo{
    width: 62%
}

@media (max-width: 570px) {
  form {
    padding: 0 1.5rem;
    top: -98px;
    position: relative;
  }

  .register{
    top: -55px;
    position: relative;
  }

  .image {
    display: none;
  }
  .logotipo{
    width: 55%;
    top: 31px;
    position: relative
  }
  .panel .content {
    padding: 0.5rem 1rem;
  }
  .container {
    padding: 1.5rem;
  }

  .container:before {
    bottom: 72%;
    left: 50%;
  }

  .container.sign-up-mode:before {
    bottom: 38%;
    left: 50%;
  }
} */

/* @media (max-width: 870px){
  .right-panel {
    grid-row: 3 / 4;
    position: relative;
    top: -115px;
}
}

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap");



.btn {
  width: 150px;
  background-color: #4054b2;
  border: none;
  outline: none;
  height: 49px;
  border-radius: 49px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.5s;
} */
.container:before {
  border-radius: 50%;
}
</style>