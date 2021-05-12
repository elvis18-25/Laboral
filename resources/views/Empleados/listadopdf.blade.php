<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Listado de Empleado</title>
    <link rel="stylesheet" href="{{asset('css/recibo.css')}}" media="all" />
  </head>
  <body>
      <div class=" form-row hoy">
      
      {{-- <span>Fecha:{{$hoy}}</span> --}}
    </div>
    <header class="clearfix">
      <div id="logo">
        <img src="{{asset('img/logo-Dual.jpg')}}">
      </div>
      <div id="logow">
      <div id="company">
        <h2 class="name">DualSoft</h2>
        <div>TECNOLOGIA A LA MEDIDA DE SU EMPRESA</div>
        <div>809-578-2892</div>
        <div>Eduardo Garcia #25, BARRIO DON BOSCO, MOCA, R.D.</div>
        <div><a href="INFO@DUAlSOFT.COM.DO">INFO@DUAlSOFT.COM.DO</a></div>
      </div>
    </div> 
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">Lista de Empleado:</div>
          {{-- <h3 class="name">Descripcion: </h3> --}}
          <h3 class="apellido">Fecha: {{$fecha->format('d/m/Y')}}</h3>

        </div>

      </div>
      <table border="0" cellspacing="0" cellpadding="0" id="princpial" >
     <thead>
      <tr>
        <th class="no">NOMBRE</th>
        <th scope="col">CEDULA</th>
        <th class="no">CARGO</th>
        <th scope="no1">TELEFONO</th>
        <th class="no">DEPARTAMENTO</th>
        <th scope="no1">SALARIO BRUTO</th>
     </tr>
    </thead>
    <tbody>
        @php
            $user=Auth::user()->id_empresa;
        @endphp
        @foreach ($empleados as $empleado)
                        
        @if ($empleado->estado==0) 
        @if ($empleado->id_empresa==$user)
        <tr >
            <td class="no">{{$empleado->nombre." ".$empleado->apellido}}</td>
            <td >{{$empleado->cedula}}</td>
            <td class="no">{{$empleado->cargo}}</td>
            <td >{{$empleado->telefono}}</td>
            
            <td class="no">
                @foreach ($empleado->puesto as $puesto)
                    {{$puesto->name}}
                @endforeach
            </td>

            <td>${{number_format($empleado->salario,2)}}</td>
        </tr>
        @endif
      @endif
       
        @endforeach
</tbody>
</table>
{{-- <span id="totsd" class="float-right">TOTAL: ${{number_format($totoalfinal,2)}}</span> --}}
<table>
  
</table>
    </main>
    <footer>
      DualSoft Tecnologia a la medida de tu Empresa
    </footer>
  </body>
</html>