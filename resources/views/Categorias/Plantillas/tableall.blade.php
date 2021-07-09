@foreach ($sub as $subs)
<tr>
    <td style="padding: 5px 7px;" onclick="updatesub({{$subs->id}})">{{$subs->nombre}}</td>
    <td style="padding: 5px 7px;">
      <button class="btn btn-danger btn-sm redondo" onclick="subcategory({{$subs->id}})" value="{{$subs->id}}"><i class="fas fa-minus"></i></button>
    </td>
</tr>
@endforeach