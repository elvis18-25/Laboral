@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

<style>

  .error{
    border-color: red !important;
  }
</style>
@section('content')
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
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
              <form action="{{route('Gasto.store')}}" method="POST" id="formulario">
                {{-- <button type="button" title="Guardar Gastos" id="save" class="btn btn-fill btn-primary btn-sm float-right " style="top: -59px;"><i class="fas fa-save"></i></button> --}}
                {{-- <button  type="button" title="Agregar Observaciones" data-toggle="modal" data-target="#obervacionCreate" class="btn btn-info  btn-sm float-right"  style="top: -59px;"><i class="fas fa-edit"></i></i></button> --}}

                @csrf   
            <div class="form-row">
                <div class="col-sm-5">
                    <label><b>{{ __('DESCRIPCION') }}</b></label>
                    <input type="text" name="descripn" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                @php
                    $user=Auth::user()->id_empresa
                @endphp

              <div class="col-sm-5">
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
                      @if ($nomina->id_empresa==$user && $nomina->estado==0 )
                          
                      <option value="{{$nomina->id}}">{{$nomina->descripcion}}</option>
                      @endif
                      @endforeach
                  </select>
                </div>
              </div>

            <div class="col-sm-2">
                <label><b>{{ __('FECHA') }}</b></label>
                <input type="date" id="fech" name="fec" class="form-control"  >
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
                        <tr>
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
                <b class="float-right" style="color: black; margin-right: -8px; font-size: 16px; top: -26px; position: relative;">TOTAL: <span id="totalnomina"></span></b>
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
              <button type="button" title="Guardar Gastos"  data-toggle="modal" data-target="#conceptomodal " class="btn btn-fill btn-info btn-sm float-right redondo whiter "><i class="fas fa-plus" style="margin-left: -2px; ; position: relative; font-size: 17px;" ></i></button>
          <div style="max-height: 289px; overflow-x: hidden; width: 100%; position: relative; overflow-y: auto; font-size:small; top:-77px; ">
              <table class="table tablesorter " id="gastoperido-table">
                <thead class="text-primary">
                    <tr>
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
            <table class="table tablesorter " id="gastonomina-table" style="top: -34px;  position: relative;" >
              <thead class="text-primary">
                  <tr>
                      <th style="text-align: center !important; "  class="TitleCp"><b>CONCEPTO</b></th>
                      <th style="text-align: center !important; position: relative; width: 25%;"  class="TitleCp"><b>MONTO</b></th>
                  </tr>
              </thead>
              <tbody>
                
              </tbody>

          </table>
          </div>
          <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
              <b class="float-right" style="color: black;
              margin-right: 15px;
              font-size: 16px;
              top: 198px;
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
<button type="submit" class="btn btn-fill btn-info mx-auto float-right" id="seave"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>

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
      <textarea class="form-control" style="color: black; font-size: 13px !important; font-weight: bold !important;" name="textarea" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
</div>
</div>
</form>

<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>

<div class="modal fade" id="nominamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
{{-- @include('Gastos.phone') --}}
<div class="modal fade" id="fijomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="modalcreatefijo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery-qrcode-0.18.0.min.js')}}"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

<script>

// $(document).ready(function(){


// });
// window.addEventListener("onbeforeunload",function(e){
// return "h";
// });

if (window.history && window.history.pushState) {

window.history.pushState('forward', null, './#forward');

$(window).on('popstate', function() {
  backsave();
});

}

function backsave(){
  Swal.fire({
  title: 'Seguro que deseas salir?',
  text: "No se podra revertir,¿Deseas guardarlo? !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, guardar!',
  cancelButtonText: 'No, salir!',
}).then((result) => {
  if (result.isConfirmed) {
    $("#seave").trigger("click");
  }else{
    history.back();
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

$("#monto").mask('0#');
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
              var restnomina=parseInt($("#nominatotaldf").val(),10);
              var concepextras=parseInt( $("#conceptosd").val(),10);

              var sum=restnomina+parseInt(result,10)+concepextras;
              var sum1=parseInt(result,10);
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
            cont=parseInt($("#formes").val());




          
           
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

var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};



$("#phone").on('click',function(){

  $('a[tabindex=1]').trigger("click");
  $("#back").attr('hidden',false);

});

$("#back").on('click',function(){
  $('a[tabindex=0]').trigger("click");
  $("#back").attr('hidden',true);

});


$("#qrcode").qrcode({
render: 'canvas',
width: 150,
height:150,
text: "{{url('phoneblade')}}",
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



$("#selecte").on('change',function(){
var valor=$("#selecte").val();
var sum=0;
var rest=0;
 cont2=0;

  if(valor!=0 && valordectes!=valor){
    
    var url = "{{url('listmonto')}}/"+valor; 
    var data = ' ';
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
          $("#"+valordectes).remove();

          valordectes=valor;
          $("#gastonomina-table tbody").prepend(result);
          var rsul=parseInt($("#formes").val(),10);
          var restnomina=parseInt($("#nominavalue").val(),10);
          var nomina=parseInt($(result).attr('value'),10);
          var Vnomina=parseInt($("#totl").val(),10);
          var id=$(result).attr('action');

          $("#getval").attr('value',id);



            if(Vnomina!=''){
              rest=Vnomina-restnomina;
              sum=nomina+rest;
              // cont2=cont2+sum;
            var results= numberFormat2.format(nomina);
            var regeneral= numberFormat2.format(sum);
            $("#totalnominamo").empty();
            $("#totalnominamo").append(results);

            $("#totalgeneral").empty();
            $("#totalgeneral").append(regeneral);


            $("#totl").attr('value',sum);
            $("#nominatotaldf").attr('value',nomina);
            $("#nominavalue").attr('value',nomina);
            $("#nominavalue").attr('value',nomina);

            $("#totalnominames").empty();
            $("#totalnominames").append(results);

            }else{
          cont=rsul+nomina-restnomina;
          var resultado= numberFormat2.format(cont);
          $("#totalnominamo").empty();
          $("#totalnominamo").append(resultado);

          $("#totalgeneral").empty();
            $("#totalgeneral").append(resultado);

          $("#totl").attr('value',cont);
          $("#nominavalue").attr('value',nomina);
          $("#nominatotaldf").attr('value',nomina);

          $("#totalnominames").empty();
            $("#totalnominames").append(results);
            }

   
       
       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            ErroresGeneral();
}
         });  
  }

});

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
    alert(e);
    $("#formes").attr('value',e);
});



