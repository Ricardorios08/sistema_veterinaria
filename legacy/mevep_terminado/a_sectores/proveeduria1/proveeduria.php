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

function multicarg(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}
</script>



<style type="text/css">
<!--
.Estilo4 {font-size: xx-small}
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo54 {font-size: 12px}
.Estilo64 {font-family: "Times New Roman", Times, serif}
.Estilo65 {font-family: "Times New Roman", Times, serif; font-size: 12px; }
.Estilo38 {font-size: 14px}
.Estilo39 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo40 {font-family: Arial, Helvetica, sans-serif; color: #000000;}
.Estilo41 {color: #000000}
.Estilo43 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<BODY background="../IMAGENES/logito.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="483" border="0" align="center">
  <tr bgcolor="#666666">
    <td width="264" height="31" align="center" scope="row"><span class="Estilo43">VENTAS</span></td>
    <td width="209" align="center" scope="row"><span class="Estilo43">COMPRAS</span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="facturacion/ver_temporal.php" target = "central" class="Estilo12">1. FACTURA </a></div></td>
    <td scope="row" align="center"><span class="Estilo64"><a href="compras/pagina1.php" target = "central" class="Estilo54" >1. INGRESOS</a></span></td>
  </tr>
<!--   <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="nota_debito/entrada_factura.php" target = "central" class="Estilo54" >2. NOTA DEBITO </a></div></td>
    <td scope="row" align="center"><span class="Estilo64"><a href="facturacion/entrada_factur.php" target = "central" class="Estilo54" >2. DEVOLUCION</a></span></td>
  </tr> -->
  <tr>
<!--     <td scope="row" align="center"><div align="center" class="Estilo64"><a href="nota_credito/entrada_factura.php" target = "central" class="Estilo54" onclick="return confirm('¿Si tiene alguna Nota de Credito Pendiente se borrará?');">3. NOTA CREDITO </a></div></td> -->
    <td scope="row" align="center"><span class="Estilo64"><a href="consultas.php" target = "izquierda" class="Estilo54" >3. BUSCAR FACT. </a></span></td>
  </tr>
  <tr>
 <!--    <td scope="row" align="center"><span class="Estilo64"><a href="nota_credito_pesos/entrada_factura.php" target = "central" class="Estilo54">4. N/ CREDITO PESOS </a></span></td> -->
    <td scope="row" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="consultas.php?A=1" target = "izquierda" class="Estilo54" >5. BUSCAR FACT. </a></span></td>
    <td scope="row" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td scope="row" align="center">&nbsp;</td>
    <td scope="row" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="center" bgcolor="#666666" scope="row"><span class="Estilo43">PROCESOS</span></td>
    <td align="center" bgcolor="#666666" scope="row"><span class="Estilo54 Estilo7 Estilo6 Estilo13"><strong>CONSULTAS</strong></span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><a href="consultas/informes.php" target = "izquierda" class="Estilo65" >1. INFORMES</a></td>
    <td scope="row" align="center"><div align="center" class="Estilo7 Estilo38">
        <select name="opciones[]" id="opciones" onkeypress="return verif_caracter(this,event)">
          <option value ="Existencia">Mercaderia</option>
          <option value ="Mercaderia">Modificar</option>
        </select>
        <input type = "hidden" name = "buscador_rapido" value = "2">
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="center"><a href="informes.php" target = "izquierda" class="Estilo65" >2. ACTUALIZACIONES </a></div></td>
    <td valign="middle" class="Estilo4" scope="row"><div align="center" class="Estilo39"><span class="Estilo7">Ingrese </span>
          <input type = "text" name = "busca" size = "7">
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="center"><a href="inventario/inventario.php" target = "central" class="Estilo65" >3. INVENTARIO </a></div></td>
    <td valign="middle" class="Estilo4" scope="row"><div align="center" class="Estilo39"><span class="Estilo40"><span class="Estilo6"><span class="Estilo4 Estilo16 Estilo70  Estilo6"><span class="Estilo4 Estilo16  Estilo6"><span class="Estilo41">PLAN:</span></span></span></span>
          <?include ("../conexiones/config_pro.php");
$sql = "SELECT * FROM `tasas_planes` where cod_plan < 90 order by cod_plan";
$result = $db->Execute($sql);

echo "<select name=plan[] size=1 id =plan class='Estilo21' onKeyPress='return verif_caracter(this,event)'>";

?>
            <option value selected= "<?"$plan";?>"> <?print("$plan");?></option>
          <optgroup label="Elegir:">
          <?

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cuenta=$result->fields["cuenta"];
$a1=strtoupper($result->fields["cod_plan"]);

echo"<option value=$a1>$a1</option>";
$result->MoveNext();
	}
?>
          <?
echo"</select>";
?>
    </span></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row">&nbsp;</td>
    <td valign="middle" class="Estilo4" scope="row"><div align="center">
      <input type="submit" name="Submit" value="BUSCAR">
    </div></td>
  </tr>
</table>

<div align="center"></div>
<div align="center"></div>
<div align="center"></div>
</form><script type="text/javascript">
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
