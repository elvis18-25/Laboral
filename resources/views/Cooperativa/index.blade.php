@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/coop.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>COOPERATIVAS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('Cooperativas.create')}}" class="btn btn-sm btn-info redondo"><button type="button" id="createdcoop" style="display: none;"></button><i class="fas fa-plus" style="top: 6px; position: relative;"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter" id="coop-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer"><b>DESCRIPCION</b></th>
                        <th class="TitlePer"><b>FECHA CREADA</b></th>
                        <th class="TitlePer"><b>EMPLEADOS</b></th>
                        <th class="TitlePer"><b>USUARIO</b></th>
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

<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
</div>
<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>

@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

    $("#monto").mask('0#');
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
  table=$('#coop-table').DataTable({
    "info": false,
    // dom: 'Bfrtip',
    select: {
            style: 'single',
        },
        keys: {
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },
        rowGroup: {
        dataSrc: 'group'
    },
    // buttons: [
    //         {
    //             extend: 'excel',
    //             messageTop: 'Listado de Asignaciones.'
    //         },
    //         {
    //             extend: 'pdf',
    //             messageBottom: null
    //         },
    //         {
    //             extend: 'print',
    //             messageTop: 'Listado de Asignaciones.',
    //         }
    //     ],
    
    ajax:
    {
      url:"{{ url('datatableCoop') }}",
    },

    // "fnDrawCallback":function(){
    //     started();
    //   }, 

    columns:[
    {data:'descripcion',name:'descripcion'},
    {data:'created_at',name:'created_at',class: "center"},
    {data:'emple',name:'emple',class: "center",searchable:false},
    {data:'user',name:'user',class: "center"},
    ],
 
    language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay informaci??n",
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

$('#coop-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#coop-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#coop-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

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

$('#coop-table').DataTable().on("draw", function(){
    var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();
});



$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});


$("#figura").append("$");

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
 }else{
    $("#figura").empty();
    $("#figura").append("%");

 }   

});

function saveasignaciones(){
   var name=$("#name").val();
   var tipo=$("#inputState").val();
   var forma=$("#forma").val();
   var monto=$("#monto").val();

   if(name==""|| tipo==""||forma==""||monto==""){
    Errores();
   }else{
    var url = "{{route('Asignaciones.store')}}"; 
     var data ={name:name,tipo:tipo,forma:forma,monto:monto};
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

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
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

$("#coop-table tbody").on('click','tr',function(){
 
    url=$(this).attr('url');

$("#sd").attr('href',url);

$("#urles").trigger("click");

 
});


</script>

<style>
    .right{
        text-align: right;
    }
    .center{
        text-align: center;
    }

    #coop-table tbody tr{
        cursor: pointer;
    }
</style>
@endsection