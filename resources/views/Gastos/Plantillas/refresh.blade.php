<option selected value="0" >ELEGIR NOMINA</option>
@foreach ($nominas as $nomina)
<option value="{{$nomina->id}}" >{{$nomina->descripcion}}</option>
@endforeach