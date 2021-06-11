@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])


@section('content')
<style>
  .dropdown-menu.show{
    left: 250px !important;
  }
</style>
<link rel="stylesheet" href="{{asset('css/nominas.css')}}">
<div class="col-md-12">
    <div class="card ">
      <form action="{{route('Listado.update',$nominas->id)}}" method="POST" id="formulashow">
        <div class="card-header" style="background: #4054b2 !important; height: 45px;">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title TitleCard" style="font-size: 16px !important; font-weight: bold !important;">NOMINA</h4>
                </div>
                <div class="col-4 text-right">
                  
                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Agregar Perfiles" data-toggle="modal" data-target="#Mnomina" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-plus"></i></a> --}}
                    <a href="#" class="btn btn-sm btn-warning redondo" style="top: -16px;" title="Agregar Empleado " data-toggle="modal" data-target="#emplados" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-user-plus" style="margin-left: -5px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    <button id="btnexcel" type="button" style="top: -16px;" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm redondo"><i class="fas fa-file-excel" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></button> --}}
                    {{-- <button  type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button> --}}
                    <button id="btnpdf" type="button" style="top: -16px;" title="Exportar en PDF" class="btn btn-danger btn-sm redondo"><i class="fas fa-file-pdf" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
                    
                    <div class="dropdown" style="top: -44px; margin-right: 141px;">
                      <button  type="button" style="top: -16px;" title="Imprimir Nomina" id="dropdownMenuButton" data-toggle="dropdown" class="btn btn-warning btn-sm redondo dropdown-toggle" ><i class="fas fa-print" style="margin-left: 2px;  position: relative; font-size: 17px;"></i>
                      
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="{{url('listadopdf').'/'.$nominas->id}}" target="_blank" rel="noopener noreferrer"  class="dropdown-item">Listado de Nomina</a>
                        <a href="{{url('EmpleRecibopdf').'/'.$nominas->id}}" target="_blank" rel="noopener noreferrer"  class="dropdown-item">Recibos para todos los Empleados</a>
                        <a class="dropdown-item" href="#">Recibo para un Empleado</a>
                      </div>
                    </div>


                  </div>

                @include('Nominas.perfiles')
                @include('Listado.empleado')
            </div>
        </div>
        <br>
        <div class="card-body">
          
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-sm-4">
                  <label for=""><b>DESCRIPCION</b></label>
                    <input type="text" value="{{$nominas->descripcion}}" autofocus name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                <div class="col-sm-2">
                  <label for=""><b>FECHA DE CREACION</b></label>
                    <input type="date" id="fech" value="{{$nominas->fecha}}" name="fecha" class="form-control"  >
                </div>
                <input type="text" name="montototal" id="nominasfull" value="" hidden>
                <div class="col-sm-2">
                  <label for=""><b>FECHA DE HORAS</b></label>
                  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; position: relative; top: 3px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                  </div>
                </div>
                <div class="form-check" style="top: 25px;
                margin-left: 10px;">
                  <label class="form-check-label">
                    @if ($nominas->id_horas==0)
                    <input class="form-check-input check"   id="btnCheck" checked   type="checkbox" >
                    @else
                    <input class="form-check-input check"   id="btnCheck"    type="checkbox" >
                    @endif
                    <span class="form-check-sign"><span class="check">
                      <b style="font-size: 14px; ">Calcular Horas</b>
                      </span></span>
                    </label>
                  </div>

            </div>
            <br>
            <input type="text" name="perfil" id="input" hidden value="{{$nominas->id}}">
                <table class="table tablesorter" id="Nominas" >
                    
                    <thead class=" text-primary">
                        <tr> 
                          <th class="TitleNomi"><b>NOMBRE</b></th>
                          <th class="TitleNomi"><b>CARGO</b></th>
                          <th class="TitleNomi"><b>SALARIO BRUTO</b></th>
                          <th class="TitleNomi"><b>DEDUCIONES</b></th>
                          <th class="TitleNomi"><b>INCREMENTO</b></th>
                          <th class="TitleNomi"><b>HORAS</b></th>
                          <th class="TitleNomi"><b>TOTAL</b></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            
        </div>
        <div class="card-footer text-muted ">
            {{-- <nav class="d-flex justify-content-end" aria-label="...">
              <b class="float-right" style="color: black; font-size: 15px;">TOTAL: <span id=""></span></b>
            </nav> --}}
        </div>
     
    </div>

    
    
    
