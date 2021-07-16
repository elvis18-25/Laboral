@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asistencia.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>HISTORIAL DE ASISTENCIA</b></h4>
                </div>
                <div class="col-4 text-right">
                <a href="{{Route('Asistencia.create')}}" title="Crear Nuevo listado de Asistencia " class="btn btn-sm btn-info redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
               @if ($permisos->grupo==1)
               <a href="{{url('Equipos')}}" title="Crear Grupo de Empleado " class="btn btn-sm btn-warning redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-users-cog" style="margin-left: -4px; top: 6px; position: relative; font-size: 17px;"></i> </a>
               @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
                        {{-- <div class="col-sm-3" >
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; position: relative; top: 3px;">
                              <i class="fa fa-calendar"></i>&nbsp;
                              <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                          </div> --}}
            <div class="">
                <table class="table tablesorter azules " id="listado-table">
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
@if (session('guardar')=='ya')
<script>
    Command: toastr["success"]("se ha guardo la nomina", "")
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



start = moment().startOf('month');
end = moment().endOf('month');

$(document).ready(function(){
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
        tabla.ajax.reload();

      });

  


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#listado-table').DataTable({
        "info":false,
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


function SuccessGen(){
    Command: toastr["success"]("se ha actualizado la asistencia", "")
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
function SuccessDelete(){
    Command: toastr["success"]("se ha eliminado la asistencia", "")
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


function saerch(){
  name=$("#btnsearch").val();

  tabla.search(name).draw();

}
</script>



@endsection

