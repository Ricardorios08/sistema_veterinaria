<script language="javascript">
function on_load()
{
document.getElementById("denominacion").focus();
document.getElementById("denominacion").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				

				case "denominacion":
				document.getElementById("domicilio").focus();
				document.getElementById("denominacion").style.backgroundColor = "#ffffff";
				document.getElementById("domicilio").style.backgroundColor = "#CCFFCC";
				break;

				case "domicilio":
				document.getElementById("puerta").focus();
				document.getElementById("domicilio").style.backgroundColor = "#ffffff";
				document.getElementById("puerta").style.backgroundColor = "#CCFFCC";
				break;
				case "puerta":
				document.getElementById("localidad").focus();
				document.getElementById("puerta").style.backgroundColor = "#ffffff";
				document.getElementById("localidad").style.backgroundColor = "#CCFFCC";
				break;
				
				case "localidad":
				document.getElementById("caracteristica_1").focus();
				document.getElementById("localidad").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_1").style.backgroundColor = "#CCFFCC";
				break;

				case "caracteristica_1":
				document.getElementById("telefono_1").focus();			
				document.getElementById("caracteristica_1").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_1").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_1":
				document.getElementById("caracteristica_3").focus();
				document.getElementById("telefono_1").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_3").style.backgroundColor = "#CCFFCC";
				break;

				
				case "caracteristica_3":
				document.getElementById("telefono_3").focus();
				document.getElementById("caracteristica_3").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_3").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_3":
				document.getElementById("email").focus();
				document.getElementById("telefono_3").style.backgroundColor = "#ffffff";
				document.getElementById("email").style.backgroundColor = "#CCFFCC";
				break;

				case "email":
				document.getElementById("cuit").focus();
				document.getElementById("email").style.backgroundColor = "#ffffff";
				document.getElementById("cuit").style.backgroundColor = "#CCFFCC";
				break;

				case "cuit":
				document.getElementById("iva").focus();
				document.getElementById("cuit").style.backgroundColor = "#ffffff";
				document.getElementById("iva").style.backgroundColor = "#CCFFCC";
				break;

				


				case "plan":
				document.getElementById("guardar").focus();
				document.getElementById("plan").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>

 


 <body background="../imagenes/logito.png" onload = "on_load ()"> 




<FORM name="form" ACTION="guardar_stock.php" METHOD = "POST">
<table width="830" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
    <td height="34" colspan="5" align="center"><strong><font color="#FFFFFF" face="Geneva, Arial, Helvetica, sans-serif">CONFIRMAR STOCK </font></strong></td>
    </tr>
  <tr align="center" bordercolor="#FFFFFF" bgcolor="#F0F0F0">
    <td width="129" align="center"><div align="right"><strong><font color="#000000" face="Arial, Helvetica, sans-serif">N&deg; FACTURA: </font>
      </strong></div></td>
    <td colspan="4" align="center"><div align="left"><strong><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="tipo_factura" id="tipo_factura" size="2" value = "<?php $tipo_fact;?>" onKeyPress="return verif_caracter(this,event)">
        -
        <input type="text" name="nro_factura" id="nro_factura" size="10" value = "<?php $nro_factura;?>"onKeyPress="return verif_caracter(this,event)">
    </font></strong></div></td>
    </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <td colspan="5" bgcolor="#666666"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
       <input type="hidden" name="id"   value="<?php echo $id;?>">

	    <input type="hidden" name="descuento"   value="<?php echo $descuento;?>">
 <input type="hidden" name="tipo_fact"   value="<?php echo $tipo_fact;?>">

	  <input type="Submit" name="guardar" id= "guardar" value="ACTUALIZAR STOCK" target = "arriba">
    </font></div></td>
  </tr>
  <tr>
    <td></td>
    <td width="299"></td>
    <td width="74"></td>
    <td colspan="2"></td>
  </tr>
</table>

<?php //include ("mostrar_detalle.php");?>

</form>

 