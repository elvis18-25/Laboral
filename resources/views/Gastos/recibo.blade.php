<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{$gasto->descripcion}}</title>
    <link rel="stylesheet" href="{{asset('css/recibogasto.css')}}" media="all" />
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
        <span>GASTOS</span><br>
        <span class="recur">Recurentes</span>
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
          <span>{{$empresa->direcion}}</span>,&nbsp;TEL:&nbsp;<span>{{$empresa->telefono}}</span>&nbsp;
          <span>Email:&nbsp;info@Dualsoft.com.do,&nbsp;RNC: <span>{{$empresa->rnc}}</span>
         
          <span></span>
          
        </div>
      </div> 
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="apellido">Descripcción:<b>&nbsp;{{$gasto->descripcion}}</b></div>
          <h3 class="apellido">No. :&nbsp;{{$gasto->id}} </h3>
          <h3 class="apellido">Fecha:&nbsp;{{date("d/m/Y", strtotime($gasto->fecha))}}</h3>
          <h3 class="apellido">Usuario:&nbsp;{{$gasto->user}} </h3>
        </div>
      </div>

      <span class="encabezado" style="margin-top: -60px;" ><b>Listado de Gastos</b></span><br><br>

      <table  border="0" cellspacing="1" cellpadding="1" style="margin-top: -1px;"   id="princpial" >
     <thead style="thd" style="">
      <tr>
        <th style="text-align: center; max- "  ><b> CONCEPTO</b></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center; height: 10px;"><b>MONTO</b></th>

     </tr>
    </thead>
    <tbody>
        @php
            $cont=0;
        @endphp

        @foreach ($concepto as $conceptos)
                        
        @if ($conceptos->estado==0) 
        @if ($conceptos->id_empresa==$user)
        <tr >
            @php
                 $cont=$cont+$conceptos->monto;
            @endphp
            <td style="text-align: left; background-color: white" >{{$conceptos->concepto}}</td>
            <td style="background-color: white "></td>
            <td style="background-color: white"></td>
            <td style="background-color: white"></td>
            <td style="background-color: white"></td>
            <td style="background-color: white"></td>
            <th style="text-align: right; background-color: white" class="last">${{number_format($conceptos->monto,2)}}</th>
        </tr>
        @endif
      @endif
       
        @endforeach
        {{-- <tr>
          <td id="#space" style=" text-align: left; background-color: white">{{$nomina->descripcion}}</td>
          <td id="#space" style="background-color: white"></td>
          <td id="#space" style="background-color: white"></td>
          <td id="#space" style="background-color: white"></td>
          <td id="#space" style="background-color: white"></td>
          <td id="#space" style="background-color: white"></td>
          <td id="#space" style="text-align: right; background-color: white">${{number_format($nomina->monto,2)}}</td>
        </tr> --}}
        <tr>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td  class="totalgasto" style="text-align: right; background-color: white "><b>Total &nbsp;${{number_format($cont,2)}}</b></td>
          </tr>
        </tbody>
      </table>
      
  {{-- <div  class="col-md-3 egreso"><b>Egreso por Nomina:&nbsp;(+)&nbsp;${{number_format(,2)}}</b></div> --}}
  <span class="encabezado"  ><b>Egreso de Nomina</b></span><br><br>
  <table border="0" cellspacing="1" cellpadding="1"  >
    <thead style="thd" style="">
      <tr>
        <th style="text-align: center; max- "  ><b> CONCEPTO</b></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center; height: 10px;"><b>MONTO</b></th>
     </tr>
    </thead>
    <tbody>
      <tr>
        <td id="#space" style=" text-align: left; background-color: white">{{$nomina->descripcion}}</td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="text-align: right; background-color: white">${{number_format($nomina->monto,2)}}</td>
      </tr>
      <tr>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td  class="totalgasto" style="text-align: right; background-color: white "><b>Total General:&nbsp;${{number_format($cont+$nomina->monto,2)}}</b></td>
      </tr>

    </tbody>
  </table>
  <br>

<table id="obser" style="margin-top: -5%; position: absolute;">
  <div class="obersrvaciones" >
    <span ><b >Observaciones:</b>&nbsp;{{$gasto->observaciones}}</span><br>
    {{-- <span></span> --}}
  </div>
</table>

<div class="row">
<div class="col-md-3" style="width:40%; border-top: 1px solid #000; margin-top: 70px; "><p style="text-align:center;">ELABORADO POR: <b>&nbsp;{{$gasto->user}}</b></p></div>
<div class="col-md-3" style="width:40%;border-top: 1px solid #000; margin-top: -50px; float: right;"><p style="text-align:center;">RECIBIDO POR</p></div>
</div>
{{-- <div class="linea" style="margin-left: 2%;"></div>
<div class="linea2" style="margin-left: 70%; margin-top: 85px; position: relative;"  ></div>

<span class="elaborado">ELABORADO POR</span>

<span class="recibido">RECIBIDO POR</span> --}}
{{-- <span id="totsd" class="float-right"></span> --}}

    </main>
    <footer>
      DualSoft Tecnologia a la medida de tu Empresa
    </footer>
  </body>
</html>

{{-- @section('js')
<script>
  function totalnominaShow(){
  var id=$("#listadonomina").val();
  if(id!=0){
    var url = "{{url('listmonto')}}/"+id; 
    var data = '';
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
          $("#princpial tbody").prepend(result);

       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
}
         });  
  }

}
</script>
@endsection --}}