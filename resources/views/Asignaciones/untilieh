
  
  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black; font-size: 16px !important; font-weight: bold !important;"><b>EDITAR ASIGNACIÓN</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="form-row">
            <div class="col-sm-6">
                <label style="color: black"><b>{{ __('NOMBRE ') }}</b></label>
                <input type="text" name="name" value="{{$asigna->Nombre}}" autofocus id="nameedit" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>

            <div class="col-sm-6">
                <label style="color: black"><b>{{ __('TIPO ') }}</b></label>
                <select id="inputStateed" class="form-control selec" required name="tipoedit" >
                    <option selected disabled>ElEGIR...</option>
                    @if ($asigna->tipo_asigna=="DEDUCCIÓN")
                    <option value="1" selected>DEDUCIÓN</option>
                    @else
                    <option value="1" selected>DEDUCIÓN</option>
                    @endif

                    @if ($asigna->tipo_asigna=="INCREMENTO")
                    <option value="2" selected >INCREMENTO</option>
                        
                    @else
                    <option value="2" >INCREMENTO</option>
                        
                    @endif
                  </select>
            </div>

            <div class="col-sm-5">
                <label style="color: black"><b> {{ __('FORMA ') }}</b></label>
                <select  class="form-control selec" name="formae" required id="formaedit" >
                    <option selected disabled>ElEGIR...</option>
                    @if ($asigna->tipo=="PORCENATJE")
                    <script>
                    $("#figure").empty();
                    $("#figure").append("%");
                    </script>
                    <option value="4" selected>PORCENATJE</option>
                    
                    @else
                    <option value="4" >PORCENATJE</option>
                    <script>
                      $("#figure").empty();
                      $("#figure").append("$"); 
                      </script>
                    @endif

                    @if ($asigna->tipo=="MONTO")
                    <option value="3" selected>MONTO</option>
                    <script>
                      $("#figure").empty();
                      $("#figure").append("$"); 
                      </script>
                    @else
                    <option value="3" >MONTO</option>
                    <script>
                      $("#figure").empty();
                      $("#figure").append("$"); 
                      </script>
                    @endif

                        
                   
                  </select>
            </div>
          
            <div class="col-sm-6">
                <label style="color: black"></label>

                <div class="input-group" style="top: 5px;">
                <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                    <div class="input-group-text"style="color: black"><span id="figure"></span></div>
                  </div>
                <input type="text" name="monto"  value="{{$asigna->Monto}}" autofocus id="montoedit" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
        </div>

    </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo" id="saveredit" onclick="updateasignaciones({{$asigna->id}});"><i class="fas fa-save" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
          <button type="button" class="btn btn-danger redondo" id="deletesr" onclick="deleteasigna({{$asigna->id}});"><i class="fas fa-trash" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
        </div>
      </div>
    </div>

    <script>
function updateasignaciones(e){
   var name=$("#nameedit").val();
   var tipo=$("#inputStateed").val();
   var forma=$("#formaedit").val();
   var monto=$("#montoedit").val();

   if(name==""|| tipo==""||forma==""||monto==""){
    Errores();
   }else{
    var url = "{{url('updateasignaciones')}}/"+e; 
     var data ={name:name,tipo:tipo,forma:forma,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            table.ajax.reload();
            $("#showmodal").trigger("click");
            SuccesGenUpdate();
            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGenerales(); 
    }
             }); 
   } 
}

function Errores(){
    Command: toastr["error"]("Debes llenar los compos", "Error")
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

  function deleteasigna(e){
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
    var url = "{{ url('deleteasigna')}}/"+e;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              table.ajax.reload();
            $("#showmodal").trigger("click");
            SuccesGenDele();
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGenerales(); 
    }
             });
  }
});
  }




    </script>
  