@php
    $user=Auth::user()->id_empresa;
    $cont=0;
    $p=0;
    $b=0;
@endphp

@foreach ($NominaAsigna as $NominaAsignas)
@if ($NominaAsignas->tipo_asigna=="INCREMENTO"  && $NominaAsignas->id_empresa==$user && $NominaAsignas->estado==0)
    @if ($p==0)

    <tr>
        <td >{{$NominaAsignas->nombre}}</td>
        <td style="text-align: center;">{{$NominaAsignas->tipo}}</td>

        @if ($NominaAsignas->tipo=="PORCENTAJE")
        @php
         $cont=$NominaAsignas->montos*$empleado->salarioBruto;
         $cont=$cont/100;
   @endphp
        <td style="text-align: center;" >{{$NominaAsignas->montos}}%</td>

        @else
        <td style="text-align: center;" >${{number_format($NominaAsignas->montos,2)}}</td>
  
        @endif
        <td style="text-align: right;" >${{number_format($cont,2)}}</td>

        <td style="text-align: center;" >{{$NominaAsignas->created_at->format('d/m/Y')}}</td>

        @if ($NominaAsignas->estado_asigna==1 )
        <td>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" onclick="switchetssbono('{{url('switchetssbonoListado',[$NominaAsignas->id])}}',{{$empleado->id_empleado}})" type="checkbox" id="customSwitch1{{$NominaAsignas->id}}"  >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
              @php
                  $b=1;
              @endphp
              @break
        </td>
        @endif

        @if ($b==0)
        <td>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" onclick="switchetssbono('{{url('switchetssbonoListado',[$NominaAsignas->id])}}',{{$empleado->id_empleado}})" type="checkbox" checked id="customSwitch1{{$NominaAsignas->id}}" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>   
        @endif
    </tr>
    @php
        $p=1;
    @endphp
    @endif
@endif
@endforeach
 


