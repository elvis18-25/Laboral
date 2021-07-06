  <!-- Modal -->
  <div class="modal fade" id="Empleadomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 144%; margin-left: -98px; margin-top: -162px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>EMPLEADOS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table tablesorter table-striped tablesemples table-hover"  id="Empleadotable">
                <thead class=" text-primary" style="color: black !important">
                    <tr> 
                    <th class="nametd">NOMBRE</th>
                    <th class="cedulatd">CEDULA</th>
                    <th class="cargotd">CARGO</th>
                    <th class="TitlePer">DEPARTAMENTO</th>
                    <th class="TitlePer">SALARIO</th>
                  </tr>
                </thead>
                @php
                    $empresa=Auth::user()->id_empresa;
                @endphp
                <tbody>
                  @foreach ($empleados as $empleado)
                    @if ($empleado->estado==0)
                    @if ($empleado->id_empresa==$empresa)
                      <tr onclick="AddGroup('{{url('agregarEmpleado',[$empleado->id_empleado])}}',{{$empleado->id_empleado}});" action="{{url('agregarEmpleado',[$empleado->id_empleado])}}" value="{{$empleado->id_empleado}}" >
                        <td class="left">{{$empleado->nombre." ".$empleado->apellido}}</td>
                        <td class="left">{{$empleado->cedula}}</td>
                        <td class="left">{{$empleado->cargo}}</td>
                        <td class="left">
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
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

