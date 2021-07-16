@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/listado.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<style>
    #listado-table tbody tr {
        cursor: pointer;
    }  
    .titlelistado{
    text-align: center !important;
    font-size: 14px !important;
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
                    <input type="text" name="" id="btnsearch" onkeyup="saerch();" placeholder="Buscar..." oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control">
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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>LISTADO DE NOMINAS</b></h4>
                </div>
                <div class="col-4 text-right">
                <a href="{{url('Nominas')}}" title="Crear Nueva Nomina " class="btn btn-sm btn-info redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                @if ($permisos->perfiles==1)
                <a href="{{url('Perfiles')}}" title="Perfiles " class="btn btn-sm btn-warning redondo "><button  type="button"  style="display: none;"></button><i class="fas fa-users" style="margin-left: -5px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    
                @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            <div class="">
                <table class="table tablesorter azules " id="listado-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="titlelistado">DESCRIPCION</th>
                        <th style="font-size: 15px !important;">FECHA</th>
                        <th style="font-size: 15px !important; width: 9% !important;">USUARIO</th>
                        <th class="titlelistado">MONTO</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($listado as $listados)
                        @if ($listados->estado==0)
                        @if ($listados->id_empresa==$user)
                        <tr action="{{Route('Listado.show',$listados->id)}}">
                            <td>{{$listados->descripcion}}</td>
                            <td>{{date("d/m/Y", strtotime($listados->fecha))}}</td>
                            <td>{{$listados->user}}</td>
                            <td class="amount">${{number_format($listados->monto,2)}}</td>
                        </tr>
                        @endif
                        @endif
                        @endforeach --}}
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

@section('js2')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
@if (session('actualizar')=='ya')
<script>
    Command: toastr["success"]("se ha actualizado la nomina", "")
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
@if (session('Eliminado')=='ya')
<script>
    Command: toastr["success"]("se ha eliminado la nomina", "")
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
var start = moment().startOf('year');
var end = moment().endOf('year');

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
        table.ajax.reload();

      });


      $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
  table=$('#listado-table').DataTable({
        // "paging":   false,
        // "ordering": false,
        "info":     false,
        processing:true,
    serverSide:true,
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

    ajax:
    {
      url:"{{ url('datatableListadoIndex') }}",
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
    {data:'descripcion',name:'descripcion'},
    {data:'fecha', name:'fecha', class: "center"},
    {data:'user', name:'user', class: "center"},
    {data:'monto',name:'monto', class: "amount"},
    ],

    // "fnDrawCallback":function(){
    //     var rowIdx = table.cell(':eq(0)').index().row;
      
    //   table.row(rowIdx).select();

    //   table.cell( ':eq(0)' ).focus();
    // }   

});
$('div.dataTables_filter input', table.table().container()).focus();  


// var options = {
//      theme:"sk-cube-grid",
//      message:'Cargando.... ',
// };

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});

// window.onbeforeunload = function(e) {
//     HoldOn.open(options);
// };

$("#listado-table tbody").on('click','tr',function(){
 
 url=$(this).attr('action');

 $("#sd").attr('href',url);

 $("#urles").trigger("click");

 
});

$('#listado-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#listado-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#listado-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

                url=$(row_s).attr('action');

                $("#sd").attr('href',url);

                $("#urles").trigger("click");
            
        }
        
    });

    function saerch(){
  name=$("#btnsearch").val();

  table.search(name).draw();

}

    //   var rowIdx = table.cell(':eq(0)').index().row;
      
    //   table.row(rowIdx).select();

    //   table.cell( ':eq(0)' ).focus();



</script>
@endsection

