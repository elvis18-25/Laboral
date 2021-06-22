
  <!-- Modal -->
  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;" ><b>NUEVO GASTO DE FIJO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card-body" style="height: 133px;">
                <div class="form-row">
 
                  <div class="form-inline" style="top: -10px; position: relative;">
                    <div class="form-check form-check-radio">
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked >
                          CREAR NUEVO GASTO FIJO
                          <span class="form-check-sign"></span>
                      </label>
                  </div>
                  <div class="form-check form-check-radio">
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" >
                          ELEGIR GASTO FIJO CREADO
                          <span class="form-check-sign"></span>
                      </label>
                  </div>
                  </div>
                  <br>
                  <br>

                    <div class="col-sm-7"  id="txtconcepto">
                        <label for=""><b>CONCEPTO</b></label>
                        <input type="text" name="" value="" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" id="txtMconepto" placeholder="Concepto">
                    </div>
                    <div class="col-sm-4" id="txtmonto">
                        <label for=""><b> MONTO</b></label>
                        <input type="text" name=""  value="" class="form-control" id="txtMmonto" placeholder="Monto">
                    </div>
                
                    <div class="col-sm-8" id="selectFijos">
                      <label for=""><b>ELEGIR GASTO</b></label>
                    <select id="selecteModal" class="form-control "  >
                      <option selected value="0" >ELEGIR...</option>
                      @foreach ( $gastofijos as  $gastofijo)
                      @if ( $gastofijo->id_empresa==Auth::user()->id_empresa && $gastofijo->estado==0)
                      <option  value="{{$gastofijo->id}}" >{{$gastofijo->concepto}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>

            </div>
        </div>
        </div>
        <input type="text" name="" value="{{$gasto->id}}" id="idgastos" hidden >
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-info redondo" onclick="saveFijos();"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
 
    <script>
$("#selectFijos").hide();
$("#txtMmonto").mask('0#');

$("#exampleRadios1").change(function(){
  if($(this).val()=="option1"){
      $("#selectFijos").hide();
      $("#txtconcepto").show();
      $("#txtmonto").show();

      
      $("#selecteModal option[value="+0+"]").attr("selected",true);

  }
 });

 $("#exampleRadios2").change(function(){
  if($(this).val()=="option2"){
    $("#selectFijos").show();
      $("#txtconcepto").hide();
      $("#txtmonto").hide();
      
      $("#txtMconepto").val(" ");
      $("#txtMmonto").val(" ");
  }
 });
options2 = { style: 'currency', currency: 'USD' };
numberFormat2 = new Intl.NumberFormat('en-US', options2);
 function saveFijos(){
     var name=$("#txtMconepto").val();
     var monto=$("#txtMmonto").val();
     var elegir=$("#selecteModal").val();
     var id=$("#idgastos").val();

     if(name!=0 && monto!=0){
       if(elegir!=0){
        errorMult();
       }else{
      var url = "{{ url('Gastossavefijo')}}/"+id;
     var data = {name:name, monto:monto,elegir:elegir};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              if(result!=0){
                $("#gastofijo-table tbody").empty();
            $("#gastofijo-table tbody").append(result);
            $("#modalSf").trigger("click");
            totalgastoConcepto();
          }else{
            Comparation();
          }
 
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
            } 

     }else{
      if(elegir!=0){
        var url = "{{ url('Gastossavefijo')}}/"+id;
     var data = {name:name, monto:monto,elegir:elegir};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              if(result!=0){
                $("#gastofijo-table tbody").empty();
            $("#gastofijo-table tbody").append(result);
            $("#modalSf").trigger("click");
            totalgastoConcepto();
          }else{
            Comparation();
          }
 
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             }); 
      }else{
        erroresCon();

      }
     }


 }

 function errorMult() {
  Command: toastr["error"]("Solo debes Elegir una de las dos Opciones", "Error")
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
 function Comparation() {
  Command: toastr["error"]("Este gasto ya esta Registrado", "Error")
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
 function erroresCon() {
  Command: toastr["error"]("El campo Concepto y Monto son obligatorios", "Error")
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