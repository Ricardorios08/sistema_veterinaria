
<?

?>
<table width="650" border="0">
  <tr bgcolor="#666666">
    <td width="9%"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"> Nº</font></strong></div></td>
    <td width="38%"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Descripcion</font></strong></div></td>
    <td width="7%"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Cantidad</font></strong></div></td>
    <td width="7%"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Agregar</font></strong></div></td>
  </tr>
  <tr bgcolor="#A0A7F5">
    <td height="26"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#006600">
        <input type = "text" name = "cod_mercaderia1" id="cod_mercaderia" size = "6"  value="<?echo $cod_mercaderia;?>" onKeyPress="return verif_caracter(this,event)">
    <!-- <a href="javascript:abrirVentan()"><img src="../../../imagenes/office/005.ico" alt="Buscar" border = "0"></a> --> </font></strong></font></div></td>
    <td><font color="#000000" size="2"><?echo $descripcion;?> - <?echo $presentacion;?>
        <input name="nro_proveedor" type="hidden" value ="<?echo $nro_proveedor;?>">
        <input name="dia" type="hidden" value ="<?echo $dia;?>">
        <input name="mes" type="hidden" value ="<?echo $mes;?>">
        <input name="anio" type="hidden" value ="<?echo $anio;?>">
        <input name="denominacion" type="hidden" value ="<?echo $denominacion;?>">
        <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
        <input name="porcentaje_dto" type="hidden" value ="<?echo $porcentaje_dto;?>">
        <input name="porcentaje_boni" type="hidden" value ="<?echo $porcentaje_boni;?>">
        <input name="periodo" type="hidden" value ="<?echo $periodo;?>">
        <input name="anio1" type="hidden" value ="<?echo $anio1;?>">
        <input name="operador" type="hidden" value ="<?echo $operador;?>">
</font></td>
    <td><div align="center"><font color="#000000" size="2">
      <input type = "text" name = "cantidad" id="cantidad"  tabindex = "2" size = "2" onKeyPress="return verif_caracter(this,event)">
    </font></div></td>
    <td><div align="center"><font color="#000000" size="2">
      <div align="center">
        <input name="Alta" type="submit" value="SI" id ="Alta" size = "10" >
      </div>    </tr>
</table>
