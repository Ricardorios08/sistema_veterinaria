<script language="javascript">
function on_load()
{
document.getElementById("cuenta").focus();
document.getElementById("cuenta").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cuenta":
				document.getElementById("estado").focus();
				document.getElementById("cuenta").style.backgroundColor = "#ffffff";
				document.getElementById("estado").style.backgroundColor = "#CCFFCC";

				break;

				case "estado":
				document.getElementById("estado1").focus();
				break;

				case "estado1":
				document.getElementById("estado2").focus();
				break;

				case "estado2":
				document.getElementById("denominacion").focus();
				
				document.getElementById("denominacion").style.backgroundColor = "#CCFFCC";
				break;

				case "denominacion":
				document.getElementById("domicilio").focus();
				document.getElementById("denominacion").style.backgroundColor = "#ffffff";
				document.getElementById("domicilio").style.backgroundColor = "#CCFFCC";
				break;

				case "domicilio":
				document.getElementById("puerta").focus();
				document.getElementById("domicilio").style.backgroundColor = "#ffffff";
				document.getElementById("puerta").style.backgroundColor = "#CCFFCC";
				break;
				case "puerta":
				document.getElementById("referencia").focus();
				document.getElementById("puerta").style.backgroundColor = "#ffffff";
				document.getElementById("referencia").style.backgroundColor = "#CCFFCC";
				break;
				case "referencia":
				document.getElementById("cod_postal").focus();
				document.getElementById("referencia").style.backgroundColor = "#ffffff";
				document.getElementById("cod_postal").style.backgroundColor = "#CCFFCC";
				break;
				case "cod_postal":
				document.getElementById("localidad").focus();
				document.getElementById("cod_postal").style.backgroundColor = "#ffffff";
				document.getElementById("localidad").style.backgroundColor = "#CCFFCC";
				break;
				case "localidad":
				document.getElementById("caracteristica_1").focus();
				document.getElementById("localidad").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_1").style.backgroundColor = "#CCFFCC";
				break;

				case "caracteristica_1":
				document.getElementById("telefono_1").focus();			
				document.getElementById("caracteristica_1").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_1").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_1":
				document.getElementById("caracteristica_2").focus();
				document.getElementById("telefono_1").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_2").style.backgroundColor = "#CCFFCC";
				break;

				case "caracteristica_2":
				document.getElementById("telefono_2").focus();
				document.getElementById("caracteristica_2").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_2").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_2":
				document.getElementById("caracteristica_3").focus();
				document.getElementById("telefono_2").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_3").style.backgroundColor = "#CCFFCC";
				break;
				case "caracteristica_3":
				document.getElementById("telefono_3").focus();
				document.getElementById("caracteristica_3").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_3").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_3":
				document.getElementById("email").focus();
				document.getElementById("telefono_3").style.backgroundColor = "#ffffff";
				document.getElementById("email").style.backgroundColor = "#CCFFCC";
				break;

				case "email":
				document.getElementById("cuit").focus();
				document.getElementById("email").style.backgroundColor = "#ffffff";
				document.getElementById("cuit").style.backgroundColor = "#CCFFCC";
				break;

				case "cuit":
				document.getElementById("iva").focus();
				document.getElementById("cuit").style.backgroundColor = "#ffffff";
				document.getElementById("iva").style.backgroundColor = "#CCFFCC";
				break;

				case "iva":
				document.getElementById("ingresos_brutos").focus();
				document.getElementById("iva").style.backgroundColor = "#ffffff";
				document.getElementById("ingresos_brutos").style.backgroundColor = "#CCFFCC";
				break;

				case "ingresos_brutos":
				document.getElementById("condiciones").focus();
				document.getElementById("ingresos_brutos").style.backgroundColor = "#ffffff";
				document.getElementById("condciones").style.backgroundColor = "#CCFFCC";
				break;

				case "condiciones":
				document.getElementById("credito").focus();
				document.getElementById("condiciones").style.backgroundColor = "#ffffff";
				document.getElementById("credito").style.backgroundColor = "#CCFFCC";
				break;

				case "credito":
				document.getElementById("flete").focus();
				document.getElementById("credito").style.backgroundColor = "#ffffff";
				document.getElementById("flete").style.backgroundColor = "#CCFFCC";
				break;

				case "flete":
				document.getElementById("observaciones").focus();
				document.getElementById("flete").style.backgroundColor = "#ffffff";
				document.getElementById("observaciones").style.backgroundColor = "#CCFFCC";
				break;

				case "observaciones":
				document.getElementById("guardar").focus();
				document.getElementById("flete").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>

<?$hoy = date("d/m/y");
$a = $_GET['id'];


		
?>


<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); on_load ();">

