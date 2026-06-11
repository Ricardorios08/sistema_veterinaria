<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SULB - Sistema Único Laboratorios Bioquímicos</title>
</head>

<?php $usuario;?> 
<frameset rows="145,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="drivers/frames/frame_arriba.php?usuario=<?php print("$usuario");?>" name="arriba" scrolling="No" noresize="noresize" id="arriba" title="arriba" />
  

<FRAMESET cols="167,857,20%">
<FRAME src="drivers/frames/frame_izquierdo.php" name="izquierda" scrolling="No" noresize="noresize" id="izquierda" title="izquierda" />
<FRAME src="validar/pantalla_inicial2.php" name="central" id="central" title="central" />
<FRAME src="drivers/frames/frame_izquierdo2.php" name="derecha" id="derecha" title="derecha" />
</FRAMESET>
</FRAMESET>




</frameset>
<noframes><body>
</body>
</noframes></html>


