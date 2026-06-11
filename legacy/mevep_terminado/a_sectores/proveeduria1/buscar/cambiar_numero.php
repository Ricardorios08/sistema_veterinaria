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

<?echo $forma_pago= $_REQUEST['forma_pago'];?>

<BODY onload = "on_load ()">
<form action ="cambiara.php" method="post" target ="central">
  <table width="698" border="0">
    <tr bgcolor="#000099">
      <td height="34" colspan="3"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>Cambiar N&uacute;mero de Factura de Proveeduria</strong></font></div></td>
    </tr>
    <tr bgcolor="#E1F2EF">
      <td width="163" rowspan="3"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><img src="../../../imagenes/calculadora.gif" width="148" height="146">
      </font></div></td>
      <td width="191">
        <div align="right"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"> N&ordm; Factura Anterior         </font>
  
              </div></td>
      <td width="494"><font color="#FF0000" size="4" face="Arial, Helvetica, sans-serif"><?echo $nro_factura = $_REQUEST['nro_factura'];?> - <?echo $tipo_fact = $_REQUEST['tipo_fact'];?></font>      </td>
    </tr>
    <tr bgcolor="#E1F2EF">
      <td><div align="right"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Factura Nuevo<font color="#FFFFFF">....</font></font> </div></td>
      <td><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif">

		<input type = "text" name = "nro_factura_nuevo" size = "5" id ="nro_factura_nuevo" onkeypress="return verif_caracter(this,event)">

		<input name = "tipo_fact_nuevo" type = "text"  size = "5" id ="tipo_fact_nuevo" value = "<?echo $tipo_fact;?>">

		 <input name = "tipo_fact" type = "hidden" value = "<?echo $tipo_fact;?>">
 		 <input name = "nro_factura" type = "hidden" value = "<?echo $nro_factura;?>">
	 <input name = "forma_pago" type = "hidden" value = "<?echo $forma_pago;?>">
		  

</font><font size="2" face="Arial, Helvetica, sans-serif">
<input type = "submit" name = "ok" value = "Cambiar" onclick="return confirm('¿Está seguro de Cambiar este Nº Factura?');">
</font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;

</font><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;      </font></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#E6E6E6"><div align="justify"><font size="2"><em><font color="#006600" face="Arial, Helvetica, sans-serif">ESTA OPERACION CAMBIARA EL NUMERO DE FACTURA PARA LOS CASOS EN QUE SE HAYA COMETIDO UN ERROR EN LA IMPRESION. </font></em></font></div></td>
    </tr>
  </table>
</form>
</body>