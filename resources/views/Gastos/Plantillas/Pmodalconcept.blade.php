<tr action="{{$gasto->monto}}" id="gasto{{$gasto->id}}">
    <td onclick="verconcept({{$gasto->id}})">{{$gasto->concepto}}</td>
    <td  onclick="verconcept({{$gasto->id}})" style="text-align: right;">${{number_format($gasto->monto,2)}}</td>
</tr>