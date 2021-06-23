<tr onclick="vernomina({{$nomina->id}});" id="{{$nomina->id}}" value="{{$nomina->monto}}" action="{{$nomina->id}}">
    <td style="cursor: pointer;">{{$nomina->descripcion}}</td>
    <td style="text-align: right; cursor: pointer;">${{number_format($nomina->monto,2)}}</td>
</tr>