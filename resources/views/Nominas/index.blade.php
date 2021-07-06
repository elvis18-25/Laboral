@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<style>

  .error{
    border-color: red !important;
  }
</style>
<link rel="stylesheet" href="{{asset('css/nominas.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link rel="stylesheet" href="{{asset('css/timepicker.min.css')}}">

<div class="col-md-12">
    <div class="card ">
      <form action="{{route('Nominas.store')}}" method="POST" id="formulario">
        <div class="card-header" style="background: #4054b2 !important; height: 45px;">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title TitleCard" style="font-size: 16px !important; font-weight: bold !important;"><b>NOMINAS</b></h4>
                </div>
                <div class="col-4 text-right">
                  <a href="#" class="btn btn-sm btn-warning redondo" style="top: -14px; position: relative; width: 36px !important; height: 35px !important;" title="Agregar Perfiles" data-toggle="modal" data-target="#Mnomina" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-users" style="margin-left: -9px; top: 3px; position: relative; font-size: 19px;"></i></a>
                  <a href="#" class="btn btn-sm btn-success redondo"style="top: -14px; position: relative; width: 36px !important; height: 35px !important;" id="btnplusemple"  title="Agregar Empleado " data-toggle="modal" data-target="#emplados" ><button type="button" id="createdperfiles" style="display: none;"></button><i class="fas fa-user-plus" style="margin-left: -4px; top: 4px; position: relative; font-size: 16px;" ></i></a>
                
                </div>
                @include('Nominas.perfiles')
                @include('Nominas.empleado')
            </div>
        </div>
        <br>
        <div class="card-body">
          
          @csrf
            <div class="form-row">
                <div class="col-sm-4">
                  <label for=""><b>DESCRIPCION</b></label>
                    <input type="text" autofocus name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                <div class="col-sm-2">
                  <label for=""><b>FECHA DE CREACION</b></label>
                    <input type="date" id="fech" name="fecha" class="form-control"  >
                </div>
                <div class="col-sm-2" id="fechaHora">
                  <label for=""><b>FECHA DE HORAS</b></label>
                  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; position: relative; top: 3px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                  </div>
                </div>
                @if ($permisos_acciones->calcular_horas==1)
                <div class="form-check" style="top: 25px;
                margin-left: 10px;">
                  <label class="form-check-label">
                    <input class="form-check-input check"   id="btnCheck" checked   type="checkbox" >
                    <span class="form-check-sign"><span class="check">
                      <b style="font-size: 14px; ">CALCULAR HORAS</b>
                      </span></span>
                    </label>
                  </div> 
                @else
                <div class="form-check" style="top: 25px;
                margin-left: 10px;">
                  <label class="form-check-label">
                    <input class="form-check-input check"   id="btnCheck"    type="checkbox" >
                    <span class="form-check-sign"><span class="check">
                      <b style="font-size: 14px; ">CALCULAR HORAS</b>
                      </span></span>
                    </label>
                  </div> 
                @endif

                <input type="text" name="" value="{{$permisos_acciones->calcular_horas}}" id="accionesf" hidden>

                



          
                <input type="text" name="montototal" id="nominasfull" value="" hidden>
            </div>
            <br>
            <input type="text" name="perfil" id="input" hidden value="">
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
                    <tbody style="font-size: 13px !important;">
                    </tbody>
                </table>
            
        </div>
        <div class="card-footer text-muted ">

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
<button type="submit" class="btn btn-fill btn-info mx-auto float-left" id="seave"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
    </div>
    <input type="date" id="start" name="start" class="form-control" value="" hidden >
    <input type="date" id="end" name="end" class="form-control" value="" hidden >
    <input type="text" id="inputCheckBox" name="inputCheckBox" value="0" hidden>

    
    <input type="text" id="arregloID" name="arregloID" class="form-control" value="" hidden>
    <input type="text" id="arregloSalario" name="arregloSalario" class="form-control" value="" hidden >
    <input type="text" id="arregloSalarioNeto" name="arregloSalarioNeto" class="form-control" value="" hidden >
    <input type="text" id="arregloHoras" name="arregloHoras" class="form-control" value="" hidden>
    <input type="text" id="arregloDedu" name="arregloDedu" class="form-control" value="" hidden>
    <input type="text" id="arregloBono" name="arregloBono" class="form-control" value="" hidden>
    <input type="text" id="arregloOtros" name="arregloOtros" class="form-control" value="" hidden>
  </form>

  <a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
  <input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >
  @include('Nominas.modalshow')
  <div class="modal fade" id="horassdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
  <div class="modal fade" id="showhorasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
  {{-- @include('Nominas.modalhoras') --}}
  
  <div class="modal fade" id="otrosedites" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
  @include('Nominas.otros')
  @include('Nominas.addGroup')
 

  <a href="{{url('Empresa')}}" class="btn btn-sm btn-success redondo"style="top: -14px; position: relative;"  ><button type="button" id="empresas" hidden style="display: none;"></button><i class="fas fa-user-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;" ></i></a>

  <div id="adcls">
    <div class="o-page-loader">
      <div class="o-page-loader--content">
        <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
          {{-- <div class=""></div> --}}
          <div class="o-page-loader--message">
              <span>Cargando...</span>
          </div>
      </div>
    </div>
  </div>
  

  <input type="text" name="" value="{{$horario}}" id="horarios" hidden>

