<tr >
    <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
    <td style="text-align: center;">{{$empleado->cedula}}</td>
    <td style="text-align: center;">{{$empleado->cargo}}</td>
    <td style="text-align: center;">
      @foreach ($empleado->puesto as $puesto)
          {{$puesto->name}}
      @endforeach
    </td>
    <td style="text-align: right;">${{number_format($empleado->salario,2)}}</td>
    <td style="text-align: right;">
      <button class="btn btn-danger remf btn-sm redondo" type="button" value="{{$empleado->id_empleado}}"><i class="fas fa-minus"></i></button>
  </td>
  </tr>