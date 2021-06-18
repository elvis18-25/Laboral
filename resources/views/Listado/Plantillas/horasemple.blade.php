
@foreach ($hora as $horas)
    
<tr style="cursor: pointer;" onclick="showHoras({{$horas->id}});">
    <td>{{date("d/m/Y H:i", strtotime($horas->fechainicio))}}</td>
    <td>{{date("d/m/Y H:i", strtotime($horas->fechafinalizado))}}</td>
    @if ($horas->type=="EXTRAS")
    <td class="titleCenter">{{$horas->horas}}</td>
    @else 
    <td  class="titleCenter">0</td>
    @endif

    @if ($horas->type=="DESCONTADA")
    <td  class="titleCenter">{{$horas->horas}}</td>
    @else
    <td  class="titleCenter">0</td>
    @endif
    
    <td>{{($horas->jornada)}}</td>
    <td>${{number_format($horas->monto,2)}}</td>
</tr>
@endforeach