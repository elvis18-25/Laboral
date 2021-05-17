<tr action="{{$concepto->monto}}" id="gasto{{$concepto->id}}" value="{{$p}}">
    <td onclick="verconcept({{$concepto->id}})">{{$concepto->concepto}}</td>
    <td  onclick="verconcept({{$concepto->id}})" style="text-align: right;">${{number_format($gasto->monto,2)}}</td>
</tr>