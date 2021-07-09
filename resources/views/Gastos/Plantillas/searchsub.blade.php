@foreach ($sub as $subs)
<option value="{{$subs->id}}">{{$subs->nombre}}</option>
@endforeach