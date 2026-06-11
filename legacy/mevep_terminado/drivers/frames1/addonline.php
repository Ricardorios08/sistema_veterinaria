<?php 
    include("webvars.php"); 

    $link = mysql_connect($hostname, $user, $password); 
    mysql_select_db($database); 

    $query = ("CREATE TABLE IF NOT EXISTS online ( 
        id int(11) NOT NULL auto_increment, 
        agent varchar(255) default NULL, 
        host varchar(255) default NULL, 
        ip varchar(15) NOT NULL default '', 
        port int(11) default NULL, 
        referer varchar(255) default NULL, 
        site varchar(255) default NULL, 
        time varchar(255) NOT NULL default '', 
        PRIMARY KEY  (id) 
    ) TYPE=MyISAM;"); 

    mysql_query($query) or die("MySQL Error: " . mysql_error()); 

    $agent = $_SERVER["HTTP_USER_AGENT"]; 
    $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]); 
    $ip = $_SERVER["REMOTE_ADDR"]; 
    $port = $_SERVER["REMOTE_PORT"]; 
    $referer = $_SERVER["HTTP_REFERER"]; 
    $site = $_SERVER["REQUEST_URI"]; 
    list($utime, $time) = explode(" ", microtime()); 

    $query = ("SELECT * FROM online WHERE ip = '$ip';"); 
    $result = mysql_query($query) or die("MySQL Error: " . mysql_error()); 

    if (!mysql_num_rows($result)) { 
        $query = ("INSERT INTO online (id, agent, host, ip, port, referer, site, time) VALUES(NULL, '$agent', '$host', '$ip', '$port', '$referer', '$site', '$time');"); 
        mysql_query($query) or die("MySQL Error: " . mysql_error()); 
    } 

    $query = ("DELETE FROM online WHERE time < ($time - 900);"); 
    mysql_query($query) or die("MySQL Error: " . mysql_error()); 

    $query = ("UPDATE online SET agent = '$agent', host = '$host', port = '$port', referer = '$referer', site = '$site' WHERE ip = '$ip';"); 
    mysql_query($query) or die("MySQL Error: " . mysql_error()); 
?> 