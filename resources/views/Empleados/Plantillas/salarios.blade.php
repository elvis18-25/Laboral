<tr action="{{$sueldoMonto->amount+$empleados->salario}}" onclick="ModalSalarioshow({{$sueldo->id}})">
    <td >{{$sueldo->description}}</td>
    <td style="text-align: center;">{{$sueldo->created_at->format('d/m/Y')}}</td>
    <td style="text-align: center;">{{$sueldo->user}}</td>
    <td style="text-align: right;">${{number_format($sueldo->sueldo_increment,2)}}</td>
</tr>