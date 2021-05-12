<tr>
    <td>{{$adjnuto->descripcion}}</td>

   <td>
    <a href="{{asset('document/'. $adjnuto->name)}}" target="_blank" rel="noopener noreferrer">
        {{$adjnuto->name}}
      </a>
   </td>
   
    <td>
        <button type="button" class="btn btn-danger btn-sm" onclick="remoED({{$adjnuto->id}},{{$id}});"><i class="fas fa-minus"></i></button>
    </td>
</tr>