@endsection


@section('js2')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="{{asset('js/timepicker.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clockpicker.min.css')}}">
<script type="text/javascript" src="{{asset('js/bootstrap-clockpicker.min.js')}}"></script>

@if (session('eliminado')=='ya')
<script>

  </script>    
@endif
<script>



      var hoy = new Date();
  var fecha = moment(hoy);
  document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");


  const options2 = { style: 'currency', currency: 'USD' };
const numberFormat2 = new Intl.NumberFormat('en-US', options2);



  $("#formulario").on('submit',function(e){
  e.preventDefault();
  event.preventDefault();
  var arregloID=[];
  var arregloSalario=[];
  var arregloHoras=[];
  var arregloDedu=[];
  var arregloBono=[];
  var arregloOtros=[];
  var arreglonNeto=[];
  var i=0;
    $("#Nominas tbody tr").each(function(){
      arregloID[i]=$(this).attr('data-href');
      arregloSalario[i]=$(this).attr('salario');
      arregloHoras[i]=$(this).attr('horas');
      arregloDedu[i]=$(this).attr('dedu');
      arregloBono[i]=$(this).attr('bono');
      arregloOtros[i]=$(this).attr('otros');
      arreglonNeto[i]=$(this).attr('total');
      i++;
    });

    $("#arregloID").attr('value',arregloID);
    $("#arregloSalario").attr('value',arregloSalario);
    $("#arregloHoras").attr('value',arregloHoras);
    $("#arregloDedu").attr('value',arregloDedu);
    $("#arregloBono").attr('value',arregloBono);
    $("#arregloOtros").attr('value',arregloOtros);
    $("#arregloSalarioNeto").attr('value',arreglonNeto);
    Verifacte();
    this.submit();
});

function Verifacte(){
$("#formulario").validate({
errorPlacement: function(error, element) {
      var name = element.attr('name');
      element.addClass('error');
      var errorSelector = '.validation_error_message[for="' + name + '"]';
      var $element = $(errorSelector);
      if ($element.length) { 
        $(errorSelector).html(error.html());
      } else {
          error.insertAfter(element);
      }
      ErroresGeneral();
  }
});
}

