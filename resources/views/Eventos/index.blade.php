@foreach ($data as $datas)
@php
$dt = new DateTime($datas['start']);
@endphp
@if ( $dt->format('Y-m-d')>=date($start) && $dt->format('Y-m-d')<=date($end))
<tr>
    {{-- <td>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </td> --}}
    <td>
        <p class="title">{{$datas['title']}}</p>
        <p class="text-muted">FECHA:&nbsp;{{$datas['start']}}</p>
    </td>
    {{-- <td class="td-actions text-right">
        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
            <i class="tim-icons icon-pencil"></i>
        </button>
    </td> --}}
</tr>
@endif
@endforeach