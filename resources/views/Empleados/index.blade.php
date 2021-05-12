@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/empleado.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">EMPLEADOS</h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('Empleados.create')}}" title="Crear Nuevo Empleado" class="btn btn-sm btn-info"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus"></i></a>
                    <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></button>
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button> --}}
                    <a href="{{url('listadopdf')}}" target="_blank" rel="noopener noreferrer"><button  type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></button></a>
                    <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            
            <div class="">
                <table class="table tablesorter " id="empleado-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th scope="col">NOMBRE</th>
                        <th scope="col">CÉDULA</th>
                        <th scope="col">CARGO</th>
                        <th scope="col">TÉLEFONO</th>
                        <th scope="col">DEPARTAMENTO</th>
                        <th scope="col">SALARIO</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($empleados as $empleado)
                        
                        @if ($empleado->estado==0) 
                        @if ($empleado->id_empresa==$user)
                        <tr action="{{Route('Empleados.show',$empleado->id_empleado)}}">
                            <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
                            <td>{{$empleado->cedula}}</td>
                            <td>{{$empleado->cargo}}</td>
                            <td>{{$empleado->telefono}}</td>
                            
                            <td>
                                @foreach ($empleado->puesto as $puesto)
                                    {{$puesto->name}}
                                @endforeach
                            </td>

                            <td>${{number_format($empleado->salario,2)}}</td>
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

<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
@endsection

@section('js')

@if (session('eliminiado')=='ya')
<script>
    Swal.fire(
      'Eliminado!',
      'El Empleado ha sido eliminado.',
      'success'
    )
  </script>    
@endif

@if (session('guardar')=='ya')
<script>
    Swal.fire(
      'Guardado!',
      'El Empleado ha sido guardado exitosamente.',
      'success'
    )
  </script>    
@endif
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>


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





  table=$('#empleado-table').DataTable({
    "info": false,
    dom: 'Bfrtip',

    select: {
            style: 'single',
        },

        keys: {
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },
        rowGroup: {
        dataSrc: 'group'
    },
    buttons: [
            {
                extend: 'excel',
                messageTop: 'Listado de Empleado.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: 'Listado de Empleado.',
            }
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

$('#empleado-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#empleado-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#empleado-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

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

//     document.addEventListener ("keydown", function (e) {
//     if (e.keyCode==16) {

//       var rowIdx = table.cell(':eq(0)').index().row;
      
//       table.row(rowIdx).select();

//       table.cell( ':eq(0)' ).focus();

//     document.addEventListener ("keydown", function (e) {
//     if (e.keyCode==16) {


      var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();


$("#empleado-table tbody").on('click','tr',function(){
 
   url=$(this).attr('action');

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

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
});

$("#btnexcel").on('click',function(){
$(".buttons-excel").click();
});

$("#btnprint").on('click',function(){
$(".buttons-print").click();
});

$("#btnpdf").on('click',function(){
$(".buttons-pdf").click();
});

</script>

@endsection