
  <!-- Modal -->
  <style>
   #subcategoriasEdi>tbody>tr>td{
      padding: 5px 7px;

    }

    #subcategoriasEdi tbody tr{
      cursor: pointer;
    }
    .dataTables_scrollHeadInner{
      width: 100% !important;
    }
    .subcategorts{
      width: 100% !important;
    }
  </style>
    <div class="modal-dialog  modal-lg">
      <div class="modal-content" style="top: -78px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>EDITAR CATEGORIA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-sm-6 text-left">
                <label style="color: black"><b>{{ __('CATEGORIA:') }}</b></label>
                <input type="text" name="editcategorias" id="editcategorias" value="{{$categorias->nombre}}" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control{{ $errors->has('newpago') ? ' is-invalid' : '' }}" placeholder="{{ __('Categoria') }}">
            </div>

            @if ($count!=0)
            <div class="form-check" style="margin-left: 9px; top: 24px;">
              <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="btnsub" checked value="todos">
                  <span class="form-check-sign">
                      <span class="check"></span>
                  </span> 
                  <h5><b style="color: black;">AÑADIR SUBCATEGORIAS</b></h5>
              </label>
          </div>    
            @else
            <div class="form-check" style="margin-left: 9px; top: 24px;">
              <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="btnsub" value="todos">
                  <span class="form-check-sign">
                      <span class="check"></span>
                  </span> 
                  <h5><b style="color: black;">AÑADIR SUBCATEGORIAS</b></h5>
              </label>
          </div>   
            @endif


        </div>

        <input type="text" name="" value="{{$count}}" id="idinput" hidden >
        
            <div id="btnplusEdit">
              <div class="col-sm-6">
                <input type="text" name="" class="form-control" onkeyup="saerches();" placeholder="Buscar..." id="btnsubsearch" style="margin-left: 175px; position: absolute; top: 12px;">
              </div>  
              <button type="button" class="btn btn-info redondo btn-sm float-left" style="margin-left: 94%" onclick="createsub({{$categorias->id}});"><i class="fas fa-plus" style="font-size: 17px; margin-left: -2px;"></i></button>
            </div>
              <table class="table subcategorts" id="subcategoriasEdi">
                <thead>
                  <tr>
                    <th style="text-align: left;">ID</th>
                    <th style="text-align: center; width: 100% !important;">NOMBRE</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sub as $subs)
                  
                      <tr >
                        <td onclick="updatesub({{$subs->ides}})">{{$subs->id_categorias}}</td>
                        <td onclick="updatesub({{$subs->ides}})" style="text-align: center; width: 132% !important; ">{{$subs->nombre}}</td>
                                    
                      </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo btn-sm"  onclick="updatecategorias({{$categorias->id}});"><i class="fas fa-save"></i></button>
          <button type="button" class="btn btn-danger redondo btn-sm"  onclick="deletecategorias({{$categorias->id}});"><i class="fas fa-trash"></i></button>
        </div>
      </div>
    </div>

<script>

var inputs=$("#idinput").val();

if(inputs==0){
$("#btnplusEdit").hide();
$("#subcategoriasEdi").hide();

}

tablesub=$('#subcategoriasEdi').DataTable({
    "info": false,
    "paging":   false,
    "ordering": false,
    scrollY: 200,


    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],

        language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

      },    
   
});

$("#btnsub").on('click',function(){
var valor =$("#idinput").val();

  if(valor==0){
    $("#idinput").attr('value',1)
    $("#subcategoriasEdi").show();
    $("#btnplusEdit").show();


  }else{
    $("#idinput").attr('value',0)
    $("#subcategoriasEdi").hide();
    $("#btnplusEdit").hide();
  }

});

function updatecategorias(e){
    var name=$("#editcategorias").val();
  var url="{{url('updatecategorias')}}/"+e
  var data ={name:name};
  $.ajax({
  method:"POST",
  data: data,
  url:url,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  success:function(result){
  $("#EditCategorias").trigger('click');
  table.ajax.reload(); 
  sucessf();
},
error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
});
}

function deletecategorias(e){
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
    var url="{{url('deletecategorias')}}/"+e
  var data ={name:name};
  $.ajax({
  method:"POST",
  data: data,
  url:url,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  success:function(result){
  $("#EditCategorias").trigger('click');
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



function createsub(e){
  var url = "{{url('showsubcategorias')}}/"+e; 
  var data='';
  $.ajax({
    method:"GET",
    data:data,
    url:url,
    success:function(result){
      $("#SubmodalEdit").html(result).modal("show");
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
  });
}
function updatesub(e){
  var url = "{{url('showsub')}}/"+e; 
  var data='';
  $.ajax({
    method:"GET",
    data:data,
    url:url,
    success:function(result){
      $("#SubupdateEdit").html(result).modal("show");
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
  });
}

function saerches(){
  var name=$("#btnsubsearch").val();
  tablesub.search(name).draw();
}

</script>