idconcepto=0;
verificador=0;

function capturar(){

  var conceptoCapturar=document.getElementById("concepto").value;
  var montoCapturar=document.getElementById("monto").value;
  var conceptid=idconcepto++;
 
  var nomina=$("#nominavalue").val();

if(conceptoCapturar!=''&&montoCapturar!=''){

    function  Persona(id,concepto,monto){
     this.concepto=concepto;
     this.monto=monto;
     this.id=id;
    }

    nuevoSujeto= new Persona(conceptid,conceptoCapturar,montoCapturar);
 
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
var p=0;

function agregar(){
  $('.datosInput').val('');
  $("#concepto").focus();
  $("#conceptomodal").trigger("click");
  var valor=parseInt($("#nominatotaldf").val(),10);
  var cont=parseInt($("#totl").val(),10);
  

  formpago=formpago+parseInt(nuevoSujeto.monto,10);

  if(valor==0){
    cont=cont+parseInt(nuevoSujeto.monto,10);
    // verificador=parseInt($("#formes").val());
    // alert()
  }else{
    cont=cont+parseInt(nuevoSujeto.monto,10);

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



baseDatos.push(nuevoSujeto);
console.log(baseDatos);
var button = '<button class="btn btn-danger remf btn-sm" value="'+nuevoSujeto.monto+'" type="button"><i class="fas fa-trash"></i></button>';
var button2=' <button class="btn btn-info  btn-sm" data-toggle="modal" data-target="#upload" type="button"><i class="fas fa-upload"></i></button>'

BDconceptos[p]=nuevoSujeto.concepto;
BDmonto[p]=nuevoSujeto.monto;
console.log(BDconceptos);
console.log(BDmonto);
p++;

$("#conp").attr('value',BDconceptos);
$("#montp").attr('value',BDmonto);


$('#gastoperido-table tbody').append('<tr class="showinfo" action="'+nuevoSujeto.concepto+'" value="'+nuevoSujeto.monto+'" ><td><input type="text" value="'+nuevoSujeto.concepto+'"  name="concepto[]" / hidden>'+nuevoSujeto.concepto+'</td><td style="text-align: right;"><input type="text" name="monto[]" value="'+nuevoSujeto.monto+'"/hidden>'+re+'</tr>');


}
var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

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
    var monto=parseInt($(this).attr('value'),10);

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

  cont=parseInt($("#totl").val())-monto;
  alert(cont);
  formpago=formpago-monto
  var reses= numberFormat2.format(formpago);
        $("#totalperiodo").empty();
        $("#totalperiodo").append(reses)
      $("#totl").attr('value',cont);

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
$(document).on('click', '.remfes', function (event) {

  $("#"+valordectes).remove();
  // valordectes=valor;
  var rsul=parseInt($("#formes").val(),10);
  var restnomina=parseInt($("#nominavalue").val(),10);
  var nomina=parseInt($(this).attr('value'),10);
  var Vnomina=parseInt($("#totl").val(),10);
  // cont=cont-nomina;
              rest=Vnomina-nomina;
            var resultses= numberFormat2.format(rest);
            $("#totalnomina").empty();
            $("#totalnomina").append(resultses);
            $("#totl").attr('value',0);
            $("#nominavalue").attr('value',1);
  
});


// function eliminis(e){
//   // var modal=$('#nominamodal').hasClass('show');
//   //     if(modal==false){
//   //       $("#nominamodal").trigger("click");
//   //  }
//   alert(e);
// }


arreglo=[];
i=0;
$(document).on('click', '.elimini', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
     var re=$(this).val();
     var elimonoto=parseInt($(this).attr('action'));
     arreglo[i]=re;


     cont=cont-elimonoto;
     $("#totl").attr('value',cont);

var reses= numberFormat2.format(cont);
      $("#totalnomina").empty();
      $("#totalnomina").append(reses);




     $("#elimiarrelgo").attr('value',arreglo);
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
function errornomina() {
  Command: toastr["error"]("Debes de elegir una nomina", "Error")
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


function vernomina(e){
  var url = "{{ url('vernomina')}}/"+e;
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

// function verconcept(e){
//  var url = "{{ url('modalmodificar')}}/"+e;
//      var data = '';
//         $.ajax({
//          method: "POST",
//            data: data,
//             url:url ,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success:function(result){
//               $("#fijomodal").html(result).modal("show");

        
          
           
//            },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) { 
//                 ErroresGeneral();
//     }
//              });  
 
// }

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

<style>
  .disabledclass{
    background-color: #e2e2e2;
  color: #000000;
  }


  <style>
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
  padding: 4px 7px !important;
}

  </style>