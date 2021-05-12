@foreach ($ciudad as $ciudades)
 <option value="{{$ciudades->id}}">{{$ciudades->name}}</option>
@endforeach