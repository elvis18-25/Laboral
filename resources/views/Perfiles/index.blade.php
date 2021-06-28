@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/perfiles.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>PERFILES</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('Perfiles.create')}}" class="btn btn-sm btn-info redondo"><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-plus" style="top: 6px; position: relative;"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter" id="perfiles-table">
                    
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer"><b>DESCRIPCION</b></th>
                        <th class="TitlePer"><b>FECHA CREADA</b></th>
                        <th class="TitlePer"><b>EMPLEADOS</b></th>
                        <th class="TitlePer"><b>USUARIO</b></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </div>
                </table>
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

<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
@endsection

@section('js')

@if (session('eliminado')=='ya')
<script>
    Command: toastr["success"]("se ha eliminado el perfil", "")
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
  </script>    
@endif
@if (session('actualizar')=='ya')
<script>
    Command: toastr["success"]("se ha actualizado el perfil", "")
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
  </script>    
@endif
@if (session('guardar')=='ya')
<script>
    Command: toastr["success"]("se ha guardado el perfil", "")
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
  </script>    
@endif
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#createdperfiles").trigger("click");
    } 
});
 $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  table=$('#perfiles-table').DataTable({
    "info": false,
    select: {
            style: 'single',
        },
        keys: {
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },
        rowGroup: {
        dataSrc: 'group'
    },
    buttons:[{
            extend: 'print',
            messageTop: 'Nomina Empleado',
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
      url:"{{ url('datatableperfiles') }}",
    },

    columns:[
    {data:'descripcion',name:'descripcion'},
    {data:'created_at',name:'created_at', class:"center"},
    {data:'emple',name:'emple',searchable:false,class:"center"},
    {data:'user',name:'user',class:"center"},
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


document.addEventListener ("keydown", function (e) {
    if (e.keyCode!=13) {
        $('div.dataTables_filter input', table.table().container()).focus(); 
    }
});

$('#perfiles-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#perfiles-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#perfiles-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            url=$(row_s).attr('url');

            $("#sd").attr('href',url);

            $("#urles").trigger("click");
            
        }
        
    });

    $('#perfiles-table').DataTable().on("draw", function(){
    var rowIdx = table.cell(':eq(0)').index().row;
      
    table.row(rowIdx).select();

    table.cell( ':eq(0)' ).focus();
});

    document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {

      var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();

    }
});
$("#perfiles-table tbody").on('click','tr',function(){
 
   url=$(this).attr('url');

   $("#sd").attr('href',url);

   $("#urles").trigger("click");

   
});

var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
});


</script>

<style>
    .center{
        text-align: center;
    }
</style>

@endsection

