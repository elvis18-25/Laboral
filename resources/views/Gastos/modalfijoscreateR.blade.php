
  <!-- Modal -->
  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;" ><b>NUEVO GASTO DE FIJO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card-body" style="height: 161px;">
                

                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: none;">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" tabindex="6" href="#homesd" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" tabindex="7" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="homesd" role="tabpanel" aria-labelledby="pills-home-tab">
                      <div class="form-row">
                        <div class="form-inline" style="top: -10px; position: relative;">
                          <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked >
                                CREAR NUEVO GASTO FIJO
                                <span class="form-check-sign"></span>
                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" >
                                ELEGIR GASTO FIJO CREADO
                                <span class="form-check-sign"></span>
                            </label>
                        </div>
                        </div>
                        <br>
                        <br>
      
                          <div class="col-sm-7"  id="txtconcepto">
                              <label for=""><b>CONCEPTO</b></label>
                              <input type="text" name="" value="" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" id="txtMconepto" placeholder="Concepto">
                          </div>
                          <div class="col-sm-4" id="txtmonto">
                              <label for=""><b> MONTO</b></label>
                              <input type="text" name=""  value="" style="text-align: right;" onkeyup="calculares();" class="form-control money" id="txtmontos" placeholder="Monto">
                              <input type="text" name="" id="txtMmonto" hidden>
      
                            </div>
                      
                          <div class="col-sm-8" id="selectFijos">
                            <label for=""><b>ELEGIR GASTO</b></label>
                          <select id="selecteModal" class="form-control "  >
                            <option selected value="0" >ELEGIR...</option>
                            @foreach ( $gastofijos as  $gastofijo)
                            @if ( $gastofijo->id_empresa==Auth::user()->id_empresa && $gastofijo->estado==0)
                            <option  value="{{$gastofijo->id}}" >{{$gastofijo->concepto}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                  </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <div id="qrcodeerFijos" style="margin-left: 36%"></div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                  </div>
 


        </div>
        </div>
        <input type="text" name="" value="{{$gasto->id}}" id="idgastos" hidden >
        <div class="modal-footer" style="display: flow-root !important;">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-success redondo float-left" id="btnQrFijos" title="Agregar Fotos por el cell"><i class="fas fa-mobile-alt" style="font-size: 18px;"></i></button>
          {{-- <button type="button" class="btn btn-warning redondo float-left" id="btnpceFijos" title="Agregar Fotos por la Pc" style="margin-left: 5px;"><i class="fas fa-image" style="font-size: 17px;  margin-left: -3px;"></i></button> --}}
          <button type="button" class="btn btn-info redondo" id="btnsavefijos" style="margin-left: 3px;" onclick="saveFijos();"><i class="fas fa-save" style="margin-left: -2px; font-size: 16px;"></i></button>
          <button type="button" class="btn btn-success redondo" id="backedFijos" hidden><i class="fas fa-arrow-left"></i></button>

        </div>
      </div>
    </div>
 
    <script>

$("#txtmontos").on('keypress', function(e) { if(e.keyCode == 13){
  $('#btnsavefijos').trigger("click");
} }); 

$('#exampleModalLabel').keyup(function(e){
    if(e.keyCode==13)
    {
      alert("S");
      $('#btnsavefijos').trigger("click");
      
    }
});

$("#selectFijos").hide();
// $("#txtMmonto").mask('0#');
$('.money').mask("#,##0.00", {reverse: true});

$("#exampleRadios1").change(function(){
  if($(this).val()=="option1"){
      $("#selectFijos").hide();
      $("#txtconcepto").show();
      $("#txtmonto").show();

      
      $("#selecteModal option[value="+0+"]").attr("selected",true);

  }
 });

 $("#exampleRadios2").change(function(){
  if($(this).val()=="option2"){
    $("#selectFijos").show();
      $("#txtconcepto").hide();
      $("#txtmonto").hide();
      
      $("#txtMconepto").val(" ");
      $("#txtMmonto").val(" ");
      $("#txtmontos").val(" ");
  }
 });

 function calculares(){
   var salario=$("#txtmontos").val();
   
  //  var sum=0;

   var montoFormat = toInt(salario);
 


  //  sum=montoFormat/23.83/8;

   $("#txtMmonto").attr('value',montoFormat);
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

options2 = { style: 'currency', currency: 'USD' };
numberFormat2 = new Intl.NumberFormat('en-US', options2);
 function saveFijos(){
     var name=$("#txtMconepto").val();
     var monto=$("#txtMmonto").val();
     var elegir=$("#selecteModal").val();
     var id=$("#idgastos").val();
     var archivo=$("#files").val();
    //  alert(name);
    //  alert(monto);

     if(name!=0 && monto!=0){
       if(elegir!=0){
        errorMult();
       }else{
      var url = "{{ url('Gastossavefijo')}}/"+id;
     var data = {name:name, monto:monto,elegir:elegir,archivo:archivo};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              if(result!=0){
            $("#gastofijo-table tbody").empty();
            $("#gastofijo-table tbody").append(result);
            $("#modalSf").trigger("click");
            totalgastoConcepto();
            SuccesGen();
          }else{
            Comparation();
          }
 
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
            } 

     }else{
      if(elegir!=0){
        var url = "{{ url('Gastossavefijo')}}/"+id;
     var data = {name:name, monto:monto,elegir:elegir};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              if(result!=0){
                $("#gastofijo-table tbody").empty();
            $("#gastofijo-table tbody").append(result);
            $("#modalSf").trigger("click");
            totalgastoConcepto();
            SuccesGen();
          }else{
            Comparation();
          }
 
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
      }else{
        erroresCon();

      }
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
 function Comparation() {
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
 function erroresCon() {
  Command: toastr["error"]("El campo Concepto y Monto son obligatorios", "Error")
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

var id_users=$("#id_user").val();
$("#qrcodeerFijos").qrcode({
render: 'canvas',
width: 150,
height:150,
text: "{{url('phoneblade')}}/"+id_users,
});

$("#btnQrFijos").on('click',function(){
$('a[tabindex=7]').trigger("click");
$("#backedFijos").attr('hidden',false);
$("#btnpceFijos").attr('hidden',true);
$("#btnsavefijos").attr('hidden',true);
$("#btnQrFijos").attr('hidden',true);

});

$("#backedFijos").on('click',function(){
$('a[tabindex=6]').trigger("click");
$("#backedFijos").attr('hidden',true);
$("#btnpceFijos").attr('hidden',false);
$("#btnsavefijos").attr('hidden',false);
$("#btnQrFijos").attr('hidden',false);

});
    </script>