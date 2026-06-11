<link href="../../css/fondo.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function on_load()
{
document.getElementById("apellido").focus();
}



function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				
				case "apellido":
				document.getElementById("nombre").focus();
				break;
				case "nombre":
				document.getElementById("direccion").focus();
				break;
				case "direccion":
				document.getElementById("telefono").focus();
				break;
				case "telefono":
				document.getElementById("celular").focus();
				break;
				case "celular":
				document.getElementById("email").focus();
				break;
								case "email":
				document.getElementById("interno").focus();
				break;
								case "interno":
				document.getElementById("sector").focus();
				break;
								case "sector":
				document.getElementById("puesto").focus();
				break;

								case "puesto":
				document.getElementById("mes").focus();
				break;

								case "mes":
				document.getElementById("anio").focus();
				break;

				case "anio":
				document.getElementById("guardar").focus();
				break;
				



				
		}
		return false;
	}
	return true;
}


</script>


<style type="text/css">
<!--
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
<BODY onload = "on_load ()">
  
<FORM ACTION="../../validar/usuarios/guardar_empleado.php" method="post" TARGET = "central">


  <table width="100%" height="314" border="0">
      <tr bgcolor="#E6E6E6">
        <td height="24" colspan="2"><h3> agenda </h3></td>
      </tr>
      <tr>
        <td width="47%" height="24"><div align="right">Apellido</div></td>
        <td width="53%"><input type="text" name="apellido" size = "15" id="apellido" onKeyPress="return verif_caracter(this,event)"> </td>
    </tr>
      <tr>
        <td height="24"><div align="right">Nombre</div></td>
        <td><input type="text" name="nombre" size = "15" id="nombre" onKeyPress="return verif_caracter(this,event)"> </td>
    </tr>
      <tr>
        <td height="24"><div align="right">Direcci&oacute;n</div></td>
        <td><input type="text" name="direccion" size = "45" id="direccion" onKeyPress="return verif_caracter(this,event)"> </td>
    </tr>
      <tr>
        <td height="24"><div align="right">Telefono</div></td>
        <td><input type="text" name="telefono" size = "15" id="telefono" onKeyPress="return verif_caracter(this,event)"> </td>
    </tr>
      <tr>
        <td height="24"><div align="right">Celular</div></td>
        <td><input type="text" name="celular" size = "15" id="celular" onKeyPress="return verif_caracter(this,event)"> </td>
    </tr>
      <tr>
        <td height="24"><div align="right">E-mail</div></td>
        <td><input type="text" name="email" size = "45" id="email" onKeyPress="return verif_caracter(this,event)"> </td>
    </tr>
      <tr>
        <td height="24"><div align="right">Interno</div></td>
        <td><input type="text" name="interno" size = "4" id="interno" onKeyPress="return verif_caracter(this,event)"></td>
    </tr>
      <tr>
        <td height="24"><div align="right">Sector de Trabajo </div></td>
        <td><select name="sector[]" id="sector" onkeypress="return verif_caracter(this,event)">

          <option value="Otro">Otro</option>
		  <option value="Secretaria">Secretaria</option>
		   <option value="Recepcion">Recepcion</option>
		   <option value="Grabacion">Grabacion</option>
          <option value ="Auditoria">Auditoria</option>
          <option value ="Contaduria">Baja</option>
          <option value ="Liquidacion">Liquidacion</option>
          <option value ="Tesoreria">Tesoreria</option>
		  <option value ="Gerencia">Gerencia</option>
          <option value ="Facturacion">Facturacion</option>
		  <option value ="Proveeduria">Proveeduria</option>
  		  <option value ="Mensajeria">Mensajeria</option>
		  
		  
        </select></td>
    </tr>
      <tr>
        <td height="24"><div align="right">Puesto</div></td>
        <td><input type="text" name="puesto" size = "45" id="puesto" onKeyPress="return verif_caracter(this,event)"></td>
    </tr>
      <tr>
        <td height="24"><div align="right">Cumplea&ntilde;os</div></td>
        <td><input type="text" name="mes" size = "2" id="mes" onKeyPress="return verif_caracter(this,event)">
          /
          <input type="text" name="anio" size = "2" id="anio" onKeyPress="return verif_caracter(this,event)"></td>
    </tr>
      <tr>
        <td height="24" colspan="2">          <div align="center">
          <input type="Submit" name="bLogin" value="Guardar" id="guardar">
          </div></td>
    </tr>
  </table>
</form>

</body>