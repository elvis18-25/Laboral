
  <!-- Modal -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b> EDITAR SUBCATEGORIAS</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-row">
          <div class="col-sm-11 text-left">

            <div class="form-row">
              <div class="col-sm-7">
                <h6 for="SUBCATEGORIAS" style="color: black"><b>SUBCATEGORIAS</b></h6>
                <input type="text" name="newcategoria" value="{{$sub->nombre}}" id="subcatupdate" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control datosInput" placeholder="{{ __('SUBCATEGORIAS') }}">

              </div>
              <div class="col-sm-4">
                <h6 for="CATEGORIAS" style="color: black"><b>CATEGORIAS</b></h6>
                <select class="custom-select form-control" id="slected" >
                  <option selected disabled value="">ELEGIR...</option>
                  @foreach ($categorias as $categoria)
                      @if ($category_sub->id_categorias==$categoria->id)
                      <option selected value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                          
                      @else
                      <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>

                      @endif
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  Please select a valid state.
                </div>
              </div>
            </div>

            </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info redondo btn-sm" id="btnclicksub" onclick="updatesave({{$sub->id}});"><i class="fas fa-save"></i></button>
      </div>
    </div>
  </div>

<script>
function updatesave(e){
    var name=$("#subcatupdate").val();
    var select=$("#slected").val();
    var url="{{url('updatesub')}}/"+e
    var data ={name:name,select:select};
    $.ajax({
    method:"POST",
    data: data,
    url:url,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success:function(result){
    $("#SubupdateEdit").trigger("click");
    $("#EditCategorias").trigger("click");
    // $("#subcategoriasEdi").empty(); 
    // $("#subcategoriasEdi").append(result); 
    sucessf();
    table.ajax.reload(); 
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    ErroresGen();
    }
    });
}
</script>