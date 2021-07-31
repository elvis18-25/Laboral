@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])
@section('content')
<style>

  .error{
    border-color: red !important;
  }
  .disabledclass{
    background-color: #e2e2e2;
  color: #000000;
  }


  .disabledclass{
    background-color: #e2e2e2;
  color: #000000;
  }
  .card-title{
    margin-left: -17px;
    width: 102% !important;
    /* height: 100px !important; */
    padding: 15px !important;
    background-color: #4054b2 !important;
    /* box-shadow: 10px 10px #80808040 !important; */
    color: white !important;
    position: relative;
    top: -15px;
}

table tr td{
  padding: 10px 7px !important;
}

  table>thead>tr>th{
          color: black !important;
      }

  table>thead>tr{
    background-color: rgb(255 255 255 / 40%) !important;
    }
  .dataTables_scroll{
    top: -97px !important;
  }
</style>
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div id="adcls" >
  <div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
  </div>
</div>

<form action="{{route('Gasto.store')}}" method="POST" id="formulario">
@csrf

<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>GASTOS RECURENTES</b></h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">

                {{-- <button type="button" title="Guardar Gastos" id="save" class="btn btn-fill btn-primary btn-sm float-right " style="top: -59px;"><i class="fas fa-save"></i></button> --}}
                {{-- <button  type="button" title="Agregar Observaciones" data-toggle="modal" data-target="#obervacionCreate" class="btn btn-info  btn-sm float-right"  style="top: -59px;"><i class="fas fa-edit"></i></i></button> --}}

                 
            <div class="form-row">
                <div class="col-sm-3">
                    <label><b>{{ __('DESCRIPCION') }}</b></label>
                    <input type="text" name="descripn" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                @php
                    $user=Auth::user()->id_empresa
                @endphp

              <div class="col-sm-3">
                <label><b>{{ __('ELEGIR NOMINA') }}</b></label>
                <div class="input-group  mb-3">
                  <div class="input-group-prepend disabledclass" id="prepend" >
                    <div class="input-group-text">
                      <input type="checkbox" value="0" aria-label="Checkbox for following text input" id="condiction" >
                    </div>
                  </div>
                  <select id="selecte" class="form-control " name="idnomina" disabled>
                      <option selected value="0" >ELEGIR NOMINA</option>
                      @foreach ($nominas as $nomina)
                          
                      <option value="{{$nomina->id}}">{{$nomina->descripcion}}</option>
                      
                      @endforeach
                  </select>
                </div>
              </div>

            <div class="col-sm-2">
                <label><b>{{ __('FECHA') }}</b></label>
                <input type="date" id="fech" name="fec" class="form-control"  >
            </div>

            <div class="col-md-2">
              <label><b>{{ __('CATEGORIAS') }}</b></label>
              <select id="category" class="form-control " name="categorias">
                <option selected value="0" disabled >ELEGIR CATEGORIAS</option>
                @foreach ($categorias as $categoria)
                    
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                
                @endforeach
            </select>
            </div>

            <div class="col-md-2" id="showsub">
              <label><b>{{ __('SUBCATEGORIAS') }}</b></label>
              <select id="subcategory" class="form-control " name="subcategory">
                <option selected value="0" disabled >ELEGIR SUBCATEGORIAS</option>
            </select>
            </div>


                <input type="text" name="montototal" id="nominasfull" value="" hidden>
            </div>
          </div>
        </div>
     {{-- ----------------------------------------------------------------------------------------------------------------- --}}   
        <div class="card" style="height: 410px">
          <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;" ><b>GASTOS FIJOS</b></h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">
              <button type="button" title="Agregar Gasto Fijo" onclick="Mcf();"   class="btn btn-fill btn-info btn-sm float-right redondo whiter "><i class="fas fa-plus"  style="margin-left: -2px; ; position: relative; font-size: 17px;"></i></button>

            
              {{-- <div style="max-height: 289px; overflow-x: hidden; width: auto; position: relative; overflow-y: auto; font-size:small; top:-12px; "> --}}
                <table class="table tablesorter " id="gastos-table">
                    <thead class=" text-primary">
                        <tr style="background-color: rgb(255 255 255 / 40%) !important; color: black !important;">
                            <th style="text-align: center !important;"  class="TitleCp"><b>CONCEPTO</b></th>
                            <th style="text-align: center !important;"  class="TitleCp"><b>MONTO</b></th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                      @foreach ($gasto as $gastos)
                      @if ($gastos->id_empresa==Auth::user()->id_empresa && $gastos->estado==0 )
                          <tr id="gasto{{$gastos->id}}">
                            <td onclick="verconcept({{$gastos->id}})">{{$gastos->concepto}}</td>
                            <td  onclick="verconcept({{$gastos->id}})" style="text-align: right;">${{number_format($gastos->monto,2)}}</td>
                          </tr>
                          @endif
                      @endforeach
                    </tbody> --}}
                </table>
            {{-- </div> --}}
            
            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="...">
                <b class="float-right" style="color: black; margin-right: -86px; font-size: 16px; top: 263px; position: relative;">TOTAL: <span id="totalnomina"></span></b>
              </nav>
            </div>
          </div>
        </div>
     {{-- -------------------------------------------------------------------------------------------------------------- --}}
        <div class="card" style="height: 410px">
          <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;" ><b>GASTOS DEL PERIODO</b></h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">
              <button type="button" title="Guardar Gastos" id="btnconceptrs" data-toggle="modal" data-target="#conceptomodal " class="btn btn-fill btn-info btn-sm float-right redondo whiter "><i class="fas fa-plus" style="margin-left: -2px; ; position: relative; font-size: 17px;" ></i></button>
          <div style="max-height: 289px; overflow-x: hidden; width: 100%; position: relative; overflow-y: auto; font-size:small; top:-77px; ">
              <table class="table tablesorter " id="gastoperido-table">
                <thead class="text-primary">
                    <tr style="background-color: rgb(255 255 255 / 40%) !important; color: black !important;">
                        <th style="text-align: center !important; "  class="TitleCp"><b>CONCEPTO</b></th>
                        <th style="text-align: center !important; "  class="TitleCp"><b>IMAGEN</b></th>
                        <th style="text-align: center !important; position: relative; width: 25%;"  class="TitleCp"><b>MONTO</b></th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>

            </table>
          </div>
        </div>
        <div class="card-footer py-4">
          <nav class="d-flex justify-content-end" aria-label="...">
            <b class="float-right" style="color: black;
            margin-right: 15px;
            font-size: 16px;
            top: 379px;
            position: absolute;">TOTAL: <span id="totalperiodo"></span></b>
          </nav>
        </div>
      </div>
   {{--------------------------------------------------------------------------------------------------------------------------------------------------}}
      <div class="card" style="height: 229px;">
        <div class="card-header">
          <div class="row">
              <div class="col-12">
                  <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;" ><b>GASTOS DE NOMINA</b></h4>
              </div>
   
              <div class="col-4 text-right">
              </div>
            </div>
          </div>
          <div class="card-body">
            <div style=" max-height:148px; overflow:auto; font-size:small; top:-41px; position: relative; ">
            <table class="table tablesorter " id="gastonomina-table" style="top: -2px;  position: relative;" >
              <thead class="text-primary">
                  <tr style="background-color: rgb(255 255 255 / 40%) !important; color: black !important;">
                      <th style="text-align: center !important; "  class="TitleCp"><b>CONCEPTO</b></th>
                      <th style="text-align: center !important; position: relative; width: 25%;"  class="TitleCp"><b>MONTO</b></th>
                  </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
          <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
              <b class="float-right" style="color: black;
              margin-right: 15px;
              font-size: 16px;
              top: 206px;
              position: absolute;">TOTAL: <span id="totalnominames"></span></b>
            </nav>
          </div>
      </div>
      {{---------------------------------------------------------------------------------------------------------------------------------------------}}
     
      @include('Gastos.modalconcept')
        @include('Gastos.upload')
        <input type="text" name="" value="" hidden id="getval">
        <input type="text" name="" value="" hidden id="formes">
        <input type="text" name="" value="0" hidden id="conceptosd">
        <input type="text" name="total" value="0" hidden id="totl">
        <input type="text" name="" value="0" hidden id="nominavalue">
        <input type="text" name="" value="0" hidden id="nominatotaldf">
        <input type="text" name="elimiarrelgo[]" value="" hidden id="elimiarrelgo">
        <input type="text" onFocus="GanoFoco2();" onBlur="PierdoFoco2();" hidden name="concepter[]" value="0" id="conp">
        <input type="text" onFocus="GanoFoco();"  onBlur="PierdoFoco();" hidden name="monter[]" value=" " id="montp">
        <input type="text" onFocus="GanoFoco();"  onBlur="PierdoFoco();" hidden name="filer[]" value=" " id="file">

        @php
        $users=Auth::user()->id;
    @endphp
    
    <input type="text" name="" id="id_user" value="{{$users}}" hidden>
    
