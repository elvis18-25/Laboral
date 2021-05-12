<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recurso Humano</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico"/')}}">
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
                <form class="form" method="post" id="formulario" action="{{ route('register') }}">
                    @csrf
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="top: 16px; position: relative;">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">DATOS DE LA EMPRESA</a>
                            </li>
                            <li class="nav-item" role="presentation" id="usuario">
                              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" tabindex="1" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">DATOS DEL USUARIO</a>
                            </li>
                          </ul>

                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="card-body">
                                    <div class="form-row">


                                
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-single-02"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="nombre" autofocus class="form-control" placeholder="Nombre de la Empresa" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                    </div>
                     

                                
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-mobile"></i>
                                            </div>
                                        </div>
                                        <input type="tel" name="telefono" class="form-control" placeholder="Télefono">
                                    </div>
                      

                              
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-map-big"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="direcion" class="form-control" placeholder="Direccion" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                    </div>
         
                            
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-paper"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="rnc" class="form-control" placeholder="RNC">
                                    </div>

                                    <button type="button" class="btn btn-primary btn-round btn-lg" onclick="next();" id="btnnext" style="margin-left: 197px;">{{ __('Siguiente') }}</button>
                                </div>
                            </div>
                        </div>



                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="nom"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" autofocus placeholder="{{ __('Nombre') }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password" id="password" minlength="8" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>
                                <div class="input-group" style="top: 10px;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password_confirmation" minlength="8" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg"  style="margin-left: 197px;">{{ __('Registrarse') }}</button>
                                </div>
                            </div>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                          </div>
                  </form>
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

    $("input[type='tel']").mask('(000) 000-0000');

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

