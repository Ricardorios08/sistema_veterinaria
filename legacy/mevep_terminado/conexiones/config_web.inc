<?php

 require_once('C:/utiles/EasyPHP-5.3.8.1/php/PEAR/adodb/adodb.inc.php');


 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "laboratorio");