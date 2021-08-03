
  
  <!-- Modal -->
  <div class="modal fade" id="modalsalario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>DETALLE DEL SUELDO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="col-sm-8">
                    <label><b>{{ __('DESCRIPCIÓN') }}</b></label>
                    <input type="text" name="" id="SalarioName" value="" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="{{ __('Nombre') }}">
                </div>
                <div class="col-sm-4">
                    <label><b>{{ __('MONTO') }}</b></label>
                    <input type="tel" name="" onkeyup="calcular();" id="salario" style="text-align: right;" value="" class="form-control money">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo" id="btnsavesSalario" onclick="savesalario();" ><i class="fas fa-save" style="margin-left: -1px;"></i></button>
        </div>
      </div>
    </div>
  </div>

  <style>
      .redondo{
          width: 40px !important;
      }
  </style>

  <script>
    function savesalario(){
  var name=$("#SalarioName").val();
  var monto=$("#salarioOP").val();

  var id=$("#inputs").val();
    var url = "{{url('salarioSave')}}"; 
     var data ={name:name,monto:monto,id:id};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              // alert(result);
              $("#salarioTable tbody").append(result);
              $("#modalsalario").trigger("click");
              var monto=$(result).attr('action');

              var bonores= numberFormat2.format(monto); 
              // $("#salarioAcum").empty();
              // $("#salarioAcum").append(bonores);
              $("#salarioAcum").attr('value',bonores);
              $("#totalsalario").empty();
              $("#totalsalario").append(bonores);
              successGen();
              $("#SalarioName").val("");

            
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
               ErroresGeneral();
    }
             }); 
}

$('#modalsalario').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btnsavesSalario').trigger("click"); 
    }
});
  </script>