<div class="col-sm-6 float-right">  
  <div class="card" style="float: inherit; height: 48px; width: 392px; margin-right: -14px;">
  <div class="card-header">
    <div class="row">
        <div class="col-12">
            <h4 class="car" style="font-size: 16px !important; font-weight: bold !important;" ><b>TOTAL GENERAL:</b></h4>
          </div>

        <div class="col-4 text-right">
        </div>
      </div>
    </div>
    <div class="card-body">
      <nav class="d-flex justify-content-end" aria-label="...">
        <b class="float-right" style="color: black;
        margin-right: 15px;
        font-size: 16px;
        top: 16px;
        position: absolute;"> <span id="totalnomina"></span></b>
      </nav>
    </div>
  </div>
</div>

<input type="text" id="inputCheckBox" name="inputCheckBox" value="{{$nominas->id_horas}}" hidden>

<input type="text" id="arregloID" name="arregloID" class="form-control" value="" hidden>
<input type="text" id="arregloSalario" name="arregloSalario" class="form-control" value="" hidden >
<input type="text" id="started" name="st"  class="form-control" value="{{$nominas->start}}" hidden>
<input type="text" id="ended" name="en"  class="form-control" value="{{$nominas->end}}" hidden>
<button type="submit" class="btn btn-fill btn-info mx-auto float-left" title="Guardar Nomina" id="seave"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>




</form>


<form action="{{Route('Listado.destroy',$nominas->id)}}" method="POST" id="deletelistado">
  @csrf
  @method('DELETE')
  <button type="submit"  class="btn btn-fill btn-danger float-right" title="Eliminar Nomina" style="float: left !important; margin-left: 9px;;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
</form>
</div>

<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

@include('Listado.modalshowEdit')
<div class="modal fade" id="otrosedites" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@include('Listado.otros')


@endsection


@section('js')
<script>
//       var hoy = new Date();
//   var fecha = moment(hoy);
//   document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");
const options2 = { style: 'currency', currency: 'USD' };
const numberFormat2 = new Intl.NumberFormat('en-US', options2);