</div>
<div class="col-sm-6 float-right">
  
<div class="card" style="height: 48px;">
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
        position: absolute;"> <span id="totalgeneral"></span></b>
      </nav>
    </div>
</div>


</div>

<div class="col-sm-6 float-left">

<div class="card">
  <div class="card-header">
    <div class="row">
        <div class="col-8">
            <h4 class="card-title"  style="font-size: 16px !important; font-weight: bold !important;"><b>OBSERVACIONES:</b></h4>
        </div>

        <div class="col-4 text-right">
        </div>
      </div>
    </div>
    <div class="card-body">
      <textarea class="form-control" style="color: black; font-size: 13px !important; font-weight: bold !important;" name="textarea" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"id="exampleFormControlTextarea1" rows="5"></textarea>
    </div>
</div>
<input type="text" name="arreglo" value="" id="arreglo" hidden>


</div>
<button type="submit" class="btn btn-fill btn-info mx-auto float-right" id="seave"><i class="fas fa-save"></i>&nbsp;Guardar</button>

</form>





<div class="modal fade" id="nominamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
{{-- @include('Gastos.phone') --}}
<div class="modal fade" id="fijomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="modalcreatefijo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

@endsection

@section('js')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery-qrcode-0.18.0.min.js')}}"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

<script>

