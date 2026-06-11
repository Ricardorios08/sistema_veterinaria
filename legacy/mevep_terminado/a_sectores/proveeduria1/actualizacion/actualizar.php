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
<?$hoy = date("d/m/y");

include ("../../../conexiones/config_pro.php");
$sql="select * from proveedores ORDER BY cuenta DESC";
$result = $db->Execute($sql);
 $cuenta=($result->fields["cuenta"] + 1);
?>
<BODY background="../../..//imagenes/logito.png" onload = "on_load ()">
<FORM name="form" ACTION="realizar_actualizacion.php" METHOD = "POST">
<table width="650" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#999999"> 
      <td height="31" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>ACTUALIZAR PRECIOS </strong></font></td>
  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td bgcolor="#A0A7F5">        
        <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
        </font></div>        
        <div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Modalidad</font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font>
      </div></td> 
      <td bgcolor="#A0A7F5"><font size="2" face="Arial, Helvetica, sans-serif">
&nbsp;&nbsp;&nbsp;&nbsp;Valor
    <input name="modalidad" type="radio" value="VAL">
    Porcentaje 
<input name="modalidad" type="radio" value="PORC" checked>
      </font></td>
  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Operaci&oacute;n&nbsp;</font></div></td>
      <td bgcolor="#A0A7F5"><font size="2" face="Arial, Helvetica, sans-serif">
&nbsp;&nbsp;Sumar
    <input name="operacion" type="radio" value="SUMA" checked>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Restar
<input name="operacion" type="radio" value="RESTA">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Alicuota&nbsp;</font></div></td>
      <td bgcolor="#A0A7F5"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="text" size = "7" name="alicuota" id="alicuota5" onKeyPress="return verif_caracter(this,event)">
% </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#999999">
      <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#FFFFFF">ACTUALIZAR POR: </font></strong></font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#9FE1BB"> 
      <td><div align="right"></div>        
        
        <div align="center">
          <font size="2" face="Arial, Helvetica, sans-serif">
      <input name="actualiza" type="radio" value="ind" checked>
      INDIVIDUAL </font></div></td>
      <td>
        <div align="center">
          <font size="2" face="Arial, Helvetica, sans-serif">
    <input name="actualiza" type="radio" value="ran">
    RANGO 
          
      </font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#9FE1BB">
      <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Ingrese N&ordm; Mercaderia</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>
          <input type="text" size = "7" name="cod_mercaderia" id="cod_mercaderia2" onKeyPress="return verif_caracter(this,event)">
          <input type="Submit" name="Submit3" value="BUSCAR" id = "Submit3">
      </strong></font></div></td>
      <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Ingrese N&ordm; Proveedor<strong>
          <input type="text" size = "7" name="cod_proveedor" id="cod_proveedor" onKeyPress="return verif_caracter(this,event)">
          <input type="Submit" name="Submit32" value="BUSCAR" id = "Submit33">
      </strong></font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#9FE1BB">
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
      </strong></font></div></td>
      <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Ingrese  Mercaderia desde</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="text" size = "4" name="desde" id="desde2" onKeyPress="return verif_caracter(this,event)">
        </strong>hasta<strong>
        <input type="text" size = "4" name="hasta" id="hasta" onKeyPress="return verif_caracter(this,event)">
      </strong></font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#CCCCCC">
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
          <input type="Submit" name="Submit" value="ACTUALIZAR" id = "Submit4">
      </strong></font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
          <input type="Submit" name="Submit2" value="ACTUALIZAR" id = "Submit22">
      </strong></font></div></td>
  </tr>
</table>
