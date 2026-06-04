<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("config.php");


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["q1-plaintext"]) && isset($_POST["q2-plaintext"]) ){
    $input_q1_plaintext = $_POST["q1-plaintext"];
    $input_q1_algorithm = strtolower($_POST["q1-algorithm"]);
    $input_q2_plaintext = $_POST["q2-plaintext"];
    $input_q2_algorithm = strtolower($_POST["q2-algorithm"]);

    if ($input_q1_plaintext=="secret" && $input_q1_algorithm=="md5" && $input_q2_plaintext=="admin" && $input_q2_algorithm=="sha256") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cryptography-1-hash";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert',' 答案錯誤');
    
    }
}else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["string"])){
    $text = $_GET["string"];
    $textMD5 = md5($text);
    $textSHA256 = hash('sha256', $text);

}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];

?>



<?php
  $titlename='Cryptography';
  include_once('../../php-inc/header.php');
?>


<h1>Cryptography</h1>

<ul>
    <li>雜湊演算法</li>
    <li>弱雜湊演算法</li>
    <li>加密演算法</li>
    <li>弱加密演算法</li>
    <li>強加密演算法</li>
</ul>

<h2>Hash</h2>
<li>不能反解</li>
<li>找得到明文，因為弱演算法容易被人收集成製作雜湊值與明文對應表</li>
<form name="intercept-request" method="POST" action="">
<p>5EBE2294ECD0E0F08EAB7690D2A6EE69</p>
明文：<input type="text" value="" name="q1-plaintext">
使用的雜湊演算法：<input type="text" value="" name="q1-algorithm">

<p>8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918</p>
明文：<input type="text" value="" name="q2-plaintext">
使用的雜湊演算法：<input type="text" value="" name="q2-algorithm">

<input type="submit" value="Submit">
</form>


<h2>Tool</h2>
<form name="" method="GEY" action="">
    輸入明文字串進行編碼 <input type="text" value="" name="string">
    <input type="submit" value="Submit">
</form>


<li>md5($text)<?php echo $textMD5;?> </li>
<li>hash('sha256', $text)<?php echo $textSHA256;?> </li>



<h2>加密</h2>
<li>對稱式加密</li>
<li>非對稱式加密</li>
<b>可參考密碼學相關課程，涉及古典密碼學與應用密碼學。</b>

<?php
include_once('../../php-inc/footer.php');
?>