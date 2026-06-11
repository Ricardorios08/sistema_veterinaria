<script language="javascript">
function on_load()
{
document.getElementById("nro_factura_nuevo").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				

				case "nro_factura_nuevo":
				document.getElementById("tipo_fact_nuevo").focus();
				break;



		}
		return false;
	}
	return true;
}



</script>

<BODY onload = "on_load ()">
<form action ="limpiar.php" method="post" target ="central">
  <table width="698" border="0">
    <tr bgcolor="#000099">
      <td height="34" colspan="3"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>Limpiar Registro de Facturaci&oacute;n </strong></font></div></td>
    </tr>
    <tr bgcolor="#E1F2EF">
      <td width="163" rowspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><img src="../../../imagenes/calculadora.gif" width="148" height="146">
      </font></div></td>
      <td width="191"><div align="right"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Factura a Limpiar <font color="#FFFFFF">....</font></font> </div></td>
      <td width="494"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif">

		<input type = "text" name = "nro_factura" size = "5" id ="nro_factura" onkeypress="return verif_caracter(this,event)">

	    </font><font size="2" face="Arial, Helvetica, sans-serif">
<input type = "submit" name = "ok" value = "Limpiar">
</font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;

</font><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;      </font></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#E6E6E6"><div align="justify">
        <p><font size="2"><em><font color="#006600" face="Arial, Helvetica, sans-serif">ESTA OPERACION LIMPIARA EL REGISTRO DE ORDENES GRABADAS, CUANDO UNA FACTURA ES CANCELADA EN EJECUCION. ES DECIR CUANDO SE INTERRUMPE YA SEA POR CORTE AUTOMATICO (LUZ) O CORTE POR ERROR.</font></em></font></p>
        <p><em><font color="#006600" size="2" face="Arial, Helvetica, sans-serif">Este proceso vuelve a vacio las tablas de composicion, ordenes grabadas, factura </font></em></p>
      </div></td>
    </tr>
  </table>
</form>
</body>