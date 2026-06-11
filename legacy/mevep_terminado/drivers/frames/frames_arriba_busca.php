<script language="javascript">
function on_load()
{
document.getElementById("busca").focus();
}

function salta()
{
document.getElementById("busca").focus();
}

}





</script>

<head>


</head>
<BODY onload = "on_load()" background="../../IMAGENES/fondo.jpg">
<form action="../../validar/buscador.php" method="post" target ="central">
<table width="649" border="0">
  <tr>
    <!-- <td width="308" rowspan="2"><div align="left"><font color="#000000"><img src="../../imagenes/arriba1.png" height="30" > -->
	<td width="308" rowspan="2"><div align="left"><font color="#000000"><img src="../../imagenes/fondo2.jpg" height="40" >
          <input type="hidden" name="buscador_rapido" value="1">
    </font></div></td>
    <td width="76"><div align="right"><font color="#FF0000" size="2"><strong>Buscar</strong></font></div></td>
    <td width="148"><div align="central"><font color="#000000">
      <select name="buscador[]" id="buscador" onclick="salta()">

<optgroup label="Datos de Cuentas">
		  <option value = "1">CUENTAS </option>
		<option value = "18">FACTURANTES </option>
		<option value = "30">DATOS AUSENTES</option>
</OPTGROUP>
<optgroup label="Datos Personales">
          <option value = "5">BIOQUIMICOS </option>
</optgroup>
<optgroup label="Datos de Obras Sociales">
		  <option value = "4">OB.SOCIALES</option>
		  <option value = "3">PRACTICAS </option>
		  <option value = "31">COMPARAR PRACT. </option>
		  <option value = "7">CONVENIOS </option>		  
		<option value = "17">NOMENCLADORES </option>
		</optgroup>
<optgroup label="Datos de Proveeduria">
		  <option value = "2">CLIENTES </option>
		  <option value = "6">PROVEEDORES </option>
  		  <option value = "16">PRESCRIPTOR</option>
</optgroup>
<optgroup label="Asociación Bioq">
		  <option value = "32">AGENDA</option>
</optgroup>

      </select>
  </font></div></td>
    <td width="99" rowspan="2"><font color="#000000">
      <input type="submit" name="os" value = "OK">
    </font></td>
  </tr>
  <tr>
    <td><div align="right"><font color="#FF0000" size="2"><strong>Ingrese</strong></font></div></td>
    <td width="148"><div align="central"><font color="#000000">
        <input type="text" name="busca" size = "6" id = "busca">
    </font><font color="#FF0000" size="2"><strong>O.S</strong></font><font color="#000000">        
    <input type="text" name="busca_os" size = "4" id = "busca_os">
    </font></div></td>
    </tr>
</table>
<font color="#000000"></font>

</form>



</body>
</html> 


