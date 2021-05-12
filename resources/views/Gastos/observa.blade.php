 
  <!-- Modal -->
  <div class="modal fade" id="obervacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="height: 250px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">OBSERVACIONES</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <textarea class="form-control" id="textarea" placeholder="Escribir observación" style="color: black">{{$gasto->observaciones}}</textarea>
 
        {{-- <input type="text" value="{{$gasto->observaciones}}"> --}}

        {{-- <div id="txtEditor"></div> --}}
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-info" onclick="saveobser();" ><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
  