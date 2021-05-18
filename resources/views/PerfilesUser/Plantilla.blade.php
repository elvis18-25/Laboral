<tr >
    <td>{{$user->name." ".$user->apellido}}</td>
    <td style="text-align: center;">{{$user->cedula}}</td>
    <td style="text-align: center;">{{$user->cargo}}</td>
    <td style="text-align: center;">
      @foreach ($user->puestoU as $puesto)
      {{$puesto->name}}
  @endforeach
    </td>
    <td style="text-align: right;">${{number_format($user->salario,2)}}</td>
    <td style="text-align: right;">
      <button class="btn btn-danger remf btn-sm" type="button" value="{{$user->id}}"><i class="fas fa-minus"></i></button>
  </td>
  </tr>