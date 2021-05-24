@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asistencia.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<form action="{{Route('Cooperativas.store')}}" method="POST" id="formularios" >
@csrf
{{ method_field('POST') }}
<div class="col-md-12">
    
    <div class="card " sty>
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>GESTION DE ASISTENCIAS</b></h4>
                </div>
                {{-- <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado a la cooperativa"  data-toggle="modal" data-target="#Empleados" class="btn btn-info btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Cooperativa.modalemple')
                </div> --}}
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
        <div class="col-sm-6">
            <label style="color: black"><b>{{ __('DESCRIPCION ') }}</b></label>
            <input type="text" name="name" autofocus id="descr" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
        </div>

        <div class="col-sm-2">
            <label style="color: black"><b>{{ __('FECHA ') }}</b></label>
            <input type="date" name="Fecha" id="fech" class="form-control{{ $errors->has('Fecha_Entrada') ? ' is-invalid' : '' }}" >

        </div>

        {{-- <div class="col-sm-2">
            <label style="color: black"><b>EMPLEADOS</b></label>
            <div class="input-group">
            <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                <div class="input-group-text" style="color: black"><span id="figura"></span></div>
              </div>
            <input type="text" name="monto" autofocus id="monto" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
        </div>
    </div> --}}

        </div>

        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>EMPLEADOS</b></h4>
                </div>
                {{-- <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado a la cooperativa"  data-toggle="modal" data-target="#Empleados" class="btn btn-info btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Cooperativa.modalemple')
                </div> --}}
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
            {{-- <div class="col-sm-4">
                <input type="text" name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
            </div> --}}
            {{-- <div class="col-sm-5">
                <input type="date" id="fech" name="fecha" class="form-control"  >
            </div> --}}
        </div>
        <br>
            <div class="">
                <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; ">
                <table class="table tablesorter table-hover" id="Asist-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer">NOMBRE</th>
                        <th class="TitlePer">CEDULA</th>
                        <th class="TitlePer">CARGO</th>
                        <th class="TitlePer">HORAS</th>
                        <th class="TitlePer">HORAS EXTRAS</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>
<input type="text" name="arreglo" value="" id="arreglo" hidden>

<button type="submit" id="subir" title="Guardar Perfil" class="btn btn-fill btn-info float-right">{{ __('Guardar') }}</button>
</form>

<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
</div>
@include('Asistencias.modalgruop')
@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
      var hoy = new Date();
  var fecha = moment(hoy);
  document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");

  var modal=$('#Mnomina').hasClass('show');
      if(modal==false){
        $('#Mnomina').modal('toggle');
       
   }


   table=$('#equipo-table').DataTable({
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
      url:"{{ url('datatablEquipos') }}",
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

    $('#equipo-table').DataTable().on("draw", function(){
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

tabla=$('#Asist-table').DataTable({
        dom: 'Bfrtip',
        "searching": false,
        "paging":   false,
        "ordering": false,
        "info":     false,
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
      url:"{{ url('datatableAsistencia') }}",
      "data":function(d){
        if($("#input").val()!=''){
          d.dato1=$("#input").val();

        }
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

      columnDefs: [{
targets: [0,1,2,3,4,5],
className: 'bolded'
}
],
      buttons: [
            {
                extend: 'excel',
                messageTop: 'Listado de Empleado.'
            },
            {
                extend: 'pdf',
                messageBottom: null,
            },
            {
                extend: 'print',
                messageTop: 'Listado de Empleado.',
                exportOptions: {
                    columns: ':visible'
                }
            },
            // 'colvis'
        ],

        // columnDefs: [ {
        //     targets: -1,
        //     visible: false
        // } ],


    columns:[
    {data:'nombre',name:'nombre', },
    {data:'cargo', name:'cargo', class: "boldend", searchable:false},
    {data:'salario',name:'salario', class: "right",},
    {data:'Asigna',name:'Asigna', class: "right"},
    {data:'amount',name:'amount', class: "right"},
    {data:'horas',name:'horas', class: "right"},
    {data:'total',name:'total', class: "right"},
    ],


   
});
</script>


@endsection