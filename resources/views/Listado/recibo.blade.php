<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{$nominas->descripcion}}</title>
    <link rel="stylesheet" href="{{asset('css/recibolistado.css')}}" media="all" />
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
      <div id="logo">
        <img src="{{asset('img/logo-Dual.jpg')}}">
      </div>
      <div id="logoWS">
        <span>NOMINA</span><br>
        <span class="recur">del mes</span>
      </div>
      <br>
      <div id="logow">
        <div id="company">
  
          {{-- <h2 class="name">{{$empresa->nombre}}</h2> --}}
          <span>{{$empresa->direcion}}</span>,&nbsp;TEL:&nbsp;<span>{{$empresa->telefono}}</span><br>
          <span>Email:&nbsp;info@Dualsoft.com.do,&nbsp;RNC: <span>{{$empresa->rnc}}</span>
         
          <span></span>
          
        </div>
      </div> 
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="apellido">Descripcción:<b>&nbsp;{{$nominas->descripcion}}</b></div>
          {{-- <h3 class="name">Descripcion: </h3> --}}
          <h3 class="apellido">Fecha:&nbsp;{{date("d/m/Y", strtotime($nominas->fecha))}}</h3>
          <h3 class="apellido">Usuario:&nbsp;{{$nombre}} </h3>

        </div>

      </div>
      <table  border="0" cellspacing="1" cellpadding="1"   id="princpial" >
     <thead>
      <tr>
        <th style="text-align: left" ><b>NOMBRE</b></th>
        <th><b>CARGO</b></th>
        <th style="text-align: right"><b>SALARIO BRUTO</b></th>
        <th style="text-align: right"><b>DEDUCIONES</b></th>
        <th style="text-align: right"><b>INCREMENTO</b></th>
        <th style="text-align: right"><b>TOTAL</b></th>

     </tr>
    </thead>
    <tbody>
        @php
            $cont=0;
        @endphp

        @foreach ($empleados as $empleado)
        @foreach ($perfiles as $perfil)
            
        @if ($empleado->id_empleado==$perfil->id_empleado)
            
        
        @if ($empleado->estado==0) 
        @if ($empleado->id_empresa==$user)
        <tr >
            {{-- @php
                 $cont=$cont+$conceptos->monto;
            @endphp --}}
            <td style="text-align: left; background-color: white" >{{$empleado->nombre." ".$empleado->apellido}}</td>
            <td style="background-color: white ">{{$empleado->cargo}}</td>
            <td style="background-color: white">{{$empleado->salario}}</td>
            <td style="background-color: white"></td>
            <td style="background-color: white"></td>
            <td style="background-color: white"></td>
            {{-- <th style="text-align: right; background-color: white" class="last">${{number_format($conceptos->monto,2)}}</th> --}}
        </tr>
        @endif
        @endif
      @endif
       

        @endforeach
        @endforeach
        <tr>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td  class="totalgasto" style="text-align: right; background-color: white "><b>TOTAL: &nbsp;${{number_format($cont,2)}}</b></td>
        </tr>
</tbody>
</table>

<div class="row">
<div class="col-md-3" style="width:40%; border-top: 1px solid #000; margin-top: 70px; "><p style="text-align:center;">ELABORADO POR</p></div>
<div class="col-md-3" style="width:40%;border-top: 1px solid #000; margin-top: -50px; float: right;"><p style="text-align:center;">RECIBIDO POR</p></div>
</div>
{{-- <div class="linea" style="margin-left: 2%;"></div>
<div class="linea2" style="margin-left: 70%; margin-top: 85px; position: relative;"  ></div>

<span class="elaborado">ELABORADO POR</span>

<span class="recibido">RECIBIDO POR</span> --}}
{{-- <span id="totsd" class="float-right"></span> --}}
<table>

</table>
    </main>
    <footer>
      DualSoft Tecnologia a la medida de tu Empresa
    </footer>
  </body>
</html>