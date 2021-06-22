@foreach ( $gastofijos as  $gastofijo)
@if ($gastofijo->id_empresa==Auth::user()->id_empresa && $gastofijo->estado==0)
@if ($gastofijo->id_gasto==$gasto->id)
    


<tr id="gasto{{$gastofijo->id}}">
    <td style=" cursor: pointer;" onclick="verconceptFijo({{$gastofijo->id}})">{{$gastofijo->concepto}}</td>
    <td  onclick="verconceptFijo({{$gastofijo->id}})" style="text-align: right; cursor: pointer;">${{number_format($gastofijo->monto,2)}}</td>
</tr>
    
@endif
@endif
@endforeach