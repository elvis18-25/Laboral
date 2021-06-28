<tr action="{{$sueldoMonto->amount+$empleados->salario}}" onclick="ModalSalarioshow({{$sueldo->id}})">
    <td>{{$sueldo->description}}</td>
    <td>{{$sueldo->created_at->format('d/m/Y')}}</td>
    <td>{{$sueldo->user}}</td>
    <td style="float: right;">${{number_format($sueldo->sueldo_increment,2)}}</td>
</tr>