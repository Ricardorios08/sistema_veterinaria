<?php 
 /*   include("addonline.php"); // put this line on top of each page 
     
    $query = ("SELECT agent, host, ip, port, referer, site FROM online ORDER BY host ASC;"); 
    $result = mysql_query($query) or die("MySQL Error: " . mysql_error()); 

    while ($row = mysql_fetch_array($result)) { 
      
        echo $row["ip"];
		echo " - ";
		echo $row["host"];
		echo "<br>";
    } 
     
    mysql_close($link); */

	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo $_SERVER['REMOTE_ADDR'];
echo "<br>";
?> 