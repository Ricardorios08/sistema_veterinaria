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
<?$anio = date("y");
$A = $_REQUEST['A'];
$mes_actual = date("m");

switch ($mes_actual){
case "01":{$periodo = "ENE";break;}
case "02":{$periodo = "FEB";break;}
case "03":{$periodo = "MAR";break;}
case "04":{$periodo = "ABR";break;}
case "05":{$periodo = "MAY";break;}
case "06":{$periodo = "JUN";break;}
case "07":{$periodo = "JUL";break;}
case "08":{$periodo = "AGO";break;}
case "09":{$periodo = "SET";break;}
case "10":{$periodo = "OCT";break;}
case "11":{$periodo = "NOV";break;}
case "12":{$periodo = "DIC";break;}
}


?>
<BODY background="../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">


<form action ="buscar/buscar_facturas.php" method="post" target ="central">
<table width="140" border="0"> 
        <tr bgcolor="#000099">
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>FACTURAS </strong></font></div></td>
    </tr>
        <tr>
          <td width="55"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">A&ntilde;o: </font></div></td>
          <td width="75"><font size="2" face="Arial, Helvetica, sans-serif">
          <input name = "anio" type = "text" value="<?echo $anio;?>" size = "6">
          </font></td>
        </tr>
        <tr>
          <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Mes:
          </font></div></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">
            <select name="mes[]" id="select3" onkeypress="return verif_caracter(this,event)">

			 <option value = "<?$mes_actual;?>" selected><?echo $periodo;?></option>
			  <option value = "13">TODOS</option>
              <option value = "01">ENE</option>
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
          <td colspan="2">
            <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
            Por:

<?IF ($A == 1){?>
                <select name="buscar_por[]" id="select5" onkeypress="return verif_caracter(this,event)">
				   <option value ="ventas" selected>VENTAS</option>   
				   <option value ="compras">COMPRAS</option>
   				   <option value ="ajustes">AJUSTES</option>
				   	 <!--   <option value ="arreglar">arreglar</option> -->
                                  
              </select>
<?}else{?>
                <select name="buscar_por[]" id="select5" onkeypress="return verif_caracter(this,event)">
				   <option value ="compras" selected>COMPRAS</option>
                   <option value ="ventas">VENTAS</option> 
				    <option value ="ajustes">AJUSTES</option>
					 	   <option value ="arreglar">arreglar</option>
              </select>
<?}?>

            </font></div></td></tr>
        <tr>
          <td colspan="2"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
            Tipo
                  <select name="tipo[]" id="tipo[]" onkeypress="return verif_caracter(this,event)">
                      <option value="TODOS">TODOS</option>
                      <option value="FACTURAS">FACTURAS</option>
                      <option value="ANULADA">ANULADA</option>
                      <option value="CREDITO">CREDITO</option>
                      <option value="DEBITO">DEBITO</option>
          </select>
          </font></div></td>
        </tr>
        <tr>
          <td><div align="center">
          <font size="2" face="Arial, Helvetica, sans-serif">            </font></div>            
            
            <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">N&ordm;</font></div></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">
            <input type = "text" name = "nro_factura" size = "9">
          </font></td>
        </tr>
        <tr>
          <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Cli/Pro</font></div></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">
            <input name = "cliente_proveedor" type = "text" id="cliente_proveedor" size = "9">
          </font></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type = "submit" name = "ok" value = "BUSCAR">
          </font></div></td>
        </tr>
</table>
</form>

  <table width="140" border="0">
    <tr>
      <td width="132" bgcolor="#000099" scope="col"><div align="center" class="Estilo6">Ir a...</div></td>
    </tr>
	<tr>
      <td scope="col"><div align="center"><A HREF="proveeduria.php">Atras</A></div></td>
    </tr>
<!--     <tr>
      <td scope="col"><div align="center"><A HREF="javascript:multicarga('../../validar/admin.php', '../../validar/cuadros.htm')">Principal</A></div></td>
    </tr> -->
    <tr>
      <td scope="col"><div align="center"><font color="#0000FF"><a href="../../index.html" target ="_parent">Salir</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
  </table>


</form>