Pusher.logToConsole = true;

var pusher = new Pusher('b94f0b012a3d0bf93748', {
  cluster: 'eu'
});

var channel = pusher.subscribe('my-channel');
channel.bind('form-submit', function(data) {
  // alert(JSON.stringify(data.text));
  console.log(JSON.stringify(data));
  $("#files").attr('value',data.text);
  succesPhones();
  $('a[tabindex=0]').trigger("click");
  $("#back").attr('hidden',true);
  $("#btnpc").attr('hidden',false);
  $("#btnsave").attr('hidden',false);
  $("#btnphone").attr('hidden',false);
});

$("#btnconceptrs").on('click',function(){
  $("#btnphone").attr('hidden',false);
});

var arraynomina=[];
b=0;



t=0;
img="{{asset('black') }}/img/logotipo.png";
$("#seave").on('click',function(){
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

// $("#monto").mask('0#');
$('.money').mask("#,##0.00", {reverse: true});
totalgasto();
  var hoy = new Date();
  var fecha = moment(hoy);
  document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");


$('#descr').keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }
});

formpago=0;
cont=0;
function totalgasto(){
    var url = "{{ url('totalgasto') }}";
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              var restnomina=parseFloat($("#nominatotaldf").val(),10);
              var concepextras=parseFloat( $("#conceptosd").val(),10);

              var sum=restnomina+parseFloat(result,10)+concepextras;
              var sum1=parseFloat(result,10);
              res= numberFormat2.format(sum1); 
              var resgeneral= numberFormat2.format(sum); 

              
            $("#totalnomina").empty();
            $("#totalnomina").append(res);



            $("#totalgeneral").empty();
            $("#totalgeneral").append(resgeneral);

            $("#formes").attr('value',result);
            $("#totl").attr('value',result);

            if($("#totl").val()!=0){
              $("#totl").attr('value',sum);

            }
            cont=parseFloat($("#formes").val());




          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });  
}


$("#montsC").on('keypress', function(e) { return e.keyCode != 13; }); 
$("#nombreC").on('keypress', function(e) { return e.keyCode != 13; }); 


