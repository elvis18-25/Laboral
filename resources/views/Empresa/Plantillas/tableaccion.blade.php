<tr>
    <td>CALCULAR HORAS</td>
    <td class="TitleP">OPCION PARA CALCULAR LAS HORAS POR DEFECTO</td>

        @if ($permisos_acciones->calcular_horas==1) 
        <td class="TitleP" value={{1}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="acciones{{1}}" checked type="checkbox" name="accion[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{1}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="acciones{{1}}" type="checkbox" name="accion[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >IMPRIMIR GASTOS</td>
    <td class="TitleP">SE PODRA IMPRIMIR LOS GASTOS DE LA EMPRESA</td>

        @if ($permisos_acciones->imprimir_gastos==1) 
        <td class="TitleP"  value={{2}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="acciones{{2}}" checked type="checkbox" name="accion[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{2}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="acciones{{2}}"  type="checkbox" name="accion[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>

