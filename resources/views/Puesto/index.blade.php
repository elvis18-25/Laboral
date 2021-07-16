@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/puesto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<div class="col-md-12">
  <div class="card ">
    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
      <div class="card card-plain">
        <div class="card-header" role="tab" id="headingTwo">
          <div class="row">
            <div class="col-12">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h4><b> FILTROS
                <i class="tim-icons icon-minimal-down"></i>
              </b>
              </h4>
            </a>
        </div>
        </div>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-4 float-left">
                  <label><b>{{ __('BUSCAR') }}</b></label>
                  <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"  placeholder="Buscar..." class="form-control">
                </div> 
              {{-- <div class="col-md-3 float-left">
                  <label><b>{{ __('TIPOS') }}</b></label>
                  <select id="tipy" class="form-control " name="categorias">
                    <option selected value=" ">NINGUNO...</option>
                    <option value="DEDUCCIÓN">DEDUCCIÓN</option>
                    <option value="INCREMENTO">INCREMENTO</option>
                </select>
                </div> --}}
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>DEPARTAMENTOS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="#" class="btn btn-sm btn-info redondo"  data-toggle="modal" data-target="#createdepart" ><button type="button" id="cretedwepart" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                @include('Puesto.modalcreate')
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter " id="depar-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitleP">NOMBRE</th>
                        <th class="TitleP">FECHA</th>
                        <th class="TitleP">EMPLEADOS</th>
                        <th class="TitleP">USUARIO</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>
<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>
<div class="modal fade" id="departshow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>

@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

document.addEventListener ("keydown", function (e) {
  if (e.keyCode== 107) {
      $("#cretedwepart").trigger("click");
  } 
});


      $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  table=$('#depar-table').DataTable({
      info: false,
      processing: true,

    select: {
           toggleable: false,
            select:true,
            style: 'single'
        },

        keys: {
          keys:true,
          focus: ':eq(0)', 
           page: 'current',
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },    
        rowGroup: {
        dataSrc: 'group'
    },    
    buttons:[{
            extend: 'print',
            messageTop: 'Lista de Departamento',
            exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '20pt' )
                        .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
          }],
    serverSide:true,
    ajax:
    {
      url:"{{ url('datatabledepart') }}",
    },

    columns:[
    {data:'name',name:'name'},
    {data:'created_at',name:'created_at',searchable:false, class:"center"},
    {data:'emple',name:'emple', searchable:false, class:"center"},
    {data:'usuario',name:'usuario', class:"center"},
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
  $('div.dataTables_filter input', table.table().container()).focus();


$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

$('#createdepart').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btndepart').trigger("click");
    }
    if(e.keycode!=13)
    {
       $("#newdepart").focus();
    }
});


function ErroresGen(){
  Command: toastr["error"]("", "Error!")
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    }
}
function savedepart(){
    var namew=$("#newdepart").val();

    var url = "{{route('Puesto.store')}}"; 
     var data ={namew:namew};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#createdepart").modal("toggle");
            table.ajax.reload();  
            sucessf(); 

            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
             }); 
}

$('#depar-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#depar-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#depar-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            ide=$(row_s).attr('data-href');

            infoDepart(ide);
        }
        
    });

//     document.addEventListener ("keydown", function (e) {
//     if (e.keyCode==16) {

//       var rowIdx = table.cell(':eq(0)').index().row;
      
//       table.row(rowIdx).select();

//       table.cell( ':eq(0)' ).focus();

//     }
// });


// $('#depar-table').DataTable().on("draw", function(){
//     var rowIdx = table.cell(':eq(0)').index().row;
      
//       table.row(rowIdx).select();

//       table.cell( ':eq(0)' ).focus();
// });


$("#depar-table tbody").on('click','tr',function(){
  // alert($(this).attr('data-href'));
   ide=$(this).attr('data-href');

   infoDepart(ide);

});

function  infoDepart(e)
{
  var url = "{{url('departshow')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#departshow").html(result).modal("show");
 
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
             });
}


function  sucessf(){
  Command: toastr["success"]("Se ha Efectuado la operación exitosamente ", "Corecto!")
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
}

function saerch(){
  name=$("#btnsearch").val();
  table.search(name).draw();
}
</script>
    
<style>
  .center{
    text-align: center !important;
  }
  #depar-table tbody tr{
    cursor: pointer;
  }
</style>
@endsection