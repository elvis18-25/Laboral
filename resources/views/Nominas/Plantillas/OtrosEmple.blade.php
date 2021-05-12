@php
    $user=Auth::user()->id_empresa;
@endphp
@foreach ($otros as $otro)
@if ($empleado->id_empleado==$otro->id_empleado && $otro->id_empresa==$user)
<tr onclick="editotros({{$otro->id}},{{$otro->id_empleado}})">
    <td>{{$otro->descripcion}}</td>
    <td>{{$otro->tipo_asigna}}</td>
    <td>{{$otro->tipo}}</td>
        @if ($otro->tipo=="PORCENTAJE")
        <td>{{$otro->monto}}%</td>
        @else
        <td>${{number_format($otro->monto,2)}}</td>
        @endif
    <td class="float-center">${{number_format($otro->p_monto,2)}}</td>
    <td>{{$otro->created_at->format('d/m/Y')}}</td>
</tr>
    
@endif
@endforeach