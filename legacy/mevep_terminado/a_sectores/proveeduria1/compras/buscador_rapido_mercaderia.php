<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
-->
</style>
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

<table width="257" border="0">
  <tr>
    <td bgcolor="#000099"><div align="center" class="Estilo1">BUSCAR MERCADERIA </div></td>
  </tr>
  <tr>
    <td>      <div align="center">
        <input name="palabra" type="text" size="4">
        <input type="submit" name="Alta" id= "Alta" value="BUSCAR">
    </div></td>
  </tr>
</table>


<?
if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
						
			case "BUSCAR":
				{

$palabra=$_POST["palabra"];
include ("detalle_buscador_mercaderia.php");

 break;	}


					}
}
?>