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
          <span><b style="font-size: 14px;">NOMBRE:</b>&nbsp;{{$empresa->nombre}}</span><br>
          <span><b style="font-size: 14px;">RNC:</b>&nbsp;{{$empresa->rnc}}</span><br>
          <span><b style="font-size: 14px;">DIRECCIÓN:</b>{{$empresa->direcion}}<br>
          </span><b style="font-size: 14px;">TEL:</b>{{$empresa->telefono}}</span><br>
          <span><b style="font-size: 14px;">EMAIL:</b>{{$empresa->email}}</span>
         
        </div>
      </div> 
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <h3 class="apellido"><b>ID:</b>&nbsp;&nbsp;#00000{{$gasto->id}} </h3>
          <div class="apellido"><b>DESCRIPCCIÓN:<b>&nbsp;&nbsp;{{$gasto->descripcion}}</div>
        </div>
        <h3 class="apellido" style="float: right; margin-right: 100px;"><b>FECHA:</b>&nbsp;&nbsp;{{date("d/m/Y", strtotime($gasto->fecha))}}</h3><br>
        <h3 class="apellido" style="float: right; margin-right: -19%;"><b>USUARIO:</b>&nbsp;&nbsp;{{$gasto->user}} </h3>
  
      </div>

<br><br>
      <span class="encabezado" style="margin-top: -60px;" ><b>LISTADO DE GASTOS</b></span><br><br>

      <table  border="0" cellspacing="1" cellpadding="1" style="margin-top: -6%;"   id="princpial" >
     <thead style="thd" style="">
      <tr>
        <th  style="text-align: left; width: 113px;">ID</th>
        <th></th>
        <th style="text-align: center;"><b> CONCEPTO</b></th>
        <th style="text-align: right; height: 10px;"><b>MONTO</b></th>
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
            <td style="background-color: white; text-align: left;">#000{{$conceptos->id}}</td>
            <td style="background-color: white"></td>
            <td style="text-align: center; background-color: white" >{{$conceptos->concepto}}</td>
            <th style="text-align: right; background-color: white" class="last">{{number_format($conceptos->monto,2)}}</th>
        </tr>
        @endif
      @endif
       
        @endforeach

        <tr>

            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td id="#space" style="background-color: white"></td>
            <td  class="totalgasto" style="text-align: right; background-color: white "><b>Total:&nbsp;${{number_format($cont,2)}}</b></td>
          </tr>
        </tbody>
      </table>
      
  {{-- <div  class="col-md-3 egreso"><b>Egreso por Nomina:&nbsp;(+)&nbsp;${{number_format(,2)}}</b></div> --}}
  <span class="encabezado"  ><b>LISTADO DE NOMINAS</b></span><br><br>
  <table border="0" cellspacing="1" cellpadding="1"  >
    <thead style="thd" style="">
      <tr>
        <th  style="text-align: left; width: 113px;">ID</th>
        <th></th>
        <th style="text-align: center; "><b> CONCEPTO</b></th>
        <th style="text-align: right; height: 10px;"><b>MONTO</b></th>
     </tr>
    </thead>
    <tbody>

      @php
          $sum=0;
      @endphp
      @foreach ($nominas as $nomina)
      <tr>
        <td style="background-color: white; text-align: left;">#000{{$nomina->id}}</td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style=" text-align: center; background-color: white">{{$nomina->descripcion}}</td>
        <td id="#space" style="text-align: right;  background-color: white">{{number_format($nomina->monto,2)}}</td>
      </tr>
      @php
          $sum=$sum+$nomina->monto;
      @endphp
      @endforeach

      @if ($t==1)
      <tr>
        <td style="background-color: white; text-align: left;">--</td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style=" text-align: center; background-color: white">--</td>
        <td id="#space" style="text-align: right; background-color: white">--</td>
      </tr> 
      @endif
      <tr>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td  class="totalgasto" style="text-align: right; background-color: white "><b>Total:&nbsp;${{number_format($sum,2)}}</b></td>
      </tr>

    </tbody>
  </table>

  <table border="0" cellspacing="1" cellpadding="1"  >
    <thead style="thd" style="">
    </thead>
    <tbody>
      <tr>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td id="#space" style="background-color: white"></td>
        <td  class="totalgasto" style="text-align: right; background-color: white "><b>Nominas + Gastos:&nbsp;${{number_format($cont+$sum,2)}}</b></td>
      </tr>
    </tbody>
  </table>

<table id="obser" style="margin-top: -88%; position: absolute;">
  <div class="obersrvaciones" style="border: 1px solid;  width: 50%; height: 10%;" >
    <span><b>OBSERVACIONES:</b>&nbsp;{{$gasto->observaciones}}</span>
  </div>
</table>

<br>
<br>
<div class="row" style="top: 82%; position: absolute;">
<div class="col-md-3" style="width:40%; border-top: 1px solid #000; margin-top: 70px; "><p style="text-align:center;">ELABORADO POR: <b>&nbsp;{{$gasto->user}}</b></p></div>
<div class="col-md-3" style="width:40%;border-top: 1px solid #000; margin-top: -50px; float: right;"><p style="text-align:center;">RECIBIDO POR</p></div>
</div>


    </main>
    <div class="Userfooter">
      <span>ELABORADO POR:Laboral.com.do</span>
    </div>
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