
<? $cod_merca= $_REQUEST['cod_merca'];
include ("variables.php");
?>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); on_load ();">


  <table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="34" colspan="2"><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>FICHA DE MERCADERIA</strong><font size="2"> - Emitido el: <?echo $hoy;?>
	   </font></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td colspan="2"><hr noshade></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td width="26%"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo</font>
      </div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif">
    <? echo $cod_merca; ?>  
      </font>        <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descripci&oacute;n</font> </div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $descripcion; ?>  </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre Comercial </font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $nombre; ?>   </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo</font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?print("$tipo");?> </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Presentaci&oacute;n</font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif">
<? echo $presentacion; ?> (unidades y magnitud) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factor de Conversión </font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $factorconver; ?>  </font>    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cadena de frio </font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cadenafrio");?>  </font>    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
      <td>    
  <?print("$denominacion");?>  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fabricante</font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif">
  <? echo $fabricante; ?>  </font>    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tasa</font></div></td>
    <td>
   <?print("$cod_tasa");?> </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Margen diferencial </font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif">
 <? echo $margendif; ?>     (Previo al precio de lista) 
    </font></tr>
  </table>
