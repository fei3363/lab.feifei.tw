<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("config2.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"]) ){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="<input>"){
        $challenges_name = "Camp-PreHTML-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="瀏覽器"){
        $challenges_name = "Camp-PreHTML-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="資料庫"){
        $challenges_name = "Camp-PreHTML-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="目標系統"){
        $challenges_name = "Camp-PreHTML-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="?"){
        $challenges_name = "Camp-PreHTML-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="表單"){
        $challenges_name = "Camp-PreHTML-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Cookie"){
        $challenges_name = "Camp-PreHTML-7";
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
    $titlename='前置網頁基礎';
	include_once('../../php-inc/header.php');
?>

<h1>前置網頁基礎</h1>

<ul>
    <li> HTML 是網頁的骨架，其中要讓頁面出現「輸入框」的標籤是什麼(******)</li>
    <li> JavaScript 是一個程式語言，可以在前端被「***」解析內容做到互動行為</li>
    <li> 後端通常指的是我們看不到的背後邏輯，如跟儲存資料的「***」進行互動</li>
    <li> 瀏覽器構造封包給伺服器時，會在請求封包加入「Host」的標頭，該標頭代表的意思是請求的「*****」</li>
    <li> 瀏覽器直接輸入網址時，會利用 GET 的方法請求，請問 GET 透過「*」代表有參數的意思」</li>
    <li> 通常是填寫「**」的時候，會使用請求方法 POST 傳送封包。</li>
    <li> 使用 Cookie 的機制時，第一次輸入帳號密碼，驗證成功後，會在回傳封包的標頭加上"Set-cookie"，
        而瀏覽器看到之後，就會儲存於瀏覽器中，並於下次進入該網站時，會在請求封包的標頭加上"*****""
    </li>
</li>
</ul>


<h2>小試身手</h2>
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