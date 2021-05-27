<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/multi.css')}}">
    <link rel="icon" type="image/png" href="{{ asset('black') }}/img/Favicon.png">
    <link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <title>Laboral</title>
</head>
<body>

    <form  class="sign-in-form" id="formulario" method="post" action="{{ url('SeleccionEmpresa') }}">
        @csrf
        @method('POST')
   <div class="container">
       <div class="row justify-content-center text-center pt-5 mt-5">
           <div class="col">
               <h1>A Cual empresa quieres acceder?</h1>
               <div class="form-group">
                   
               </div>
           </div>
       </div>
       <div class="row justify-content-center text-center">
           @foreach ($empresa as $empresas)
           @foreach ($user as $users)
           @if ($users->id_empresa==$empresas->id)
           @php
           $color="";
               if($empresas->color==null){
                $color="#eceded";
               }else{
                $color=$empresas->color;
               }
           @endphp
               
           <div class="col-md-2 col-sm-2 col-xl-2 col-lg-2 pb-2 text-center empresas">
               <button type="submit" class=" btn users" style='height: 150px ;background-color:<?php printf($color); ?>' value="{{$users->email}}" action="{{$users->password}}" id="{{$empresas->id}}" >
                @if ($empresas->imagen!=null)
                <img src="{{ asset('logo/'.$empresas->imagen)}}"  width="100%" height="100%" alt="">
                    
                @else 
                @php
                $num="";
                    $numero=rand(1, 5);
                    $num=$numero.".png";
                    // dd($num);
                    
    
                @endphp
                <img src="{{asset('recuros/'.$num)}}" width="100%" height="100%"  alt="">
                @endif
                </button>
                <h4>{{$empresas->nombre}}</h4>
            </div>

            @endif
            @endforeach
            @endforeach
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
    <input type="text" placeholder="Email" name="email" id="email" hidden/>
  <input type="password" placeholder="Contraseña" name="password" id="password" hidden />
  <input type="password" placeholder="Contraseña" name="id_empresa" id="id_empresa" hidden />
</form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
    <script src="{{asset('js/pageLoader.js')}}"></script>
</body>
</html>

<script>

$(".users").on("click",function(){
 email= $(this).attr('value');
password= $(this).attr('action');
 empresa=$(this).attr('id');

})



$("#formulario").submit(function(e){
  e.preventDefault();
$("#email").attr('value',email);
$("#password").attr('value',password);
$("#id_empresa").attr('value',empresa);
this.submit();

  });
</script>


<style>
    body{
        background-color: whitesmoke
    }

    h1{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>