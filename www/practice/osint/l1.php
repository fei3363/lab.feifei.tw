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
    if($input_answer=="網域"||$input_answer=="域名"){
        $challenges_name = "OSINT-Tool-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{Robots_txt_in_here}"){
        $challenges_name = "OSINT-Tool-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="GANDI SAS"){
        $challenges_name = "OSINT-Tool-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="SSH"){
        $challenges_name = "OSINT-Tool-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{dirb_none}"){
        $challenges_name = "OSINT-Tool-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="5.9.3"){
        $challenges_name = "OSINT-Tool-6";
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
    $titlename='OSINT';
	include_once('../../php-inc/header.php');
?>






<h1>OSINT</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>
<h2>LAB1</h2>
請問 Google Hacking 中 site 語法是針對____作為搜尋<br>

<br>

<h2>LAB2</h2>
請於目前網站中的 robots.txt 中找到 flag<br>
<br>

<h2>LAB3</h2>
使用工具 whois<br>
$sudo apt install whois<br>
找出 feifei.com.tw 的域名提供者（Registration Service Provider)<br>
<br>

<h2>LAB4</h2>
使用工具 nmap<br>
找出 <?php echo $_SERVER['HTTP_HOST'] ?> port 22 SERVICE 為何(全大寫)<br>
<br>

<h2>LAB5</h2>
使用工具 dirb<br>
找出 <?php echo $_SERVER['HTTP_HOST'] ?>長度 15 的檔案內容<br>
<br>

<h2>LAB6</h2>
找出 https://feifei.tw/ WordPress  版本 <br>
<br>





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
