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
.Estilo55 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo61 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
.Estilo64 {font-family: "Times New Roman", Times, serif}
.Estilo65 {font-family: "Times New Roman", Times, serif; font-size: 12px; }
.Estilo26 {	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo71 {font-size: 10px}
.Estilo72 {font-size: 12px; color: #000000; }
-->
</style>
<BODY background="../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="140" border="0">
  <tr>
    <th height="28" bgcolor="#006699" scope="col"><span class="Estilo6">PROVEEDURIA</span></th>
  </tr>
  <tr>
    <td align="center" bgcolor="#006699" scope="row"><span class="Estilo55">VENTAS</span></td>
  </tr>
   <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="facturacion/ver_temporal.php" target = "central" class="Estilo12">1. FACTURA </a></div></td>
  </tr> 
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="facturacion_presu/ver_temporal.php" target = "central" class="Estilo12">2. PRESUPUESTO</a></span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="nota_debito/entrada_factura.php" target = "central" class="Estilo54" >3. NOTA DEBITO </a></div></td>
  </tr>
  <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="nota_credito/entrada_factura.php" target = "central" class="Estilo54" onclick="return confirm('¿Si tiene alguna Nota de Credito Pendiente se borrará?');">4. NOTA CREDITO </a></div></td>
  </tr>
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="nota_credito_pesos/entrada_factura.php" target = "central" class="Estilo54">5. N/ CREDITO PESOS </a></span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="consultas.php?A=1" target = "izquierda" class="Estilo54" >6. BUSCAR FACT. </a></span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="cobros/cobrar_factura_1.php" target = "central" class="Estilo54" >7. COBRAR </a></span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="ajustes/ver_temporal.php" target = "central" class="Estilo12">8. AJUSTES </a></span></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#006699" scope="row"><div align="center"><span class="Estilo55">COMPRAS</span></div></td>
  </tr>
  <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="compras/pagina1.php" target = "central" class="Estilo54" >1. INGRESOS</a></div></td>
  </tr>
  <tr>
    <td scope="row" align="center"><div align="center" class="Estilo64"><a href="devolucion/devolucion.php" target = "izquierda" class="Estilo54" >2. DEVOLUCION</a></div></td>
  </tr>
  <tr>
    <td scope="row" align="center"><span class="Estilo64"><a href="consultas.php" target = "izquierda" class="Estilo54" >3. BUSCAR FACT. </a></span></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#006699" scope="row"><span class="Estilo55">PROCESOS</span></td>
  </tr>
  <tr>
    <td scope="row" align="center"><a href="consultas/informes.php" target = "izquierda" class="Estilo65" >1. INFORMES</a></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="center"><a href="informes.php" target = "izquierda" class="Estilo65" >2. ACTUALIZACIONES </a></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="center"><a href="inventario/inventario.php" target = "izquierda" class="Estilo65" >3. INVENTARIO </a></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><table width="103%" border="0">
  <tr>
    <td width="100%" align="center" bgcolor="#006699" scope="row"><div align="center"><span class="Estilo13 Estilo6 Estilo7 Estilo54">CONSULTAS </span></div></td>
  </tr>
  <tr>
    <td align="center" scope="row">
      <div align="right">
            <select name="opciones[]" id="opciones" onkeypress="return verif_caracter(this,event)">
			<option value ="Existencia">Mercaderia</option>
			<option value ="Mercaderia">Modificar</option>
            </select>
            <input type = "hidden" name = "buscador_rapido" value = "2">    
      </div></td>
  </tr>
  <tr>
    <td align="center" scope="row"><span class="Estilo64">Ingrese </span>
      <input type = "text" name = "busca" size = "7"></td>
  </tr>
  <tr>
    <td align="center" scope="row"><span class="Estilo26"><span class="Estilo6"><span class="Estilo4 Estilo6  Estilo16 Estilo70"><span class="Estilo4 Estilo16  Estilo6"><span class="Estilo71"><span class="Estilo72">PLAN:</span></span></span></span></span>
        <?include ("../../conexiones/config_pro.php");
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
    </span></td>
  </tr>
  <tr>
    <td align="center" scope="row"><input type="submit" name="Submit" value="BUSCAR"></td>
  </tr>
</table></td>
  </tr>
</table>

<div align="center"></div>
<table width="140" border="0">
    <tr>
      <td width="132" bgcolor="#006699" scope="col"><div align="center" class="Estilo61">Ir a...</div></td>
    </tr>
  <!--   <tr>
      <td scope="col"><div align="center"><A HREF="javascript:multicarga('../../validar/admin.php', '../../validar/cuadros.htm')">Principal</A></div></td>
    </tr> -->
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#FFFFFF" scope="col"><div align="center"><font color="#0000FF"><a href="../../validar/provee.php" target ="central">Menú</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#FFFFFF" scope="col"><div align="center"><font color="#0000FF"><a href="../../index.html" target ="_parent">Salir</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
  </table>


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
