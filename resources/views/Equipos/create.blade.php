@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/equipos.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link rel="stylesheet" href="{{asset('css/timepicker.min.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<form action="{{Route('Equipos.store')}}" method="POST" id="formularios" >
@csrf
{{ method_field('POST') }}
<div class="col-md-12">
    
    <div class="card " sty>
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVO GRUPO</b></h4>
                </div>
                {{-- <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado a la cooperativa"  data-toggle="modal" data-target="#Empleado" class="btn btn-info btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Equipos.modalempleado')
                </div> --}}
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
        <div class="col-sm-5">
            <label style="color: black"><b>{{ __('DESCRIPCION ') }}</b></label>
            <input type="text" name="name" autofocus id="descr" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
        </div>


      
            <div class="col-sm-2">
                <label style="color: black"><b>{{ __('HORA DE ENTRADA') }}</b></label>
              <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i style="color: black !important;" class="fas fa-clock"></i>
                 </div>      
               </div>
              <input type="text" class="form-control" id="entrada"  name="entrada" readonly style="cursor: pointer !important; " >
            </div>
            </div>
            </div>
      
            <div class="col-sm-2">
                <label style="color: black"><b>{{ __('HORA DE SALIDA') }}</b></label>
              <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i style="color: black !important;" class="fas fa-clock"></i>
                 </div>      
               </div>
              <input type="text" class="form-control" id="salida"  name="salida" readonly style="cursor: pointer !important; " >
            </div>
            </div>
            </div>

            <div class="form-group col-md-2" id="type">
                <label for="inputState"><b>TIPO DE GRUPO</b></label>
                <select id="inputState" class="form-control" name="type">
                  <option selected value="0">ASISTENCIA</option>
                  <option value="1">HORA EXTRA</option>
                </select>
              </div>

        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>EMPLEADOS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleados al Grupo"  data-toggle="modal" data-target="#Empleado" class="btn btn-info btn-sm redondo"><i class="fas fa-user"  style="top: 6px; margin-left: -25%; font-size: 17px;"></i></button>
                    <button type="button" id="btnall" onclick="AllGroup();" title="Agregar Todos los Empleado al Grupo"  class="btn btn-warning btn-sm redondo"><i class="fas fa-users"  style="top: 6px; margin-left: -53%; font-size: 18px;"></i></button>
               @include('Equipos.modalempleado')
                </div>
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
                <table class="table tablesorter table-hover" id="grupo-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer">NOMBRE</th>
                        <th class="TitlePer">CEDULA</th>
                        <th class="TitlePer">CARGO</th>
                        <th class="TitlePer">DEPARTAMENTO</th>
                        <th class="TitlePer">SALARIO</th>
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

<button type="submit" id="subir" title="Guardar grupo" class="btn btn-fill btn-info float-right">{{ __('Guardar') }}</button>
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
@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="{{asset('js/timepicker.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clockpicker.min.css')}}">
<script type="text/javascript" src="{{asset('js/bootstrap-clockpicker.min.js')}}"></script>
<script>
    $('.clockpicker').clockpicker();
    //  $('.bs-timepicker').timepicker();


     $("#Empleadotable tbody").on('click','tr',function(){
    $('td', this).css('backgroundColor', '#958fcd ');
            $('td', this).css('color', 'white');
});




t=0;
img="{{asset('black') }}/img/logotipo.png";
$("#subir").on('click',function(){
t=1;
});

// alert(img);
window.onbeforeunload = function() {
  // 
  if(t==0){
      $('.o-page-loader').remove();
      return "¿Estás seguro que deseas salir de la actual página?"
    }
    
  }  
tebl=$('#Empleadotable').DataTable({
        scrollY: 300,
        "paging":   false,
        // "ordering": false,
        "info":     false,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group'
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


  });

  document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {

      var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();

    }
});


  $('#Empleadotable').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tebl.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#Empleadotable').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tebl.cell(this).index().row;

        
        // Select row
        tebl.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Empleadotable').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = tebl.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            $('td', row_s).css('backgroundColor', '#958fcd ');
            $('td', row_s).css('color', 'white');

           button=$(row_s).attr('action');
           id=$(row_s).attr('value');
           AddGroup(button,id);
            
        }
        
    });

    function started(){
    var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();
}


document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#createdperfiles").trigger("click");
        started();
    } 
});

p=0;
document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 40){
        if(p==0){
        var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();   
        p=1; 
        }
    } 
});

$("#createdperfiles").on('click',function(){
    var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();
      p=0; 
});

arreglo=[];
 i=0;
function AddGroup(e,m){
    var p=0;
    for (let index = 0; index < arreglo.length; index++) {
            if(arreglo[index]==m){
                p=1;
            }
     }
     if(p!=1){
    var url = e
     var data = '';
        $.ajax({
         method: "PUT",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $('#grupo-table tbody').append(result);
            arreglo[i]=m
            $("#arreglo").attr('value',arreglo);
            i++;
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
     }else{
        Errore();
     }
}



function AllGroup(){
    var url="{{url('AllGroup')}}"; 
  var data='';
  $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
            $('#grupo-table tbody').empty();
            $('#grupo-table tbody').append(result);
            AgregarGru();

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}


function AgregarGru(){
    $("#grupo-table tbody tr").each(function(){
        arreglo[i]=$(this).attr('value');
        i++;
        $("#arreglo").attr('value',arreglo);
    });
}

function saerches(){
  name=$("#btnsearch").val();
  tebl.search(name).draw();

}
function Errore(){
    Command: toastr["error"]("Este Empleado ha sido Selecionado", "Error")
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
</script>

<style>
    table tbody tr td{
        padding:  6px 7px !important;
    }
    .form-control[readonly]{
        background-color: rgb(255 255 255 / 50%);
      }
</style>
@endsection