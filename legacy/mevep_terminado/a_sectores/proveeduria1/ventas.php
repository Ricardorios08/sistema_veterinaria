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


<link href="../..//plantillas/azul.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo1 {color: #ffffff}
.Estilo2 {font-size: 12px}
.Estilo3 {font-family: Arial, Helvetica, sans-serif}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo5 {color: #FFFFFF}
.Estilo18 {color: #FFFFFF; font-size: 12px; }
-->
</style>

<?
$anio = date("Y");
$mes_actual = date("m");
switch ($mes_actual){
	case "01":{$periodo = "ENE";BREAK;}
	case "02":{$periodo = "FEB";BREAK;}
	case "03":{$periodo = "MAR";BREAK;}
	case "04":{$periodo = "ABR";BREAK;}
	case "05":{$periodo = "MAY";BREAK;}
	case "06":{$periodo = "JUN";BREAK;}
	case "07":{$periodo = "JUL";BREAK;}
	case "08":{$periodo = "AGO";BREAK;}
	case "09":{$periodo = "SET";BREAK;}
	case "10":{$periodo = "OCT";BREAK;}
	case "11":{$periodo = "NOV";BREAK;}
	case "12":{$periodo = "DIC";BREAK;}

}
?>
<BODY background="../../IMAGENES/logito.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="buscar/ventas.php" method="post" TARGET = "central">
<div align="left"></div>
<table width="151" border="0" align="left">
  <tr>
    <td height="44" align="center" bgcolor="#666666" scope="row"><span class="Estilo54 Estilo7 Estilo13 Estilo1 Estilo2"><strong>VENTAS</strong></span></td>
  </tr>
  <tr>
    <td width="145" align="center" bgcolor="000099" scope="row"><div align="center" class="Estilo64 Estilo3 Estilo2">
      <div align="left"><a href="facturacion/ver_temporal.php" target = "central" class="Estilo12">1. FACTURAR </a></div>
    </div></td>
    </tr>

	
  <tr>
    <td height="35" align="center" bgcolor="#666666" scope="row"><span class="Estilo18">BUSCAR FACTURAS </span></td>
    </tr>
  <tr>
    <td align="center" bgcolor="000099" scope="row"><div align="right"><span class="Estilo5"><font size="2" face="Arial, Helvetica, sans-serif">A&ntilde;o<font size="2" face="Arial, Helvetica, sans-serif">
        <input name = "anio" type = "text" id="anio" value="<?echo $anio;?>" size = "9">
    </font></font></span></div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="000099" scope="row"><div align="right">
      <span class="Estilo5"><font size="2" face="Arial, Helvetica, sans-serif">Periodo </font></span>
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
        </div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="000099" scope="row"><div align="right"><span class="Estilo5"><font size="2" face="Arial, Helvetica, sans-serif">Tipo
              <select name="tipo[]" id="select2" onkeypress="return verif_caracter(this,event)">
                <option value="TODOS">TODOS</option>
                <option value="FACTURAS">FACTURAS</option>
                <option value="ANULADA">ANULADA</option>
                <option value="CREDITO">CREDITO</option>
                <option value="DEBITO">DEBITO</option>
              </select>
    </font></span></div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="000099" scope="row"><div align="right"><span class="Estilo5"><font size="2" face="Arial, Helvetica, sans-serif">N&ordm;  
	<input type = "text" name = "nro_factura" size = "9">
    </font></span></div></td>
  </tr>

  <tr>
    <td align="center" bgcolor="000099" scope="row"><div align="right"><span class="Estilo5"><font size="2" face="Arial, Helvetica, sans-serif">Cli/Pro 
          <input name = "cliente_proveedor" type = "text" id="cliente_proveedor3" size = "9">
    </font></span></div></td>
  </tr>

  <tr>
    <td align="center" bgcolor="#666666" scope="row"><font size="2" face="Arial, Helvetica, sans-serif">    <span class="Estilo7"><font size="2" face="Arial, Helvetica, sans-serif">
    <input type = "submit" name = "ok" value = "BUSCAR">
    </font></span> </font></td>
  </tr>
  
</table>
