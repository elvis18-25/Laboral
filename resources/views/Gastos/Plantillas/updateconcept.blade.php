@foreach ( $concepto as  $conceptos)
@if ($conceptos->id_empresa==Auth::user()->id_empresa && $conceptos->estado==0)
@if ($conceptos->id_gasto==$gasto->id)

<tr id="gasto{{$conceptos->id}}">
    <td onclick="verconcept({{$conceptos->id}})">{{$conceptos->concepto}}</td>
    <td style="text-align: center;" >
        <a href="{{asset('recibo/'. $conceptos->imagen)}}" target="_blank" rel="noopener noreferrer">
            {{$conceptos->imagen}}
          </a>
       </td>   
    <td  onclick="verconcept({{$conceptos->id}})" style="text-align: right;">${{number_format($conceptos->monto,2)}}</td>
</tr>
    
@endif
@endif
@endforeach