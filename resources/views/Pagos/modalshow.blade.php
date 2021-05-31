
  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black"><b>FORMA DE PAGO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group{{ $errors->has('newpago') ? ' has-danger' : '' }} text-left">
                <label style="color: black">{{ __('FORMA DE PAGO') }}</label>
                <input type="text" name="editpagos" value="{{$pagos->pago}}" id="editpagos" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control{{ $errors->has('newpago') ? ' is-invalid' : '' }}" placeholder="{{ __('NUEVA FORMA DE PAGO') }}">
           
            </div>
        </div>
        <input type="text" name="" id="idpagos" value="{{$pagos->id}}" hidden>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger redondo" onclick="eliminie({{$pagos->id}})"><i class="fas fa-trash" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
          <button type="button" onclick="updatepagos({{$pagos->id}});" id="btneditpago" class="btn btn-info float-right redondo"><i class="fas fa-save" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
        </div>
      </div>
    </div>

    <script>
function  updatepagos(e)
{
var name=$("#editpagos").val();
  var url = "{{url('PagoUpdate')}}/"+e; 
     var data ={name:name};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#pagosshow").modal("toggle");
            table.ajax.reload();  
            sucessf();
 
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

function  eliminie(e)
{
Swal.fire({
  title: 'Estas Seguro que quieres eliminarlo?',
  text: "¡No podrás revertir esto!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si,Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    var url="{{url('eliminipagos')}}/"+e
    var data='';
      $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                $("#pagosshow").modal("toggle");
            table.ajax.reload();  
             Swal.fire(
            'Eliminado!',
            'Se ha eliminado exitosamente.',
            'success'
          )

              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
  }
});
}

$('#pagosshow').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btneditpago').trigger("click");
    }
    if(e.keycode!=13)
    {
       $("#editpagos").focus();
    }
});
    </script>