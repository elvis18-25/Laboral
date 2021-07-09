@foreach ($sub as $subs)
@if ($count==$subs->id)
<option value="{{$subs->id}}" selected>{{$subs->nombre}}</option>
    
@else
    
<option value="{{$subs->id}}">{{$subs->nombre}}</option>
@endif
@endforeach