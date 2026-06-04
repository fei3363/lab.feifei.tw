<?php




session_start();


include('../../php-inc/header.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo 'You are not logged in.<br>';
    echo 'flag{Broken_Authentication}<br>';
}else{
    echo 'You are logged in.<br>';
    echo '可以用無痕模式訪問這個頁面<br>';

}

echo '<a href="/practice/auth/l1.php">Back</a>';

include('../../php-inc/footer.php');


    ?>