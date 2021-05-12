<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recurso Humano</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	{{-- <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico"/')}}"> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('logincss/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('logincss/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('logincss/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('logincss/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('logincss/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('logincss/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
	
<!--===============================================================================================-->
</head>
<body>
    {{-- <form class="form" method="post" action="{{ route('login') }}">
        @csrf --}}
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Recursos Humanos
					</span>
				</div>

				<ul class="nav nav-tabs" id="myTab" role="tablist" hidden>
					<li class="nav-item" role="presentation">
					  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
					</li>
					<li class="nav-item" role="presentation">
					  <a class="nav-link" >Profile</a>
					</li>
					<li class="nav-item" role="presentation">
					  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
					</li>
				  </ul>

				  <div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<form class="login100-form validate-form" method="post" action="{{ route('login') }}">
							@csrf

							<ul>
								{{-- @foreach ($errors->get('email') as $error)
								<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
									<script>
										Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: 'Something went wrong!',
										footer: '<a href>Why do I have this issue?</a>'
										})
									</script>
								@endforeach --}}


							</ul>
							<div class="wrap-input100 validate-input m-b-26" data-validate="Email es requerido">
								<span class="label-input100" style="color: black">Email</span>
								<input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" >
								<span class="focus-input100"></span>
							</div>
							@error('email')
							<span class="invalid-feedback" role="alert">
								<span>{{ $message }}</span>
							</span>
							@enderror
		
							<div class="wrap-input100 validate-input m-b-18" data-validate = "Contraseña es requerido">
								<span class="label-input100 @error('password') is-invalid @enderror" style="color: black"  autocomplete="current-password">Contraseña</span>
								<input class="input100" type="password" name="password" placeholder="Contraseña">
								<span class="focus-input100"></span>
							</div>
							@error('password')
							<span class="invalid-feedback" role="alert">
								<span style="color: red">{{ $message }}</span>
							</span>
							@enderror
		
							<div class="flex-sb-m w-full p-b-30">
								<div class="contact100-form-checkbox">
									<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" {{ old('remember') ? 'checked' : '' }}>
									<label class="label-checkbox100" for="ckb1" style="color: black">
										Recordar
									</label>
								</div>
		
								{{-- <div>
									<a sty  href="{{ route('password.request') }}" class="txt1">
										Olvidaste tu Contraseña?
									</a>
								</div> --}}
								<div >
									<a style="color: black" href="{{ route('register') }}" class="txt1">
										Resgistrate aqui?
									</a>
								</div>
							</div>
		
							<div class="container-login100-form-btn" >
								<button submit class="login100-form-btn">
									Login
								</button>
							</div>
						</form>
					</div>

					@if ($errors->any())
					{{-- <div class="alert alert-danger"> --}}
					   <ul>
							@foreach ($errors->all() as $error)
							<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
								<script>
									Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'La Contraseña o el Usuario esta incorrecto!',
									})
								</script>
							@endforeach
					   </ul>
				   </div>
				   @endif
			</div>
		</div>
	</div>
</form>



  

{{-- <script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script> --}}
<!--===============================================================================================-->
	<script src="{{asset('logincss/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('logincss/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('logincss/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('logincss/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('logincss/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('logincss/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('logincss/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('logincss/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
	


</body>
</html>
<script src="{{asset('js/holdOn.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/holdOn.css')}}">

<script>
	var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};
document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
          $('a[tabindex='+i+']').trigger("click");
        //   ponleFocus();
        }
      }))
    });

    // $("input[type='tel']").mask('(000) 000-0000');

i=1;
function next(){
$('a[tabindex='+i+']').trigger("click");

}

if(!("autofocus" in document.createElement("input")))
  document.getElementById("nom").focus();

var options = {
     theme:"sk-cube-grid",
     message:'Procesando la informacion.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};


$("#formulario").validate({
           rules: {
            pass: { 
                    minlength: 8,
                    maxlength: 10,

               } , 

               password_confirmation: { 
                    equalTo: "#password",
                     minlength: 8,
                     maxlength: 10
               }


           },
     messages:{
      password: { 
                 minlength:"El Contraseña debe tener minimo 8 caracteres",
                 maxlength: ""
               },
               password_confirmation: { 
         equalTo: "No coincide",
         minlength:"El Contraseña debe tener minimo 8 caracteres",
         maxlength: ""
       }
     }

 

});



</script>


<style>
.form-control::placeholder {
    color: black;

}
#password-error{
position: absolute;
top: 35px; 
color: red;
}
#password_confirmation-error{
position: absolute;
top: 33px; 
color: red;
}
</style>

