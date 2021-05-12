<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR CONCEPTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">CONCEPTO</label>
                <input type="text" class="form-control" value="{{$concepto->concepto}}" id="nombre">
              </div>
              <br>
              <div class="form-group col-md-6">
                  <label for="inputEmail4">MONTO</label>
                  <input type="text" value="{{$concepto->monto}}" class="form-control" id="monts">
                </div>
          </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-danger eliminiconcepts btn-sm" value="{{$concepto->id}}" type="button"><i class="fas fa-trash"></i>&nbsp;Eliminar</button> 
        <button type="button" class="btn btn-info updatestes btn-sm" value="{{$concepto->id}}" ><i class="fas fa-save">&nbsp;</i> Guardar</button>
      </div>
    </div>
  </div>

  <script>
      $("#monts").mask('0#');

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
   var url = "{{ url('conceptelimini')}}/"+id;
    var data = '';
       $.ajax({
        method: "POST",
          data: data,
           url:url ,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(result){
            tabla.ajax.reload();
            $("#fijomodal").trigger("click");
            totalgastoshow();
         
          
          },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus); alert("Error: " + errorThrown); 
   }
            });
 }
})
});

$('.updatestes').on('click',function(){
    var id=$(this).val();
    var name=$("#nombre").val();
    var monto=$("#monts").val();
    var url = "{{ url('updateconceptedit')}}/"+id;
     var data = {name:name,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            tabla.ajax.reload();
            $("#fijomodal").trigger("click");
            totalgastoshow();
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
});
  </script>