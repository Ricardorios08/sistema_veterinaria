<?php
phpinfo();

if (!extension_loaded('php_lxv4')) {
    if (!dl('php_lxv4.dll')) {
        exit;
    }
}


?>