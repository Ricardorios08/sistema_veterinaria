<table width="828" border="1" bordercolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr bordercolor="#333333" bgcolor="#006699">
    <td height="44" colspan="2" align="left" valign="top"><div align="center"><font color="#FFFFCC" size="6"><strong>Ventas Proveeduria</strong></font></div></td>
  </tr>
  <tr>
    <td width="811" height="401" align="left" valign="top"><div align="center">
        <table width="811" height="72" border="0">
          <tr bgcolor="#006699">
            <td height="23" colspan="10"><div align="center"><strong><font color="#FFFFCC">Ingreso de Datos</font></strong> </div></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td width="68" height="43" bgcolor="#FFFF99"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Bioquimico</font></div></td>
            <td width="76" bgcolor="#FFFF99"><input type = "text" name = "cuenta" id="cuenta3" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['cuenta']))   echo $_REQUEST['cuenta'];?>">              <font color="#FF0000" size="3"><strong>
              <?
	  echo $cuenta;
	  ?>
              </strong></font></td>
            <td width="37" bgcolor="#FFFF99">CUIT</td>
            <td width="50" bgcolor="#FFFF99"><input type = "text" name = "cuenta2" id="cuenta4" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['cuenta']))   echo $_REQUEST['cuenta'];?>"></td>
            <td width="92" bgcolor="#FFFFCC">
              <div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Laboratorio</font></div></td>
            <td width="62" bgcolor="#FFFFCC"><font color="#000000" size="2">
              <input type = "text" name = "laboratorio" id="laboratorio3" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['laboratorio']))   echo $_REQUEST['laboratorio'];?>">
            </font></td>
            <td width="82" bgcolor="#FFFFCC"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CONDICI&Oacute;N</font></td>
            <td width="62" bgcolor="#FFFFCC"><font color="#000000" size="2">
              <input type = "text" name = "cuenta22" id="cuenta222" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['cuenta']))   echo $_REQUEST['cuenta'];?>">
            </font></td>
            <td width="83" bgcolor="#FFFFCC"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font></td>
            <td width="157" bgcolor="#FFFFCC"><input type = "text" name = "fecha" id="fecha2" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['fecha']))   echo $_REQUEST['fecha'];?>"></td>
          </tr>
        </table>
        <div align="center">        </div>
        </div></td>
    <td width="1" valign="top"><!--DWLayoutEmptyCell-->&nbsp;    </td>
  </tr>
</table>
