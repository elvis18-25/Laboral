
  <div class="modal fade" id="emplados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 909px; margin-top: -110px; height: 544px;" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">EMPLEADO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div style=" max-height: 435px;font-size: small; top: -12px; overflow-y: auto;
          overflow-x: hidden; ">
                        {{-- <div class="class="display " style="width: 100""></div> --}}

            <table class="table tablesorter table-striped table-hover " style="width: 100" id="Empleadotable" style=" width: 844px !important;">
                <thead class=" text-primary" style="color: black !important">
                    <tr> 
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CEDULA</th>
                    <th scope="col">CARGO</th>
                    <th scope="col">DEPARTAMENTO</th>
                    <th scope="col">SALARIO</th>
                  </tr>
                </thead>
                @php
                    $empresa=Auth::user()->id_empresa;
                @endphp
                <tbody>
                  @foreach ($empleados as $empleado)
                    @if ($empleado->estado==0)
                    @if ($empleado->id_empresa==$empresa)
                      <tr onclick="Add({{$empleado->id_empleado}});" value="{{$empleado->id_empleado}}" >
                        <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
                        <td>{{$empleado->cedula}}</td>
                        <td>{{$empleado->cargo}}</td>
                        <td>
                          @foreach ($empleado->puesto as $puesto)
                              {{$puesto->name}}
                          @endforeach
                        </td>
                        <td>${{number_format($empleado->salario,2)}}</td>
                      </tr>
                      @endif
                      @endif
                  @endforeach
                </tbody>
            </table>
          </div>
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
    }

    #Empleadotable tbody tr{
      cursor: pointer;
    }
  </style>