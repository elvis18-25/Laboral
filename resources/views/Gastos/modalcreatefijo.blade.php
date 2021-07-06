
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;"><b>EDITAR CONCEPTO</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-row">
                  <div class="form-group col-md-8">
                    <label for="inputEmail4"><b>CONCEPTO</b></label>
                    <input type="text" class="form-control" placeholder="Concepto"  id="nombreC"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputEmail4"><b>MONTO</b></label>
                      <input type="text" style="text-align: right;"  class="form-control" placeholder="Monto" id="montsC">
                    </div>
              </div>
          </div>
          <div class="modal-footer">
              {{-- <button class="btn btn-danger elimini btn-sm"  type="button"><i class="fas fa-trash"></i>&nbsp;Eliminar</button>  --}}
            <button type="button" class="btn btn-info save btn-sm redondo" id="btnsavefijos"><i class="fas fa-save"></i></button>
          </div>
        </div>
      </div>
  
    <script>
        $("#montsC").mask('0#');
  
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
                  ErroresGeneral();
      }
               });
    }
  })
  
   
  });
  
  $('.save').on('click',function(){
      var id=$(this).val();
      var conce=$("#nombreC").val();
      var monto=$("#montsC").val();
  
  
      if(conce!=''&& monto!=''){
        var url = "{{ url('saveFijos') }}";
     var data = {conce:conce,monto:monto};
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
                ErroresGeneral();
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