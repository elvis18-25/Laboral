<tr>
    <td >TOTAL EMPLEADOS</td>
    <td class="TitleP">VISUALIZACION DE DATOS DE EMPLEADOS</td>

        @if ($permisos_widget->total_empleado==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >TOTAL USUARIOS</td>
    <td class="TitleP">VISUALIZACION DE DATOS DE USUARIOS</td>

        @if ($permisos_widget->total_usuarios==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >TOTAL DEPARTAMENTOS</td>
    <td class="TitleP">VISUALIZACION DE DATOS DE DEPARTAMENTOS</td>
        @if ($permisos_widget->total_departamentos==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >FORMAS DE PAGOS</td>
    <td class="TitleP">VISUALIZACION DE DATOS DE FORMAS DE PAGOS</td>
        @if ($permisos_widget->formas_pago==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >TOTAL ROLES</td>
    <td class="TitleP">VISUALIZACION DE DATOS DE ROLES</td>
        @if ($permisos_widget->totales_roles==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >REUNIONES PENDIENTE</td>
    <td class="TitleP">VISUALIZACION DE DATOS DE REUNIONES</td>
        @if ($permisos_widget->reuniones==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >EMPLEADOS</td>
    <td class="TitleP">GRAFICO DE EMPLEADOS</td>
        @if ($permisos_widget->w_empleados==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="7" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="7" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >DEPARTAMENTOS</td>
    <td class="TitleP">GRAFICO DE DEPARTAMENTOS</td>
        @if ($permisos_widget->w_departamentos==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >GENEROS</td>
    <td class="TitleP">GRAFICO DE GENEROS</td>
        @if ($permisos_widget->w_generos==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >GASTOS DE LA EMPRESA</td>
    <td class="TitleP">GRAFICO DE GASTO DE EMPRESA</td>
        @if ($permisos_widget->g_gasto==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >HISTORIAL DE EMPLEADOS</td>
    <td class="TitleP">VISUALIZACION DE HISTORIAL DE LOS EMPLEADOS</td>
        @if ($permisos_widget->historial==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >CALENDARIO</td>
    <td class="TitleP">VISUALIZACION DE CALENDARIO</td>
        @if ($permisos_widget->calendario==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="wingdt[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="wingdt[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>