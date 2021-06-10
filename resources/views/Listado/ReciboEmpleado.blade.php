<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>RECIBOS DE LOS EMPLEADOS</title>
<link rel="stylesheet" href="{{asset('css/ReciboEmple.css')}}">
	</head>

	<body>
		@foreach ($empleados as $empleado)
		
        @php
        $user=Auth::user()->id_empresa;
		$name=Auth::user()->name;
		$apellido=Auth::user()->apellido;
        $nombre=Auth::user()->name;
    @endphp
		<div class="invoice-box">
            <div id="logoWS">
                <span>RECIBOS</span><br>
                <span class="recur">de Pago</span>
              </div>
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{ asset('logo/'.$empresa->imagen)}}" style="width: 50%; max-width: 100px; min-height: 100px;" />
								</td>

								<td style="text-align: left !important; margin-left: -10% !important; ">
                                    <span style="color: black;" >{{$empresa->direcion}}</span>,<span style="color: black;">&nbsp;TEL:&nbsp;<span>{{$empresa->telefono}}</span>&nbsp;
                                    <span style="color: black;">Email:&nbsp;{{$empresa->email}},<br>&nbsp;RNC: <span>{{$empresa->rnc}}</span>
								</td>
							</tr>
                            {{-- <tr>
                                <td>
                                   
                                </td>
                            </tr> --}}
						</table>
					</td>
				</tr>
                @php
                    $b=time();
                @endphp

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
                                <td>
                                    <span style="margin-top: 40% !important; position: relative;">Fecha:&nbsp;{{date("d/m/Y", strtotime($nominas->fecha))}}</span>

                                </td>
                                <td>
                                    <span style="margin-top: 40% !important; position: relative;">No.{{$b}}</span>
								</td>
						

							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
                                <td  style="margin-top: -5% !important">
                                    <p style="text-align:left;">Recibido Por:<div class="col-md-3" style="width:150%; border-top: 1px solid #000; margin-top: -20px !important; margin-left: 40% "> <span class="spam">{{$name." ".$apellido}}</span></div></p>

                                </td>
                                <td style="margin-top: -3% !important; position: relative;">
                                    <span >Cantidad:  <b style="  border-color: black;
										border-width: 2px;
										padding: 20px 20px 20px 20px;
										border-style: solid;">${{number_format($empleado->salarioneto,2)}}</b> </span>
										<input type="text" id="numero" style="display: none;" onkeyup="" value="{{$empleado->salarioneto}}" hidden>
                                </td>


							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td style="margin-top: -5% !important">
									<p style="text-align:left;">Cantidad:<div class="col-md-3" style="width:60%; border-top: 1px solid #000; margin-top: -20px !important; margin-left: 12% "></div><span id="texto"></span> </p>
	
								</td>

							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td style="margin-top: -5% !important">
									<p style="text-align:left;">Concepto:<div class="col-md-3" style="width:60%; border-top: 1px solid #000; margin-top: -20px !important; margin-left: 12% "></div> </p>
	
								</td>

							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td >
									<p style="text-align:left;">Recibido Por:<div class="col-md-3" style="width:54%; border-top: 1px solid #000; margin-top: -20px !important; margin-left: 16% "></div> </p>
									<span style="text-align: center; margin-right: 45% !important; float: right"><b>{{$empleado->nombre." ".$empleado->apellido}}</b></span>
								</td>

							</tr>
						</table>
					</td>
				</tr>

			</table>
		</div>
		<br><br><br><br><br><br><br><br><br><br>&nbsp;<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br><br><br>
		@endforeach
	</body>
</html>

<script>
<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
document.getElementById("numero").addEventListener("keyup",function(e){
    document.getElementById("texto").innerHTML=NumeroALetras(this.value);
});
 
 
function Unidades(num){
 
  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()
 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()
 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()
 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()
 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()
 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()
 
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="EUROS";
    data.letrasMonedaSingular="EURO";
  }else{
    data.letrasMonedaPlural="CENTIMOS";
    data.letrasMonedaSingular="CENTIMO";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
 
  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()	
</script>