$('#modalcreatefijo').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btnsavefijos').trigger("click");
      
    }
    if(e.keycode!=13)
    {
      var nom=$("#nombreC").val();
       if(nom==""){
         $("#nombreC").focus();
       }
        
    }
});

$("#condiction").change(function(){
  if($(this).val()==0){
 
      $("#selecte").attr('disabled',false);
    $("#condiction").attr('value',1);
    $("#prepend").removeClass( "disabledclass" )
  }else{
    $("#selecte").attr('disabled',true);
    $("#condiction").attr('value',0);
    $("#prepend").addClass( "disabledclass" )
  }
 });

$('.focus').keypress(function(tecla)
{
   if(tecla.charCode==43)
   {
      return false;

   }
});
$('.montro').keypress(function(tecla)
{
   if(tecla.charCode==43)
   {
      return false;

   }
});

function calcular(){
   var salario=$("#montoOPS").val();
   
  //  var sum=0;

   var montoFormat = toInt(salario);
 


  //  sum=montoFormat/23.83/8;

   $("#monto").attr('value',montoFormat);
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




var id_users=$("#id_user").val();

$("#qrcode").qrcode({
render: 'canvas',
width: 150,
height:150,
text: "{{url('phoneblade')}}/"+id_users,
});


HayFoco=false;
HayFoco2=false;
document.addEventListener ("keydown", function (e) {
  if(HayFoco==true || HayFoco2==true ){
    HayFoco=true;
HayFoco2=true;
    if (e.keyCode== 13) {
        event.preventDefault();
        capturar()
    } 
  } 
});


function PierdoFoco(){
   HayFoco = false;
}

function GanoFoco(){
   HayFoco = true;
}
function PierdoFoco2(){
  HayFoco2 = false;
 
}

function GanoFoco2(){
  HayFoco2 = true;
  
}

// window.onbeforeunload = function(e) {
//  if($("#gastoperido-table tbody tr").length>0){
//    return "h";
//  }else{
//    return null;
//  }
// };

options2 = { style: 'currency', currency: 'USD' };
numberFormat2 = new Intl.NumberFormat('en-US', options2);

valordectes=0;
general=0;
reses= numberFormat2.format(formpago); 
            $("#totalperiodo").append(reses);

resnomina= numberFormat2.format(valordectes); 
            $("#totalnominames").append(resnomina);

restotal= numberFormat2.format(general); 
            $("#totalgeneral").append(restotal);


var rest=0;
var ant=0;
$("#selecte").on('change',function(){
var valor=$("#selecte").val();
var cont=parseFloat($("#totl").val(),10);
var sum=0;

    var url = "{{url('listmontoCreate')}}/"+valor; 
    var data = ' ';
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
          $("#gastonomina-table tbody").append(result);
          var monto=parseFloat($(result).attr('value'),10);
          var cont=parseFloat($("#totl").val(),10);
          
          if(ant==0){
          rest=rest+monto;
          sum=rest+cont;
        }else{
          cont=cont-ant;
          rest=rest+monto;
          sum=rest+cont;
        }
          
          ant=monto;
          // alert(sum);

          var resgeneral= numberFormat2.format(rest);     
          $("#totalnominames").empty();
          $("#totalnominames").append(resgeneral);

          var restotal= numberFormat2.format(sum);     
          $("#totalgeneral").empty();
          $("#totalgeneral").append(restotal);

          $("#totl").attr('value',sum);
          var id=$(result).attr('action');
          arraynomina[b]=id;
          b++;
          succesNomina();
          $("#arreglo").attr('value',arraynomina);
          refreshSelect(arraynomina);

       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            ErroresGeneral();
}
         });  
  

});

function refreshSelect(e){
    var url = "{{url('refreshSelectCreate')}}"; 
    var data = {e:e};
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
        $("#selecte").empty();
        $("#selecte").append(result);
          
       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
           ErroresGeneral();
}
         });  
}

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#gastos-table').DataTable({
        dom: 'Bfrtip',
        "searching": false,
        "paging":   false,
        "info":     false,
        processing:true,
        "scrollY":        "280px",
        "scrollCollapse": true,
      

    serverSide:true,
    ajax:
    {
      url:"{{ url('datatablegastos') }}",
     
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

//       columnDefs: [{
// targets: [0,1,2,3,4,5],
// className: 'bolded'
// }
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
                messageTop: 'Listado de Empleado.',
            }
        ],



    columns:[
    {data:'concepto',name:'concepto', class:'left' },
    {data:'monto', name:'monto', class:'right'},
    ],

});

