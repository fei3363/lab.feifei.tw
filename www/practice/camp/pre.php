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
    if($input_answer=="feifei.tw"){
        $challenges_name = "Camp-Pre-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="社交工程"){
        $challenges_name = "Camp-Pre-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="開發者工具"){
        $challenges_name = "Camp-Pre-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="事件調查"){
        $challenges_name = "Camp-Pre-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="逆向工程"){
        $challenges_name = "Camp-Pre-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="ATT&CK"){
        $challenges_name = "Camp-Pre-6";
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
    $titlename='資安基礎';
	include_once('../../php-inc/header.php');
?>

<h1>資安基礎</h1>

<ul>
    <li>請問講師的部落格(包含許多資安文章)的網址為何(f******w)</li>
    <li>請問關於「資安風險」中釣魚網站、交友詐騙、釣魚信件、惡意檔案中「如何騙你上鉤」的資安名詞為何(****)</li>
    <li>請問關於分析釣魚網站，可以利用「*****」查看網頁的原始碼。</li>
    <li>想要針對資安事件瞭解經過，可以做資安「****」</li>
    <li>想要知道惡意程式的行為，可以針對該程式做「****」分析</li>
    <li>想要知道其他駭客集團的攻擊手法，可以看資料庫「******」</li>
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