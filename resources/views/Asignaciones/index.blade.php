@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/asignaciones.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
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
                  <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"  placeholder="Buscar..." class="form-control">
                </div> 
              <div class="col-md-3 float-left">
                  <label><b>{{ __('TIPOS') }}</b></label>
                  <select id="tipy" class="form-control " name="categorias">
                    <option selected value=" ">NINGUNO...</option>
                    <option value="DEDUCCIÓN">DEDUCCIÓN</option>
                    <option value="INCREMENTO">INCREMENTO</option>
                </select>
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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>ASIGNACIONES</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="#" title="Crear Nueva Asignacion" data-toggle="modal" data-target="#asignacionesmodal" class="btn btn-sm btn-info redondo"><button   type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    {{-- <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></button> --}}
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></button> --}}
                    {{-- <a href="{{url('listadopdf')}}" target="_blank" rel="noopener noreferrer"><button  type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button></a> --}}
                    {{-- <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i></button> --}}
                </div>
                @include('Asignaciones.modal')
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter" id="asigna-table">
                    
                    <thead class=" text-primary">
                        <tr> 
                        <th style="font-size: 14px; text-align: center">NOMBRE</th>
                        <th style="font-size: 14px; text-align: center">TIPO</th>
                        <th style="font-size: 14px; text-align: center">EMPLEADOS</th>
                        <th style="font-size: 14px; text-align: center">USUARIO</th>
                        <th style="font-size: 14px; text-align: center">MONTO</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </div>
                </table>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>

<input type="text" name="" id="input" value="" hidden>
<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
    {{-- <div class=""></div> --}}
    <div class="o-page-loader--message">
      <span>Cargando...</span>
    </div>
  </div>
</div>
{{-- <a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a> --}}
<div class="modal fade" id="showmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@include('Asignaciones.modalemple')
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

<input type="text" name="" id="input" value="" hidden>
@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
$('.money').mask("#,##0.00", {reverse: true});


function calcular(){
   var salario=$("#monto").val();
   
  //  var sum=0;

   var montoFormat = toInt(salario);
 


  //  sum=montoFormat/23.83/8;

   $("#montoOP").attr('value',montoFormat);
  //  $("#salDias").attr('value',financial(sum));

 }
 
 function financial(x) {
   var sala=Number.parseFloat(x).toFixed(2);
  return sala;
}


String.prototype.toInt = function (){    
    return parseInt(this.split(' ').join('').split(',').join('') || 0);
}



toInt = function(val){
  var result;
  if (typeof val === "string")
    result = parseInt(val.split(' ').join('').split(',').join('') || 0);
  else if (typeof val === "number")
    result = parseInt(val);
  else if (typeof val === "object")
    result = 0;
  return result;
}



    
document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
    } 
});

$('#asignacionesmodal').keyup(function(e){
    var name= $("#name").val();
    if(e.keyCode!=13)
    {
        if(name==''){
      $("#name").focus();

        }
    }
    if (e.keyCode==13) {
       $("#saver").trigger("click"); 
    }

});
$('#showmodal').keyup(function(e){
    var name= $("#nameedit").val();
    if(e.keyCode!=13)
    {
        if(name==''){
      $("#nameedit").focus();

        }
    }
    if (e.keyCode==13) {
       $("#saveredit").trigger("click"); 
    }

});


 $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  table=$('#asigna-table').DataTable({
    "info": false,
    processing:true,

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
                messageTop: 'Listado de Asignaciones.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: 'Listado de Asignaciones.',
            }
        ],
    
    ajax:
    {
      url:"{{ url('datatablesasigna') }}",
            "data":function(d){
        if($("#input").val()!=''){
          
            // alert($("#input").val());
          d.dato1=$("#input").val();

        }

      }
    },


    columns:[
    {data:'Nombre',name:'Nombre'},
    {data:'tipo_asigna',name:'tipo_asigna',class: "center"},
    {data:'emple',name:'emple',class: "center",searchable:false},
    {data:'user',name:'user',class: "center"},
    {data:'Monto',name:'Monto',class: "right"},
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

$('#asigna-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#asigna-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#asigna-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 
            url=$(row_s).attr('data-href');

            edit(url);
            
        }
        
    });

// $('#asigna-table').DataTable().on("draw", function(){
//     var rowIdx = table.cell(':eq(0)').index().row;
      
//       table.row(rowIdx).select();

//       table.cell( ':eq(0)' ).focus();
// });





$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});


$("#figura").append("$");
$(".monto").mask('0.#');

$("#btnexcel").on('click',function(){
$(".buttons-excel").click();
});

