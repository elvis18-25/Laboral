@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asistencia.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">


<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>HISTORIAL DE ASISTENCIA</b></h4>
                </div>
                <div class="col-4 text-right">
                <a href="{{Route('Asistencia.create')}}" title="Crear Nuevo listado de Asistencia " class="btn btn-sm btn-info redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                <a href="{{url('Equipos')}}" title="Crear Grupo de Empleado " class="btn btn-sm btn-warning redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-users-cog" style="top: 5px; margin-left: -25%; position: relative; font-size: 15px;"></i> </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
                        <div class="col-sm-3" >
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; position: relative; top: 3px;">
                              <i class="fa fa-calendar"></i>&nbsp;
                              <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                          </div>
            <div class="">
                <table class="table tablesorter " id="listado-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="titlelistado">NOMBRE</th>
                        <th style="font-size: 15px !important;">CARGO</th>
                        <th style="font-size: 15px !important;">CEDULA</th>
                        <th style="font-size: 15px !important;">FECHA DE ENTRADA</th>
                        <th style="font-size: 15px !important;">FECHA DE SALIDA</th>
                      </tr>
                    </thead>
                    <tbody style="cursor: pointer;">
                        
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

<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<div class="modal fade" id="horassdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
  </div>

@endsection

@section('js2')
<script src="{{asset('js/pageLoader.js')}}"></script>

<script>



start = moment().startOf('month');
end = moment().endOf('month');

$(document).ready(function(){
$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

$('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    timePicker: true,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
},      function (start, end) {
          
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          tabla.ajax.reload();
        });

  


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#listado-table').DataTable({

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

    serverSide:true,
    ajax:
    {
      url:"{{url('datatableHAS') }}",
      "data":function(d){
        var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');

        d.start_date=start;
          d.end_date=end;

       
      }
    },

    language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "",
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


    columns:[
    {data:'nombre',name:'nombre',class: "boldend" },
    {data:'cargo', name:'cargo', class: "boldend"},
    {data:'cedula', name:'cedula', class: "boldend"},
    {data:'entrada',name:'entrada', class: "boldend", searchable:false},
    {data:'salidad',name:'salidad', class: "boldend", searchable:false},
    ],

});

$('div.dataTables_filter input', tabla.table().container()).focus();   
});



document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});





$("#listado-table tbody").on('click','tr',function(){
 
 url=$(this).attr('data-href');

 modaledit(url);

 
});

// $('#listado-table').DataTable().on("draw", function(){
//     var rowIdx = tabla.cell(':eq(0)').index().row;
      
//       tabla.row(rowIdx).select();

//       tabla.cell( ':eq(0)' ).focus();
// });


$('#listado-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tabla.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#listado-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tabla.cell(this).index().row;

        
        // Select row
        tabla.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#listado-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = tabla.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

                url=$(row_s).attr('data-href');

                modaledit(url);

  
            
        }
        
    });



function modaledit(e){
    var url="{{url('modaleditFecha')}}/"+e; 
var data='';
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              $("#horassdd").html(result).modal("show");
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

</script>

<style>
    .dataTables_filter{
        margin-top: -30px !important;
        margin-left: 34px;
    }
    #listado-table tbody tr {
        cursor: 'pointer';
    } 
    #listado-table{
        width: 100% !important;
    }
</style>

@endsection

