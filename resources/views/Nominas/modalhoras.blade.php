    <div class="modal-dialog modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>HORAS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-sm-6 md-10" id="selecgrupo" >
              <label for="inputState"><b>ElEGIR GRUPO</b></label>
              <select id="idgrupos" class="form-control">
                <option selected  value="0">ELEGIR...</option>
                @foreach ($equipos as $equipo)
                <option value="{{$equipo->id}}">{{$equipo->descripcion}} {{$equipo->entrada."  "."A"."  ".$equipo->salida}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4 md-8">
              <label for="inputState"><b>FECHA</b></label>
              <input type="text" name="datetimes" class="form-control" />
            </div>
          </div>
          <br>

            <div class="col-sm-10">
              <div class="form-group">
                <label for="exampleFormControlTextarea1"><b> OBERVACIONES</b></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>

        </div>
        <input type="text" name="" value="" id="equipos" hidden>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>

    <script>
     $(function() {
  $('input[name="datetimes"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  });
}); 
    </script>