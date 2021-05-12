@foreach ($ad as $Adjuntos)
@if ($emple==$Adjuntos->id_empleado)
@if ($Adjuntos->id_empresa==$user)
@if ($Adjuntos->estado!=1)
<tr>
  <td>{{$Adjuntos->descripcion}}</td>

 <td>
  <a href="{{asset('document/'. $Adjuntos->name)}}" target="_blank" rel="noopener noreferrer">
      {{$Adjuntos->name}}
    </a>
 </td>
 
  <td>
      <button type="button" class="btn btn-danger btn-sm" onclick="remoED({{$Adjuntos->id}},{{$emple});"><i class="fas fa-minus"></i></button>
  </td>
</tr>
@endif    
@endif    
@endif
@endforeach