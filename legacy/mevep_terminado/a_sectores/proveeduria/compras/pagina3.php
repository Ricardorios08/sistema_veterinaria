
<table width="860" border="0">
  <tr bgcolor="#E8DCFC">
    <td width="28%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"> Nº</font></div></td>
    <td width="30%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descripcion</font></div></td>
    <td width="8%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Lote</font></div></td>
    <td width="18%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Mes - A&ntilde;o </font></div></td>
    <td width="4%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Pr. Unit</font></div></td>
    <td width="6%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cantidad</font></div></td>
    <td width="6%" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Agregar</font></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td height="26" bgcolor="#EDEDED"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#006600">
        <input type = "text" name = "cod_mercaderia1" id="cod_mercaderia" size = "40"  value="<?php echo $cod_mercaderia;?>" onKeyPress="return verif_caracter(this,event)">
    <!-- <a href="javascript:abrirVentan()"><img src="../../../imagenes/office/005.ico" alt="Buscar" border = "0"></a> --> </font></strong></font></div></td>
    <td bgcolor="#EDEDED"><font color="#000000" size="2"><?php echo $descripcion;?> - <?php echo $presentacion;?>
        <input name="nro_proveedor" type="hidden" value ="<?php echo $nro_proveedor;?>">
        <input name="dia" type="hidden" value ="<?php echo $dia;?>">
        <input name="mes" type="hidden" value ="<?php echo $mes;?>">
        <input name="anio" type="hidden" value ="<?php echo $anio;?>">
        <input name="denominacion" type="hidden" value ="<?php echo $denominacion;?>">
        <input name="nro_factura" type="hidden" value ="<?php echo $nro_factura;?>">
        <input name="porcentaje_dto" type="hidden" value ="<?php echo $porcentaje_dto;?>">
        <input name="porcentaje_boni" type="hidden" value ="<?php echo $porcentaje_boni;?>">
        <input name="periodo" type="hidden" value ="<?php echo $periodo;?>">
        <input name="anio1" type="hidden" value ="<?php echo $anio1;?>">
        <input name="operador" type="hidden" value ="<?php echo $operador;?>">
</font></td>
    <td bgcolor="#EDEDED"><div align="center"><font color="#000000" size="2">
        <input type = "text" name = "lote" id="lote" size = "10" onKeyPress="return verif_caracter(this,event)">
    </font></div></td>
    <td bgcolor="#EDEDED"><div align="center"><font color="#000000" size="2">
        <input type = "text" name = "mes_lote" id="mes_lote" size = "2" onKeyPress="return verif_caracter(this,event)" >
/</font><font color="#000000" size="2">
        20
        <input name = "anio_lote" type = "text" id="anio_lote" onKeyPress="return verif_caracter(this,event)" size = "2" maxlength="2" >
</font></div>      </td>
    <td bgcolor="#EDEDED"><div align="center"><font color="#000000" size="2">
        <input type = "text" name = "precio_unitario" id="precio_unitario" size = "5" value = "<?php echo number_format($precio_actualizado,2);?>"onKeyPress="return verif_caracter(this,event)" >



    </font></div></td>
    <td bgcolor="#EDEDED"><div align="center">
      <input type = "text" name = "cantidad" id="cantidad"  tabindex = "2" size = "2" onKeyPress="return verif_caracter(this,event)">
    </div></td>
    <td bgcolor="#EDEDED"><div align="center">

      <input name="Alta" type="submit" value="SI" id ="SI" size = "10" >
    </div></td>
  </tr>
</table>
