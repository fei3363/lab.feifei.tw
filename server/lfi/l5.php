<?php
session_start();
include($_SESSION['lang'] . '.php');


if (isset($_GET['src'])){
    highlight_file(__FILE__);}

?>
<br><br>
致敬  DEVCORE-Wargame/HITCON-2021<br>

<a href='?src'>Source Code</a>