jQuery.extend(jQuery.validator.messages, {
  required: "",
  remote: "Please fix this field.",
  email: "Please enter a valid email address.",
  url: "Please enter a valid URL.",
  date: "Please enter a valid date.",
  dateISO: "Please enter a valid date (ISO).",
  number: "Please enter a valid number.",
  digits: "Please enter only digits.",
  creditcard: "Please enter a valid credit card number.",
  equalTo: "",
  accept: "Please enter a value with a valid extension.",
  maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
  minlength: jQuery.validator.format("Please enter at least {0} characters."),
  rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
  range: jQuery.validator.format("Please enter a value between {0} and {1}."),
  max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
  min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

$("#figures").append("$");
  $("#formardC").on('change',function(){
 if($(this).val()==3){
     $("#figures").empty();
     $("#figures").append("$");
 }else{
    $("#figures").empty();
    $("#figures").append("%");
 }   

});
$('.bs-timepicker').timepicker();

// $(function() {
  var start = moment().startOf('month');
  var end = moment().endOf('month');



  $(document).ready(function(){
    
    $('.money').mask("#,##0.00", {reverse: true});

var estado=$("#accionesf").val();

if(estado==0){
    $("#inputCheckBox").attr('value',1)
    $("#fechaHora").hide();
  }else{
    $("#inputCheckBox").attr('value',0)
    $("#fechaHora").show();
  }


$("#btnCheck").on('click',function(){
var valor =$("#inputCheckBox").val();

  if(valor==0){
    $("#inputCheckBox").attr('value',1)
    $("#fechaHora").hide();
  }else{
    $("#inputCheckBox").attr('value',0)
    $("#fechaHora").show();
  }
  tabla.ajax.reload();
  totalnomi(idnomina);
  // alert($("#inputCheckBox").val())

});




t=0;
img="{{asset('black') }}/img/logotipo.png";
$("#seave").on('click',function(){
t=1;

if(t==1){
$("#adcls").append('<div class="o-page-loader">'+ '<div class="o-page-loader--content">'+
      '<img src="'+img+'" alt="" class="o-page-loader--spinner">'+
      '<div class="o-page-loader--message"><span>Cargando...</span></div></div></div>');
}
});

// alert(img);



window.onbeforeunload = function(e) {

  if(t==0){
      $('.o-page-loader').remove();
        return  "H"
    }
    
  }  

$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

$("#selecgrupo").hide();
$("#exams1").change(function(){
 if($(this).val()=="option1"){
     $("#selecgrupo").hide();
     $("#descrsa").show();
      $("#entrada").show();
      $("#salida").show();
 }
});

$("#exams2").change(function(){
  if($(this).val()=="option2"){
      $("#salida").hide();
      $("#entrada").hide();
      $("#descrsa").hide();
      $("#selecgrupo").show();
  }
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
          var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');

          $("#start").attr('value',start);
          $("#end").attr('value',end);
          tabla.ajax.reload();
         
          totalnomi($("#input").val());
        });

        var startComes=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var endComes=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');

          $("#start").attr('value',startComes);
          $("#end").attr('value',endComes);
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
          var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
          var valor =$("#inputCheckBox").val();
          d.start_date=start;
          d.end_date=end;
          d.valor=valor;


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
    {data:'cargo', name:'cargo', class: "boldend", searchable:false},
    {data:'salario',name:'salario', class: "right",},
    {data:'Asigna',name:'Asigna', class: "right"},
    {data:'amount',name:'amount', class: "right"},
    {data:'horas',name:'horas', class: "right"},
    {data:'total',name:'total', class: "right"},
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
    {data:'emple',name:'emple',searchable:false,class: "center"},
    {data:'user',name:'user', class: "center"},
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
              $("#input").attr('value',e);
              tabla.ajax.reload();
              $("#Mnomina").trigger('click');
              totalnomi(e);
            
        }
        
    });



    $('#perfiles').DataTable().on("draw", function(){
    var rowIdx = tab.cell(':eq(0)').index().row;
      
    tab.row(rowIdx).select();

    tab.cell( ':eq(0)' ).focus();
});



$("#perfiles tbody").on('click','tr',function(){
   var e=$(this).attr('data-href');
   idnomina=e;
    $("#input").attr('value',e);
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
   var time=$(this).attr('times');
   
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

   var Timesmonto= numberFormat2.format(time); 
   $("#totalTimes").empty();
   $("#totalTimes").append(Timesmonto);



   detalle(id);
   $("#detalle").modal('toggle');

});



function ErroresGeneral(){
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
      "hideMethod": "fadeOut"
    }
  }

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
                ErroresGeneral();
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
                ErroresGeneral();
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
                ErroresGeneral();
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
              horas(e);
              
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });
 
}

