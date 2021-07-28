
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
              <div class="col-sm-2" id="colcode">
                <h6 for="SUBCATEGORIAS" style="color: black"><b>ID</b></h6>
                <input type="text" id="updatecode" class="form-control" value="{{$sub->id_subed}}">
              </div>
              <div class="col-sm-6">
                <h6 for="SUBCATEGORIAS" style="color: black"><b>SUBCATEGORIAS</b></h6>
                <input type="text" name="newcategoria" value="{{$sub->nombre}}" id="subcatupdate" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control datosInput" placeholder="{{ __('SUBCATEGORIAS') }}">
              </div>
              <div class="col-sm-4"  id="colpertenece">
                <h6 for="CATEGORIAS" style="color: black"><b>PERTENCE</b></h6>
                <select class="js-example-basic-single" id="slected" >
                  @foreach ($categoria as $categorys)
                  <option  value="{{$categorys->id_category}}" style="color: black; font-weight: bold !important;"><b>{{$categorys->id_category."."." ".$categorys->nombre}}</b></option>
                  @php
                    $sub_g=App\Models\categorias_sub::select('id_sub')->where('padres','=',$categorys->id_category)->get();
                    $arreglo=[];
                    $p=0;
                    
                    foreach($sub_g as $sub_gs){
                        $arreglo[$p]=$sub_gs->id_sub;
                        $p++;
                    }
                $subss=App\Models\SubCategorias::leftjoin('categorias_sub','categorias_sub.id_sub','=','sub_categorias.id')
                ->whereIn('sub_categorias.id',$arreglo)
                ->where('sub_categorias.id_empresa','=',Auth::user()->id_empresa)
                ->where('sub_categorias.estado','=',0)
                ->orderBy('categorias_sub.id_categorias')
                ->select('sub_categorias.id as ides','sub_categorias.nombre','categorias_sub.id_categorias')
                ->get();
                  @endphp

                  @foreach ($subss as $subs)
                  <option value="{{$subs->id_categorias}}">{{$subs->id_categorias."."." ".$subs->nombre}}</option>

                  @endforeach
                  
                  @endforeach
                </select>
 
              </div>

              <div class="col-sm-6">
              <div class="form-check" style="margin-left: 9px; top: 24px;">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="todos" id="btnCheckcategory"  >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span> 
                    <h5><b style="color: black">CONVERTIR EN CATEGORIAS</b></h5>
                </label>
            </div>
          </div>
            </div>

            </div>
      </div>
      </div>

      <input type="text" name="" value="0" id="inputchec" hidden>

      <div class="modal-footer">
        <button type="button" class="btn btn-info redondo btn-sm" id="btnclicksub" onclick="updatesave({{$sub->id}});"><i class="fas fa-save"></i></button>
        <button type="button" class="btn btn-danger redondo btn-sm" id="" onclick="subcategory({{$sub->id}});"><i class="fas fa-trash"></i></button>
      </div>
    </div>
  </div>

<script>
function updatesave(e){
    var name=$("#subcatupdate").val();
    var select=$("#slected").val();
    var code=$("#updatecode").val();
    var category=$("#inputchec").val();
    var url="{{url('updatesub')}}/"+e
    var data ={name:name,select:select,code:code,category:category};
    $.ajax({
    method:"POST",
    data: data,
    url:url,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success:function(result){
  // $("#subcategoriasEdi tbody").empty();
  // $("#subcategoriasEdi tbody").append(result);
    $("#SubupdateEdit").trigger("click");
    $("#EditCategorias").trigger("click");

    sucessf();
    table.ajax.reload(); 
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    ErroresGen();
    }
    });
}


function subcategory(e){
  Swal.fire({
  title: 'Estas seguro?',
  text: "¡No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminarlo!'
}).then((result) => {
  if (result.isConfirmed) {
    var url="{{url('deletesubcategory')}}/"+e
  var data ={name:name};
  $.ajax({
  method:"POST",
  data: data,
  url:url,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  success:function(result){
    $("#SubupdateEdit").trigger("click");
    $("#EditCategorias").trigger("click");
  table.ajax.reload(); 
  sucessf();
},
error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
});
  }
})

}

$('#slected').select2({
  theme: "classic",
  width: "100%",
  height: "50%"
});


$("#btnCheckcategory").on('click',function(){
var valor =$("#inputchec").val();

  if(valor==0){
    $("#inputchec").attr('value',1)
    $("#colcode").hide();
    $("#colpertenece").hide();

  }else{
    $("#inputchec").attr('value',0)
    $("#colcode").show();
    $("#colpertenece").show();
  }

});
</script>