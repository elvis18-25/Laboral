@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">EDITAR GASTOS</h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{route('Gasto.destroy',$gasto->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button  type="submit" title="Eliminar" class="btn btn-danger btn-sm float-right"  style="top: -59px;"><i class="fas fa-trash"></i></button>
              </form>
              <form action="{{route('Gasto.update',$gasto->id)}}" method="POST">
                <button type="submit" title="Guardar Gastos" id="save" class="btn btn-fill btn-info btn-sm float-right " style="top: -59px;"><i class="fas fa-save"></i></button>
                <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm float-right"  style="top: -59px;"><i class="fas fa-file-excel"></i></button>
                <button  type="button" title="Agregar Observaciones" data-toggle="modal" data-target="#obervacion" class="btn btn-info  btn-sm float-right"  style="top: -59px;"><i class="fas fa-edit"></i></i></button>
                {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm float-right"  style="top: -59px;"><i class="fas fa-print"></i></button> --}}
                <a href="{{url('listadopdfgasto').'/'.$gasto->id}}" target="_blank" rel="noopener noreferrer"><button  type="button"  style="top: -59px;" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm float-right"><i class="fas fa-print"></i></button></a>
                {{-- <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm float-right"  style="top: -59px;"><i class="fas fa-file-pdf"></i></button> --}}
               <a href="{{url('donwloadgasto').'/'.$gasto->id}}" target="_blank" rel="noopener noreferrer"><button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm float-right"  style="top: -59px;"><i class="fas fa-file-pdf"></i></button></a>
                @csrf   
                @method('PUT')
            <div class="form-row">
                <div class="col-sm-5">
                    <label>{{ __('DESCRIPCION') }}</label>
                    <input type="text" name="descripn" id="descr" value="{{$gasto->descripcion}}" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                </div>

                <div class="col-sm-19 mb-1">
                    <label>{{ __('ELEGIR NOMINA') }}</label>
                    <select id="selecte" class="form-control" name="idnomina">
                      <option selected value="0" >ELEGIR NOMINA</option>
                      @foreach ($nominas as $nomina)
                      @if ($nomina->id_empresa==Auth::user()->id_empresa && $nomina->estado==0 )
                      @if ($gasto->id_nomina==$nomina->id)
                      <option value="{{$nomina->id}}" selected>{{$nomina->descripcion}}</option>
                          
                      @else
                      <option value="{{$nomina->id}}">{{$nomina->descripcion}}</option>
                          
                      @endif
                      @endif
                      @endforeach
                    </select>
                </div>

            <div class="col-sm-3">
                <label>{{ __('FECHA') }}</label>
                <input type="date" id="fech" name="fec" value="{{$gasto->fecha}}" class="form-control"  >
            </div>

                <input type="text" name="montototal" id="nominasfull" value="" hidden>
            </div>
          <div class="form-row">
            <td scope="row"><div class="col-sm-5 mb-1" ><input type="text" onFocus="GanoFoco2();" onBlur="PierdoFoco2();" name="concepto[]" id="concepto" placeholder="Concepto" class="form-control datosInput focus" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"></div></td>
                        <td><div class="col-sm-3 mb-1"><input type="text" onFocus="GanoFoco();"  onBlur="PierdoFoco();" name="monto[]" id="monto"   class="form-control datosInput montro" placeholder="Monto"></div></td>
                        <td><button class="btn btn-success btn-sm"  title="Agregar Gasto" type="button" style=" position: relative;margin-left: 3px; top:-4px" onclick=" capturar({{$gasto->id}});"><i class="fas fa-plus"></i></button></td>
                      </div>
                      <br>
            <div class="">
              @include('Gastos.observa')
              <input type="text" name="perfil" id="input" hidden value="{{$gasto->id}}">

                <table class="table tablesorter " id="gastos-table">
                    <thead class=" text-primary">
                        <tr>
                            <th scope="col" style="text-align: center !important;">CONCEPTO</th>
                            <th scope="col" style="text-align: center !important;">MONTO</th>
                        </tr>
                    </thead>
                   <tbody>
                       {{-- @foreach ($concepto as $conceptos)
                      @if ($conceptos->id_empresa==Auth::user()->id_empresa && $conceptos->estado!=1 )
                    
                          <tr>
                            <td onclick="verconcept({{$conceptos->id}})">{{$conceptos->concepto}}</td>
                            <td onclick="verconcept({{$conceptos->id}})"style="text-align: right;">${{number_format($conceptos->monto,2)}}</td>
                          </tr>
                          @endif
                      @endforeach--}}
                    </tbody> 
                </table>
            </div>
        </div>
        @include('Gastos.upload')
        <input type="text" name="" value="{{$gasto->id}}" hidden id="idgasto">
        <input type="text" name="" value="{{$gasto->id_nomina}}" hidden id="listadonomina">
        <input type="text" name="" value="" hidden id="getval">
        <input type="text" name="" value="" hidden id="formes">
        <input type="text" name="total" value="0" hidden id="totl">
        <input type="text" name="" value="0" hidden id="nominavalue">
        <input type="text" name="elimiarrelgo[]" value="" hidden id="elimiarrelgo">
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                <b class="float-right" style="color: black">TOTAL DE NOMINA: <span id="totalnomina"></span></b>
              </nav>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="nominamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
{{-- @include('Gastos.phone') --}}
<div class="modal fade" id="fijomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

@endsection
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script> --}}
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery-qrcode-0.18.0.min.js')}}"></script>
{{-- <script src="{{asset('js/editor.js')}}"></script>
<script src="{{asset('css/editor.css')}}"></script> --}}
<script>
  // $("#formes").append()
totalgastoshow();



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

function totalnominaShow(){
  var id=$("#listadonomina").val();
  if(id!=0){
    var url = "{{url('listmonto')}}/"+id; 
    var data = '';
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
          $("#gastos-table tbody").prepend(result);

       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
}
         });  
  }

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
        // "ordering": false,
        "info":     false,
        // select: true,
        processing:true,
      

    serverSide:true,
    ajax:
    {
      url:"{{ url('datatableconcept') }}",
      "data":function(d){
        if($("#input").val()!=''){
          d.dato1=$("#input").val();
          id=$("#input").val();
            // totalnomi(id);
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
//           className: "dt-head-center",
//         },
//         {
//       "targets": 0, // your case first column
//       "className": "text-left",
//       // "width": "20%",
//         },
//         {
//       "targets": 1, // your case first column
//       "className": "text-left",
//       // "width": "20%",
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
                messageTop: 'Listado de Empleado.',
            }
        ],



    columns:[
    {data:'concepto',name:'concepto', class:'left' },
    {data:'monto', name:'monto', class:'right'},
    ],

});