function horas(e){
  var url="{{url('horasemple')}}/"+e; 
  var data='';
  $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
              $('#horasTables tbody').empty();
              $('#horasTables tbody').append(result)
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
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
                ErroresGeneral();
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
                ErroresGeneral();
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
              SuccesEmpleadoDelete();
              
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });
}



var Priim=0;
var reses= numberFormat2.format(Priim); 
            $("#totalnomina").empty();
            $("#totalnomina").append(reses);


function totalnomi(e){
  var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var valor =$("#inputCheckBox").val();
    var url ="{{url('totalnominas')}}/"+e;
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
                ErroresGeneral();
    }
             });
}


function showHoras(e){
  var url="{{url('showHoras')}}/"+e; 
var data='';
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              $("#showhorasModal").html(result).modal("show");
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });
}



function modalhours(){
  var e=$("#empleotros").val();
  var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
  var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
  var valor =$("#inputCheckBox").val();
  var url="{{url('modalhours')}}/"+e; 
var data={start:start,end:end,valor:valor};
  $.ajax({
         method: "POST",
           data: data,
            url:url ,
            success:function(result){
              // alert(result);
              if(result==1){
                NothigHours();
              }else{
              $("#horassdd").html(result).modal("show");
              }
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });
}


function NothigHours(){
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-info',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'No tiene un Horario Establecido en su empresa',
  text: "Deseas Asignarle un horario?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Si, Asignar!',
  cancelButtonText: 'No, cancelar!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    $("#empresas").trigger('click');
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    // swalWithBootstrapButtons.fire(
    //   'Cancelado',
    //   'Your imaginary file is safe :)',
    //   'error'
    // )
  }
})
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
                ErroresGeneral();
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
      searchClass: "serachEmpleado",
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

//   document.addEventListener ("keydown", function (e) {
//     if (e.keyCode==16) {

//       var rowIdx = tebl.cell(':eq(0)').index().row;
      
//       tebl.row(rowIdx).select();

//       tebl.cell( ':eq(0)' ).focus();

//     }
// });
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

  $('#Empleadotable').DataTable().on("draw", function(){
    $("input:[type=search]").addClass("serachEmpleado");

});

$("#btnplusemple").on('click',function(){
  var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();
      verificate();
});


$('#emplados').keyup(function(e){
    if(e.keyCode!=13)
    {
      $('div.dataTables_filter input', tebl.table().container()).focus();
    }

});

function verificate(){
  var modal=$('#emplados').hasClass('show');
      if(modal==false){
        var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();
       
   }
}



function Add(e){
    var idPerfiles =$("#input").val();
    alert(idPerfiles);
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
                ErroresGeneral();
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


function calcular(){
   var salario=$("#montoOP").val();
   
  //  var sum=0;

   var montoFormat = toInt(salario);
 


  //  sum=montoFormat/23.83/8;

   $("#montoC").attr('value',montoFormat);
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
                ErroresGeneral();
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



  function errorMult() {
  Command: toastr["error"]("Solo debes Elegir una de las dos Opciones", "Error")
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
  function SuccesEmpleadoDelete() {
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
function exitos() {
Command: toastr["success"]("Se ha guardado", "Correcto!")
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

</script>
<style>
  .right{
  text-align: right !important;
}

.center{
  text-align: center !important;
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
  .titleCenter{
    text-align: center;
  }
</style>

    
@endsection

