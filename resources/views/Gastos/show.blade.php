@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;" ><b>GASTOS RECURENTES</b></h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">

                <form action="{{route('Gasto.update',$gasto->id)}}" method="POST">
                  @if ($permisos_acciones->imprimir_gastos)
                  <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm redondo float-right"  style="top: -92px;"><i class="fas fa-file-excel" style="margin-left: -2px; ; position: relative; font-size: 17px;"></i></button>
                  {{-- <button  type="button" title="Agregar Observaciones" data-toggle="modal" data-target="#obervacion" class="btn btn-info  btn-sm float-right whiter redondo"  style="top: -104px;"><i class="fas fa-edit"></i></i></button> --}}
                  {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm float-right"  style="top: -59px;"><i class="fas fa-print"></i></button> --}}
                  <a href="{{url('listadopdfgasto').'/'.$gasto->id}}" target="_blank" rel="noopener noreferrer"><button  type="button"  style="top: -92px;" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm redondo float-right"><i class="fas fa-print" style="margin-left: -2px; ; position: relative; font-size: 17px;"></i></button></a>
                  {{-- <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm float-right"  style="top: -59px;"><i class="fas fa-file-pdf"></i></button> --}}
                  <a href="{{url('donwloadgasto').'/'.$gasto->id}}" target="_blank" rel="noopener noreferrer"><button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm redondo float-right"  style="top: -92px;"><i class="fas fa-file-pdf" style="margin-left: -2px; ; position: relative; font-size: 17px;"></i></button></a>
                  @endif
                  @csrf   
                  @method('PUT') 
            <div class="form-row">
                <div class="col-sm-5">
                    <label>{{ __('DESCRIPCION') }}</label>
                    <input type="text" name="descripn" id="descr" value="{{$gasto->descripcion}}"class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>
                @php
                    $user=Auth::user()->id_empresa
                @endphp
              <div class="col-sm-4">
                <label>{{ __('ELEGIR NOMINA') }}</label>
                <div class="input-group  mb-3">
                  <div class="input-group-prepend disabledclass" id="prepend" >
                    <div class="input-group-text">
                      <input type="checkbox" value="0" aria-label="Checkbox for following text input" id="condiction" >
                    </div>
                  </div>
                  <select id="selecte" class="form-control " value="" name="idnominaser" disabled>
                    <option selected value="0" >ELEGIR NOMINA</option>
                    @foreach ($nominas as $nomina)
                    <option value="{{$nomina->id}}" >{{$nomina->descripcion}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            <div class="col-sm-3">
                <label>{{ __('FECHA') }}</label>
                <input type="date" id="fech" name="fec"  value="{{$gasto->fecha}}" class="form-control"  >
            </div>

                <input type="text" name="montototal" id="nominasfull" value="" hidden>
            </div>
          </div>
        </div>
        <input type="text" id="idnomina" name="idnomina" hidden value="{{$gasto->id_nomina}}">
     {{-- ----------------------------------------------------------------------------------------------------------------- --}}   
     {{-- @include('Gastos.modalfijoscreate') --}}
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
              <button type="button" title="Agregar Gasto Fijo" onclick="MFDC();"   class="btn btn-fill btn-info btn-sm float-right redondo whiter" ><i class="fas fa-plus" style="margin-left: -2px; ; position: relative; font-size: 17px;"></i></button>
              <div style="max-height: 305px; overflow-x: hidden; width: 100%; position: relative; overflow-y: auto; font-size:small; top:-77px; ">
                <table class="table tablesorter " id="gastofijo-table" style="top: -8px; position: relative;">
                <thead class="text-primary">
                    <tr>
                        <th style="text-align: center !important; "  scope="col">CONCEPTO</th>
                        <th style="text-align: center !important; position: relative; width: 25%;"  scope="col">MONTO</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ( $gastofijos as  $gastofijo)
                  @if ($gastofijo->id_empresa==Auth::user()->id_empresa && $gastofijo->estado==0)
                  @if ($gastofijo->id_gasto==$gasto->id)
                      
                  

                  <tr id="gasto{{$gastofijo->id}}">
                      <td style=" cursor: pointer;" onclick="verconceptFijo({{$gastofijo->id}})">{{$gastofijo->concepto}}</td>
                      <td  onclick="verconceptFijo({{$gastofijo->id}})" style="text-align: right; cursor: pointer;">${{number_format($gastofijo->monto,2)}}</td>
                  </tr>
                      
                  @endif
                  @endif
                  @endforeach
                </tbody>

            </table>
            <input type="text" name="" value="" id="totalfijo" hidden>
          </div>
            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="...">
                <b class="float-right" style="color: black;
                margin-right: 15px;
                font-size: 16px;
                top: 379px;
                position: absolute;">TOTAL: <span id="totalnomina"></span></b>
              </nav>
            </div>
          </div>
        </div>
      {{------ Gastos del Periodo -------}}
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
              <button type="button" title="Guardar Gastos"  data-toggle="modal" data-target="#conceptomodal" class="btn btn-fill btn-info btn-sm float-right redondo whiter " ><i class="fas fa-plus" style="margin-left: -2px; ; position: relative; font-size: 17px;"></i></button>
              <div style="max-height: 305px; overflow-x: hidden; width: 100%; position: relative; overflow-y: auto; font-size:small; top:-77px; ">
                <table class="table tablesorter " id="gastoperido-table" style="top: -8px; position: relative;">
                <thead class="text-primary">
                    <tr>
                        <th style="text-align: center !important; "  scope="col">CONCEPTO</th>
                        <th style="text-align: center !important; position: relative; width: 25%;"  scope="col">MONTO</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ( $concepto as  $conceptos)
                  @if ($conceptos->id_empresa==Auth::user()->id_empresa && $conceptos->estado==0)
                  @if ($conceptos->id_gasto==$gasto->id)

                  <tr id="gasto{{$conceptos->id}}">
                      <td onclick="verconcept({{$conceptos->id}})">{{$conceptos->concepto}}</td>
                      <td  onclick="verconcept({{$conceptos->id}})" style="text-align: right;">${{number_format($conceptos->monto,2)}}</td>
                  </tr>
                      
                  @endif
                  @endif
                  @endforeach
                </tbody>

            </table>
          </div>
        </div>
        <input type="text" name="" value="" id="totalconcepto" hidden >
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
      <input type="text" name="perfil" id="input" hidden value="{{$gasto->id}}">
   {{--------------------------------------------------------------------------------------------------------------------------------------------------}}
      <div class="card">
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
            <table class="table tablesorter " id="gastonomina-table" style="top: -42px;  position: relative;">
              <thead class="text-primary">
                  <tr>
                      <th style="text-align: center !important; "  scope="col">CONCEPTO</th>
                      <th style="text-align: center !important; position: relative; width: 25%;"  scope="col">MONTO</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($gasto_nomina as $gasto_nominas)
                <tr onclick="vernomina({{$gasto_nominas->id_nomina}});" id="{{$gasto_nominas->id_nomina}}" value="{{$gasto_nominas->monto}}" action="{{$gasto_nominas->id_nomina}}">
                  <td style="cursor: pointer;"> {{$gasto_nominas->descripcion}}</td>
                  <td style="text-align: right; cursor: pointer;">${{number_format($gasto_nominas->monto,2)}}</td>
                  
              </tr>
                @endforeach
              </tbody>
          </table>
          </div>
          <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
              <b class="float-right" style="color: black;
              margin-right: 15px;
              font-size: 16px;
              top: 186px;
              position: absolute;">TOTAL: <span id="totalnominames"></span></b>
            </nav>
          </div>
      </div>
      <input type="text" id="nomina" value="0" hidden>
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
        <div class="col-8">
            <h4 class="car"><b>TOTAL GENERAL:</b></h4>
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
        position: absolute;"><span id="totalgeneral"></span></b>
      </nav>
    </div>
</div>

</div>
<div class="col-sm-6 float-left">
  
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-8">
          <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;" ><b>OBSERVACIONES</b></h4>
        </div>
        
        <div class="col-4 text-right">
        </div>
      </div>
    </div>
    <div class="card-body">
      <textarea class="form-control" style="color: black; font-size: 13px !important; font-weight: bold !important;" name="textarea" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" id="exampleFormControlTextarea1" rows="3">{{$gasto->observaciones}}</textarea>
    </div>
  </div>
</div>
<button type="submit" class="btn btn-fill btn-info mx-auto float-right" id="seave"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
</form>

<form action="{{route('Gasto.destroy',$gasto->id)}}" method="POST">
  @csrf
  @method('DELETE')
  <button type="submit"  class="btn btn-fill btn-danger float-right" title="Eliminar Empleado" style="margin-right: 5px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
</form>


<div class="modal fade" id="nominamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
{{-- @include('Gastos.phone') --}}
<div class="modal fade" id="fijomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="modalcreatefijo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="modalSf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

<div id="adcls" >
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
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery-qrcode-0.18.0.min.js')}}"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

totalgastoConcepto();
totalgastoFijo();


$("#monto").mask('0#');
$('.money').mask("#,##0.00", {reverse: true});



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

// formpago=parseInt($("#totalconcepto").val(),10);
cont=0;
valordectes=0;
general=0;
options2 = { style: 'currency', currency: 'USD' };
numberFormat2 = new Intl.NumberFormat('en-US', options2);

// reses= numberFormat2.format(formpago); 
// $("#totalperiodo").append(reses);

resnomina= numberFormat2.format(valordectes); 
$("#totalnominames").append(resnomina);

restotal= numberFormat2.format(general); 
$("#totalgeneral").append(restotal);


// totalgasto();
  // var hoy = new Date();
  // var fecha = moment(hoy);
  // document.getElementById("fech").defaultValue = fecha.format("YYYY-MM-DD");


$('#descr').keypress(function(tecla)
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


function MFDC(){
  var id=$("#input").val();
  var url = "{{ url('modalcreateedit')}}/"+id;
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#modalSf").html(result).modal("show");
              
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
    }
             });  
}


function totalgeneral(){

                var totalconcepto=parseInt($("#totalconcepto").val(),10);
              var totalfijo=parseInt($("#totalfijo").val(),10);
              var totalnomina=parseInt($("#nomina").val(),10);


              var sum=totalfijo+totalconcepto+totalnomina;
              var resgeneral= numberFormat2.format(sum); 
              $("#totl").attr('value',sum);
              $("#totalgeneral").empty();
            $("#totalgeneral").append(resgeneral);
}


function totalgastoConcepto(){
  var e=$("#input").val();
  var url = "{{ url('totalgastoConcepto')}}/"+e;
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              
            // var totalconcepto=$("#totalconcepto").val();
            var restotal= numberFormat2.format(result); 
            
            $("#totalperiodo").empty();
            $("#totalperiodo").append(restotal);
            $("#totalconcepto").attr('value',result)
            totalgastoFijo();
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
    }
             });  
}
function totalgastoFijo(){
  var e=$("#input").val();
  var url = "{{ url('totalgastoFijo')}}/"+e;
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            var restotal= numberFormat2.format(result); 
            
            $("#totalnomina").empty();
            $("#totalnomina").append(restotal);
            $("#totalfijo").attr('value',result);
            VerficateNomina();
            
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
    }
             });  
}



