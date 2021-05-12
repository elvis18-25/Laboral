
  

  <div class="modal fade" id="converteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">EMPLEADO A USUARIO</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @php
              $user=Auth::user()->id_empresa;
          @endphp
            <form action="{{url('ConverterUsuario')}}" method="POST">
                @csrf
            <div class="form-group col-md-10">
                <label for="inputState">ROL</label>
                <select id="inputState" class="form-control" name="rol">
                    <option selected>ELEGIR ROL...</option>
                    @foreach ($role as $rol)
                    @if ($rol->id_empresa==$user || $rol->id_empresa==0 )
                        
                    <option value="{{$rol->id}}">{{$rol->name}}</option> 
                    @endif
                    @endforeach
                </select>
              </div>
              <input type="text" name="idempleado"  value="{{$empleados->id_empleado}}" hidden>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
</form>
  