function totalgastoshow(){
  var id =$("#idgasto").val();
    var url = "{{ url('totalgastoshow')}}/"+id;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            
            res= numberFormat2.format(result); 
            $("#totalnomina").empty();
            $("#totalnomina").append(res);
            $("#formes").attr('value',result);
            $("#totl").attr('value',result);
            cont=parseInt(result,10);
            totalnominaShow();
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
}

// function concepelimini(e){
//   var id =$("#idgasto").val();
//     var url = "{{ url('conceptelimini')}}/"+e;
//      var data = '';
//         $.ajax({
//          method: "POST",
//            data: data,
//             url:url ,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success:function(result){
//               $("#"+e).closest('tr').remove();
//             //  $().remove();
//              totalgastoshow();

        
          
           
//            },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) { 
//                 alert("Status: " + textStatus); alert("Error: " + errorThrown); 
//     }
//              });  
// }

$("#gastos-table tbody").on('click','tr',function(){
  var e=$(this).attr('data-href');
  var nomina=$(this).attr('nomi');

  if(nomina==0){
  var url = "{{ url('modalshowmodificar')}}/"+e;
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
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
  }else{

    // listadomodal(nomina);
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
        capturar($("#input").val());
    } 
  } 
});

function saveobser(){
  var id =$("#idgasto").val();
  var name=$("#textarea").val();


            
    if(name!=" "){
    var url = "{{ url('observacion')}}/"+id;
     var data = {name:name};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#obervacion").trigger("click");
                     
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
    }else{
      errorObers();
    }
}

function buscarobservaciones(){
  var id =$("#idgasto").val();
    var url = "{{ url('buscarobs')}}/"+id;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#textarea").append(result);
              
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}


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
//     HoldOn.open(options);
// };

