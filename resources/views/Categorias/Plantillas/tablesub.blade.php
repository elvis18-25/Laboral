@foreach ($sub as $subs)
<tr >
  <td onclick="updatesub({{$subs->id}})">{{$subs->id_categorias}}</td>
  <td onclick="updatesub({{$subs->id}})" style="text-align: center; width: 132% !important; ">{{$subs->nombre}}</td>
              
</tr>
@endforeach