<script type="text/javascript">
function ocultamenu(){
  var menu = document.getElementById("Atributos");
  menu.style.display = "none";
}
function despliega(){
  var menu = document.getElementById("Atributos");
    if(menu.style.display == "none"){
      menu.style.display = "block";
    }
    else{
      menu.style.display = "none";
    }
}
</script>
<script LANGUAGE="JavaScript">
function multicarga(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}
</script>
<style type="text/css">
<!--
.Estilo4 {font-size: xx-small}
.Estilo6 {color: #FFFFFF}
-->
</style>
<? $anio = date("y");?>
<BODY background="../../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">


<form action ="buscar_facturas_os.php" method="post" target ="central">
<table width="140" border="0"> 
        <tr bgcolor="#000099">
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>OBRAS SOCIALES</strong></font></div></td>
        </tr>
        <tr bgcolor="#000099">
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>IVA VENTAS </strong></font></div></td>
    </tr>
        <tr>
          <td width="55"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">A&ntilde;o: </font></div></td>
          <td width="75"><font size="2" face="Arial, Helvetica, sans-serif">
          20 <input name = "anio" type = "text" value="<?echo $anio;?>" size = "2" maxlength ="2">
          </font></td>
        </tr>
        <tr>
          <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Mes:
          </font></div></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">
            <select name="mes[]" id="select3" onkeypress="return verif_caracter(this,event)">
              <option value = "01" >ENE</option>
              <option value = "02">FEB</option>
              <option value = "03">MAR</option>
              <option value = "04">ABR</option>
              <option value = "05">MAY</option>
              <option value = "06">JUN</option>
              <option value = "07">JUL</option>
              <option value = "08">AGO</option>
              <option value = "09">SET</option>
              <option value = "10">OCT</option>
              <option value = "11">NOV</option>
              <option value = "12">DIC</option>
            </select>
          </font></td>
        </tr>
        <tr>

	

          <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Salida:</font></div></td>
        </tr>
        <tr>
          <td colspan="2">
            <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
              <select name="buscar_por[]" id="select5" onkeypress="return verif_caracter(this,event)">
					      <option value ="pantalla" selected>PANTALLA</option>
                          <option value ="pre_impreso">PRE-IMPRESO</option>
						     <option value ="totales">TOTALES</option>
                    
              </select>
            </font></div></td></tr>
			<tr>
          <td colspan="2">
            <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
             <select name="ordenar[]" id="select5" onkeypress="return verif_caracter(this,event)">
					       <option value ="fecha, nro_factura" selected>FECHA</option>
						  <option value ="nro_factura">FACTURA</option>
                         	 
                    
              </select>
            </font></div></td></tr>
<tr>
			  <td colspan="2"><div align="center">N&ordm; Registro:<font size="2" face="Arial, Helvetica, sans-serif">
		        <input name = "registro" type = "text" id="registro" value="" size = "2">
		      </font></div></td>
    </tr>
			<tr>
			  <td colspan="2"><div align="center">N&ordm; Hoja:&nbsp; &nbsp; &nbsp;<font size="2" face="Arial, Helvetica, sans-serif">
			    <input name = "hoja" type = "text" id="hoja" value="" size = "2">
			  </font></div></td>
    </tr>
        <tr>
          <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type = "submit" name = "ok" value = "CONSULTAR">
          </font></div></td>
        </tr>
</table>
</form>

  <table width="140" border="0">
    <tr>
      <td width="132" bgcolor="#000099" scope="col"><div align="center" class="Estilo6">Ir a...</div></td>
    </tr>

<tr>
      <td scope="col"><div align="center"><A HREF="javascript:multicarga('../../../drivers/frames/frame_izquierdo.php', '../../../validar/contaduria.php')">Menu</A></div></td>
    </tr> 
    <tr>
      <td scope="col"><div align="center"><font color="#0000FF"><a href="../../../index.html" target ="_parent">Salir</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
  </table>


</form>