function VerficateNomina(){
  var id=$("#input").val();
  var url = "{{url('totalnomina')}}/"+id;
     var data = '';
     $.ajax({
         method: "POST",
         data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              var restotal= numberFormat2.format(result); 
            
            $("#totalnominames").empty();
            $("#totalnominames").append(restotal);
              $("#nomina").attr('value',result);
              totalgeneral();

           },
           error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
              }
             });  
}


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


HayFoco=true;
HayFoco2=true;
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


$("#selecte").on('change',function(){
var valor=$("#selecte").val();
var id=$("#input").val();
    var url = "{{url('listmonto')}}/"+valor; 
    var data = {id:id};
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){

          $("#gastonomina-table tbody").empty();
          $("#gastonomina-table tbody").prepend(result);

          var monto=$(result).attr('value');
          $("#nomina").attr('value',monto);
          totalgastoConcepto();
          refreshSelect();
          SuccesGen();


   
       
       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
           ErroresGeneral();
}
         });  

});


function refreshSelect(){
  var id=$("#input").val();
    var url = "{{url('refreshSelect')}}/"+id; 
    var data = '';
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


$("#gastos-table select[name='porciento[]']").on('change',function(){
   var  e=$(this).val();
    alert(e);
    $("#formes").attr('value',e);
});



idconcepto=0;
verificador=0;


function capturar(){
  var concepto=document.getElementById("concepto").value;
  var monto=document.getElementById("monto").value;
  var e=$("#input").val();
  // var conceptid=idconcepto++;
 
  var nomina=$("#nominavalue").val();

if(concepto!=''&& monto!=''){
  var url = "{{ url('saveconconcepto')}}/"+e;
     var data = {concepto:concepto, monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              if(result!=0){
            $('.datosInput').val('');
            $("#concepto").focus();

              $("#gastoperido-table tbody").empty();
            $("#gastoperido-table tbody").append(result);
            $("#conceptomodal").trigger("click");
            totalgastoConcepto();
            SuccesGen();


              }else{
                ComparationGastos();
              }
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
    }
             }); 
            }else{
              error();
            }
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

function verconceptFijo(e){
 var url = "{{ url('modalmodificarFijo')}}/"+e;
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
 
}
function verconcept(e){
 var url = "{{ url('modalmodificar')}}/"+e;
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
 
}

function ComparationGastos() {
  Command: toastr["error"]("Este gasto ya esta Registrado", "Error")
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

// $("#gastos-table tbody").on('click','tr',function(){
 
//  var id=$(this).attr('data-href');
//  var url = "{{ url('modalfijo')}}/"+id;
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
//                ErroresGeneral();
//     }
//              });  
 
// });


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

/* table tr td{
  padding: 4px 7px !important;
} */

table tr td{
  padding: 4px 7px !important;
}

  </style>
@endsection

