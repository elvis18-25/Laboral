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
      {{-- <div class="Userlogin">
        <span>{{$nombre}}</span>
      </div> --}}
      <div id="logo">
        <img src="{{ asset('logo/'.$empresa->imagen)}}">
      </div>
      <div id="logoWS">
        <span>NOMINA</span><br>
        <span class="recur">del Mes</span>
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
          <span>Email:&nbsp;{{$empresa->email}},&nbsp;RNC: <span>{{$empresa->rnc}}</span>
         
          <span></span>
          
        </div>
      </div> 
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="apellido">Descripcción:<b>&nbsp;{{$nominas->descripcion}}</b></div>
          <h3 class="apellido">No. :&nbsp;{{$nominas->id}} </h3>
          <h3 class="apellido">Fecha:&nbsp;{{date("d/m/Y", strtotime($nominas->fecha))}}</h3>
          <h3 class="apellido">Usuario:&nbsp;{{$nominas->user}} </h3>
        </div>
      </div>

      <span class="encabezado" style="margin-top: -60px;" ><b>NOMINA DEL MES</b></span><br><br>

      <table  border="0" cellspacing="1" cellpadding="1" style="margin-top: -1px;"   id="princpial" >
     <thead style="thd" style="">
      <tr>
        <th style="text-align: center;"  ><b> NOMBRE</b></th>
        <th style="text-align: center;"  ><b> CARGO</b></th>
        <th style="text-align: center;"  ><b> SALARIO BRUTO</b></th>
        <th style="text-align: center;"  ><b> DEDUCCIONES</b></th>
        <th style="text-align: center;"  ><b> INCREMENTO</b></th>
        <th style="text-align: center; height: 10px;"><b>TOTAL</b></th>

     </tr>
    </thead>
    <tbody>
        @php
            $cont=0;
            $TotalDeducion=0;
            $TotalSalario=0;
            $Totalincremento=0;

        @endphp

        @foreach ($empleados as $empleados)
         @foreach ($nomina_empleador as $nomina_empleadores)
             
         @if ($empleados->id_empleado==$nomina_empleadores->id_empleado) 
         
         <tr >
           {{-- @php
                 $cont=$cont+$conceptos->monto;
               @endphp --}}
            <td style="text-align: left; background-color: white; font-size: 14px;" >{{$empleados->nombre." ".$empleados->apellido}}</td>
            <td style="background-color: white; text-align: center; font-size: 14px; ">{{$empleados->cargo}}</td>
            <td style="background-color: white; font-size: 14px;">${{number_format($nomina_empleadores->salarioBruto,2)}}
            @php
                $salario=0;
                $num=0;
                
                if($nomina_empleadores->horas!=null){
                  $num=$nomina_empleadores->horas*$p;
                  $salario=$num;
                }else{
                  $num=$nomina_empleadores->salarioBruto/23.83/8;
                  $salario=$num*$p;
                }

                $TotalSalario=$TotalSalario+$salario;
                
            @endphp
            </td>
            <td style="background-color: white; font-size: 14px;">
              @php
                $otrosCont=0;
                $cont=0;
                $cont2=0;
                $sum=0;
                $sum2=0;
                $deducion=0;
                

                foreach($nominaOtros as $nominaOtro){
                    if($nomina_empleadores->id_nomina==$nominaOtro->id_nomina){
                        if($nominaOtro->tipo_asigna=="DEDUCCIÓN"){
                            if($nominaOtro->id_empleado==$empleados->id_empleado){
                            if($nominaOtro->p_monto!=null){
                                $otrosCont=$otrosCont+$nominaOtro->p_monto;
                            }else{
                                $otrosCont=$otrosCont+$nominaOtro->monto;

                            }
                            }
                        }
                    }
                }

                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($nomina_empleadores->id_nomina==$nominaAsignacione->id_nomina){
                            if($empleados->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                    if($nominaAsignacione->estado_asigna==1){
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $cont=$nominaAsignacione->montos*$nomina_empleadores->salarioBruto;
                                            $cont=$cont/100;
                                            $sum2=$sum2+$cont;
                                            }else{
                                             $cont=$cont+$nominaAsignacione->montos;
                                             $sum2=$sum2+$cont;
                                            }
                                        }
                                }
                            }
     
                            }
                        }
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($nomina_empleadores->id_nomina==$nominaAsignacione->id_nomina){
                            if($empleados->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="DEDUCCIÓN"){
                                    if($nominaAsignacione->tipo=="PORCENTAJE"){
                                      
                                        $cont2=$nominaAsignacione->montos*$nomina_empleadores->salarioBruto;
                                        $cont2=$cont2/100;
                                        $sum=$sum+$cont2;
                                        }else{
                                         $cont2=$nominaAsignacione->montos;
                                         $sum=$sum+$cont2;
                                        }
                                    }
                                        
                                }
                            }
     
                            }
                        
                      $deducion=$otrosCont-$sum2+$sum; 
                      $TotalDeducion=$TotalDeducion+$deducion
              @endphp
            ${{number_format($otrosCont-$sum2+$sum,2)}}
            </td>
            <td style="background-color: white; font-size: 14px;">
            @php
                 $otrosCont=0;
                $cont=0;
                $cont2=0;
                $sum=0;
                $sum2=0;
                $incremento=0;
                
                foreach($nominaOtros as $nominaOtro){
                    if($nomina_empleadores->id_nomina==$nominaOtro->id_nomina){
                        if($nominaOtro->tipo_asigna=="INCREMENTO"){
                            if($nominaOtro->id_empleado==$empleados->id_empleado){
                            if($nominaOtro->p_monto!=null){
                                $otrosCont=$otrosCont+$nominaOtro->p_monto;
                            }else{
                                $otrosCont=$otrosCont+$nominaOtro->monto;

                            }
                            }
                        }
                    }
                }

                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($nomina_empleadores->id_nomina==$nominaAsignacione->id_nomina){
                            if($empleados->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                    if($nominaAsignacione->estado_asigna==1){
                                        if($nominaAsignacione->tipo=="PORCENTAJE"){
                                            $cont=$nominaAsignacione->montos*$nomina_empleadores->salarioBruto;
                                            $cont=$cont/100;
                                            $sum2=$sum2+$cont;
                                            }else{
                                             $cont=$cont+$nominaAsignacione->montos;
                                             $sum2=$sum2+$cont;
                                            }
                                        }
                                }
                            }
     
                            }
                        }
                    foreach($nominaAsignaciones as $nominaAsignacione){
                        if($nomina_empleadores->id_nomina==$nominaAsignacione->id_nomina){
                            if($empleados->id_empleado==$nominaAsignacione->id_empleado){
                                if($nominaAsignacione->tipo_asigna=="INCREMENTO"){
                                    if($nominaAsignacione->tipo=="PORCENTAJE"){
                                      
                                        $cont2=$nominaAsignacione->montos*$nomina_empleadores->salarioBruto;
                                        $cont2=$cont2/100;
                                        $sum=$sum+$cont2;
                                        }else{
                                         $cont2=$nominaAsignacione->montos;
                                         $sum=$sum+$cont2;
                                        }
                                    }
                                        
                                }
                            }
     
                            }
                            $incremento=$otrosCont-$sum2+$sum;
                            $Totalincremento= $Totalincremento+$incremento;
            @endphp
            ${{number_format($otrosCont-$sum2+$sum,2)}}

            </td>

            <td style="background-color: white; font-size: 14px;">
            ${{number_format($salario+$incremento-$deducion,2)}}
            </td>
            {{-- <th style="text-align: right; background-color: white" class="last">${{number_format($conceptos->monto,2)}}</th> --}}
          </tr>
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
            {{-- <td  class="totalgasto" style="margin-left: -50px; background-color: white; "><b>TOTAL: ${{number_format($TotalSalario+$Totalincremento-$TotalDeducion,2)}}</b></td> --}}
          </tr> 
        </tbody>
        <div class="col-md-3" ><p style="text-align: right; font-size: 18px;  margin-top:-20px;"><b>TOTAL: ${{number_format($TotalSalario+$Totalincremento-$TotalDeducion,2)}}</b></p></div>
      </table>


  <br>



<div class="row">
<div class="col-md-3" style="width:40%; border-top: 1px solid #000; margin-top: 70px; "><p style="text-align:center;">ELABORADO POR: <b>&nbsp;{{$nominas->user}}</b></p></div>
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