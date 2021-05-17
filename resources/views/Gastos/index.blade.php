@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title"  style="font-size: 16px !important; font-weight: bold !important;" ><b>GASTOS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('Gasto.create')}}" title="Agregar Gastos" class="btn btn-sm btn-info float-right redondo"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="top: 5px; position: relative;"></i></a>
                    <a href="{{url('GastosFijo')}}" title="Agregar Nuevo Gastos Fijo" class="btn btn-sm btn-warning float-right redondo"><button type="button" id="created" style="display: none;"></button><i class="fas fa-coins"style="top: 5px; position: relative;" ></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            <div class="">
                <table class="table tablesorter " id="gastos-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitleP">DESCRIPCION</th>
                        <th class="TitleP">FECHA</th>
                        <th class="TitleP">USUARIO</th>
                        <th class="TitleP">MONTO</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($gasto as $gastos)
                        @if ($gastos->estado!=1)
                        @if ($gastos->id_empresa==$user)
                        <tr action="{{Route('Gasto.show',$gastos->id)}}">
                            <td>{{$gastos->descripcion}}</td>
                            <td style="text-align: center;" >{{date("d/m/Y", strtotime($gastos->fecha))}}</td>
                            <td style="text-align: center;" >{{$gastos->user}}</td>
                            <td style="text-align: right;" >${{number_format($gastos->monto,2)}}</td>
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
   table=$('#gastos-table').DataTable({
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

        // "fnDrawCallback":function(){
    //     started();
    //   }, 

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


var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

$("#gastos-table tbody").on('click','tr',function(){
 
 url=$(this).attr('action');

 $("#sd").attr('href',url);

 $("#urles").trigger("click");

 
});

$('#gastos-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#gastos-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#gastos-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

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

    document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {

      var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();

    }
});


    var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();


$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

$("#gastos-table tbody").on('click','tr',function(){
    url=$(this).attr('action');

$("#sd").attr('href',url);

$("#urles").trigger("click");

});
</script>
@endsection