$("#gastos-table select[name='porciento[]']").on('change',function(){
   var  e=$(this).val();
    // alert(e);
    $("#formes").attr('value',e);
});

$("#showsub").hide();
$("#category").on('change',function(){
var id=$(this).val();
// $("#input").val(id);
// table.ajax.reload();
subcategory(id);
});


function subcategory(id){
  var url = "{{url('searchsubcategory')}}/"+id; 
    var data = "";
    $.ajax({
     method: "GET",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
          if(result!=""){
        $("#subcategory").empty();
        $("#subcategory").append(result);
        $("#showsub").show();
        }else{
          $("#showsub").hide();
        }
          
       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
           ErroresGeneral();
}
         }); 
}
idconcepto=0;
verificador=0;

function capturar(){

  var conceptoCapturar=document.getElementById("concepto").value;
  var montoCapturar=document.getElementById("monto").value;
  var ArchivosFiles=document.getElementById("files").value;
  var conceptid=idconcepto++;
 
  var nomina=$("#nominavalue").val();

if(conceptoCapturar!=''&&montoCapturar!=''){

    function  Persona(id,concepto,monto,archivo){
     this.concepto=concepto;
     this.monto=monto;
     this.id=id;
     this.archivo=archivo;
    }

    nuevoSujeto= new Persona(conceptid,conceptoCapturar,montoCapturar,ArchivosFiles);
 
 agregar();
  }else{
    // if(nomina==0){
    //  errornomina();
    // }
    if(conceptoCapturar=='' ||montoCapturar=='' ){

    error();
    }

  }
}
var baseDatos=[];
var BDconceptos=[];
var BDmonto=[];
var BDfile=[];
var p=0;

function agregar(){
  $('.datosInput').val('');
  $("#concepto").focus();
  // $("#conceptomodal").trigger("click");
  var valor=parseFloat($("#nominatotaldf").val(),10);
  var cont=parseFloat($("#totl").val(),10);
  

  formpago=formpago+parseFloat(nuevoSujeto.monto,10);

  if(valor==0){
    cont=cont+parseFloat(nuevoSujeto.monto,10);
  }else{
    cont=cont+parseFloat(nuevoSujeto.monto,10);

  }

  
  $("#totl").attr('value',cont);

  var reses= numberFormat2.format(formpago);
  var resgeneral= numberFormat2.format(cont);

        $("#totalperiodo").empty();
        $("#totalperiodo").append(reses);

        $("#totalgeneral").empty();
            $("#totalgeneral").append(resgeneral);

        $("#conceptosd").attr('value',formpago);

   re= numberFormat2.format(nuevoSujeto.monto);
   succesCapturar();



baseDatos.push(nuevoSujeto);
console.log(baseDatos);
var button = '<button class="btn btn-danger remf btn-sm" value="'+nuevoSujeto.monto+'" type="button"><i class="fas fa-trash"></i></button>';
var button2=' <button class="btn btn-info  btn-sm" data-toggle="modal" data-target="#upload" type="button"><i class="fas fa-upload"></i></button>'

BDconceptos[p]=nuevoSujeto.concepto;
BDmonto[p]=nuevoSujeto.monto;
BDfile[p]=nuevoSujeto.archivo;
console.log(BDconceptos);
console.log(BDmonto);
console.log(BDfile);
p++;

$("#conp").attr('value',BDconceptos);
$("#montp").attr('value',BDmonto);
$("#file").attr('value',BDfile);


$('#gastoperido-table tbody').append('<tr class="showinfo" action="'+nuevoSujeto.concepto+'" value="'+nuevoSujeto.monto+'" ><td><input type="text" value="'+nuevoSujeto.concepto+'"  name="concepto[]" / hidden>'+nuevoSujeto.concepto+'</td>'+'<td style="text-align: center;"><a href="{{asset("recibo")}}/'+nuevoSujeto.archivo+'" target="_blank" rel="noopener noreferrer">'+nuevoSujeto.archivo+'</a></td>'+'<td style="text-align: right;"><input type="text" name="monto[]" value="'+nuevoSujeto.monto+'"/hidden>'+re+'<input type="text" name="file[]" value="'+nuevoSujeto.archivo+'"/hidden>'+'</tr>');


}
// var options = {
//      theme:"sk-cube-grid",
//      message:'Cargando.... ',
// };

