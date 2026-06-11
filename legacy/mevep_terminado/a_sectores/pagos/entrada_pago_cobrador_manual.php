<link href="../../../laboratorio/css/fondo.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function on_load()
{
document.getElementById("cod_barra").focus();
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cod_barra":
				document.getElementById("fecha_pago").focus();
				break;
				case "fecha_pago":
				document.getElementById("cod_socio").focus();
				break;
				case "cod_socio":
				document.getElementById("mes").focus();
				break;
				case "mes":
				document.getElementById("anio").focus();
				break;
				case "anio":
				document.getElementById("importe").focus();
				break;

				case "importe":
				document.getElementById("cobrador").focus();
				break;
						
		}
		return false;
	}
	return true;
}


</script>

<style type="text/css">
<!--
.Estilo3 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<BODY onload = "on_load()">

<?php 

$cod_socio=$_REQUEST["cod_socio"];
$fecha_hoy = date("d-m-Y");

 $mes_pagar=$_REQUEST["mes_pagar"];
 $anio_pagar=$_REQUEST["anio_pagar"];

$importe=$_REQUEST["importe"];
$cobrador=$_REQUEST["cobrador"];
$nro_boleta=$_REQUEST["nro_boleta"];


 switch ($mes_pagar){
case "01":{$periodo = "ENERO";break;}
case "02":{$periodo = "FEBRERO";break;}
case "03":{$periodo = "MARZO";break;}
case "04":{$periodo = "ABRIL";break;}
case "05":{$periodo = "MAYO";break;}
case "06":{$periodo = "JUNIO";break;}
case "07":{$periodo = "JULIO";break;}
case "08":{$periodo = "AGOSTO";break;}
case "09":{$periodo = "SETIEMBRE";break;}
case "10":{$periodo = "OCTUBRE";break;}
case "11":{$periodo = "NOVIEMBRE";break;}
case "12":{$periodo = "DICIEMBRE";break;}
}


?>
<form action="guardar_manual.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="3" bgcolor="#CCCCCC"><div align="center"><strong>INGRESO PAGO MANUAL </strong></div></td>
  </tr>
    
    <tr align="center" bordercolor="#FFFFFF">
      <td height="24"><div align="right"><span class="Estilo3">N&deg; BOLETA:  </span></div></td>
      <td><div align="left"><?php echo $nro_boleta;?></div></td>
      <td width="455" rowspan="7" bgcolor="#FFFFFF"><?php include ("lista_cobradores.php");?></td>
    </tr>
    <tr align="center" bordercolor="#FFFFFF">
      <td width="172" height="24"><div align="right" class="Estilo3">FECHA </div></td>
      <td width="217"><div align="left"><font color="#000000" size="2">
          <input name="fecha_pago" type="text" id="fecha_pago" tabindex="2"onKeyPress="return verif_caracter(this,event)" value="<?php echo $fecha_hoy;?>" size="20" maxlength="60">
      </font></div></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td width="172" height="24" align="center">
        <div align="right" class="Estilo3">
      N&ordm; SOCIO </div></td>
      <td width="217" align="center"><div align="left"> <font color="#000000" size="2">
      <input name="cod_socio" type="text" id="cod_socio" onKeyPress="return verif_caracter(this,event)" size="20" maxlength="8" value = "<?php echo $cod_socio;?>" tabindex="1">
</font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF">


      <td height="24"><div align="right" class="Estilo3"><font color="#000000">MES</font></div></td>
      <td><font color="#000000" size="2">
        <input name="mes" type="text" id="mes"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes_pagar;?>" size="4" maxlength="4" tabindex="3">
    <?php echo $periodo;?>  </font></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right" class="Estilo3"><font color="#000000">A&Ntilde;O</font></div></td>
      <td><font color="#000000" size="2">
        <input name="anio" type="text" id="anio"onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio_pagar;?>" size="4" maxlength="4" tabindex="3">
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right" class="Estilo3">
          IMPORTE
              <div align="right"> </div>
      </div></td>
      <td> <font color="#000000" size="2">
        <input name="importe" type="text" id="importe"onKeyPress="return verif_caracter(this,event)" value="<?php echo $importe;?>" size="20" maxlength="20" tabindex="3">
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right" class="Estilo3">COBRADOR</div></td>
      <td><font color="#000000" size="2">
        <input name="cobrador" type="text" id="cobrador"onKeyPress="return verif_caracter(this,event)" value="<?php echo $cobrador;?>" size="20" maxlength="20" tabindex="3">
      </font></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="center"><font color="#000000" size="2">

    <input type="hidden" name="nro_boleta" value="<?php echo $nro_boleta;?>">

      <input type="Submit" name="Submit" id ="Submit3" value="ACEPTAR" tabindex="29" onClick="return confirm('Si esta todo correcto Presione Aceptar');">
    </font></div></td>
    <td height="26"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td height="26"><div align="center"><font color="#000000" size="2"> <span class="Estilo4">CONTRASE&Ntilde;A DE SEGURIDAD</span>            <input name="contra" type="password" id="contra3" tabindex="2"onKeyPress="return verif_caracter(this,event)" size="20" maxlength="60">        
        <input type="Submit" name="Submit" id ="Submit" value="ELIMINAR" tabindex="29" onClick="return confirm('Si esta todo correcto Presione Aceptar');">
    </font></div></td>
  <tr>
    <td height="0"></td>
    <td></td>
    <td></td>
  </tr>  
</table>
