  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">DEPARTAMENTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group{{ $errors->has('newpago') ? ' has-danger' : '' }} text-left">
                <label style="color: black">{{ __('DEPARTAMENTO:') }}</label>
                <input type="text" name="editpuesto" value="{{$puesto->name}}" id="editpuesto" autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" class="form-control{{ $errors->has('newpago') ? ' is-invalid' : '' }}" placeholder="{{ __('Departamento') }}">
           
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger redondo" onclick="eliminie({{$puesto->id}})"><i class="fas fa-trash"></i></button>
            <button type="button" onclick="editdepart({{$puesto->id}});" id="btneditdepart" class="btn btn-info float-right redondo"><i class="fas fa-save" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
        </div>
      </div>
    </div>

  
<script>

function  editdepart(e)
{
var name=$("#editpuesto").val();
  var url = "{{url('puestoUpdate')}}/"+e; 
     var data ={name:name};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#departshow").modal("toggle");
            table.ajax.reload();  
            sucessf();
 
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

    $('#departshow').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btneditdepart').trigger("click");
    }
    if(e.keycode!=13)
    {
       $("#editpuesto").focus();
    }
});

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
    var url="{{url('eliminipuesto')}}/"+e
    var data='';
      $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#departshow").modal("toggle");
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
</script>