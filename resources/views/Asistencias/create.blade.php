@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asistencia.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<style>
    #listado-table tbody {
        cursor: 'pointer';
    }  
  </style>
<form action="{{route('Asistencia.store')}}" method="POST" id="formulario">
    @csrf
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>REGISTRO DE ASISTENCIAS</b></h4>
                </div>
                <div class="col-4 text-right">
               
                </div>
            </div>
        </div>
        <div class="card-body">
        <div class="col-sm-4">
            <div class="form-inline ">
                <label for="inputState"><b> SELECCIONAR POR GRUPO:</b> &nbsp;</label>
                    <select id="inputState" class="form-control form-control-sm" name="dinamico">
                      <option  value="-1">NINGUNO...</option>
                      <option selected value="0">TODOS</option>
                      @foreach ($equipo as $equipos)
                      @if ($equipos->id_empresa==Auth::user()->id_empresa && $equipos->estados==0)
                      <option value="{{$equipos->id}}">{{$equipos->descripcion}}</option>
                      @endif
                      @endforeach
                    </select>
                </div>
            </div>
            <br>
            <br>
            <input type="text" id="input" value="0" hidden>
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            <div class="">
                <table class="table tablesorter " id="listado-table" style="width: 100% !important;">
                    <thead class=" text-primary">
                    <tr> 
                        <th style="font-size: 15px !important; width: 61px !important;">ACCIÓN</th>
                        <th style="font-size: 15px !important; text-align: center !important;"><b>EMPLEADO</b></th>
                        <th style="font-size: 15px !important;"><b>CARGO</b></th>
                        <th style="font-size: 15px !important;"><b>DEPARTAMENTO</b></th>
                        <th style="font-size: 15px !important;"><b>CEDULA</b></th>
                        <th class="titlelistado"><b>GRUPO</b></th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 13px !important;">
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
<input type="text" name="arreglo" value="" id="arreglo" hidden>
@include('Asistencias.modalFecha')
<button type="button" id="subir" class="btn btn-fill btn-info float-right"><i class="fas fa-save"></i>&nbsp;{{ __('REGISTRAR') }}</button>
</form>
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
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#listado-table').DataTable({
        // dom: 'Bfrtip',
        // "searching": false,
        "paging":   false,
        // "ordering": false,
        "info":     false,
        processing:true,
      
        // select: {
        //     style: 'single',
        // },

    //     keys: {
    //       keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
    //     },
    //     rowGroup: {
    //     dataSrc: 'group'
    // },

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


    columns:[
    {data:'btn',name:'btn', },
    {data:'nombre',name:'nombre',class: "boldend" },
    {data:'cargo', name:'cargo', class: "boldend"},
    {data:'puesto', name:'puesto', class: "boldend",searchable:false},
    {data:'cedula',name:'cedula', class: "boldend"},
    {data:'equipos',name:'equipos', class: "boldend",searchable:false},
    ],

});


$("#inputState").on('change',function(){
    var id=$(this).val();
    alert(id);
        $("#input").val(id);
        tabla.ajax.reload();

});


function AllEmplen(){
    var url="{{url('AllGroupAsistencia')}}"; 
  var data='';
  $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
            $('#listado-table tbody').empty();
            $('#listado-table tbody').append(result);


           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

$("#subir").on('click',function(){
    $('#horas').modal('toggle');
});



$("#formulario").submit(function(e){
  e.preventDefault();
  var valor=$("#inputState").val();

  if(valor!=-1){
    $("#horas").trigger("click");
    this.submit();
  }else{
    errorEmptys();
  }
  });


function errorEmptys() {
  Command: toastr["error"]("Debes de elegir un Grupo", "Error")
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
    "hideMethod": "fadeOut"
  }
}
$(function() {
  $('input[name="birthday"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoclose: true,
    todayHighlight: true,
    minYear: 1901,
    timePicker: true,
    locale: {
        format: 'YYYY-MM-DD hh:mm '
    },
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {

  });
});
$(function() {
  $('input[name="birthday2s"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    autoclose: true,
    todayHighlight: true,
    timePicker: true,
    locale: {
      format: 'YYYY-MM-DD hh:mm '
    },
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {

  });
});
</script>

<style>
.boldend{
    text-align: center !important;
}
.right{
  text-align: left !important;
}

.listado-table{
    width: 100% !important;
}
.dataTables_filter{
  top: -37px !important;
}
</style>
@endsection