$("#btnprint").on('click',function(){
$(".buttons-print").click();
});

$("#btnpdf").on('click',function(){
$(".buttons-pdf").click();
});


$("#forma").on('change',function(){
 if($(this).val()==3){
     $("#figura").empty();
     $("#figura").append("$");
     $("#monto").removeClass("monto");
    $("#monto").addClass("money");
    $('.money').mask("#,##0.00", {reverse: true});
     
 }else{
    $("#figura").empty();
    $("#figura").append("%");
    $("#monto").removeClass("money");
    $("#monto").addClass("monto");
    $(".monto").mask('0#');
    

 }   

});

i=0;
function saveasignaciones(){
   var name=$("#name").val();
   var tipo=$("#inputState").val();
   var forma=$("#forma").val();
   var monto=$("#monto").val();
   var grupo=$("#inputStateGrupo").val();
   var arreglo=[];
   i=0;

   $("#listado-table tbody tr").each(function(){
    arreglo[i]=$(this).attr('data-href');
      i++;
    });

    console.log(arreglo);

   if(name==""|| tipo==""||forma==""||monto==""){
    Errores();
   }else{
    var url = "{{route('Asignaciones.store')}}"; 
     var data ={name:name,tipo:tipo,forma:forma,monto:monto,arreglo:arreglo,grupo:grupo};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            table.ajax.reload();
            $("#asignacionesmodal").modal("toggle");
            
            $("#name").val("");
            $("#monto").val("");
            SuccesGen();

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGenerales();
    }
             }); 
   } 
}

function Errore(){
    Command: toastr["error"]("Este empleado ya esta selecionado", "Error")
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

function Errores(){
    Command: toastr["error"]("Debes llenar los campos", "Error")
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
function ErroresGenerales(){
    Command: toastr["error"]("", "Error!")
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
function SuccesGen(){
    Command: toastr["success"]("se ha guardo la asignacion", "")
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
function SuccesGenDele(){
    Command: toastr["success"]("se ha eliminado la asignacion", "")
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
function SuccesGenUpdate(){
    Command: toastr["success"]("se ha guardado los de la asignacion", "")
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

$("#asigna-table tbody").on('click','tr',function(){
 
 url=$(this).attr('data-href');

edit(url);

 
});

function edit(e){
    var url = "{{url('viewasigna')}}/"+e; ; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#showmodal").html(result).modal("show");
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGenerales();
    }
             }); 
   } 

   $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#listado-table').DataTable({
      "info":    false,
      "paging":  false,
      "ordering":  false,
    responsive: true,
    // "order": [[ 1, 'desc' ]],
    scrollY: 400,
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
    {data:'nombre',name:'nombre',},
    {data:'cargo', name:'cargo', class: "boldend"},
    {data:'puesto', name:'puesto', class: "boldend",searchable:false},
    ],

});

$("#inputStateGrupo").on('change',function(){
        var id=$(this).val();
        if(id!=-1){
          $("#input").val(id);
          tabla.ajax.reload();
        }else{
          checkendesd();
        }

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

function checkendesd(){
      $('#listado-table tbody input[type="checkbox"]').prop('checked',false);
}


tebl=$('#Empleadotable').DataTable({
      "info":    false,
      "paging":  false,
      // "ordering":  false,
    // responsive: true,
    // "order": [[ 1, 'desc' ]],
    scrollY: 400,
        processing:true,

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

    $("#Empleadotable tbody").on('click','tr',function(){
    $('td', this).css('backgroundColor', '#958fcd ');
            $('td', this).css('color', 'white');
});

    function AddGroup(e,m){
    var arreglo=[];
    var p=0;
    i=0;
    $("#listadoEdit-table tbody tr").each(function(){
    arreglo[i]=$(this).attr('value');
      i++;
    });
    console.log(arreglo);
    for (let index = 0; index < arreglo.length; index++) {
            if(arreglo[index]==m){
                p=1;
            }
     }
     if(p!=1){
    var url = e
    var id=$("#inputEdit").val();
     var data = {id:id,arreglo:arreglo};
        $.ajax({
         method: "PUT",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $('#listadoEdit-table tbody').append(result);
            SuccesAdd();
            // $("#arreglo").attr('value',arreglo);
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
     }else{
        Errore();
     }
}

function SuccesAdd(){
    Command: toastr["success"]("Exito!", "")
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

  $("#tipy").on('change',function(){
var id=$(this).val();
$("#input").val(id);
table.ajax.reload();
});

    
function saerch(){
  name=$("#btnsearch").val();

  table.search(name).draw();

}
</script>


@endsection