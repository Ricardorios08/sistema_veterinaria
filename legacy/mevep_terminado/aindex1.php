<html>
<head>
  <title>Frames Test</title>
  <style>
   .arriba {
      float:left;
      width:95%;
      height:20%;
    }
    .central {
      float:left;
      width:85%;
      height:80%;
    }

	 .izquierda {
      float:left;
      width:12%;
      height:80%;
    }


	 .derecha {
      float:left;
      width:75%;
      height:80%;
    }


  </style>
</head>
<body>

  <iframe class="arriba" src="drivers/frames/frame_arriba.php?usuario=<?php print("$usuario");?>"></iframe>
  <iframe class="izquierda" src="drivers/frames/frame_izquierdo.php"></iframe>
  
  <iframe class="central" src="validar/pantalla_inicial2.php"></iframe>



</body>
</html>



