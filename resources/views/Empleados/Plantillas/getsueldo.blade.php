<tr action="{{$sum}}" >
    <td>SUELDO BASE</td>
    <td>{{$empleado->created_at->format('d/m/Y')}}</td>
    <td>{{$user}}</td>
    <td style="float: right;">${{number_format($empleado->salario,2)}}</td>
  </tr>
@foreach ($sueld as $sueldo)
<tr action="{{$sueldoMonto->amount+$sueldo->sueldo_base}}" onclick="ModalSalarioshow({{$sueldo->id}})">
    <td>{{$sueldo->description}}</td>
    <td>{{$sueldo->created_at->format('d/m/Y')}}</td>
    <td>{{$sueldo->user}}</td>
    <td style="float: right;">${{number_format($sueldo->sueldo_increment,2)}}</td>
</tr>
@endforeach