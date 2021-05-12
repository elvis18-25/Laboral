<tr onclick="vernomina({{$nomina->id}});" id="{{$nomina->id}}" value="{{$nomina->monto}}" action="{{$nomina->id}}">
    <td>{{$nomina->descripcion}}</td>
    <td style="text-align: right;">${{number_format($nomina->monto,2)}}</td>

</tr>
