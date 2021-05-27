@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/empresa.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">

<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>CONFIGURACION DE LA EMPRESA</b></h4>
                </div>
                <div class="col-4 text-right">
                    {{-- <a href="{{url('Nominas')}}" class="btn btn-sm btn-info"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus"></i></a> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="row">
                    <div class="col-3">
                      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">EMPRESA</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">CONTRATO</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">NUEVA EMPRESA</a>
                        {{-- <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> --}}
                      </div>
                    </div>
                    <div class="col-9">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <form action="{{Route('Empresa.update',$empresa->id)}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="card-body" style="height: 300px;">
                                <div class="form-row">

                                 <div class="col-sm-5">
                                     <label for=""><b>NOMBRE:</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                            <i class="fas fa-address-card" style="color: black"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="nombreUP" value="{{$empresa->nombre}}" autofocus class="form-control" placeholder="Nombre de la Empresa" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                </div>
                            </div>
                 
                            

                            <div class="col-sm-3 wrap-input100 validate-input m-b-18" >
                                <label for=""><b>TELÉFONO:</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="color: black">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                    </div>
                                    <input type="tel" name="telefonoUP" value="{{$empresa->telefono}}" class="form-control" placeholder="Télefono">
                                </div>
                                <span class="focus-input100"></span>
                            </div>
                  
                            <div class="col-sm-3">
                                <label for=""><b>RNC:</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="color: black">
                                            <i class="tim-icons icon-paper"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="rncUP" class="form-control rnc" value="{{$empresa->rnc}}" placeholder="RNC">
                                </div>
                          </div>

                            <div class="col-sm-4">
                                <label for=""><b>DIRECCION:</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="color: black">
                                            <i class="tim-icons icon-map-big"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="direcionUP" class="form-control"value="{{$empresa->direcion}}" placeholder="Direccion" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for=""><b>EMAIL:</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="color: black">
                                            <i class="fas fa-at"></i>
                                        </div>
                                    </div>
                                    <input type="email" name="emailUP" class="form-control"value="{{$empresa->email}}" placeholder="Email" >
                                </div>
                            </div>
            
                            <div class="col-sm-4">
                                <div class="color-wrapper">
                                  <label for=""><b>COLOR:</b></label><br>
                                  <input type="text" name="custom_color" readonly placeholder="#FFFFFF" id="pickcolor" class="call-picker form-control" value="{{$empresa->color}}">
                                  <div class="color-holder call-picker"></div>
                                  <div class="color-picker" id="color-picker" style="display: none"></div>
                                </div>
                              </div>

                            <div class="col-sm-4">
                                <label for=""><b>IMAGEN:</b></label><br>
                                <button type="button" type="button" id="btnuploa" for="actual-btn"  class="btn btn-success btn-sm"><i class="fas fa-folder-open"></i></button>
                                <input type="file" id="actual-btn" max-file-size="1" accept=".png" name="archiveUP" hidden/>
                                {{-- <label for="actual-btn" id="labides" style="color: black;"></label> --}}
                                <span id="file-chosen" style="color: black">SIN ARCHIVO...</span>
                              </div>


                       
                        

                            </div>
                            
                            <button type="submit" class="btn btn-info btn-round btn-lg" id="btnnext" style="margin-left: 197px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
                        </form>


                        </div>
                             
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="card-body" style="height: 300px;">
                                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#contrato"><i class="fa fa-plus"></i></button>
                                <table class="table tablesorter " id="contratos-table">
                                    <thead class=" text-primary">
                                        <tr> 
                                        <th scope="col">NOMBRE</th>
                                        <th scope="col">USUARIO</th>
                                        <th scope="col">FECHA</th>
                                        <th></th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($contrato as $contratos)
                                        
                                        @if ($contratos->estado==0) 
                                        @if ($contratos->id_empresa==$empresa->id)
                                        <tr >
                                            <td>{{$contratos->name}}</td>
                                            <td>{{$contratos->user}}</td>
                                            <td>{{$contratos->created_at->format('d/m/Y')}}</td>
                                            <td>
                                                <button type="button" value="{{$contratos->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endif
                                      @endif
                                       
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <div class="card-body"  style="height: 300px;">
                                
                                  
                                    <form action="{{Route('Empresa.store')}}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                        <div class="col-sm-5">
                                            <label for=""><b>NOMBRE:</b></label>
                                           <div class="input-group mb-3">
                                               <div class="input-group-prepend">
                                                   <div class="input-group-text">
                                                   <i class="fas fa-address-card" style="color: black"></i>
                                               </div>
                                           </div>
                                           <input type="text" name="nombre"  autofocus class="form-control" placeholder="Nombre de la Empresa" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                       </div>
                                   </div>
                        
                                   <div class="col-sm-3 wrap-input100 validate-input m-b-18" >
                                       <label for=""><b>TELÉFONO:</b></label>
                                       <div class="input-group mb-3">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text" style="color: black">
                                                   <i class="fas fa-mobile-alt"></i>
                                               </div>
                                           </div>
                                           <input type="tel" name="telefono"  class="form-control" placeholder="Télefono">
                                       </div>
                                       <span class="focus-input100"></span>
                                   </div>
                         
                                   <div class="col-sm-3">
                                       <label for=""><b>RNC:</b></label>
                                       <div class="input-group mb-3">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text" style="color: black">
                                                   <i class="tim-icons icon-paper"></i>
                                               </div>
                                           </div>
                                           <input type="text" name="rnc" class="form-control rnc"  placeholder="RNC">
                                       </div>
                                 </div>
       
                                   <div class="col-sm-4">
                                       <label for=""><b>DIRECCION:</b></label>
                                       <div class="input-group mb-3">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text" style="color: black">
                                                   <i class="tim-icons icon-map-big"></i>
                                               </div>
                                           </div>
                                           <input type="text" name="direcion" class="form-control" placeholder="Direccion" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                       </div>
                                   </div>
       
                                   <div class="col-sm-4">
                                       <label for=""><b>EMAIL:</b></label>
                                       <div class="input-group mb-3">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text" style="color: black">
                                                   <i class="fas fa-at"></i>
                                               </div>
                                           </div>
                                           <input type="email" name="email" class="form-control" placeholder="Email" >
                                       </div>
                                   </div>
                   
                                   <div class="col-sm-4">
                                       <div class="color-wrapper">
                                         <label for=""><b>COLOR:</b></label><br>
                                         <input type="text" name="custom_color" placeholder="#FFFFFF" id="pickcolor" class="call-picker form-control" >
                                         <div class="color-holder call-picker"></div>
                                         <div class="color-picker" id="color-picker" style="display: none"></div>
                                       </div>
                                     </div>
       
                                   <div class="col-sm-4">
                                       <label for=""><b>IMAGEN:</b></label><br>
                                       <button type="button" type="button" id="btnuploa" for="actual-btn"  class="btn btn-success btn-sm"><i class="fas fa-folder-open"></i></button>
                                       <input type="file" id="actual-btn" max-file-size="1" accept=".png" name="archiveUP" hidden/>
                                       {{-- <label for="actual-btn" id="labides" style="color: black;"></label> --}}
                                       <span id="file-chosen" style="color: black">SIN ARCHIVO...</span>
                                     </div>

                                     <button type="submit" class="btn btn-info btn-round btn-lg" id="btnnext" style="margin-left: 197px; top:82px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
                                    </form>
                               

                            </div>
                        </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                      </div>
                    </div>
                  </div>
                  
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>
  
<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner logotipo">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
  </div>
    @include('Contrato.modal')
@endsection

@section('js')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>


<script>


document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});



