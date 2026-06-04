<?php




session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


include('../../php-inc/header.php');

if ($_COOKIE["admin"]==1){
    echo 'Hi admin!<br> answer is  flag{Trusting_cookies_is_not_s@fe}<br>';}
else{
    echo 'You are not admin!<br>';
}
    
echo '<a href="/practice/auth/l1.php">Back</a>';

include('../../php-inc/footer.php');


    ?>