@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/empleado.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<style>
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


@media (max-width: 360px) {
  .o-page-loader--spinner {
    width: 50% !important;
    height: 20% !important;
    /* background-color: rgb(255,255,255); */
    /* background-image: url('..black/img/logotipo.png'); */
    margin: 20px auto !important;
    /* animation: rotate-plane 1.2s infinite ease-in-out;
    -webkit-animation: rotate-plane 1.2s infinite ease-in-out; */
  }
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
                <div class="col-md-2 float-left">
                    <label><b>{{ __('BUSCAR') }}</b></label>
                    <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"  placeholder="Buscar..." class="form-control">
                  </div> 
                <div class="col-md-2 float-left">
                    <label><b>{{ __('DEPARTAMENTOS') }}</b></label>
                    <select id="departament" class="form-control " name="categorias">
                      <option selected value="0" >NINGUNO</option>
                      @foreach ($puesto as $puestos)
                          
                      <option value="{{$puestos->id}}">{{$puestos->name}}</option>
                      
                      @endforeach
                  </select>
                  </div>
                <div class="col-md-2 float-left">
                    <label><b>{{ __('GENERO') }}</b></label>
                    <select id="genero" class="form-control " name="categorias">
                        <option selected value="0" >NINGUNO</option>
                        @foreach ($sexo as $sexos)
                          
                        <option value="{{$sexos->id}}">{{$sexos->name}}</option>
                        
                        @endforeach
                  </select>
                  </div>
                <div class="col-md-2 float-left">
                    <label><b>{{ __('PAGOS') }}</b></label>
                    <select id="pagos" class="form-control " name="categorias">
                        <option selected value="0" >NINGUNO</option>
                        @foreach ($pagos as $pago)
                          
                        <option value="{{$pago->id}}">{{$pago->pago}}</option>
                        
                        @endforeach
                  </select>
                  </div>
                  <div class="col-sm-2" id="fechaHora">
                    <label for=""><b>FECHA DE INGRESOS</b></label>
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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>EMPLEADOS</b></h4>
                </div>
                <div class="col-4 text-right col4">
                    <a href="{{route('Empleados.create')}}" title="Crear Nuevo Empleado" class="btn btn-sm btn-info redondo creaplus"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus"  style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm redondo"><i class="fas fa-file-excel"  style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button> --}}
                    <a href="{{url('listadopdf')}}" target="_blank" rel="noopener noreferrer"><button  type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm redondo"><i class="fas fa-print"  style="margin-left: -3px;  position: relative; font-size: 17px;"></i></button></a>
                    <a href="{{url('downloadpdf')}}" target="_blank" rel="noopener noreferrer"><button  type="button" title="Descargar Listado de Empleado" class="btn btn-danger btn-sm redondo"><i class="fas fa-file-pdf"  style="margin-left: -1px;  position: relative; font-size: 19px;"></i></button></a>
                    {{-- <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm redondo"><i class="fas fa-file-pdf"  style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            
            <div class="">
                <table class="table tablesorter azules" id="empleado-table">
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
                        
                        {{-- @foreach ($empleados as $empleado)
                        
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
                                @php
                                    $b=0;
                                    $sum=0;
                                @endphp
                            <td>
                                @foreach ($sueldo as $sueldos)
                                @if ($sueldos->id_empleado==$empleado->id_empleado)
                                  @php
                                      $b=1;
                                      $sum=$sum+$sueldos->sueldo_increment;
                                  @endphp                                  
                                @endif
                                @endforeach

                                @if ($b==1)
                                ${{number_format($empleado->salario+$sum,2)}} 
                                @endif

                                @if ($b==0)
                                ${{number_format($empleado->salario,2)}}  
                                @endif
                            </td>
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

<input type="text" name="" id="input" value="0" hidden>
<input type="text" name="" id="inputsub" value="0" hidden>
<input type="text" name="" id="inputpagos" value="0" hidden>

<input type="text" name="" value="" id="started" hidden>
<input type="text" name="" value="" id="ended" hidden>

<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
@endsection

@section('js')

@if (session('eliminiado')=='ya')
<script>
    Command: toastr["success"]("se ha eliminado el empleado", "")
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

@if (session('guardar')=='ya')
<script>
    Command: toastr["success"]("se ha guardado el empleado", "")
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
    Command: toastr["success"]("se ha actualizado el empleado", "")
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
{{--  --}}
<script>

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});

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

        $("#started").attr('value',start);
        $("#ended").attr('value',end);
        table.ajax.reload();

      });

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
  table=$('#empleado-table').DataTable({
        // "paging":   false,
        // "ordering": false,
        "info": false,
        processing:true,
        responsive: true,

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
      url:"{{ url('datatableEmpleado') }}",
      "data":function(d){
        if($("#input").val()!=''){
          if($("#inputsub").val()==0){
            // alert($("#inputsub").val());
          d.dato1=$("#input").val();
          }else{
            d.dato2=$("#inputsub").val();
          } 
          if($("#inputpagos").val()!=0){
            // alert($("#inputpagos").val());
            d.dato3=$("#inputpagos").val();
          }

        }
        startComes = new Date($("#started").attr('value'));
        endComes = new Date($("#ended").attr('value'));

        start = moment(startComes).format('YYYY-MM-DD');
        end = moment(endComes).format('YYYY-MM-DD');
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
    {data:'nombre',name:'nombre'},
    {data:'cedula', name:'cedula', class: "center"},
    {data:'cargo', name:'cargo', class: "center"},
    {data:'telefono',name:'telefono', class: "right"},
    {data:'puesto',name:'puesto', class: "right",searchable:false},
    {data:'salario',name:'salario', class: "right"},
    ],

    // "fnDrawCallback":function(){
    //     var rowIdx = table.cell(':eq(0)').index().row;
      
    //   table.row(rowIdx).select();

    //   table.cell( ':eq(0)' ).focus();
    // }   

});
$('div.dataTables_filter input', table.table().container()).focus(); 


    $('div.dataTables_filter input', table.table().container()).on('click',function(){
        var rowIdx = table.cell(':eq(0)').index().row;
        
        table.row(rowIdx).select();

        table.cell( ':eq(0)' ).focus();
    });  

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

    $("#empleado-table tbody").on('click','tr',function(){
 
 url=$(this).attr('action');

 $("#sd").attr('href',url);

 $("#urles").trigger("click");

});

// function myFunction(x) {
//   if (x.matches) { // If media query matches
//     alert("S");
//   } else {
//    alert("a");
//   }
// }

// var x = window.matchMedia("(max-width: 765px)")
// myFunction(x) // Call listener function at run time
// x.addListener(myFunction) // Attach listener function on state changes

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


$("#departament").on('change',function(){
var id=$(this).val();
$("#input").val(id);
$("#inputsub").val(0);
table.ajax.reload();
});

$("#genero").on('change',function(){
var id=$(this).val();
$("#inputsub").val(id);
table.ajax.reload();
});

$("#pagos").on('change',function(){
var id=$(this).val();
$("#inputpagos").val(id);
table.ajax.reload();
});

function saerch(){
  name=$("#btnsearch").val();

  table.search(name).draw();

}
</script>

@endsection