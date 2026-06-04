<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    if ($input_answer == "Set-Cookie") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-LAB-1";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else if ($input_answer == "HttpOnlyCo0k1e") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-LAB-2";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      }else if ($input_answer == "secureCo0k1e") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-LAB-3";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else{
        $challenge_array = ["alert", "答案錯誤"];
    }
}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];
    

 
?>


<?php
    $titlename='Cookie';
	include_once('../../php-inc/header.php');
?>


Lab: 請確認 <a href="cookiecheck.php">頁面</a> 並回答以下問題
<br>

1. 伺服器在回應封包中透過什麼標頭設定 cookie (S********e)<br>
2. 有設定 HTTPOnly 屬性的是哪一個 Cooke (H************e)<br>
2. 有設定 secure 屬性的是哪一個 Cooke (s*********e)<br>




<form method="POST">
    <div class="form-group">
        <label for="answer"><br><h4>Flag提交</h4></label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>



