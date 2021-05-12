
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">EDITAR CONCEPTO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-row">
                  <div class="form-group col-md-7">
                    <label for="inputEmail4">CONCEPTO</label>
                    <input type="text" class="form-control" placeholder="Concepto"  id="nombreC"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                  </div>
                  <br>
                  <div class="form-group col-md-4">
                      <label for="inputEmail4">MONTO</label>
                      <input type="text"  class="form-control" placeholder="Monto" id="montsC">
                    </div>
              </div>
          </div>
          <div class="modal-footer">
              {{-- <button class="btn btn-danger elimini btn-sm"  type="button"><i class="fas fa-trash"></i>&nbsp;Eliminar</button>  --}}
            <button type="button" class="btn btn-info save btn-sm"  ><i class="fas fa-save">&nbsp;</i> Guardar</button>
          </div>
        </div>
      </div>
  
    <script>
        $("#monts").mask('0#');
  
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
              excele()
              $("#fijomodal").trigger("click");
          
            
             
             },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }
               });
    }
  })
  
   
  });
  
  $('.save').on('click',function(){
      var id=$(this).val();
      var name=$("#nombreC").val();
      var monto=$("#montsC").val();
  
  
      if(name!=''&& monto!=''){
        var url = "{{ url('Gastossavefijo') }}";
     var data = {name:name,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            tabla.ajax.reload();
            $("#nombreC").val("");
            $("#montsC").val("");
            $("#modalcreatefijo").trigger("click");
             totalgasto()
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
    }else{
        error()
    }

  });
  

  function error() {
  Command: toastr["error"]("El valor monto es obligatorio", "Error")
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