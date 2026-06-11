<?php 
/*include ("facturacion/numero_a_letras.php");
$total_acumulado =74122125834749.96;
$numero = explode('.',$total_acumulado);

$numero[0];
$numero[1];


echo $a = num2letras($numero[0])." con ".substr($numero[1],0,2)."/100";

echo "<br>";
include ("../conexiones/config_pr.php");
echo $sql = "SELECT valor FROM `convenio_practica` WHERE nro_os = 5073 and cod_practica = 998";
$result1 = $db->Execute($sql);
echo "<br>";
echo "dsfsd".$valor_998 = $result1->fields["valor"];

//include ("circulo.php");

    Header("Content-type: ../image/png");
    $im = imagecreate(200,200);
    $fondo=ImageColorAllocate ($im,0,0,255);
    $linea=ImageColorAllocate ($im,255,255,255); 
  
    imageline($im,0,0,200,200,$linea);

    Imagepng($im);
    Imagedestroy($im);  

// Enviamos los encabezados de hoja de calculo
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=excel.xls");

// Creamos la tabla
/*$letra = array ("A","B","C","D","E","F","G","H","I","J");
echo "<table>";
for ($i=0;$i<10;$i++){
  echo "<tr>";
  for ($e=0;$e<10;$e++){
    echo "<td>Fila ".($i+1)." columna ".$letra[$e]."</td>";
  }
  echo "</tr>";
}
echo "</table>";
*/
?>
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title></title>
<style type="text/css">
body	{ font-family: Verdana, arial, helvetica, sans-serif;  
	font-size:14px; }
h1	{ font-size:18px }	
a:link { color:#33c }	
a:visited { color:#339 }		

/* This is where you can customize the appearance of the tooltip */
div#tipDiv {
  position:absolute; visibility:hidden; left:0; top:0; z-index:10000;
  background:url("images/marble.gif") #eef2f9;
  border:1px solid #336; 
  width:250px; padding:4px;
  color:#000; font-size:11px; line-height:1.2;
}
div.tp1 { font-size:12px; color:#336; padding-top:4px }
</style>
<script type="text/javascript" src="js/dw_event.js"></script>
<script src="js/dw_viewport.js" type="text/javascript"></script>
<script src="js/dw_tooltip.js" type="text/javascript"></script>

<script type="text/javascript">

function doTooltip(e, msg) {
  if ( typeof Tooltip == "undefined" || !Tooltip.ready ) return;
  Tooltip.show(e, msg);
}

function hideTip() {
  if ( typeof Tooltip == "undefined" || !Tooltip.ready ) return;
  Tooltip.hide();
}
	</script>	


</head>
<body>


 <a href="192.168.1.7" onmouseover="doTooltip(event,'Pago a Capita')" onmouseout="hideTip()">prueba</a>



</body>
</html>
