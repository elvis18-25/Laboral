<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;">EDITAR CONCEPTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: none;">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" tabindex="3" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" tabindex="4" href="#QRcode" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
          </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4"><b>CONCEPTO</b></label>
                <input type="text" class="form-control" value="{{$concepto->concepto}}" id="nombre" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" >
              </div>
              <div class="form-group col-md-3">
                  <label for="inputEmail4"><b>MONTO</b></label>
                  {{-- <input type="text" value="{{$concepto->monto}}" class="form-control" id="monts"> --}}
                  <input type="tel" onFocus="GanoFoco();" style="text-align: right;" onkeyup="calculares();" value="{{number_format($concepto->monto,2)}}"  onBlur="PierdoFoco();"  value="" id="montoCla"   class="form-control datosInput money" placeholder="Monto">
                  <input type="text" name="" id="monts" value="{{$concepto->monto}}" hidden>
                </div>
          </div>
          </div>
          <div class="tab-pane fade" id="QRcode" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div id="qrcodeer" style="margin-left: 36%"></div>
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>

      </div>
      <input type="text" id="retenido" value="{{$concepto->monto}}" hidden>
      <div class="modal-footer" style="display: flow-root !important;">
        <button type="button" class="btn btn-success redondo float-left" id="btnQr" title="Agregar Fotos por el cell"><i class="fas fa-mobile-alt" style="font-size: 18px;"></i></button>
        {{-- <button type="button" class="btn btn-warning redondo float-left" id="btnpce" title="Agregar Fotos por la Pc" style="margin-left: 5px;"><i class="fas fa-image" style="font-size: 17px;  margin-left: -3px;"></i></button> --}}
          <button class="btn btn-danger eliminiconcepts redondo" title="Eliminar Concepto" style="margin-left: 5px;" value="{{$concepto->id}}" type="button"><i class="fas fa-trash" style="margin-left: -2px; font-size: 16px;"></i></button> 
        <button type="button" class="btn btn-info updatestes redondo" title="Guardar Concepto" value="{{$concepto->id}}" ><i class="fas fa-save" style="margin-left: -2px; font-size: 16px;"></i></button>
        <button type="button" class="btn btn-success redondo" id="backed" hidden><i class="fas fa-arrow-left"></i></button>

      </div>
    </div>
  </div>

  <script>
      // $("#monts").mask('0#');
      $('.money').mask("#,##0.00", {reverse: true});

      function calculares(){
   var salario=$("#montoCla").val();
   
  //  var sum=0;

   var montoFormat = toInt(salario);
 


  //  sum=montoFormat/23.83/8;

   $("#monts").attr('value',montoFormat);
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


$('.eliminiconcepts').on('click',function(){

var id=$(this).val();
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
  var gasto=$("#input").val();
   var url = "{{ url('deleteconcept')}}/"+id;
    var data = {gasto:gasto};
       $.ajax({
        method: "POST",
          data: data,
           url:url ,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(result){
            $("#gastoperido-table tbody").empty();
            $("#gastoperido-table tbody").append(result);
            $("#fijomodal").trigger("click");
            totalgastoConcepto();
            SuccesGen();
            
         
          },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral(); 
   }
            });
 }
})
});

$('.updatestes').on('click',function(){
    var id=$(this).val();
    var name=$("#nombre").val();
    var monto=$("#monts").val();
    var gasto=$("#input").val();
    var archivo=$("#files").val();
    // alert(archivo);
    var url = "{{ url('updateconcept')}}/"+id;
     var data = {name:name,monto:monto,gasto:gasto,archivo:archivo};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#gastoperido-table tbody").empty();
            $("#gastoperido-table tbody").append(result);
            $("#fijomodal").trigger("click");
            totalgastoConcepto();
            SuccesGen();
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral(); 
    }
             });  
});


$("#btnQr").on('click',function(){
$('a[tabindex=4]').trigger("click");
$("#backed").attr('hidden',false);
$("#btnpce").attr('hidden',true);
$(".updatestes").attr('hidden',true);
$(".eliminiconcepts").attr('hidden',true);
$("#btnQr").attr('hidden',true);

});

$("#backed").on('click',function(){
$('a[tabindex=3]').trigger("click");
$("#backed").attr('hidden',true);
$("#btnpce").attr('hidden',false);
$(".updatestes").attr('hidden',false);
$(".eliminiconcepts").attr('hidden',false);
$("#btnQr").attr('hidden',false);

});

var id_users=$("#id_user").val();
$("#qrcodeer").qrcode({
render: 'canvas',
width: 150,
height:150,
text: "{{url('phoneblade')}}/"+id_users,
});

  </script>