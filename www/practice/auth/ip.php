<?php




session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


include('../../php-inc/header.php');

// CLIENT-IP
// X_FORWARDED_FOR
// X_FORWARDED_FOR


if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $myip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $myip= $_SERVER['REMOTE_ADDR'];
}
if ($myip == "127.0.0.1"){
    echo "Hi admin!<br> answer is  flag{HTTP_Header_Not_Safe}<br>";
}else{
    echo "please use 127.0.0.1 to login<br>";
}

    
echo '<a href="/practice/auth/l1.php">Back</a>';

include('../../php-inc/footer.php');


    ?>