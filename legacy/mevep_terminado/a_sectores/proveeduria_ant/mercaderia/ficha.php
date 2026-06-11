
<?php  $cod_merca= $_REQUEST['cod_merca'];
include ("variables.php");
?>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); on_load ();">


  <table width="850" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="34" colspan="2"><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>FICHA DE MERCADERIA</strong><font size="2"> 
	   </font></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td colspan="2"><hr noshade></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td width="43%"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo</font>
      </div></td>
      <td width="57%"><font size="2" face="Arial, Helvetica, sans-serif">
    <?php  echo $cod_merca; ?>  
      </font>        <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font> </div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?php  echo $nombre; ?>  </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
      <td><?php print("$denominacion");?></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo moneda </font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$tipo");?> </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Precio Actualizado </font> </div>        <div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"></font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif">
  <?php  echo $precio_actualizado; ?>  </font>    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tasa</font></div></td>
    <td>
   <?php print("$por_iva1");?> </tr>
</table>
