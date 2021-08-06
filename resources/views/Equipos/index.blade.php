@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/equipos.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<style>
      table>thead>tr{
    background-color: rgb(255 255 255 / 50%) !important;
  
}
table>thead>tr>th{
  color: black !important;
}
.azules>thead>tr{
    background-color: #4054b2 !important;
  
}
.azules>thead>tr>th{
  color: white !important;
}
</style>
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
                <div class="col-md-3 float-left">
                    <label><b>{{ __('BUSCAR') }}</b></label>
                    <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Buscar..." class="form-control">
                  </div> 
                  <div class="col-sm-2" id="fechaHora">
                    <label for=""><b>FECHA DE CREACION</b></label>
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 125%; position: relative; top: 3px;">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                  </div>
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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>GRUPO</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('Equipos.create')}}" title="Crear Nuevo Grupo" class="btn btn-sm btn-info redondo"><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-plus" style="    top: 6px;
                      position: relative;
                      font-size: 18px;
                      margin-left: -2px;"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter azules" id="equipo-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer"><b>DESCRIPCION</b></th>
                        <th class="TitlePer"><b>FECHA CREADA</b></th>
                        <th class="TitlePer"><b>EMPLEADOS</b></th>
                        <th class="TitlePer"><b>USUARIO</b></th>
                        <th class="TitlePer" hidden></th>
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
      <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
  </div>

  <input type="text" name="" value="" id="started" hidden>
<input type="text" name="" value="" id="ended" hidden>

<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>

@if (session('eliminado')=='ya')
<script>
    Command: toastr["success"]("se ha eliminado el equipo", "")
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
    Command: toastr["success"]("se ha actualizado el equipo", "")
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
    Command: toastr["success"]("se ha actualizado el equipo", "")
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
    
<script>

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#createdperfiles").trigger("click");
    } 
});


start = moment().startOf('month');
end = moment().endOf('month');


$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

$('#reportrange').daterangepicker({
  startDate: start,
  endDate: end,
  ranges: {
     'Hoy': [moment(), moment()],
     'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
     'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
     'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
     'Este mes': [moment().startOf('month'), moment().endOf('month')],
     'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
     'Este año': [moment().startOf('year'), moment().endOf('year')],
     'El año pasado': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
  }
}, function (start, end) {
        
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');

        $("#started").attr('value',start);
        $("#ended").attr('value',end);
        
        table.ajax.reload();

      });


 $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  table=$('#equipo-table').DataTable({
    "info": false,
    processing:true,
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
      url:"{{ url('datatablEquipos') }}",
      "data":function(d){
        startComes = new Date($("#started").attr('value'));
        endComes = new Date($("#ended").attr('value'));

        start = moment(startComes).format('YYYY-MM-DD');
        end = moment(endComes).format('YYYY-MM-DD');
        d.start_date=start;
        d.end_date=end;
      }
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

$('#equipo-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#equipo-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#equipo-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

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

//     $('#equipo-table').DataTable().on("draw", function(){
//     var rowIdx = table.cell(':eq(0)').index().row;
      
//     table.row(rowIdx).select();

//     table.cell( ':eq(0)' ).focus();
// });

    document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {

      var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();

    }
});
$("#equipo-table tbody").on('click','tr',function(){
 
   url=$(this).attr('url');

   $("#sd").attr('href',url);

   $("#urles").trigger("click");

   
});


$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

function saerch(){
  name=$("#btnsearch").val();

  table.search(name).draw();

}

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

    #equipo-table tbody tr{
        cursor: pointer;
    }
</style>

@endsection

