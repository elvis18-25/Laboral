
  <div class="modal fade" id="Edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" width: 964px; margin-top: -174px; height: 615px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black font-size: 16px !important; font-weight: bold !important;"><b>USUARIOS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <div style=" max-height:512px; overflow:auto; font-size:small; top:-12px; "> --}}
            <table class="table tablesorter " style="color: black !important" id="Empleadotable-edit">
                <thead class=" text-primary">
                  <tr> 
                    <th class="TitlePer">NOMBRE</th>
                    <th class="TitlePer">CEDULA</th>
                    <th class="TitlePer">CARGO</th>
                    <th class="TitlePer">DEPARTAMENTO</th>
                    <th class="TitlePer">SALARIO</th>
                  </tr>
                </thead>
                @php
                    $empresa=Auth::user()->id_empresa;
                @endphp
                <tbody>
                  @foreach ($users as  $user)
                    @if ($user->estado==0)
                    @if ($user->id_empresa==$empresa)
                      <tr onclick="AddUser('{{url('agregarUsuarioEdit',[$user->id])}}',{{$user->id}});" action="{{url('agregarUsuarioEdit',[$user->id])}}" value="{{$user->id}}" >
                        <td class="left">{{$user->name." ".$user->apellido}}</td>
                        <td class="left">{{$user->cedula}}</td>
                        <td class="left">{{$user->cargo}}</td>
                        <td class="left">
                    
                                @foreach ($user->puestoU as $puesto)
                                    {{$puesto->name}}
                                @endforeach
                            
                        </td>
                        <td>${{number_format($user->salario,2)}}</td>
                      </tr>
                      @endif
                      @endif
                  @endforeach
                </tbody>
            </table>
          {{-- </div> --}}
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  <style>
    .display{
      margin-left: 0px;
      width: 844px !important;
    }
    .dataTables_scrollBody{
      width: 104% !important;
      position: relative !important;
      overflow: auto !important;
      max-height: 449px !important;
      height: 473px !important;
    }
    .dataTables_scrollHeadInner{
      box-sizing: content-box !important;
    width: 860px !important;
    padding-right: 17px !important;
    }

    .table-striped{
      width: 935px !important;
    margin-left: 0px !important;
    }
    .dataTables_scrollHead{
      overflow: hidden !important;
    position: relative !important;
    border: 0px !important;
    width: 100% !important;
    }

    #Empleadotable-edit tbody tr{
      cursor: pointer;
    }

    .left{
      text-align: left;
      font-size: 14px;
    }
  </style>
  