@php
    $user=Auth::user()->id_empresa;
@endphp
@foreach ($NominaOtros as $NominaOtro)
@if ($empleado->id_empleado==$NominaOtro->id_empleado && $NominaOtro->id_empresa==$user)
<tr onclick="editotros({{$NominaOtro->id}},{{$NominaOtro->id_empleado}})">
    <td>{{$NominaOtro->descripcion}}</td>
    <td>{{$NominaOtro->tipo_asigna}}</td>
    <td>{{$NominaOtro->tipo}}</td>
        @if ($NominaOtro->tipo=="PORCENTAJE")
        <td>{{$NominaOtro->monto}}%</td>
        @else
        <td>${{number_format($NominaOtro->monto,2)}}</td>
        @endif
    <td class="float-center">${{number_format($NominaOtro->p_monto,2)}}</td>
    <td>{{$NominaOtro->created_at->format('d/m/Y')}}</td>
</tr>
    
@endif
@endforeach