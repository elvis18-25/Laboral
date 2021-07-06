<tr value={{$empleado->id_empleado}}>
    <td>
        <div class="form-check"><label class="form-check-label">
            <input class="form-check-input" name="dinamico[]" checked type="checkbox" value="{{$empleado->id_empleado}}">
            <span class="form-check-sign"><span class="check"></span></span></label>
        </div>
        </td>
        <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
        <td>{{$empleado->cargo}}</td>
        <td>
        @foreach ($empleado->puesto as $puesto)
            {{$puesto->name}}
        @endforeach
    </td>
</tr>