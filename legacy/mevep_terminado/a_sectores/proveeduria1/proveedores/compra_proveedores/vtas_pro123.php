<script language="javascript">
function on_load()
{
document.getElementById("nro_proveedor").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	
	{
		switch(obj.id)
		{
				case "nro_proveedor":
				document.getElementById("fecha").focus();
				break;
				case "fecha":
				document.getElementById("factura").focus();
				break;
				case "factura":
				document.getElementById("porcentaje_boni").focus();
				break;
				case "porcentaje_boni":
				document.getElementById("porcentaje_dto").focus();
				break;
				case "porcentaje_dto":
				document.getElementById("cod_merca").focus();
				break;
				case "cod_merca":
				document.getElementById("presentacion").focus();
				break;
				case "presentacion":
				document.getElementById("lote").focus();
				break;
				case "lote":
				document.getElementById("vto_lote").focus();
				break;
				case "vto_lote":
				document.getElementById("precio_unitario").focus();
				break;
				case "precio_unitario":
				document.getElementById("cantidad").focus();
				break;
				
				
				
		}
		return false;
	}
	return true;
}


</script>

<html>
<BODY onload = "on_load ()">


<!-- <FORM ACTION="guardar_vtas_pro.php"<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">-->
<!--  <form action="guardar_vtas_pro.php" method="post">-->

<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

  
   
   <?php
include ("../../../../conexiones/config_pro.php");

$sql1="select * from mercaderia ORDER BY cod_merca";
$result1 = $db->Execute($sql1);
?>



<div align="center"></div>
<table width="621" border="1" bordercolor="#FFFFFF">
  <tr bordercolor="#333333" bgcolor="#993300">
    <td height="36" colspan="2" align="left"><div align="center"><font color="#FFFFCC" size="6"><strong>Compras  Proveeduria </strong></font></div></td>
  </tr>
  <tr>
    <td width="404" align="left"><div align="center">
      <table width="380" border="0">
          <tr bgcolor="#006699">
            <td height="23" colspan="2"><div align="center"><strong><font color="#FFFFCC">Ingreso de Datos</font></strong> </div></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
            <td width="172" bgcolor="#FFFFCC">
              <div align="left">
                <input type = "text" name = "nro_proveedor" id="nro_proveedor" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['nro_proveedor']))   echo $_REQUEST['nro_proveedor'];?>">
                <font color="#FF0000" size="3"><strong>
                <?
	  echo $bioquimico;
	  ?>
</strong></font></div>                </td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td width="171" height="25" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font></div></td>
            <td><font color="#000000" size="2">
              <input type="text" name="fecha" id="fecha"  size="20" onKeyPress="return verif_caracter(this,event)">
            </font></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td height="25" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factura</font></div></td>
            <td><input type="text" name="factura" id="factura"  size="20" onKeyPress="return verif_caracter(this,event)"></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Porcentaje de bonificacion </font></div></td>
            <td bgcolor="#FFFFCC"><input type="text" name="porcentaje_boni" id="porcentaje_boni"  size="20" onKeyPress="return verif_caracter(this,event)"></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td height="25" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Porcentaje de Descuento</font></div></td>
            <td><input type="text" name="porcentaje_dto" id="porcentaje_dto"  size="20" onKeyPress="return verif_caracter(this,event)"></td>
          </tr>
        </table>
        <table width="380" border="0">
          <tr bgcolor="#006699">
            <td colspan="4" align="left"><div align="center"><strong></strong></div></td>
          </tr>
          <tr bgcolor="#E0EDF3">
            <td width="159" height="25" align="left" bgcolor="#E0EDF3"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo de Mercanderia </font></div></td>
            <td width="203" colspan="2" bgcolor="#E0EDF3">
              <div align="left">
                <strong><font color="#006600">                
                <input type = "text" name = "cod_merca" id="cod_merca" size = "4" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['cod_merca']))   echo $_REQUEST['nombre'];?>">
                <?

$cod_merca = $_REQUEST['cod_merca'];
include ("../../../../conexiones/config_pro.php");

	if (is_numeric($cod_merca))  {
$sql="select * from mercaderia where cod_merca = '$cod_merca%'";
$result = $db->Execute($sql);

								}
	else {
$sql = "select * from mercaderia where nombre = '$nombre%'";
$result = $db->Execute($sql);
	

		}
		
		$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());





$nombre=ucwords($result->fields["nombre"]);
$cod_merca=ucwords($result->fields["cod_merca"]);



if ($cod_merca == ""){
	?>
                <font color="#FF0000"><?echo "No existe esa mercaderia ".$cod_merca." ";?></font>
                <?
}

