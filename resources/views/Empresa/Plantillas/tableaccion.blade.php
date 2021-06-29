@foreach ($acciones as $accione)
<tr>
    <td >{{$accione->nombre}}</td>
    <td class="TitleP">{{$accione->descripcion}}</td>

        @if ($accione->estado==1) 
        <td class="TitleP" value={{$accione->id}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" id="accions{{$accione->id}}" name="accion[]" value="{{$accione->id}}" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{$accione->id}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="accions{{$accione->id}}"  type="checkbox" name="accion[]" value="{{$accione->id}}" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
@endforeach