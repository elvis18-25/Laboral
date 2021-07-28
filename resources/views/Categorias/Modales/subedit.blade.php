
  <!-- Modal -->
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>SUBCATEGORIAS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-row">

            <div class="col-sm-2">
              <input type="text" name="newcategoria" id="subcodeedit"class="form-control datosInput" placeholder="{{ __('ID..') }}">

            </div>
            <div class="col-sm-6 text-left">
                <input type="text" name="newcategoria" id="subcatedit"   oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control datosInput" placeholder="{{ __('SUBCATEGORIAS') }}">
            </div>

            <div class="col-sm-4">
              <select class="js-example-basic-single"  name="" id="perntencs">
                <option value="{{$categorias->id}}">{{$categorias->id_category."."." ".$categorias->nombre}}</option>
                @foreach ($sub as $sub_gs)
                
                <option value="{{$sub_gs->id_categorias}}">{{$sub_gs->id_categorias."."." ".$sub_gs->nombre}}</option>
                @endforeach
              </select>
            </div>

        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo btn-sm" id="btnclicksub" onclick="saveeditbug({{$id}});"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>

<script>
  $('#perntencs').select2({
  theme: "classic",
  width: "100%",
  height: "50%"
});

$("#subcodeedit").mask('0#');

function saveeditbug(e){
  var name=$("#subcatedit").val();
  var pertenece=$("#perntencs").val();
  var code=$("#subcodeedit").val();
  // alert(code);

  var url="{{url('savesub')}}/"+e
  var data ={name:name,pertenece:pertenece,code:code};
  $.ajax({
  method:"POST",
  data: data,
  url:url,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  success:function(result){
    // alert(result);
  $("#SubmodalEdit").trigger("click");

  $("#subcategoriasEdi tbody").empty();
  $("#subcategoriasEdi tbody").append(result);
  table.ajax.reload(); 
  sucessf();
},
error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
});
}
</script>