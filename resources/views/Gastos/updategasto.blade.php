<tr id="gasto{{$concepto->id}}">
    <td onclick="verconcept({{$concepto->id}})">{{$concepto->concepto}}</td>
    <td style="text-align: right;">${{number_format($concepto->monto,2)}}</td>
  </tr>