// window.onbeforeunload = function(e) {
//     HoldOn.open(options);
// };

// $('#gastoperido-table').DataTable( {
//         "searching": false,
//         "paging":   false,
//         "info":     false,
//         processing:true,
//         "scrollY":        "280px",
//         "scrollCollapse": true,
//     } );

$(document).on('click', '.showinfo', function (event) {
    var name=$(this).attr('action');
    var monto=parseFloat($(this).attr('value'),10);

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
  $(this).closest('tr').remove();

  cont=parseFloat($("#totl").val())-monto;
  // alert(cont);
  formpago=formpago-monto
  var reses= numberFormat2.format(formpago);
        $("#totalperiodo").empty();
        $("#totalperiodo").append(reses)


      $("#totl").attr('value',cont);
      var resgeneral= numberFormat2.format(cont);


    $("#totalgeneral").empty();
    $("#totalgeneral").append(resgeneral);

      Swal.fire(
      'Eliminado!',
      'El gasto ha sido Eliminado.',
      'success'
    )  

 }
})


});


  $('#conceptomodal').keyup(function(e){
    if(e.keycode!=13)
    {
       var name=$("#concepto").val();
       if(name==""){
      $("#concepto").focus();

       }
        
    }
});
$(document).on('click', '.remfesrrres', function (event) {
var valor=parseFloat($(this).attr('value'),10);
var monto=parseFloat($(this).attr('action'),10);
var cont=parseFloat($("#totl").val(),10);
var sum=0;

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
    $("#"+valor).closest('tr').remove();
    $("#nominamodal").trigger("click");

    sum=cont-monto;
    rest=rest-monto;

    var restotal= numberFormat2.format(sum);     
    $("#totalgeneral").empty();
    $("#totalgeneral").append(restotal);

    var resgeneral= numberFormat2.format(rest);     
    $("#totalnominames").empty();
    $("#totalnominames").append(resgeneral);

    $("#totl").attr('value',sum);

          
    for (let index = 0; index < arraynomina.length; index++) {
      if(arraynomina[index]==valor){
        arraynomina.splice(index,1);
        console.log(arraynomina);
      }
            
     }
     $("#arreglo").attr('value',arraynomina);
     refreshSelect(arraynomina);
   }
})
          
});

arreglo=[];
i=0;
$(document).on('click', '.elimini', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
     var re=$(this).val();
     var elimonoto=parseFloat($(this).attr('action'));
     arreglo[i]=re;


     cont=cont-elimonoto;
     $("#totl").attr('value',cont);

var reses= numberFormat2.format(cont);
      $("#totalnomina").empty();
      $("#totalnomina").append(reses);




     $("#r").attr('value',arreglo);
    i++
});


function error() {
  Command: toastr["error"]("Los campos son obligatorios", "Error")
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


function succesNomina(){
  Command: toastr["success"]("se ha agregado la nomina", "")
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
function succesPhones(){
  Command: toastr["success"]("se ha subido la imagen", "Exito!")
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
function succesCapturar(){
  Command: toastr["success"]("se ha agregado el concepto", "")
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

function vernomina(e){
  var url = "{{ url('vernominaCreate')}}/"+e;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#nominamodal").html(result).modal("show");
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });  
}
function Mcf(){
  var url = "{{ url('modalcreatefijo')}}/";
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#modalcreatefijo").html(result).modal("show");
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });  
}







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

$("#gastos-table tbody").on('click','tr',function(){
 
 var id=$(this).attr('data-href');
 var url = "{{ url('modalfijo')}}/"+id;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#fijomodal").html(result).modal("show");

        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });  
 
});

</script>
    
@endsection

