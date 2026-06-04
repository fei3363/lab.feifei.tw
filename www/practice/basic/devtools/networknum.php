<?php

session_start();


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$_SESSION['networknum'] = rand();

$networknum = $_SESSION['networknum'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo $networknum;
}

?>