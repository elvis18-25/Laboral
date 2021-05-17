

<tr action="{{$concept->monto}}" id="gasto{{$concept->id}}" >
    <td onclick="verconcept({{$concept->id}})">{{$concept->concepto}}</td>
    <td  onclick="verconcept({{$concept->id}})" style="text-align: right;">${{number_format($concept->monto,2)}}</td>
</tr>
    

