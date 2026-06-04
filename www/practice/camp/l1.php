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
    if($input_answer=="觀察"){
        $challenges_name = "Camp-PreWebSec-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="利用"){
        $challenges_name = "Camp-PreWebSec-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="白帽駭客"){
        $challenges_name = "Camp-PreWebSec-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="SSDLC"){
        $challenges_name = "Camp-PreWebSec-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Google"){
        $challenges_name = "Camp-PreWebSec-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="OWASP TOP 10"){
        $challenges_name = "Camp-PreWebSec-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="site"){
        $challenges_name = "Camp-PreWebSec-7";
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
    $titlename=' 前置開發、攻擊基礎';
	include_once('../../php-inc/header.php');
?>

<h1>前置開發、攻擊基礎</h1>

<ul>
    <li> 當你想偷東西、攻擊網站的時候，第一步會做「**」</li>
    <li> 當你蒐集到資訊，第二步會「**」這些資訊</li>
    <li> 黑帽駭客總是搞破壞，甚至會違反刑法民法；而「****」則是守護企業的安全，幫客戶做滲透測試</li>
    <li> 當一個開發者，想寫出安全的軟體，可以透過「S****」從開發專案開始，各階端都加入安全防護</li>
    <li> 查資料的時候，我們都會用「G****」駭客也會，駭客還會查詢一些已知漏洞或是弱點特徵</li>
    <li> OWASP 是一個非營利組織，從三到四年就會統計網站的前十大弱點，這個專案名稱為「O*****T******」</li>
    <li> 在 Google Hacking 中，針對特定網站/網址/網域，所使用的關鍵字為「s***」</li>
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