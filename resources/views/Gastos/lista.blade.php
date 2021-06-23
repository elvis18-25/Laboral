@foreach ($nominas as $nomina)
    
<tr onclick="vernomina({{$nomina->id_nomina}});" id="{{$nomina->id_nomina}}" value="{{$nomina->monto}}" action="{{$nomina->id_nomina}}">
    <td style="cursor: pointer;">{{$nomina->descripcion}}</td>
    <td style="text-align: right; cursor: pointer;">${{number_format($nomina->monto,2)}}</td>
    
</tr>
@endforeach
