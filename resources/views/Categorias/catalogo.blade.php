<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Catalogos de Categorias</title>
    <link rel="stylesheet" href="{{asset('css/catalogo.css')}}" media="all" />
  </head>
  <body>
      <div class=" form-row hoy">
        @php
        $user=Auth::user()->id_empresa;
        $nombre=Auth::user()->name;
    @endphp
      {{-- <span>Fecha:{{$hoy}}</span> --}}
    </div>

    <header class="clearfix">
      {{-- <div class="Userlogin">
        <span>{{$nombre}}</span>
      </div> --}}
      <div id="logo">
        <img src="{{ asset('logo/'.$empresa->imagen)}}">
      </div>
      <br>
      <br>
      <div id="logoWS">
        <span>CATALOGO</span><br>
        <span class="recur">De Categorias</span>
      </div>
      @php
          $hoy=Illuminate\Support\Carbon::now();
      @endphp
           <div class="Userlogin">
            <span>Impresa por:&nbsp;{{$nombre}},&nbsp;  Fecha:&nbsp;{{$hoy->format('d/m/Y')}}</span>
          </div>
      <br>
      <div id="logow">
        <div id="company">
  
          {{-- <h2 class="name">{{$empresa->nombre}}</h2> --}}
          <span><b style="font-size: 14px;">NOMBRE:</b>&nbsp;{{$empresa->nombre}}</span><br>
          <span><b style="font-size: 14px;">RNC:</b>&nbsp;{{$empresa->rnc}}</span><br>
          <span><b style="font-size: 14px;">DIRECCIÓN:</b>{{$empresa->direcion}}<br>
          </span><b style="font-size: 14px;">TEL:</b>{{$empresa->telefono}}</span><br>
          <span><b style="font-size: 14px;">EMAIL:</b>{{$empresa->email}}</span>
         
        </div>
      </div> 
    </header>
    <main>
<br><br><br>
        {{-- <span class="encabezado" style="margin-top: -60px;" ><b>CATALOGO</b></span><br><br> --}}

        <table  border="0" cellspacing="1" cellpadding="1" style="margin-top: -6%;"   id="princpial" >
          <thead style="thd" style="">
           <tr>
             <th  style="text-align: left; width: 150px;"><b>ID</b></th>

             <th style="text-align: center; "><b>NOMBRE</b></th>
          </tr>
         </thead>
         <tbody>


          @foreach ($categorias as $categoria)
          @php
          $p=0;
      @endphp
            <tr>  
                 <td style="background-color: white; text-align: left;"><b> {{$categoria->id_category}}</b></td>
                 <td style="text-align: left; background-color: white" ><b>{{$categoria->nombre}}</b></td>
             </tr>

             @foreach ($sub_g as $sub_gs)
             @foreach ($medio as $medios)

             @if ($medios->id_categorias==$categoria->id)
             @if ($sub_gs->id==$medios->id_sub)
                 @php
                     $p++;
                 @endphp
             <tr>  
               <td style="background-color: white; text-align: left;"><span style="margin-left: 5%; position: relative;">{{$categoria->id_category}}.{{$p}}</span></td>
               <td style="text-align: left; background-color: white; "><span style="margin-left: 5%; position: relative;">{{$sub_gs->nombre}}</span></td>
              </tr>
              @endif
            @endif

             @endforeach
             @endforeach
             @endforeach
     
             </tbody>
           </table>

    </main>
    <div class="Userfooter">
      <span>ELABORADO POR:Laboral.com.do</span>
    </div>
  </body>
</html>

