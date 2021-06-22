<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 14px !important; font-weight: bold !important;"><b>EDITAR CONCEPTO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4"><b>CONCEPTO</b></label>
                <input type="text" class="form-control" value="{{$concepto->concepto}}" id="nombreFijo" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" >
              </div>
              <div class="form-group col-md-3">
                  <label for="inputEmail4"><b>MONTO</b></label>
                  <input type="text" value="{{$concepto->monto}}" class="form-control" id="montsFijo">
                </div>
          </div>
      </div>
      <input type="text" id="retenido" value="{{$concepto->monto}}" hidden>
      <div class="modal-footer">
          <button class="btn btn-danger eliminiconceptsFjo btn-sm" value="{{$concepto->id}}" type="button"><i class="fas fa-trash"></i>&nbsp;Eliminar</button> 
        <button type="button" class="btn btn-info updatestesFijo btn-sm" value="{{$concepto->id}}" ><i class="fas fa-save">&nbsp;</i> Guardar</button>
      </div>
    </div>
  </div>

  <script>
      $("#monts").mask('0#');

$('.eliminiconceptsFjo').on('click',function(){

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
   var url = "{{ url('deleteconceptFijo')}}/"+id;
    var data = {gasto:gasto};
       $.ajax({
        method: "POST",
          data: data,
           url:url ,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(result){
             
            $("#gastofijo-table tbody").empty();
            $("#gastofijo-table tbody").append(result);
            $("#fijomodal").trigger("click");
            totalgastoConcepto();
            
         
          
          },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus); alert("Error: " + errorThrown); 
   }
            });
 }
})
});

$('.updatestesFijo').on('click',function(){
    var id=$(this).val();
    var name=$("#nombreFijo").val();
    var monto=$("#montsFijo").val();
    var gasto=$("#input").val();
    var url = "{{ url('updateconceptFijo')}}/"+id;
     var data = {name:name,monto:monto,gasto:gasto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){

            $("#gastofijo-table tbody").empty();
            $("#gastofijo-table tbody").append(result);
            $("#fijomodal").trigger("click");

            totalgastoConcepto();

           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
});
  </script>