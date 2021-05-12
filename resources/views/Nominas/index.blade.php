@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/nominas.css')}}">
<div class="col-md-12">
    <div class="card ">
      <form action="{{route('Nominas.store')}}" method="POST">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">NOMINAS</h4>
                </div>
                <div class="col-4 text-right">
                    <a href="#" class="btn btn-sm btn-primary" title="Agregar Perfiles" data-toggle="modal" data-target="#Mnomina" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-plus"></i></a>
                    <a href="#" class="btn btn-sm btn-success" title="Agregar Empleado " data-toggle="modal" data-target="#emplados" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-user-plus"></i></a>
                    {{-- <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></button> --}}
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></button> --}}
                    {{-- <button  type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button> --}}
                    {{-- <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></button> --}}
                </div>
                @include('Nominas.perfiles')
                @include('Nominas.empleado')
            </div>
        </div>
        <br>
        <div class="card-body">
          
          @csrf
            <div class="form-row">
                <div class="col-sm-5">
                    <input type="text" autofocus name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                <div class="col-sm-3">
                    <input type="date" id="fech" name="fecha" class="form-control"  >
                </div>
                <input type="text" name="montototal" id="nominasfull" value="" hidden>
                <button type="submit"  class="btn btn-fill btn-info btn-sm float-right"><i class="fas fa-save"></i></button>
            </div>
            <br>
            <input type="text" name="perfil" id="input" hidden value="">
                <table class="table tablesorter" id="Nominas" >
                    
                    <thead class=" text-primary">
                        <tr> 
                            <th scope="col">NOMBRE</th>
                            <th scope="col">CARGO</th>
                            <th scope="col">SALARIO BRUTO</th>
                            <th scope="col">DEDUCIONES</th>
                            <th scope="col">INCREMENTO</th>
                            <th scope="col">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            
        </div>
        <div class="card-footer text-muted ">
            <nav class="d-flex justify-content-end" aria-label="...">
              <b class="float-right" style="color: black">TOTAL DE NOMINA: <span id="totalnomina"></span></b>
            </nav>
        </div>
      </form>
    </div>
</div>

<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

@include('Nominas.modalshow')
<div class="modal fade" id="otrosedites" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@include('Nominas.otros')


@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
@if (session('eliminado')=='ya')
<script>
    Swal.fire(
      'Eliminado!',
      'El Empleado ha sido eliminado.',
      'success'
    )
  </script>    
@endif
<script>
      var hoy = new Date();
  var fecha = moment(hoy);
  document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");

  $("#formardC").on('change',function(){
 if($(this).val()==3){
     $("#figures").empty();
     $("#figures").append("$");
 }else{
    $("#figures").empty();
    $("#figures").append("%");

 }   

});

  $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#Nominas').DataTable({
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
      url:"{{ url('datatable') }}",
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
    {data:'cargo', name:'cargo', searchable:false},
    {data:'salario',name:'salario', className: "text-right",},
    {data:'Asigna',name:'Asigna', className: "text-right"},
    {data:'amount',name:'amount', className: "text-right"},
    {data:'total',name:'total', className: "text-right"},
    ],


   
});

$('div.dataTables_filter input', tabla.table().container()).focus(); 



$('#Nominas').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tabla.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#Nominas').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tabla.cell(this).index().row;

        
        // Select row
        tabla.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Nominas').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = tabla.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

              var id=$(row_s).attr('data-href');
              var name=$(row_s).attr('name');
              var dedu=$(row_s).attr('dedu');
              var bonus=$(row_s).attr('bono');
              

            $("#empleotros").val(id);
              $("#nameemple").empty();
              $("#nameemple").append(name);

              $("#totald").empty();
              $("#totald").append(dedu);

              $("#totalI").empty();
              $("#totalI").append(bonus);

              detalle(id);
              $("#detalle").modal('toggle');
            
        }
        
    });
    
//     $('#Nominas').DataTable().on("draw", function(){
//     var rowIdx = tabla.cell(':eq(0)').index().row;
      
//     tabla.row(rowIdx).select();

//     tabla.cell( ':eq(0)' ).focus();
// });

    document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {
      var rowI = tabla.cell(':eq(0)').index().row;
      
      tabla.row(rowI).select();

      tabla.cell(':eq(0)').focus(); 
    }
  });

      //     document.addEventListener ("keydown", function (e) {
//     if (e.keyCode==16) {

// $(document).ready(function(){
  
// });

var modal=$('#Mnomina').hasClass('show');
      if(modal==false){
        $('#Mnomina').modal('toggle');
       
   }


   $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  tab=$('#perfiles').DataTable({
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

    serverSide:true,
    
    ajax:
    {
      url:"{{ url('datatableperfiles') }}",
      
    },

    columns:[
    {data:'id',name:'id'},
    {data:'descripcion',name:'descripcion'},
    {data:'created_at',name:'created_at'},
    {data:'emple',name:'emple',searchable:false},
    {data:'user',name:'user'},
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

$('#perfiles').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tab.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#perfiles').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tab.cell(this).index().row;

        
        // Select row
        tab.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#perfiles').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = tab.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            var e=$(row_s).attr('data-href');
            idnomina=e;
              $("#input").val(e);
              tabla.ajax.reload();
              $("#Mnomina").trigger('click');
              totalnomi(e);
            
        }
        
    });

  //   var modal=$('#Mnomina').hasClass('show');
  //     if(modal==true){
  //       perfilesstarte();
  //  }

    // function perfilesstarte(){
    // var ro= tab.cell(':eq(0)').index().row;
      
    //   tab.row(ro).select();

    //   tab.cell( ':eq(0)' ).focus();
    // }

    $('#perfiles').DataTable().on("draw", function(){
    var rowIdx = tab.cell(':eq(0)').index().row;
      
    tab.row(rowIdx).select();

    tab.cell( ':eq(0)' ).focus();
});



