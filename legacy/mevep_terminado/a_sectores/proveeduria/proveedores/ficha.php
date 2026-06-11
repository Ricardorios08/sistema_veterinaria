<script language="javascript">
function on_load()
{
document.getElementById("cuenta").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cuenta":
				document.getElementById("denominacion").focus();
				break;
				case "denominacion":
				document.getElementById("contacto").focus();
				break;
				case "contacto":
				document.getElementById("domicilio").focus();
				break;
				case "domicilio":
				document.getElementById("puerta").focus();
				break;
				case "puerta":
				document.getElementById("referencia").focus();
				break;
				case "referencia":
				document.getElementById("localidad").focus();
				break;
				case "localidad":
				document.getElementById("cod_postal").focus();
				break;
				case "cod_postal":
				document.getElementById("caracteristica_1").focus();
				break;

				case "caracteristica_1":
				document.getElementById("telefono_1").focus();
				break;
				case "telefono_1":
				document.getElementById("caracteristica_2").focus();
				break;

				case "caracteristica_2":
				document.getElementById("telefono_2").focus();
				break;
				case "telefono_2":
				document.getElementById("caracteristica_3").focus();
				break;
				case "caracteristica_3":
				document.getElementById("telefono_3").focus();
				break;
				case "telefono_3":
				document.getElementById("email").focus();
				break;
				case "email":
				document.getElementById("cuit").focus();
				break;
				case "cuit":
				document.getElementById("tipo_iva").focus();
				break;
				case "tipo_iva":
				document.getElementById("ing_bruto").focus();
				break;
				case "ing_bruto":
				document.getElementById("nro_ib").focus();
				break;
				case "nro_ib":
				document.getElementById("pago_orden").focus();
				break;
				
				
				case "pago_orden":
				document.getElementById("observaciones").focus();
				break;
				case "observaciones":
				document.getElementById("guardar").focus();
				break;
				
		}
		return false;
	}
	return true;
}


</script>
<?php $hoy = date("d/m/y");

$cuenta = $_REQUEST['cuenta'];
include ("variables.php");
?>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); on_load ();">

<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="31" colspan="3"><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>FICHA PROVEEDOR </strong><font size="2">- Emitido el: <?php echo $hoy;?> </font></font></td>
  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td colspan="3"><hr noshade></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td width="36%"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Numero de Cuenta</font>
      </div></td>
      <td width="64%" colspan="2">        <div align="left"></div>        <?php echo $cuenta;?></td></tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Raz&oacute;n social o Apellido y Nombre</font> </div></td>
      <td colspan="2"><?php echo $denominacion;?>     </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Nombre</font> <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">del Contacto</font></div></td>
      <td colspan="2"><?php echo $contacto;?>        </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Calle</font></div></td>
      <td colspan="2"> <?php echo $domicilio;?>     </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Nro</font> </div></td>
      <td><?php echo $puerta;?></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Referencia</font></div></td>
      <td><?php echo $referencia;?></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad</font></div></td>
      <td colspan="2">  <?php print("$localidad");?>    </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo Postal </font></div></td>
      <td colspan="2"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><?php echo $cuenta;?></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(1)</font></div></td>
      <td colspan="2">    <?php echo $caracteristica_1;?>  <?php echo $telefono_1;?>    <font size="2" face="Arial, Helvetica, sans-serif">      (Fijo)</font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(2)</font></div></td>
      <td colspan="2"><?php echo $caracteristica_2;?> <?php echo $telefono_2;?> <font size="2" face="Arial, Helvetica, sans-serif"> (Fijo)</font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(3)</font></div></td>
      <td colspan="2"><?php echo $caracteristica_3;?> <?php echo $telefono_3;?> <font size="2" face="Arial, Helvetica, sans-serif"> (Celular)</font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td height="24"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Email</font></div></td>
      <td colspan="2"><?php echo $email;?>   </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td height="24" colspan="3"><div align="right"></div>        
      <div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><strong>INSCRIPCIONES</strong></font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td colspan="3" bgcolor="#FFFFFF"><hr noshade></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo de IVA</font><strong></strong></div></td>
      <td colspan="2"><strong><?php print("$tipo_iva");?> </strong></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nro Cuit</font></div></td>
      <td colspan="2"><strong>
 <?php echo $cuit;?>        </strong></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Convenio</font></div></td>
      <td colspan="2">
  <?php print("$ing_bruto");?>               <strong>
      </strong> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nro Ingresos Brutos </font></div></td>
      <td colspan="2"><strong><?php echo $nro_ib;?></strong></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Pago a la orden de: </font></div></td>
      <td colspan="2"><strong>
  <?php echo $pago_orden;?>    </strong></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Observaciones</font></div></td>
      <td colspan="2"><strong>
   <?php echo $observaciones;?>   </strong></td>
    </tr>
</table>
