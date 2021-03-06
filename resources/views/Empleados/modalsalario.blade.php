  <!-- Modal -->


    <style>
    .TitlePs{
      text-align: center !important;
    }
     .table.dataTable.no-footer {
      width: 100% !important;
    }

    /* .dataTables_scrollBody{
      width: 101% !important;
    }  */

    /* .dataTables_scrollHead{
      width: 100% !important;
    }  */

     .dataTables_scrollHeadInner{
      width: 100% !important;
    }
    .dataTables_scrollBody{
      width: 102% !important;
    }

  </style>
  <div class="modal fade" id="salariosbase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>DETALLE DEL SUELDO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table azules" id="salarioTable" style="width: 100% !important;">
                <thead>
                  <tr>
                    <th>DESCRIPCION</th>
                    <th class="TitlePs">FECHA</th>
                    <th class="TitlePs">USUARIO</th>
                    <th class="TitlePs">MONTO</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $user=Auth::user()->name;
                  @endphp
                    <tr>
                      <td>SUELDO BASE</td>
                      <td  style="text-align: center;">{{$empleados->created_at->format('d/m/Y')}}</td>
                      <td  style="text-align: center;">{{$user}}</td>
                      <td style="text-align: center;">${{number_format($empleados->salario,2)}}</td>
                    </tr>
                    
                    @php
                        $sum=0;
                    @endphp
                    @foreach ($sueldo as $sueldos)
                    
                    @php
              
                        $sum=$sueldoMonto->amount;
                        @endphp
                    <tr action="{{$sum}}" onclick="ModalSalarioshow({{$sueldos->id}})">
                      <td>{{$sueldos->description}}</td>
                      <td style="text-align: center;">{{$sueldos->created_at->format('d/m/Y')}}</td>
                      <td style="text-align: center;">{{$sueldos->user}}</td>
                      <td style="text-align: center;">${{number_format($sueldos->sueldo_increment,2)}}</td>
                    </tr>
                    @endforeach
                   
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" data-toggle="modal" data-target="#modalsalario" id="btnwssswa" class="btn btn-info redondo"><i class="fas fa-plus" style="margin-left: -1px;"></i></button>
          <b class="totalsueldo">TOTAL:</b><b><span id="totalsalario" style="margin-right: 53px;">&nbsp;${{number_format($sum+$empleados->salario,2)}}</b></span>
        </div>
      </div>
    </div>
  </div>



  <script>

  </script>