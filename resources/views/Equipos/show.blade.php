@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/equipos.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link rel="stylesheet" href="{{asset('css/timepicker.min.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<form action="{{Route('Equipos.update',$equipo->id)}}" method="POST" id="formularios" >
@csrf
{{ method_field('PUT') }}
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
            <input type="text" name="name" autofocus id="descr" value="{{$equipo->descripcion}}" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
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
        <input type="text" class="form-control" id="entrada" value="{{$equipo->entrada}}" name="entrada" readonly style="cursor: pointer !important; " >
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
      <input type="text" class="form-control" id="salida" value="{{$equipo->salida}}" name="salida" readonly style="cursor: pointer !important; " >
    </div>
    </div>
    </div>

    <div class="form-group col-md-2" id="type">
      <label for="inputState"><b>TIPO DE GRUPO</b></label>
      <select id="inputState" class="form-control" name="type">
        @if ($equipo->type=="ASISTENCIA")
        <option selected value="0">ASISTENCIA</option>
        @else
        <option  value="0">ASISTENCIA</option>
        @endif

        @if ($equipo->type=="EXTRAS")
        <option selected value="1">HORA EXTRA</option>
        
        @else
        
        <option  value="1">HORA EXTRA</option>
        @endif
      </select>
    </div> 

        </div>

        </div>
        <input type="text" name="" id="input" value="{{$equipo->id}}" hidden>
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
                <div class="col-4 text-right">
                    <button type="button" id="createdgruop" title="Agregar Empleados al Grupo"  data-toggle="modal" data-target="#EmpleadoEDIT" class="btn btn-info btn-sm redondo"><i class="fas fa-user"  style="top: 5px; margin-left: -14%;"></i></button>
                    <button type="button" id="btnall" onclick="AllGroup();" title="Agregar Todos los Empleado al Grupo"  class="btn btn-warning btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Equipos.modalEdit')
                </div>
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
        </div>
        <br>
        @php
        $empresa=Auth::user()->id_empresa;
    @endphp
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
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleado as $empleados)
                        @foreach ($perf as $perfe)
                        @if ($perfe->id_empleado==$empleados->id_empleado)
                        @if ($perfe->id_empresa=$empresa)
                        <tr value="{{$empleados->id_empleado}}">
                            <td >{{$empleados->nombre." ".$empleados->apellido}}</td>
                            <td style="text-align: center;">{{$empleados->cedula}}</td>
                            <td style="text-align: center;">{{$empleados->cargo}}</td>
                            <td style="text-align: center;">
                            @foreach ($empleados->puesto as $puesto)
                                {{$puesto->name}}
                            @endforeach
                            </td>
                            <td style="text-align: right;">${{number_format($empleados->salario,2)}}</td>
                            <td style="text-align: right;">
                                <button class="btn btn-danger btn-sm remfe" type="button" value="{{$empleados->id_empleado}}"><i class="fas fa-minus"></i></button>
                            </td>
                        </tr>
                        @endif
                        @endif
                        @endforeach
                        @endforeach
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
<input type="text" name="arregloremo" value="" id="arregloremo" hidden>

<button type="submit" id="subir" title="Guardar Grupos" class="btn btn-fill btn-info float-right"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
</form>

<form action="{{route('Equipos.destroy',$equipo->id)}}" id="deleeperfil" method="POST">
    @csrf
    @method('DELETE');
<button type="submit" title="Eliminar Grupos"  class="btn btn-fill btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
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
<script>
     $('.bs-timepicker').timepicker();

     $("#Empleadotableedit tbody").on('click','tr',function(){
    $('td', this).css('backgroundColor', '#958fcd ');
    $('td', this).css('color', 'white');
});



$("#deleeperfil").submit(function(e){
    e.preventDefault();
Swal.fire({
  title: 'Estas seguro?',
  text: "Ya no se podra revertir los cambios!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    this.submit();
  }
})
})
tebl=$('#Empleadotableedit').DataTable({
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
  $('#Empleadotableedit').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tebl.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#Empleadotableedit').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tebl.cell(this).index().row;

        
        // Select row
        tebl.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Empleadotableedit').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

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


arreRemov=[];
j=0;

$(document).on('click', '.remfe', function (event) {
    Swal.fire({
  title: 'Enserio Quieres Eliminarlo?',
  text: "Ya no podras revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    event.preventDefault();
    $(this).closest('tr').remove();
   var id=$(this).val();
     arreRemov[j]=id;
     $("#arregloremo").attr('value',arreRemov);
      j++;
    Swal.fire(
      'Eliminado!',
      'Este empleado ha sido eliminado.',
      'success'
    )
  }
})


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
       var equipos=$("#input").val();
    var url = e
     var data = {equipos:equipos};
        $.ajax({
         method: "PUT",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
         
                if(result!=0){
                $('#grupo-table tbody').append(result);
                arreglo[i]=m
                $("#arreglo").attr('value',arreglo);
                exito();
                i++;
                }else{
                    Errore();
                }

          
           
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
    $("#grupo-table tbody tr").each(function(){
        arreglo[i]=$(this).attr('value');
        i++;
        $("#arreglo").attr('value',arreglo);
    });

    var url="{{url('AllGroupEDIT')}}"; 
  var data={arreglo:arreglo};
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                if(result!=0){
                $('#grupo-table tbody').empty();
                $('#grupo-table tbody').append(result);
                exitoall();
                AgregarGru();
                }else{
                    ErroreAll();
                }

              

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
function ErroreAll(){
    Command: toastr["error"]("Ya esta selecionado todos los empleados", "Error")
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
function exito(){
    Command: toastr["success"]("Este Empleado ha Añadido Correctamente", "Correto")
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
function exitoall(){
    Command: toastr["success"]("Los Empleado se han Añadidos Correctamente", "Correto")
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