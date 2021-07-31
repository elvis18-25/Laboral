
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>EDITAR CONCEPTO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4" style="font-size: 12px;"><b>CONCEPTO</b></label>
                  <input type="text" class="form-control" value="{{$concepto->concepto}}" id="nombre">
                </div>
                <br>
                <div class="form-group col-md-6">
                    <label for="inputEmail4" style="font-size: 12px;"><b>MONTO</b></label>
                    <input type="tel" value="{{number_format($concepto->monto,2)}}" onkeyup="calcularesFijos();" class="form-control" id="montsOPFijos" style="text-align: right;">
                    <input type="text" name="" value="{{$concepto->monto}}" id="monts" hidden>
                  </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger elimini btn-sm redondo" value="{{$concepto->id}}" type="button"><i class="fas fa-trash"></i></button> 
          <button type="button" class="btn btn-info updates btn-sm redondo" value="{{$concepto->id}}" ><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>

  <script>
     $('#montsOPFijos').mask("#,##0.00", {reverse: true});

 $('.elimini').on('click',function(){

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
    var url = "{{ url('deletegasto')}}/"+id;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            tabla.ajax.reload();
            totalgasto()
            $("#fijomodal").trigger("click");
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
  }
})

 
});

$('.updates').on('click',function(){
    var id=$(this).val();
    var name=$("#nombre").val();
    var monto=$("#monts").val();

    var url = "{{ url('updategastoFijos')}}/"+id;
     var data = {name:name,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            tabla.ajax.reload();
            totalgasto();
            execle();
            $("#fijomodal").trigger("click");
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
});


function execle(){
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

function calcularesFijos(){
   var salario=$("#montsOPFijos").val();
   
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
  </script>