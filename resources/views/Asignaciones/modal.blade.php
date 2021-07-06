
  
  <!-- Modal -->
  <div class="modal fade" id="asignacionesmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 129%; margin-top: -198px;" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVA ASIGNACIÓN</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="form-row">
            <div class="col-sm-3">
                <label style="color: black"><b>{{ __('NOMBRE ') }}</b></label>
                <input type="text" name="name" autofocus id="name" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>

            <div class="col-sm-3">
                <label style="color: black"><b> {{ __('TIPO ') }}</b></label>
                <select id="inputState" class="form-control selec" required name="tipo" >
                    <option selected disabled>ElEGIR...</option>
                    <option value="1">DEDUCIÓN</option>
                    <option value="2">INCREMENTO</option>
                  </select>
            </div>

            <div class="col-sm-3">
                <label style="color: black"><b>{{ __('FORMA ') }}</b></label>
                <select  class="form-control selec" name="formae" required id="forma" >
                    <option selected disabled>ElEGIR...</option>
                    <option value="3">MONTO</option>
                    <option value="4">PORCENTAJE</option>
                  </select>
            </div>
          
            <div class="col-sm-2">
                <label style="color: black"></label>
                <label style="color: black"><b>{{ __('MONTO ') }}</b></label>

                <div class="input-group" >
                <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                    <div class="input-group-text" style="color: black"><span id="figura"></span></div>
                  </div>
                <input type="text" name="monto"  onkeyup="calcular();" style="text-align: right;" id="monto" required  class="form-control money" placeholder=""  >
                <input type="text"   id="montoOP" value="" hidden>
            </div>
        </div>

    </div> 
<br>
    <div class="form-inline ">
      <label for="inputState"><b> SELECCIONAR POR GRUPO:</b> &nbsp;</label>
          <select id="inputStateGrupo" class="form-control form-control-sm" name="grupo">
            <option  value="-1" >NINGUNO...</option>
            <option selected value="0">TODOS</option>
            @foreach ($equipo as $equipos)
            @if ($equipos->id_empresa==Auth::user()->id_empresa && $equipos->estados==0)
            <option value="{{$equipos->id}}">{{$equipos->descripcion}}</option>
            @endif
            @endforeach
          </select>
      </div>
      <br>
      <table class="table tablesorter list" id="listado-table" style="width: 100% !important;">
        <thead class=" text-primary">
        <tr> 
            <th style="font-size: 12px !important; width: 61px !important;">ACCIÓN</th>
            <th class="listadoth"><b>EMPLEADO</b></th>
            <th class="listadoth2"><b>CARGO</b></th>
            <th class="listadoth3"><b>DEPARTAMENTO</b></th>
          </tr>
        </thead>
        <tbody style="font-size: 13px !important;">
        </tbody>
    </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo" id="saver" onclick="saveasignaciones();"><i class="fas fa-save" style="margin-left: -2px; position: relative; font-size: 17px;" ></i></button>
        </div>
      </div>
    </div>
  </div>
  