else{
?>
                <font color="#006633"><strong><strong><font color="#006633"><strong><strong> <font color="#006633"><strong><strong><strong><?echo $nombre." (".$cod_merca.")";?></strong></strong></strong></font></strong></strong></font></strong></strong></font> </font></strong></div></td>
          </tr>
          <!--  trae el nombre de la mercaderia --><tr bgcolor="#E0EDF3">
      <td height="26" valign="top"><div align="right"><font color="#000000"><font size="2" face="Arial, Helvetica, sans-serif">Presentacion </font></font> </div>
      <td height="26" valign="top"><font color="#000000" size="2">
      <input type = "text" name = "presentacion" id="presentacion" size = "10" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['presentacion'])) echo $_REQUEST['presentacion'];?>">
      </font>
      <tr bgcolor="#E0EDF3">
      <td height="26" valign="top"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Lote </font><font color="#000000"></font> </div>
      <td height="26" valign="top"><font color="#000000" size="2">
      <input type = "text" name = "lote" id="lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['lote'])) echo $_REQUEST['lote'];?>">
      </font>
      <tr bgcolor="#E0EDF3">
      <td height="26" valign="top" bgcolor="#E0EDF3"><div align="right"><font color="#000000">Vencimiento del lote</font>                    
      </div>
      <td height="26" valign="top"><font color="#000000" size="2">
      <input type = "text" name = "vto_lote" id="vto_lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['vto_lote'])) echo $_REQUEST['vto_lote'];?>">
      </font>                    
      <tr bgcolor="#E0EDF3">                                                       <td height="26" valign="top" bgcolor="#E0EDF3"><div align="right"><font color="#000000"><font size="2" face="Arial, Helvetica, sans-serif">Precio Unitario</font></font>  </div>
      <td height="26" valign="top"><font color="#000000" size="2">
      <input type = "text" name = "precio_unitario" id="precio_unitario" size = "10" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['precio_unitario'])) echo $_REQUEST['precio_unitario'];?>">
      </font>
              
		  
			  <?
}

$precio_unitario = $_REQUEST['precio_unitario'];
include ("../../../../conexiones/config_pro.php");

	if (is_numeric($precio_unitario))  {
$sql="select * from compras_proveeduria where precio_unitario = '$precio_unitario'";
$result = $db->Execute($sql);

							}
	else {
$sql = "select * from compras_proveeduria where precio_unitario like '$precio_unitario'";
$result = $db->Execute($sql);
		}
		
		$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());

$precio_unitario=ucwords($result->fields["precio_unitario"]);
echo$precio_unitario=ucwords($result->fields["precio_unitario"]);

?>                                                                                                                    
        </table>
        <div align="center"><br>
        Ingrese cantidad del producto 
        <input type = "text" name = "cantidad" id="cantidad"  size = "15" > 
                  <input name="Alta" type="submit" value="1" id ="Alta" size = "10" > <br>
       
				  <br>
      </div>
        </div></td>
	
	
	<td width="227" valign="top">
	  <div align="center"></div>
      <div align="center"></div>
    <div align="center">
      <table width="227" height="163" border="0">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
          <th width="31" scope="col"><div align="center"><font color="#FFFFFF">N&ordm; </font></div></th>
          <th width="114" bgcolor="#006699" scope="col"><div align="center"><font color="#FFFFCC">Mercaderia</font></div></th>
          <th width="68" scope="col"><div align="center"><font color="#FFFFCC">Eliminar</font></div></th>
        </tr>
 

        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td bgcolor="#FFFFCC"><?echo $cod_merca;?></td>
          <td bgcolor="#FFFFCC"><?print $nombre;?></td>
          <td bgcolor="#FFFFCC"><div align="center">
		  <a href="borra.php?
		             &cod_merca=<?print("$cod_merca");?>
	   	             &nombre=<?print("$nombre");?>
		                                                  ">[OK]</a></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#006699">
		    <td colspan="3">&nbsp;</td>
	      </tr>
			<tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
         
          <td height="21" colspan="2" bgcolor="#CCCC99"><div align="center"></div>            <div align="left">NETO GRABADO </div></td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $neto_grabado;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="21" colspan="2" bgcolor="#CCCC99">IVA</td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $iva;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="21" colspan="2" bgcolor="#CCCC99">PERCEPCION</td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $percepcion;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td colspan="2" bgcolor="#CCCC99">TOTAL</td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $total;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
     
      </table>
      <div align="right"><a href="imprimir.php?fecha=<?print("$fecha");?>  && nro_laboratorio=<?print("$nro_laboratorio");?> && operario=<?print("$operario");?>&& observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">IMPRIMIR</a> </div>
    </div></td>
  </tr>
</table>
<div align="right"></div>
<div align="center"></div>