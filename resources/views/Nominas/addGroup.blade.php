
  <!-- Modal -->
  <div class="modal fade" id="addgrup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;"><b>GRUPOS</b></h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <div class="card-body" style="height: 173px;">

              <div class="form-row">
        <div class="form-inline" style="top: -32px; position: relative;">
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="exampleRadios" checked id="exams1" value="option1" >
                   CREAR NUEVO GRUPO
                    <span class="form-check-sign"></span>
                </label>
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exams2" value="option2" >
                    AÑADIR EMPLEADO A UN GRUPO
                    <span class="form-check-sign"></span>
                </label>
            </div>
        </div>
        <br>

        <div class="col-sm-6" id="descrsa">
            <label style="color: black"><b>{{ __('DESCRIPCION ') }}</b></label>
            <input type="text" name="name" id="txtDescrip"    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">

        <div class="col-sm-3"  id="entrada">
            <label style="color: black"><b>{{ __('HORA DE ENTRADA') }}</b></label>
            <input type="text" id="txtentrada" name="entrada" class="form-control bs-timepicker" value="">
        </div>

        <div class="col-sm-3"  id="salida">
            <label style="color: black"><b>{{ __('HORA DE SALIDA') }}</b></label>
            <input type="text" id="txtsalida" name="salida" class="form-control bs-timepicker" value="">
        </div>

        <div class="form-group col-md-10" id="selecgrupo">
          <label for="inputState">ElEGIR GRUPO</label>
          <select id="idgrupos" class="form-control">
            <option selected  value="0">ELEGIR...</option>
            @foreach ($equipos as $equipo)
            <option value="{{$equipo->id}}">{{$equipo->descripcion}} {{$equipo->entrada."  "."A"."  ".$equipo->salida}}</option>
            @endforeach
          </select>
        </div>

      

    </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo" onclick="savegruop()"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>

  <script>

  </script>