if($("#started").attr('value')!=" "){
startComes = new Date($("#started").attr('value'));
 endComes = new Date($("#ended").attr('value'));

 start = moment(startComes);
 end = moment(endComes);
}else{
  var start = moment().startOf('month');
  var end = moment().endOf('month');

}



  $(document).ready(function(){

    $('#montoC').mask('0#');

$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

$("#formardC").on('change',function(){
 if($(this).val()==3){
     $("#figures").empty();
     $("#figures").append("$");
 }else{
    $("#figures").empty();
    $("#figures").append("%");

 }   

});


if (window.history && window.history.pushState) {

window.history.pushState('forward', null);

$(window).on('popstate', function() {
  backsave();

});

}


function backhome(){
  if (window.history && window.history.pushState) {

window.history.pushState('forward', null);

$(window).on('popstate', function() {
  backsave();
});

}
}

$("#btnCheck").on('click',function(){
var valor =$("#inputCheckBox").val();

  if(valor==0){
    $("#inputCheckBox").attr('value',1)
  }else{
    $("#inputCheckBox").attr('value',0)
  }
  tabla.ajax.reload();
  totalnomi($("#input").attr('value'));
  // alert($("#inputCheckBox").val())

});

function backsaveEmpresa(){
  event.preventDefault();
  Swal.fire({
  title: 'Seguro que deseas salir?',
  text: "No se podra revertir,¿Deseas guardarlo? !",
  icon: 'warning',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Si, Guardar`,
  denyButtonText: `No, Salir`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $("#seave").trigger("click");
  } 
})
}

function backsave(){
  Swal.fire({
  title: 'Seguro que deseas salir?',
  text: "No se podra revertir,¿Deseas guardarlo? !",
  icon: 'warning',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Si, Guardar`,
  denyButtonText: `No, Salir`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $("#seave").trigger("click");
  } else if (result.isDenied) {
    history.back();
  }else{
    backhome();
  }
})

}

$("#formulashow").on('submit',function(e){
  i=0;
  e.preventDefault();
  event.preventDefault();
  var arregloSalario=[];
  var arregloID=[];

  $("#Nominas tbody tr").each(function(){
      arregloSalario[i]=$(this).attr('total');
      arregloID[i]=$(this).attr('data-href');
      i++;
    });
    $("#arregloSalario").attr('value',arregloSalario);
    $("#arregloID").attr('value',arregloID);
    this.submit();
    console.log(arregloSalario);
    console.log(arregloID);

});

$("#SearcFormulario").on('submit',function(e){
e.preventDefault();
Swal.fire({
  title: 'Seguro que deseas salir?',
  text: "No se podra revertir,¿Deseas guardarlo? !",
  icon: 'warning',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Si, Guardar`,
  denyButtonText: `No, Salir`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $("#seave").trigger("click");
  } else if (result.isDenied) {
    this.submit();
  }else{
    backhome();
  }
})
});

$('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Hoy': [moment(), moment()],
       'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
       'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
       'Este mes': [moment().startOf('month'), moment().endOf('month')],
       'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, function (start, end) {
          
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          start = start;
          end = end;
          var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');

          $("#started").attr('value',start);
          $("#ended").attr('value',end);
          tabla.ajax.reload();
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
      url:"{{ url('datatableListado') }}",
      "data":function(d){
        if($("#input").val()!=''){
          d.dato1=$("#input").val();
          id=$("#input").val();
          var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
          var valor =$("#inputCheckBox").val();
          d.start_date=start;
          d.end_date=end;
          d.valor=valor;
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

//       columnDefs: [
//         {
//       "targets": 0, // your case first column
//       "className": "text-left",
//       "width": "20%",
//         },
//         {
//       "targets": 1, // your case second column
//       "className": "text-left",
//       "width": "10%"
//         },
//         {
//       "targets": 2, // your case second column
//       "className": "text-right",
//       "width": "10%"
//         },
//         {
//       "targets": 3, // your case second column
//       "className": "text-right",
//       "width": "13%"
//         },
//         {
//       "targets": 4, // your case second column
//       "className": "text-right",
//       "width": "13%"
//         },
//         {
//       "targets": 5, // your case second column
//       "className": "text-right",
//       "width": "13%"
//         },
// ],
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
    {data:'cargo', name:'cargo', class: "boldend", searchable:false},
    {data:'salarioBruto',name:'salarioBruto', class: "right",},
    {data:'Asigna',name:'Asigna', class: "right"},
    {data:'amount',name:'amount', class: "right"},
    {data:'time',name:'time', class: "right"},
    {data:'total',name:'total', class: "right"},
    ],


   
});

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

   var Dedures= numberFormat2.format(dedu); 
   $("#totald").empty();
   $("#totald").append(Dedures);

   var bonores= numberFormat2.format(bonus); 
   $("#totalI").empty();
   $("#totalI").append(bonores);

   var Otrosres= numberFormat2.format(otros); 
   $("#totalO").empty();
   $("#totalO").append(Otrosres);




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
              totalnomi($("#input").attr('value'));

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
              totalnomi($("#input").attr('value'));
              $("#detalle").trigger("click")
   
             
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
 
  }

function detalle(e){
  var nomina=$("#input").val();
  $("#otre").attr('value',e);
  idotros_emple=e;
  $("#emple").attr('value',e);
  $("#idempleados").attr('value',e);
$("#otrosbutton").attr('hidden',false);
  // otrosSinre(m);
  var url = "{{ url('DetalleListado') }}/"+e;
     var data = {nomina:nomina};
        $.ajax({
         method: "POST",
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
  var url="{{url('otrosListado')}}/"+e; 
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
  var url="{{url('incrementoListado')}}/"+r; 
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
  Swal.fire({
  title: 'Encerio quieres eliminarli?',
  text: "No podras revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Elimarlo!'
}).then((result) => {
  if (result.isConfirmed) {
var id=$("#idempleados").val();
var idperfi= $("#input").val();

var url="{{url('deleteempleListado')}}/"+id; 
var data={idperfi:idperfi};
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              tabla.ajax.reload();
              $("#detalle").trigger("click")
              totalnomi($("#input").attr('value'));
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
  }
})  

}



function totalnomi(e){
  var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
      var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
      var valor =$("#inputCheckBox").val();
      var url ="{{url('totalnominasListado')}}/"+e;
     var data ={e:e,start:start,end:end,valor:valor};
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




// window.onbeforeunload = function(e) {
//     HoldOn.open(options);
// };


function editotros(e,p){
  var idperfil= $("#input").val();
var url="{{url('otroseditListado')}}/"+e; 
var data={p:p,idperfil:idperfil};
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
    var id =$("#input").val();
    var url = "{{url('addempleadoListado')}}/"+e;
     var data ={id:id};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              // alert(result);
                if(result==1){
                tabla.ajax.reload();
                totalnomi(id);
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
    var url = "{{url('Otrosstorea')}}"; 
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
          SuccesGen();
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


function SuccesGen(){
    Command: toastr["success"]("", "Exito!")
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
  .right{
  text-align: right !important;
}

.TitleNomi{
    font-size: 14px !important;
    text-align: center !important;
  }

  .boldend{
    width: 200px;
  }

  .serachEmpleado{
    font-size: 13px;
    color: black;
  }
</style>
@endsection