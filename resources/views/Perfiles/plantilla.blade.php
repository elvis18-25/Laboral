<tr >
    <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
    <td>{{$empleado->cedula}}</td>
    <td>{{$empleado->cargo}}</td>
    <td>
      @foreach ($empleado->puesto as $puesto)
          {{$puesto->name}}
      @endforeach
    </td>
    <td>${{number_format($empleado->salario,2)}}</td>
    <td>
      <button class="btn btn-danger remf btn-sm" type="button" value="{{$empleado->id_empleado}}"><i class="fas fa-minus"></i></button>
  </td>
  </tr>