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
    if($input_answer=="oQd)&y)%)trUJmni@5"){
        $challenges_name = "Remote-Code-Execution-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    
    }else if($input_answer=="flag{you_get_the_webshell}"){
        $challenges_name = "Remote-Code-Execution-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    
    }else if($input_answer=="flag{you_get_toor}"){
        $challenges_name = "Remote-Code-Execution-3";
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
    $titlename='Remote Code Execution';
	include_once('../../php-inc/header.php');
?>

<h2>RCE</h2>

<h3> 何謂 RCE</h3>
<h3>RCE 會造成什麼結果</h3>
<h3>如何達到 RCE</h3>
<h3>RCE 之後要做什麼事情</h3>

<h2>小試身手</h2>

34.125.211.181
<ul>
    <li>找到密碼</li>
    <li>上傳後門，拿到第一個 flag </li>
    <li>提升權限，拿到第二個 flag</li>
</ul>

<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>



