<tr action="{{$sum}}" >
    <td>SUELDO BASE</td>
    <td style="text-align: center;">{{$empleado->created_at->format('d/m/Y')}}</td>
    <td style="text-align: center;">{{$user}}</td>
    <td style="text-align: center;">${{number_format($empleado->salario,2)}}</td>
  </tr>
@foreach ($sueld as $sueldo)
<tr action="{{$sueldoMonto->amount+$sueldo->sueldo_base}}" onclick="ModalSalarioshow({{$sueldo->id}})">
    <td>{{$sueldo->description}}</td>
    <td style="text-align: center;">{{$sueldo->created_at->format('d/m/Y')}}</td>
    <td style="text-align: center;">{{$sueldo->user}}</td>
    <td style="text-align: center;">${{number_format($sueldo->sueldo_increment,2)}}</td>
</tr>
@endforeach