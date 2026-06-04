<?php

define('DB_SERVER', 'db');
define('DB_USERNAME', 'xssuser');
define('DB_PASSWORD', 'happyxsshacking');
define('DB_NAME', 'myDb');
$link_xss = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link_xss === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



?>