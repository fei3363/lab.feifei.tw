<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username=="root" && $password=="michael1"){
        echo "flag{you_can_use_Intruder}";
    }else{
        echo "登入失敗";
    }
}
?>

<form method="POST" action="login.php">
    <input id="username" placeholder="Username" required="" autofocus="" type="text" name="username">
    <input id="password" placeholder="Password" required="" type="password" name="password">
    <button  type="submit">登入</button>
</form>