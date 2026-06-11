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
.Estilo13 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}

body {
	background-image: url(../../../../imagenes/logito.png);
}
.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>

<?php 
$anio_actual = date("Y");
$mes_actual = date("m");
$dia = date("d");

$anio_anterior = $anio_actual;
$cuenta= $_REQUEST['cuenta'];
$denominacion= $_REQUEST['denominacion'];

?>
<BODY background="../../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">
<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="650" border="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#B8B8B8" scope="row"><div align="center"><span class="Estilo13">CUENTA CORRIENTE DE: <?php echo $denominacion;?></span></div></td>
  </tr>
<!--   <tr bgcolor="#E1F2EF">
    <td width="40%" align="center" scope="row">
      <div align="right">Seleccione tipo de Consulta: 
      
    </div></td>
    <td width="60%" align="center" scope="row"><div align="left">
       <input type = "hidden" name = "buscador_rapido" value = "2">
    </div></td>
  </tr> -->
  <tr bgcolor="#E1F2EF">
    <td width="324" align="center" bgcolor="#EDEDED" scope="row"><div align="right" class="Estilo8">Ingrese </div></td>
    <td width="316" align="center" bgcolor="#EDEDED" scope="row"><div align="left" class="Estilo8">
    
      
      <?php 
      include ("../../../conexiones/config.inc.php");
$sql = "SELECT * FROM cobradores";
$result = $db->Execute($sql);
echo "<select name=cobrador[] size=1 id =nro_os onKeyPress='return verif_caracter(this,event)'>";
echo"<option value=''>COBRADOR</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {

$nombre_cobrador=strtoupper($result->fields["nombre_cobrador"]);

$cod_cobrador=$result->fields["cod_cobrador"];
 

echo"<option value=$cod_cobrador>$cod_cobrador - $nombre_cobrador</option>";
$result->MoveNext();
	}
echo"</select>";
?>


    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" bgcolor="#EDEDED" scope="row"><div align="right" class="Estilo8">Desde</div></td>
    <td align="center" bgcolor="#EDEDED" scope="row"><div align="left" class="Estilo8">
      <input name = "dia_d" type = "text" id="dia_d" size = "2" value = "<?php echo $dia;?>">
  /
  <input name = "mes_d" type = "text" id="mes_d" size = "2" value = "<?php echo $mes_actual;?>">
  /
  <input name = "anio_d" type = "text" id="anio_d" size = "4" value = "<?php echo $anio_anterior;?>">
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" bgcolor="#EDEDED" scope="row"><div align="right" class="Estilo8">Hasta</div></td>
    <td align="center" bgcolor="#EDEDED" scope="row"><div align="left" class="Estilo8">
      <input name = "dia_h" type = "text" id="dia_h" size = "2" value = "<?php echo $dia;?>">
  /
    <input name = "mes_h" type = "text" id="mes_h" size = "2" value = "<?php echo $mes_actual;?>">
  /
  <input name = "anio_h" type = "text" id="anio_h" size = "4" value = "<?php echo $anio_actual;?>">
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" bgcolor="#EDEDED" scope="row"><div align="right" class="Estilo8">Ordenar por </div></td>
    <td align="center" bgcolor="#EDEDED" scope="row"><div align="left" class="Estilo8">
      
        <div align="left">
          <select name="ordenar[]" id="select2" onkeypress="return verif_caracter(this,event)">
            <!--  <option value ="TODOS" selected>TODOS</option> -->
            <option value="fecha,  tipo_fact, comprobante" selected>FECHA</option>
            <option value="comprobante, tipo_fact, fecha">FACT</option>
          </select>
        </div>
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2" align="center" bgcolor="#EDEDED" scope="row"><span class="Estilo8"><span class="Estilo16"><span class="Estilo14">
      </span>
      <div align="left" class="Estilo8">
        <input name="tipo" type="radio" value="3" checked>
      COMISION COBRADOR</div></td>
    </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2" align="center" bgcolor="#EDEDED" scope="row"><div align="left" class="Estilo8">
      <input name="tipo" type="radio" value="1">
      COMISION 
      COMPLETO
      
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2" align="center" bgcolor="#EDEDED" scope="row"><div align="left" class="Estilo8">
      <input name="tipo" type="radio" value="2">
      DEUDA
      <input name = "mes_deuda" type = "text" id="mes_deuda" size = "2" value = "<?php echo $mes_actual;?>">
      /
      <input name = "anio_deuda" type = "text" id="anio_deuda" size = "4" value = "<?php echo $anio_actual;?>">
      <label>
      Detalle Cuotas
      <input name="pago" type="checkbox" id="pago" value="si">
      </label>
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2" align="center" bgcolor="#EDEDED" scope="row">&nbsp;</td>
  </tr>
  <tr bgcolor="#000099">
    <td colspan="2" align="center" bgcolor="#B8B8B8" scope="row">
        <div align="center">
          <input type="submit" name="Submit" value="CONSULTAR CTA CTE">
</div></td>
    </tr>
</table>

<div align="center"></div>
</form>
