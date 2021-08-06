@foreach ($empleado as $empleados)
    
<tr value="{{$empleados->id_empleado}}">
    <td >{{$empleados->nombre." ".$empleados->apellido}}</td>
    <td style="text-align: center;">{{$empleados->cedula}}</td>
    <td style="text-align: center;">{{$empleados->cargo}}</td>
    <td style="text-align: center;">
        {{$empleados->name}}
    </td>
    <td style="text-align: right;">${{number_format($empleados->salario,2)}}</td>
    <td style="text-align: right;">
        <button class="btn btn-danger btn-sm remfe redondo" type="button" value="{{$empleados->id_empleado}}"><i class="fas fa-minus"></i></button>
    </td>
</tr>
@endforeach