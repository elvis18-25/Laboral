@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

<style>
    .TitleP{
        text-align: center;
    }
    .table>tbody>tr>td{
            padding: 5px 7px !important;
        }  
    </style>
    <link rel="stylesheet" href="{{asset('css/roles.css')}}">
    <link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
@section('content')
<form action="{{Route('Roles.store')}}" method="POST">
    @csrf
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVO ROL</b></h4>
                    </div>
                    <div class="col-4 text-right">
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-row">
                    <div class="col-sm-4">
                        <input type="text" name="descripcion" id="descr" class="form-control" required  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Nombre">
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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>MODULOS</b></h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        @csrf
        <div class="card-body">
            <div class="form-row">


                <div class="col-sm-4">

                </div>
            </div>
            {{-- <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; "> --}}
    <table class="table table-striped" id="roles">
        <thead>
          <tr>
            <th class="TitleP" style="font-size: 14px;"><b>ACCESO</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>
                <div class="form-check" style="margin-left: 52px;">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggle(this)' >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        {{-- <h5><b>TODOS</b></h5> --}}
                    </label>
                </div>    
            </b></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($modulos as $modulo)
            <tr>
                <td >{{$modulo->nombre}}</td>
                <td style="text-align: left;">{{$modulo->descripcion}}</td>
                <td class="TitleP" value={{$modulo->id}}>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input cheinput" id="modulo{{$modulo->id}}" type="checkbox" name="dinamico[]" value="{{$modulo->id}}" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- </div> --}}

</div>
        </div>
    </div>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>DASHBOARD</b></h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>

        @csrf
        <div class="card-body">
            <div class="form-row">


                <div class="col-sm-4">

                </div>
            </div>
            {{-- <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; "> --}}
    <table class="table table-striped" id="Widget">
        <thead>
          <tr>
            <th class="TitleP" style="font-size: 14px;"><b>ACCESO</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>
                <div class="form-check" style="margin-left: 20px;">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="todos" id="todoWidget" onclick='toggleWidg(this)' >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        {{-- <h5><b>TODOS</b></h5> --}}
                    </label>
                </div>    
            </b></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($widget as $widgets)
            <tr>
                <td >{{$widgets->nombre}}</td>
                <td style="text-align: left;">{{$widgets->descripcion}}</td>
                <td class="TitleP" value={{$widgets->id}}>
                    <div class="form-check" >
                        <label class="form-check-label">
                            <input class="form-check-input cheinput" type="checkbox" id="widgdt{{$widgets->id}}" name="wingdt[]" value="{{$widgets->id}}" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- </div> --}}

</div>
        </div>

    </div>
</div>
<button type="submit"  id="subir" class="btn btn-fill btn-info float-right" style="top: 47px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
</form>

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
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

function toggle(source) {
  checkboxes = document.getElementsByName('dinamico[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}
function toggleWidg(source) {
  checkboxes = document.getElementsByName('wingdt[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

$(document).ready(function(){

table=$('#roles').DataTable({
    "info": false,
    "paging":   false,
    scrollY: 500,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group',
    },

    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
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

var rowIdx = table.cell(':eq(0)').index().row;
      
table.row(rowIdx).select();

table.cell( ':eq(0)' ).focus();


document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16){
       
        var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();   
        
        
    } 
});

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 84) {
        $('#todos').trigger("click");
        $('#todoWidget').trigger("click");
    }
});

$('#roles').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#roles').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#roles').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 
            var colum=$('td', row_s).eq(2);

            var siz=$(colum).attr('value');
            $("#modulo"+siz).trigger("click");

            console.log(siz);

        }
        
    });


   $('div.dataTables_filter input', table.table().container()).on('click',function(){
    var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();
      
      table.cell( ':eq(0)' ).focus();

   });
});

tab=$('#Widget').DataTable({
    "info": false,
    "paging":   false,
    scrollY: 300,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group',
    },

    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
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


$('#Widget').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tab.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#Widget').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tab.cell(this).index().row;

        
        // Select row
        tab.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Widget').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = tab.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 
            var colum=$('td', row_s).eq(2);

            var siz=$(colum).attr('value');
            $("#widgdt"+siz).trigger("click");

            console.log(siz);

        }
        
    });



$('div.dataTables_filter input', tab.table().container()).on('click',function(){
    var rowIdx = tab.cell(':eq(0)').index().row;
      
      tab.row(rowIdx).select();
      
      tab.cell( ':eq(0)' ).focus();

   });

</script>




@endsection