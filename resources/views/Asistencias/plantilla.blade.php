@foreach ($empleados as $empleado)
<tr>
    <td>
        <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" value=""><span class="form-check-sign"><span class="check"></span></span></label></div>
    </td>
    <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
    <td>{{$empleado->cargo}}</td>
    <td>
    @foreach ($empleado->puesto as $puesto)
        {{$puesto->name}}
    @endforeach
    </td>
    <td>{{$empleado->cedula}}</td>
    @foreach ($equipo as $equipos)
    @if ($empleado->id_empleado==$equipos->id_empleado)
        <td>{{$equipos->equipos}}</td>
    @else
        <td>0</td>
    @endif   
    @endforeach
</tr>
    
@endforeach