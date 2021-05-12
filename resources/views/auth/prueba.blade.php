@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        <div class="col-md-5 ml-auto">
        </div>
        <div class="col-md-7 mr-auto">
            <div class="card card-register card-white">
                <div class="card-header">
                    <img class="card-img" src="{{ asset('black') }}/img/card-primary.png" alt="Card image">
                    <h4 class="card-title">{{ __('Registro') }}</h4>
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
@endsection

@section('js')

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script>

// document.addEventListener ("keydown", function (e) {
//     if (e.keyCode== 32) {
//         $("#nom").focus();
//     } 
// });

// function ponleFocus(){
//     document.getElementById("nom").focus();
// }
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
@endsection

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