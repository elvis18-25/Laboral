<tr>
    <td style="padding: 5px 7px;" onclick="updatesub({{$sub->id}})">{{$sub->nombre}}</td>
    <td style="padding: 5px 7px;">
      <button class="btn btn-danger btn-sm redondo" onclick="subcategory({{$sub->id}})" value="{{$sub->id}}"><i class="fas fa-minus"></i></button>
    </td>
</tr>