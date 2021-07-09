
  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>SUBCATEGORIAS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <div class="col-sm-11 text-left">
                <label style="color: black"><b>{{ __('SUBCATEGORIAS:') }}</b></label>
                <input type="text" name="newcategoria" id="subcatedit" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control datosInput" placeholder="{{ __('Categoria') }}">
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo btn-sm" id="btnclicksub" onclick="saveeditbug({{$id}});"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>

<script>
  function saveeditbug(e){
  var name=$("#subcatedit").val();
  var url="{{url('savesub')}}/"+e
  var data ={name:name};
  $.ajax({
  method:"POST",
  data: data,
  url:url,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  success:function(result){
  $("#SubmodalEdit").trigger("click");
  $("#subcategoriasEdi").append(result);
  table.ajax.reload(); 
  sucessf();
},
error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
});
}
</script>