<?
include ("variables.php");
switch ($estado){
		  case "1":{
			  $estado = "Activo";
			  break;
		  }

		  case "2":{
			   $estado = "Suspendido";
			  break;
		  }

		  case "3":{
				$estado = "Baja";
			  break;
		  }

	  }
?>
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF"> 
      <td height="34" colspan="3"><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>FICHA PERSONAL</strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td colspan="3" bgcolor="#FFFFFF"><hr noshade></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="41%" bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Cuenta: </font>
      </div></td>
      <td width="21%" bgcolor="#FFFFFF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font><font size="2" face="Arial, Helvetica, sans-serif"> </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
        
      </font><font size="2" face="Arial, Helvetica, sans-serif">     </font>      
      </div>        
      <strong><font size="2" face="Arial, Helvetica, sans-serif"><?echo $a;?></font></strong></td>
      <td width="38%" bgcolor="#FFFFFF"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font>:<font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
    <?echo $hoy;?>  </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Estado: </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $estado;?></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Denominaci&oacute;n: </font> </div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $denominacion;?></strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Domicilio: </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif">
      <strong><?echo $domicilio;?></strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Puerta: </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $puerta;?></strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Referencia: </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $referencia;?></strong> </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo Postal: </font></div></td>
    <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif">
    <strong><?echo $cod_postal;?></strong></font>    
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad: </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2">
        </font>      </div>        
        <font size="2" face="Arial, Helvetica, sans-serif"><?print("$localidad");?></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(1): </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif">
      <strong><?echo $caracteristica_1;?> <?echo $telefono_1;?>     (Fijo) </strong> </font></td>
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(2): </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF">        <font size="2" face="Arial, Helvetica, sans-serif">
      <strong><?echo $caracteristica_2;?> <?echo $telefono_2;?>
(Fijo)</strong></font>        <div align="right"></div>                  </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(3): </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"> <strong><?echo $caracteristica_3;?>  <?echo $telefono_3;?>    (Celular) </strong>     </font>        <div align="right"></div>
    <div align="left"> </div></td></tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Email: </font></div></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $email;?></strong> </font>
        
      </td>
    </tr>
</table>
  <br>  


<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF">
      <td height="21" colspan="7"><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>CONDICIONES DE VENTA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td colspan="4" bgcolor="#FFFFFF"><hr noshade></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CUIT: </font></div></td>
      <td colspan="3" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
  <?echo $cuit;?>    </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td width="41%" bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo de IVA: </font></div></td>
      <td width="59%" colspan="3" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>

	  <?switch ($iva){
		  case "1":{
			  $iva = "Resp. Inscripto";
			  break;
		  }

		  case "2":{
			   $iva = "Monotributista";
			  break;
		  }

		  case "3":{
				$iva = "Exento";
			  break;
		  }

	  }
		  
		  
		  ?>
		<?print("$iva");?>
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nro Ingresos Brutos: </font></div></td>
      <td colspan="3" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
   <?print("$ingresos_brutos");?>   </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Credito $: </font></div></td>
      <td colspan="3" bgcolor="#FFFFFF"> <font size="2" face="Arial, Helvetica, sans-serif"><strong>
   <?echo $credito;?>     </strong>(M&aacute;ximo credito importe en pesos) </font>        <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Flete: </font></div></td>
      <td colspan="3" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?print("$flete");?>
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Observaciones: </font></div></td>
      <td colspan="3" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
  <?echo $observaciones;?>    </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#FFFFFF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Plan: </font></div></td>
      <td colspan="3" bgcolor="#FFFFFF"><font size="2" face="Arial, Helvetica, sans-serif"><strong> <?echo $plan;?>     </strong></font></td>
    </tr>
</table>

  
