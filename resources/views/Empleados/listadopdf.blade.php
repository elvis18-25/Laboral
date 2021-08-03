<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Listado de Empleados</title>
    <link rel="stylesheet" href="{{asset('css/recibo.css')}}" media="all" />
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
      <div id="logoWS">
        <span>LISTADO</span><br>
        <span class="recur">de Empleados</span>
      </div>

      @php
          $hoy=Illuminate\Support\Carbon::now();
      @endphp
           <div class="Userlogin">
        <span>Imprimida por:&nbsp;{{$nombre}},&nbsp;  Fecha:&nbsp;{{$hoy->format('d/m/Y')}}</span>
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
    <footer>
    
      <div class="row" style="top: -2%; position: absolute;">
        <span style="color: black">Laboral.com.do</span>
        {{-- <div class="col-md-3" style="width:40%; border-top: 1px solid #000; top: -26px; position: relative; "><p style="text-align:center;">ELABORADO POR: <b>&nbsp;{{$gasto->user}}</b></p></div>
        <div class="col-md-3" style="width:40%; border-top: 1px solid #000; top: -75px; margin-left: 60%; position: relative; "><p style="text-align:center;">RECIBIDO POR:</p></div> --}}
        {{-- <div class="col-md-3" style="width:40%;border-top: 1px solid #000; margin-top: -50px; float: right;"><p style="text-align:center;">RECIBIDO POR</p></div> --}}
      </div> 
  </footer>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <h3 class="apellido"><b>ID:</b>&nbsp;&nbsp;#000001 </h3>
          <div class="apellido"><b>DESCRIPCCIÓN:<b>&nbsp;REPORTE DE EMPLEADOS</div>
        </div>
        <h3 class="apellido" style="float: right; margin-right: 100px;"><b>FECHA:</b>&nbsp;&nbsp;{{$fecha->format('d/m/Y')}}</h3><br>
        <h3 class="apellido" style="float: right; margin-right: -19%;"><b>USUARIO:</b>&nbsp;&nbsp;{{$nombre}} </h3>
  
      </div>

<br><br>
      <span class="encabezado" style="margin-top: -60px;" ><b>LISTADO DE EMPLEADOS</b></span><br><br>

      <table  border="0" cellspacing="1" cellpadding="1" style="margin-top: -6%;"   id="princpial" >
     <thead style="thd" style="">
      <tr>
        <th style="text-align: left;">NOMBRE</th>
        <th style="text-align: center;"> CEDULA</th>
        <th style="text-align: center;">CARGO</th>
        <th style="text-align: center;">TELEFONO</th>
        <th style="text-align: center;">DEPARTAMENTO</th>
        <th style="text-align: right;">SALARIO</th>
     </tr>
    </thead>
    <tbody>
        @php
            $cont=0;
            $b=0;
            $sum=0;
        @endphp

        @foreach ($empleados as $empleado)
                        

        <tr style="background-color: white !important;">
          <td  style="text-align: left;">{{$empleado->nombre." ".$empleado->apellido}}</td>
          <td style="text-align: left;">{{$empleado->cedula}}</td>
          <td style="text-align: center;">{{$empleado->cargo}}</td>
          <td style="text-align: center;">{{$empleado->telefono}}</td>
          @foreach ($empleado->puesto as $puesto)
          <td style="text-align: center;">{{$puesto->name}}</td>
          @endforeach
          @php
            $cont=0;
            $b=0;
            $sum=0;
          @endphp
          @php
                
                foreach ($sueldo as $sueldos){
                if ($sueldos->id_empleado==$empleado->id_empleado){
                      $b=1;
                      $sum=$sum+$sueldos->sueldo_increment;                                
                    }
                }

                if($b==1){
                   $cont=number_format($empleado->salario+$sum,2);
                }

                if($b==0){
                   $cont=number_format($empleado->salario,2);
                }
          @endphp
          <td style="text-align: right;">${{$cont}}</td>
        </tr>

       
        @endforeach

        </tbody>
      </table>
      

    </main>

  <script type="text/php">
      if ( isset($pdf) ) {
          $pdf->page_script('
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $pdf->text(470, 14, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
          ');
      }


</script>

  </body>

</html>