options2 = { style: 'currency', currency: 'USD' };
numberFormat2 = new Intl.NumberFormat('en-US', options2);

valordectes=0;
$("#selecte").on('change',function(){
var valor=$("#selecte").val();
var id=$("#input").val();
var sum=0;
var rest=0;
 cont2=0;
  if(valor!=0 && valordectes!=valor){

    
    var url = "{{url('listmonto')}}/"+valor; 
    var data = {id:id};
    $.ajax({
     method: "POST",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
          $("#"+valordectes).remove();

          valordectes=valor;
          $("#gastos-table tbody").prepend(result);
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
            var results= numberFormat2.format(sum);
            $("#totalnomina").empty();
            $("#totalnomina").append(results);
            $("#totl").attr('value',sum);
            $("#nominatotaldf").attr('value',nomina);
            $("#nominavalue").attr('value',nomina);
            }else{
          cont=rsul+nomina-restnomina;
          var resultado= numberFormat2.format(cont);
          $("#totalnomina").empty();
          $("#totalnomina").append(resultado);
          $("#totl").attr('value',cont);
          $("#nominavalue").attr('value',nomina);
          $("#nominatotaldf").attr('value',nomina);
            }
   
       
       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
}
         });  
  }

});


$("#gastos-table select[name='porciento[]']").on('change',function(){
   var  e=$(this).val();
    alert(e);
    $("#formes").attr('value',e);
});





idconcepto=0;
verificador=0;
var formpago=0;
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
  if(nomina==0){
   errornomina();
  }
  if(conceptoCapturar=='' ||montoCapturar=='' ){

  error();
  }

}
}
var baseDatos=[];

function agregar(){
$('.datosInput').val('');
$("#concepto").focus();
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

var reses= numberFormat2.format(cont);
      $("#totalnomina").empty();
      $("#totalnomina").append(reses);

      $("#conceptosd").attr('value',formpago);

re= numberFormat2.format(nuevoSujeto.monto);



baseDatos.push(nuevoSujeto);
console.log(baseDatos);
var button = '<button class="btn btn-danger remf btn-sm" value="'+nuevoSujeto.monto+'" type="button"><i class="fas fa-trash"></i></button>';
var button2=' <button class="btn btn-info  btn-sm" data-toggle="modal" data-target="#upload" type="button"><i class="fas fa-upload"></i></button>'

// $('#gastos-table tbody').append(button);




$('#gastos-table tbody').append('<tr class="showinfo" action="'+nuevoSujeto.concepto+'" value="'+nuevoSujeto.monto+'" ><td><input type="text" value="'+nuevoSujeto.concepto+'"  name="concepto[]" / hidden>'+nuevoSujeto.concepto+'</td><td style="text-align: right;"><input type="text" name="monto[]" value="'+nuevoSujeto.monto+'"/hidden>'+re+'</tr>');


}

var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

// $("#txtEditor").Editor();

// $(document).on('click', '.remf', function (event) {
//     event.preventDefault();
//     $(this).closest('tr').remove();
//      var re=$(this).val();
//      cont=cont-re;
//      $("#totl").attr('value',cont);

// var reses= numberFormat2.format(cont);
//       $("#totalnomina").empty();
//       $("#totalnomina").append(reses);


// });



// function eliminis(e){
//   // var modal=$('#nominamodal').hasClass('show');
//   //     if(modal==false){
//   //       $("#nominamodal").trigger("click");
//   //  }
//   alert(e);
// }


// arreglo=[];
// i=0;
// $(document).on('click', '.elimini', function (event) {
//     event.preventDefault();
//     $(this).closest('tr').remove();
//      var re=$(this).val();
//      var elimonoto=parseInt($(this).attr('action'));
//      arreglo[i]=re;


//      cont=cont-elimonoto;
//      $("#totl").attr('value',cont);

// var reses= numberFormat2.format(cont);
//       $("#totalnomina").empty();
//       $("#totalnomina").append(reses);




//      $("#elimiarrelgo").attr('value',arreglo);
//     i++
// });


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

function errorObers() {
  Command: toastr["error"]("No hay ningun dato para guardar", "Error")
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
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
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

<style>
  #gastos-table{
    width: revert !important;
  }

   .right{
    text-align: right !important;
  }

  /* .left{
    text-align: center !important;
  } */
</style>