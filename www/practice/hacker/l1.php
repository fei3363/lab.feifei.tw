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
    if($input_answer=="部署"){
        $challenges_name = "Hacker-L1-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="版本控制"){
        $challenges_name = "Hacker-L1-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer==".git"){
        $challenges_name = "Hacker-L1-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="site" or $input_answer=="SITE" ){
        $challenges_name = "Hacker-L1-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="目錄遍歷"){
        $challenges_name = "Hacker-L1-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="權限"){
        $challenges_name = "Hacker-L1-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="歷史紀錄"){
        $challenges_name = "Hacker-L1-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="hardcode"){
        $challenges_name = "Hacker-L1-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{git_leak_demo}"){
        $challenges_name = "Hacker-L1-9";
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
    $titlename='駭客說：我看得到網站的程式碼';
	include_once('../../php-inc/header.php');
?>

<h1>駭客說：我看得到網站的程式碼</h1>

<ul>
    <li> 開發網站的流程：需求、設計、開發、「**」、上線</li>
    <li> git 是用來做「****」的軟體</li>
    <li> 使用 git 時，會在專案資料夾出現「****」資料夾</li>
    <li> 使用 Google Hacking 時，利用「****」可以針對指定網域進行搜尋</li>
    <li> index of 是「****」的弱點，主要是因為工程師設定錯誤/忘記設定</li>
    <li> 當存取網頁的時候如 .git 資料夾 出現 403 錯誤碼/Forbidden，表示你沒有「**」才不能存取 </li>
    <li> git log 可以看到專案資料夾的「****」</li>
    <li> 把帳號密碼寫死在程式碼的弱點叫做「********」(英文)</li>
    <li> https://lab.feifei.tw 有 .git 洩漏問題，請嘗試存取 Readme.txt 取得 FLAG</li>
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