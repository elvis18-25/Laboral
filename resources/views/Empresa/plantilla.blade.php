<tr >
    <td>{{$contrato->name}}</td>
    <td>{{$contrato->user}}</td>
    <td>{{$contrato->created_at->format('d/m/Y')}}</td>
    <td>
        <button type="button" value="{{$contrato->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
    </td>
</tr>