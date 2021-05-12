@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/nominas.css')}}">
<div class="col-md-12">
    <div class="card ">
      <form action="{{route('Listado.update',$nominas->id)}}" method="POST">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">NOMINA</h4>
                </div>
                <div class="col-4 text-right">
                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Agregar Perfiles" data-toggle="modal" data-target="#Mnomina" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-plus"></i></a> --}}
                    <a href="#" class="btn btn-sm btn-info" title="Agregar Empleado " data-toggle="modal" data-target="#emplados" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-user-plus"></i></a>
                    <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></button>
                   <a href="{{url('listadopdf').'/'.$nominas->id}}" target="_blank" rel="noopener noreferrer"><button  type="button" title="Imprimir Nomina" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></button></a>
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></button> --}}
                    {{-- <button  type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button> --}}
                    <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></button>
                </div>
                @include('Nominas.perfiles')
                @include('Nominas.empleado')
            </div>
        </div>
        <br>
        <div class="card-body">
          
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-sm-5">
                    <input type="text" value="{{$nominas->descripcion}}" autofocus name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                <div class="col-sm-3">
                    <input type="date" id="fech" value="{{$nominas->fecha}}" name="fecha" class="form-control"  >
                </div>
                <input type="text" name="montototal" id="nominasfull" value="" hidden>
                <button type="submit" title="Guardar Nominas" class="btn btn-fill btn-info btn-sm float-right"><i class="fas fa-save"></i>&nbsp;</button>
            </form>
            <form action="{{Route('Listado.destroy',$nominas->id)}}" method="POST" id="deletelistado">
                @csrf
                @method('DELETE')
            <button type="submit" style="margin-left: 2px;" title="Eliminar nomina" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
        </form>

            </div>
            <br>
            <input type="text" name="perfil" id="input" hidden value="{{$nominas->id_perfiles}}">
                <table class="table tablesorter" id="Nominas" >
                    
                    <thead class=" text-primary">
                        <tr> 
                            <th scope="col" style="text-align: center !important;">NOMBRE</th>
                            <th scope="col" style="text-align: center !important;">CARGO</th>
                            <th scope="col" style="text-align: center !important;">SALARIO BRUTO</th>
                            <th scope="col" style="text-align: center !important;">DEDUCIONES</th>
                            <th scope="col" style="text-align: center !important;">INCREMENTO</th>
                            <th scope="col" style="text-align: center !important;">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            
        </div>
        <div class="card-footer text-muted ">
            <nav class="d-flex justify-content-end" aria-label="...">
              <b class="float-right" style="color: black; font-size: 15px;">TOTAL: <span id="totalnomina"></span></b>
            </nav>
        </div>
     
    </div>
</div>



<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

@include('Nominas.modalshow')
<div class="modal fade" id="otrosedites" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@include('Nominas.otros')


@endsection


@section('js')
<script>
//       var hoy = new Date();
//   var fecha = moment(hoy);
//   document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");

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
        // select: true,
        processing:true,
      
        select: {
            style: 'single',
        },
    //     keys: {
    //       keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
    //     },
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
          id=$("#input").val();
            totalnomi(id);
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

      columnDefs: [
        {
      "targets": 0, // your case first column
      "className": "text-left",
      "width": "20%",
        },
        {
      "targets": 1, // your case second column
      "className": "text-left",
      "width": "10%"
        },
        {
      "targets": 2, // your case second column
      "className": "text-right",
      "width": "10%"
        },
        {
      "targets": 3, // your case second column
      "className": "text-right",
      "width": "13%"
        },
        {
      "targets": 4, // your case second column
      "className": "text-right",
      "width": "13%"
        },
        {
      "targets": 5, // your case second column
      "className": "text-right",
      "width": "13%"
        },
],
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
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ],



    columns:[
    {data:'nombre',name:'nombre', },
    {data:'cargo', name:'cargo', searchable:false},
    {data:'salario',name:'salario', className: "text-right",},
    {data:'Asigna',name:'Asigna', className: "text-right"},
    {data:'amount',name:'amount', className: "text-right"},
    {data:'total',name:'total', className: "text-right"},
    ],


   
});


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
            event.preventDefault();
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


$("#deletelistado").submit(function(e){
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

//date 0328015315

// $("#perfiles tbody").on('click','tr',function(){
//    var e=$(this).attr('data-href');
//    idnomina=e;
//     $("#input").val(e);
//     tabla.ajax.reload();
//     $("#Mnomina").trigger('click');
    
// });
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