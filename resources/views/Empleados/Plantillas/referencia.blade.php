@foreach ($referen as $ref)
@if ($emple==$ref->empleado_id_empleado)
<td>{{$ref->nombre}}</td>
<td>{{$ref->telefono}}</td>
<td>{{$ref->parentesco}}</td>
<td>
 <button type="button" class="btn btn-danger btn-sm"  onclick="elimini({{$ref->id}},{{$emple}})" ><i class="fas fa-minus"></i></button>
</td>
@endif
@endforeach