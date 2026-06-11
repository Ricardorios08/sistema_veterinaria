<?php 
  /*  include("addonline.php"); // put this line on top of each page 
     
    $query = ("SELECT agent, host, ip, port, referer, site FROM online ORDER BY host ASC;"); 
    $result = mysql_query($query) or die("MySQL Error: " . mysql_error()); 

    while ($row = mysql_fetch_array($result)) { 
        $row["agent"] = htmlentities($row["agent"], ENT_QUOTES); 
        $row["referer"] = htmlentities($row["referer"], ENT_QUOTES); 
        print("<a href=\"http://" . $row["ip"] . "/\">" . $row["ip"] . "</a> <a href=\"http://" . $row["host"] . "/\">" . $row["host"] . "</a> " . $row["port"] . " <a href=\"" . $row["site"] . "\">" . $row["site"] . "</a> " . $row["agent"] . " <a href=\"" . $row["referer"] . "\">" . $row["referer"] . "</a><br />\n"); 
    } 
     
    mysql_close($link); */
?> 

<?php
####Imagen
//header("Content-type: image/png");
//$im=imagecreatefrompng("nombre_imagen.png");
 
//imagepng($im);
 
 

$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$name = gethostbyaddr($_SERVER['REMOTE_NAME']);

//echo $_SERVER['REMOTE_ADDR'];
echo $_SERVER['SERVER_NAME'];

echo "<br>";

 
 
?>