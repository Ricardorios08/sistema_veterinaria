 <?include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

 $sql="select * from tasas_planes";
 $result = $db->Execute($sql);



 ?>



<table width="589" border="0">
      <tr>
        <th width="66" scope="col">&nbsp;</th>
        <th colspan="2" bgcolor="#000099" scope="col"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Descuento </font></th>
        <th colspan="5" bgcolor="#000099" scope="col"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Recargo</font><font size="2" face="Arial, Helvetica, sans-serif"></font></th>
        <th width="69" scope="col"><font size="2" face="Arial, Helvetica, sans-serif"></font></th>
        <th width="84" scope="col">&nbsp;</th>
        <th width="48" scope="col">&nbsp;</th>
      </tr>
      <tr bgcolor="#000099">
        <th scope="row"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Plan</font></div></th>
        <th width="49"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">1</font></div></th>
        <th width="49"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">2</font></div></th>
        <th width="28"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">1</font></div></th>
        <th width="33"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">2</font></div></th>
        <th width="64"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Flete</font></div></th>
        <th width="66"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Mensual</font></div></th>
        <th width="81"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Impuesto</font></div></th>
        <th><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Cuotas</font></div></th>
        <th><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Modificar</font></th>
        <th><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Borrar</font></th>
      </tr>

<?
	  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_plan=strtoupper($result->fields["cod_plan"]);
$descuento_1=strtoupper($result->fields["descuento_1"]);
$descuento_2=strtoupper($result->fields["descuento_2"]);
$recargo_1=strtoupper($result->fields["recargo_1"]);
$recargo_2=strtoupper($result->fields["recargo_2"]);
$recargo_flete=strtoupper($result->fields["recargo_flete"]);
$recargo_impuesto=strtoupper($result->fields["recargo_impuestos"]);
$cuotas=strtoupper($result->fields["cuotas"]);
$recargo_mensual=strtoupper($result->fields["recargo_mensual"]);





?>
      <tr bgcolor="#E8DCFC">
        <td scope="row"><div align="center"><?print("$cod_plan");?>
          </div>
        <div align="center"></div></td>
        <td><div align="center"><?print("$descuento_1");?>
        </div></td>
        <td><div align="center"><?print("$descuento_2");?>
        </div></td>
        <td><div align="center"><?print("$recargo_1");?>
        </div></td>
        <td><div align="center"><?print("$recargo_2");?>
        </div></td>
        <td><div align="center"><?print("$recargo_flete");?>
        </div></td>
        <td><div align="center"><?print("$recargo_mensual");?>
        </div></td>
        <td><div align="center"><?print("$recargo_impuesto");?>
        </div></td>
        <td><div align="center">
          <?print("$cuotas");?> </div></td>
        <td><div align="center"><a href="modificar.php?id=<?print("$cod_plan");?>"><IMG SRC="../../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></div></td>
        <td><div align="center"><a href="borra.php?id=<?print("$cod_plan");?>"><IMG SRC="../../../imagenes/office/1047.ico" alt="Eliminar" border = "0"></a></div></td>
      </tr>


	  <?$result->MoveNext();}?>

    </table>
	