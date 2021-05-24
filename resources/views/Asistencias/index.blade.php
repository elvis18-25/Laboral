@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asistencia.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<style>
    #listado-table tbody {
        cursor: 'pointer';
    }  
  </style>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>LISTADO DE ASISTENCIAS</b></h4>
                </div>
                <div class="col-4 text-right">
                <a href="{{Route('Asistencia.create')}}" title="Crear Nuevo listado de Asistencia " class="btn btn-sm btn-info redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="top: 5px; position: relative;"></i></a>
                <a href="{{url('Equipos')}}" title="Crear Grupo de Empleado " class="btn btn-sm btn-warning redondo "><button  type="button" id="created" style="display: none;"></button><i class="fas fa-users-cog" style="top: 5px; margin-left: -25%; position: relative; font-size: 15px;"></i> </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            <div class="">
                <table class="table tablesorter " id="listado-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="titlelistado">DESCRIPCION</th>
                        <th style="font-size: 15px !important;">FECHA</th>
                        <th style="font-size: 15px !important;">USUARIO</th>
                        <th class="titlelistado">MONTO</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($asistencia as $asistencias)
                        @if ($asistencias->estado!=1)
                        @if ($asistencias->id_empresa==$user)
                        <tr action="{{Route('Asistencia.show',$asistencias->id)}}">
                            <td>{{$asistencias->descripcion}}</td>
                            <td>{{date("d/m/Y", strtotime($asistencias->fecha))}}</td>
                            <td>{{$asistencias->user}}</td>
                            <td class="amount">${{number_format($asistencias->monto,2)}}</td>
                        </tr>
                        @endif
                        @endif
                        @endforeach
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

   table=$('#listado-table').DataTable({
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
        $("#created").trigger("click");
         
    } 
});



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



      var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();



</script>
@endsection
