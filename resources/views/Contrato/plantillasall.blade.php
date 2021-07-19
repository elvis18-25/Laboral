@foreach ($contra as $contratos)
<tr >
    <td>{{$contratos->name}}</td>
    <td>{{$contratos->user}}</td>
    <td>{{$contratos->created_at->format('d/m/Y')}}</td>
    <td>
        <button type="button" class="btn btn-danger btn-sm redondo" style="border-radius: 50% !important;"><i class="fas fa-trash"></i></button>
    </td>
</tr>
@endforeach