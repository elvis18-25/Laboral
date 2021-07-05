    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>EDITAR SUELDO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="col-sm-8">
                    <label>{{ __('DESCRIPCIÓN') }}</label>
                    <input type="text" name="" id="showsalario" value="{{$sueldo->description}}" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}">
                </div>
                <div class="col-sm-4">
                    <label>{{ __('MONTO') }}</label>
                    <input type="text" name="" value="{{number_format($sueldo->sueldo_increment,2)}}" style="text-align: right;"  onkeyup="calcular();" id="salarioShow" value="" class="form-control money">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo"><i class="fas fa-save" onclick="updatesalario({{$sueldo->id}});" style="margin-left: -1px;"></i></button>
          <button type="button" class="btn btn-danger redondo"><i class="fas fa-trash" onclick="deletesalario({{$sueldo->id}});" style="margin-left: -1px;"></i></button>
        </div>
      </div>
    </div>
<input type="text" id="salarioRecishow" hidden>

    <script>

$('.money').mask("#,##0.00", {reverse: true});

        function calcular(){
   var salario=$("#salarioShow").val();
   

   var montoFormat = toInt(salario);


   $("#salarioRecishow").attr('value',montoFormat);
  //  $("#salDias").attr('value',financial(sum));

 }
 
 function financial(x) {
   var sala=Number.parseFloat(x).toFixed(2);
  return sala;
}


String.prototype.toInt = function (){    
    return parseInt(this.split(' ').join('').split(',').join('') || 0);
}

// Incluso pensándolo como algo más genérico:

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

function updatesalario(e){
    var monto=$("#salarioRecishow").val();
    var name=$("#showsalario").val()
if(monto!="" && name!=""){
    var url = "{{url('updatesalario')}}/"+e; 
     var data ={name:name,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
  
              $("#salarioTable tbody").empty()
              $("#salarioTable tbody").append(result);
              $("#showsalarios").trigger("click");
              var monto=$(result).attr('action');

              var bonores= numberFormat2.format(monto); 
              // $("#salarioAcum").empty();
              // $("#salarioAcum").append(bonores);
              $("#salarioAcum").attr('value',bonores);
              $("#totalsalario").empty();
              $("#totalsalario").append(bonores);
              successGen();

            
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
    }
             }); 
}else{
    ErroresGeneral();
}
}


function deletesalario(e){
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
    var url = "{{url('deletesalario')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
  
              $("#salarioTable tbody").empty()
              $("#salarioTable tbody").append(result);
              $("#showsalarios").trigger("click");
              var monto=$(result).attr('action');

              var bonores= numberFormat2.format(monto); 
              // $("#salarioAcum").empty();
              // $("#salarioAcum").append(bonores);
              $("#salarioAcum").attr('value',bonores);
              $("#totalsalario").empty();
              $("#totalsalario").append(bonores);
              successDelete();
  }
  
})
  }
})
}



function successGen(){
  Command: toastr["success"]("se ha creado exitosamente", "")
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
function successDelete(){
  Command: toastr["success"]("se ha eliminado correctamente", "")
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

function ErroresGeneral(){
    Command: toastr["error"]("", "Error!")
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