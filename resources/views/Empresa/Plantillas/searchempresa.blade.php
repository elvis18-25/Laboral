@foreach ($empre as $empresas)
@foreach ($userEmpresa as $users)
@if ($users->id_empresa==$empresas->id)

<tr>
<td>{{$empresas->nombre}}</td>
<td class="TitleL">{{$empresas->created_at->format('d/m/Y')}}</td>
@if ($empresas->deafult==1)
<td>
    <div class="form-check form-check-radio TitleL" style="top: 8px">
        <label class="form-check-label">
            <input class="form-check-input" value="{{$empresas->id}}" type="radio" name="exampleRadios" checked name="empresavalue"  >
            {{-- Radio is off --}}
            <span class="form-check-sign"></span>
        </label>
    </div>
</td>    
@else
<td>
    <div class="form-check form-check-radio TitleL" style="top: 8px">
        <label class="form-check-label">
            <input class="form-check-input" value="{{$empresas->id}}" type="radio" name="exampleRadios" name="empresavalue"  >
            {{-- Radio is off --}}
            <span class="form-check-sign"></span>
        </label>
    </div>
</td>   
@endif



</tr>
@endif
@endforeach
@endforeach