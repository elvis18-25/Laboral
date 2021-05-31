@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<style>
    #pagos-table_length{
        margin-left: 3% !important;
    }
</style>
<link rel="stylesheet" href="{{asset('css/pagos.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>FORMAS DE PAGOS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="#" data-toggle="modal" data-target="#create" class="btn btn-sm btn-info redondo"><button type="button" id="cretepagos"  style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                @include('Pagos.modalcreate')
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter " id="pagos-table">
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
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

<div class="modal fade" id="pagosshow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
    <script>
         $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  table=$('#pagos-table').DataTable({
      info: false,
      processing: true,

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
            messageTop: 'Lista de Usuario',
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
      url:"{{ url('datatablePagos') }}",
    },

    columns:[
    {data:'pago',name:'pago'},
    {data:'created_at',name:'created_at',class:'center'},
    {data:'emple',name:'emple', searchable:false,class:'center'},
    {data:'usuario',name:'usuario',searchable:false,class:'center'},
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
    if (e.keyCode== 107) {
        $("#cretepagos").trigger("click");
         
    } 
});

$('#pagos-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#pagos-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#pagos-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            ide=$(row_s).attr('data-href');

            infoPa(ide);
        }
        
    });

    $('#pagos-table').DataTable().on("draw", function(){
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

function savepagos(){
    var namew=$("#newpago").val();
    var url = "{{route('Pagos.store')}}"; 
     var data ={namew:namew};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                $("#create").modal("toggle");
                table.ajax.reload();  
                sucessf(); 

            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
}


$('#create').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btnpago').trigger("click");
    }
    if(e.keycode!=13)
    {
       $("#newpago").focus();
    }
});


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

$("#pagos-table tbody").on('click','tr',function(){
  // alert($(this).attr('data-href'));
   ide=$(this).attr('data-href');

   infoPa(ide);

});

function  infoPa(e)
{
  var url = "{{url('Pagosshow')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#pagosshow").html(result).modal("show");
 
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}


    </script>

    <style>
        .center{
            text-align: center;
        }
    </style>
@endsection