// $("input[name='custom_color']").mask('0#');
$(".rnc").mask('0#');
$("input[type='tel']").mask('(000) 000-0000');


document.getElementById('actual-btn').onchange = function () {
  console.log(this.value);
  document.getElementById('file-chosen').innerHTML = document.getElementById('actual-btn').files[0].name;
}

$("#btnuploa").on('click',function(){
    $("#actual-btn").trigger("click");
  });
// const inputElement = document.querySelector('input[type="file"]');
// const pond = FilePond.create( inputElement );

// $("#filepond--drop-label-6ece2zz3j").change()

var colorList = [ '000000', '993300', '333300', '003300', '003366', '000066', '333399', '333333', 
'660000', 'FF6633', '666633', '336633', '336666', '0066FF', '666699', '666666', 'CC3333', 'FF9933', '99CC33', '669966', '66CCCC', '3366FF', '663366', '999999', 'CC66FF', 'FFCC33', 'FFFF66', '99FF66', '99CCCC', '66CCFF', '993366', 'CCCCCC', 'FF99CC', 'FFCC99', 'FFFF99', 'CCffCC', 'CCFFff', '99CCFF', 'CC99FF', 'FFFFFF' ];
		var picker = $('#color-picker');

		for (var i = 0; i < colorList.length; i++ ) {
			picker.append('<li class="color-item" data-hex="' + '#' + colorList[i] + '" style="background-color:' + '#' + colorList[i] + ';"></li>');
		}

		$('body').click(function () {
			picker.fadeOut();
		});

		$('.call-picker').click(function(event) {
			event.stopPropagation();
			picker.fadeIn();
			picker.children('li').hover(function() {
				var codeHex = $(this).data('hex');

				$('.color-holder').css('background-color', codeHex);
				$('#pickcolor').val(codeHex);
			});
		});
</script>
    
@endsection