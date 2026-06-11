<script language="JavaScript">
var m="A.M.";
function mueveReloj(){
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = momentoActual.getMinutes();
    segundo = momentoActual.getSeconds();

if(hora==12)
{
    m="";
}
if(hora==13)
{
    hora="0"+1;
    m="";
}
if(hora==14)
{
    hora="0"+2;
    m="P.M.";
}
if(hora==15)
{
    hora="0"+3;
    m="P.M.";
}
if(hora==16)
{
    hora="0"+4;
    m="P.M.";
}
if(hora==17)
{
    hora="0"+5;
    m="P.M.";
}
if(hora==18)
{
    hora="0"+6;
    m="P.M.";
}
if(hora==19)
{
    hora="0"+7;
    m="P.M.";
}
if(hora==20)
{
    hora="0"+8;
    m="P.M.";
}
if(hora==21)
{
    hora="0"+9;
    M="P.M.";
}
if(hora==22)
{
    hora=10;
    m="P.M.";
}
if(hora==23)
{
    hora=11;
    m="P.M.";
}
if((hora==0)||(hora==24))
{
    hora=12;
    m="M.N";
}

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo;

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto;

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora;

    horaImprimible = hora + ":" + minuto + ":" + segundo;

    cl.innerHTML = horaImprimible;//cl=clock=reloj

    setTimeout("mueveReloj()",1000);
}
</script>

<!-- <table border="0" cellpadding="2" cellspacing="0">
<tr> <center><td bgcolor="#FFFFFF" colspan="2"><a href="http://www.tutiempo.net/tiempo/Mndoza_Aerodrome/SAME.htm">El Tiempo Mendoza </a></td></center></tr>
<tr><td width="1%"><tt id="TT_IB"> </tt></td><td align="left"><tt id="TT_Condiciones" class="tiempo"></tt>, <tt id="TT_Temperatura" class="tiempo"></tt></td></tr>
</table> -->
</tt>
<script type="text/javascript">
TT_LOC = 'SAME';
TT_VAR = 'AR;-3;S';
</script>

<!-- <script src="http://www.tutiempo.net/asociados/TTjscript/tiempo.php" type="text/javascript"></script> -->
<?php $hoy = date("d/m/y");
$hora = time("h/m/s");

?>

 

<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo3 {color: #FF0000}
.Estilo9 {color: #FFFFFF; font-family: "Trebuchet MS"; }
-->
</style>
<!-- <BODY background="../../IMAGENES/ladrillos.jpg" onload="mueveReloj()"> -->
<BODY background="../../imagenes/presentacion/fondo4.jpg" onload ="ocultamenu()">
<table width="165" height="207" border="0">
 
<!--   <tr>
    <th height="24" scope="col"><?php echo $hoy;?></th>
  </tr> -->
  <tr>
    <th bgcolor="#666666" scope="col"><span class="Estilo9">Hora Actual </span></th>
  </tr>
  <tr>
    <th width="122" scope="col"><span class="Estilo1"><font id="cl">0</font></span></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th bgcolor="#666666" scope="col"><span class="Estilo9">Cumplea&ntilde;os</span></th>
  </tr>
 
<?php  $hoy = date("d/m");
$dia1 = date("d");
$mes1 = date("m");
$mes2 = $mes1 - 1;
$mes3 = $mes1 + 1;


include ("../../conexiones/config.inc.php");
$sql = "SELECT * FROM `empleados` where (anio = $mes1) or (anio = $mes2) or (anio = $mes3)  order by anio, mes, apellido";
$result = $db->Execute($sql);
 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {
$id=$result->fields["id"];
$nombre=strtoupper($result->fields["nombre"]);
$apellido=strtoupper($result->fields["apellido"]);
$dia=strtoupper($result->fields["mes"]);
$mes=strtoupper($result->fields["anio"]);

$cumpleaños = $dia."/".$mes;

if ($cumpleaños == "/"){
$result->MoveNext();
}
else {


if (strlen($dia == 1)){
	$dia = "0".$dia;
}

if (strlen($mes == 1)){
	$mes = "0".$mes;
}

if ($cumpleaños == $hoy){

?>
  <tr>
    <th bgcolor="#FFFFFF" scope="col"><div align="center" class="Estilo2 Estilo3">
      <div align="left"><blink><span class="Estilo3"><?php echo $cumpleaños;?></span></blink></div>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#FFFFFF" scope="col"><div align="center" class="Estilo2 Estilo3">
      <div align="left"><blink><?php echo $nombre;?></blink></div>
    </div></th>
  </tr>
<?php }else{
?>
<!--   <tr>
    <th scope="col"><div align="center" class="Estilo2"><?php echo $cumpleaños;?></div></th>
  </tr> -->
  <tr>
    <th bgcolor="#FFFFFF" scope="col"><div align="center" class="Estilo2">
      <div align="left"><?php echo $cumpleaños." - ".$nombre;?></div>
    </div></th>
  </tr>
<?php }


$result->MoveNext();
	}

}?>



    <!-- <th width="122" scope="col"><a href="../../validar/usuarios/nuevo_usuario.php" target = "central">Registrarse</a> </th> -->

  <tr>
    <th scope="col">&nbsp;</th>
  </tr>

<tr>
    <th bgcolor="#666666" scope="col"><center><?php include ("../../lautaro/cale.php");?>
    </center></th>
  </tr>
  <tr>
  </tr>
</table>
<br><br>
</body>

