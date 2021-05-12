<tr onclick="editotros({{$otros->id}},{{$otros->id_empleado}})">
    <td>{{$otros->descripcion}}</td>
    <td>{{$otros->tipo_asigna}}</td>
    <td>{{$otros->tipo}}</td>
        @if ($otros->tipo=="PORCENTAJE")
        <td>{{$otros->monto}}%</td>
        @else
        <td>${{number_format($otros->monto,2)}}</td>
        @endif
    <td>${{number_format($otros->p_monto,2)}}</td>
    <td>{{$otros->created_at->format('d/m/Y')}}</td>
    
</tr>