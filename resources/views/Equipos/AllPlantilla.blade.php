{{-- @php
    $arreglo=[];
    $i=0;
@endphp --}}
@foreach ($empleados as  $empleado)
{{-- @php
   $arreglo[$i]=$empleado->id_empleado;
   $i++; 
@endphp --}}
<tr value="{{$empleado->id_empleado}}">
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
  <td hidden>
    {{-- <input type="text" name="arreglo[]" value="{{serialize($arreglo)}}" id=""> --}}
  </td>
</tr>

  @endforeach