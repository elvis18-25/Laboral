<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>RECIBOS DE LOS EMPLEADOS</title>
<link rel="stylesheet" href="{{asset('css/ReciboEmple.css')}}">
	</head>

	<body>
        @php
        $user=Auth::user()->id_empresa;
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
                                    <p style="text-align:left;">Recibido Por:<div class="col-md-3" style="width:150%; border-top: 1px solid #000; margin-top: -20px !important; margin-left: 40% "></div> </p>

                                </td>
                                <td style="margin-top: -3% !important; position: relative;">
                                    <span >Cantidad:  <b style="  border-color: black;
										border-width: 2px;
										padding: 20px 20px 20px 20px;
										border-style: solid;">$24,459.50</b> </span>
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
									<p style="text-align:left;">Cantidad:<div class="col-md-3" style="width:60%; border-top: 1px solid #000; margin-top: -20px !important; margin-left: 12% "></div> </p>
	
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
									<span style="text-align: center; margin-right: 45% !important; float: right"><b>Jose Perez Pichardo</b></span>
								</td>

							</tr>
						</table>
					</td>
				</tr>

			</table>
		</div>
	</body>
</html>