$("#perfiles tbody").on('click','tr',function(){
   var e=$(this).attr('data-href');
   idnomina=e;
    $("#input").val(e);
    tabla.ajax.reload();
    $("#Mnomina").trigger('click');
    totalnomi(e);
    
});
$("#Nominas tbody").on('click','tr',function(){
   var id=$(this).attr('data-href');
   var name=$(this).attr('name');
   var dedu=$(this).attr('dedu');
   var bonus=$(this).attr('bono');
   var otros=$(this).attr('otros');
   

$("#empleotros").val(id);
   $("#nameemple").empty();
   $("#nameemple").append(name);

   $("#totald").empty();
   $("#totald").append(dedu);

   $("#totalI").empty();
   $("#totalI").append(bonus);

   $("#totalO").empty();
   $("#totalO").append(otros);



   detalle(id);
   $("#detalle").modal('toggle');

});

function switchetss(e,p){
    var url = e;
     var data = {p:p};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              tabla.ajax.reload();
              // alert(idnomina);
              totalnomi(idnomina);

              $("#detalle").trigger("click")
   
             
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
  }

function switchetssisr(e,p){
    var url = e;
     var data = {p:p};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              // alert(result);
              tabla.ajax.reload();
              totalnomi(idnomina);
              $("#detalle").trigger("click")
   
             
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
 
  }
function switchetssbono(e,p){
    var url = e;
     var data = {p:p};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              tabla.ajax.reload();
              totalnomi(idnomina);
              $("#detalle").trigger("click")
   
             
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
 
  }

function detalle(e){
  $("#otre").attr('value',e);
  idotros_emple=e;
  $("#emple").attr('value',e);
  $("#idempleados").attr('value',e);
$("#otrosbutton").attr('hidden',false);
  // otrosSinre(m);
  var url = "{{ url('Detalle') }}/"+e;
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
              $('#Detalles tbody').empty();
              $('#Detalles tbody').append(result);
              
              incremento(e);
              otros(e);
              
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
 
}

function otros(e){
  var url="{{url('otros')}}/"+e; 
  var data='';
  $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
              $('#ot tbody').empty();
              $('#ot tbody').append(result)
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

function incremento(r){
  var url="{{url('incremento')}}/"+r; 
  var data='';
  $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
              $('#aumeto tbody').empty();
              $('#aumeto tbody').append(result)
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

function eliminaremple(){
var id=$("#idempleados").val();
var idperfi= $("#input").val();
var url="{{url('deleteemple')}}/"+id; 
var data={idperfi:idperfi};
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              tabla.ajax.reload();
              $("#detalle").trigger("click")
              totalnomi(idnomina);
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

const options2 = { style: 'currency', currency: 'USD' };
const numberFormat2 = new Intl.NumberFormat('en-US', options2);

function totalnomi(e){
    // alert(e);
    var url ="{{url('totalnominas')}}/"+e;
     var data ={e:e};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
             res= numberFormat2.format(result); 
            $("#totalnomina").empty();
            $("#totalnomina").append(res);

            $("#nominasfull").attr('value',result);
            
            totaldenomina=result;
            $("#totales").attr('value',result);
            
   
             
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};



$('#detalle').keyup(function(e){
    if(e.keyCode==107)
    {
      $("#otrosmodal").modal("toggle");
    }
});

$('#otrosmodal').keyup(function(e){
  var name =$("#name").val();
    if(e.keyCode!=13)
    {
      if(name==""){
        $("#name").focus();
      }
    }
});




window.onbeforeunload = function(e) {
    HoldOn.open(options);
};


function editotros(e,p){

var url="{{url('otrosedit')}}/"+e; 
var data={p:p};
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              $("#otrosedites").html(result).modal("show");
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

tebl=$('#Empleadotable').DataTable({
        // scrollY: 200,
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

            $('td', row_s).css('backgroundColor', '#9e2ca8');


           var id=$(row_s).attr('value');
           Add(id);
            
        }
        
    });


function Add(e){
    var idPerfiles =$("#input").val();
    var url = "{{url('addempleado')}}/"+e;
     var data ={idPerfiles:idPerfiles};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                if(result==1){
                tabla.ajax.reload();
                totalnomi(idPerfiles);
                 $("#emplados").trigger('click');
                 corect();
                 
                }else{
                  Errores();
                }

          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });   
}

function Errores(){
    Command: toastr["error"]("Este Empleado esta en la nomina", "Error")
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

function corect(){
    Command: toastr["success"]("Se Añadido el Empleado", "Exito!")

toastr.options = {
  "closeButton": false,
  "debug": true,
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

$('#Mnomina').keyup(function(e){
    if(e.keyCode!=13)
    {
      $('div.dataTables_filter input', tab.table().container()).focus();
    }

});

function saveotros(){
  var name=$("#nameC").val();
   var tipo=$("#inputStateC").val();
   var forma=$("#formardC").val();
   var monto=$("#montoC").val();
   var idempl=$("#empleotros").val();
   var idperfil= $("#input").val();


   if(name==""|| tipo==""||forma==""||monto==""){
    Errore();
   }else{
    var url = "{{route('Otros.store')}}"; 
     var data ={name:name,tipo:tipo,forma:forma,monto:monto,idempl:idempl,idperfil:idperfil};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
             $("#ot").append(result); 
             $("#otrosmodal").trigger("click");
             $("#detalle").trigger("click");
            tabla.ajax.reload();
            $("#nameC").val(" ");
          $("#montoC").val(" ");
                      totalnomi(idperfil);


        
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
   }
}

function Errore(){
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