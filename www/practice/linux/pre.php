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
    if($input_answer=="flag{cat_lookmetxt}"){
        $challenges_name = "Linux-pre-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{The_bash_history_is_located_under_~/.bash_history}"){
        $challenges_name = "Linux-pre-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{check_tmp_next.txt}"){
        $challenges_name = "Linux-pre-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{good_at_find_file}"){
        $challenges_name = "Linux-pre-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{you_know_zip_and_tar}"){
        $challenges_name = "Linux-pre-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{Got_Wendy_user}"){
        $challenges_name = "Linux-pre-6";
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






<h1>Linux</h1>

<h3>使用命令提示字元</h3>
目前未開放，若有需要請洽資源頻道 敲 feifei<br>
<!-- ssh fei@IP -p <? echo$_COOKIE['port'];?><br> -->
密碼：feifeiP@ssword!<br>
<br>


<h3>使用瀏覽器外掛 Google 開發</h3>
目前未開放主機，若有需要請洽資源頻道 敲 feifei<br>
<a href="https://chrome.google.com/webstore/detail/secure-shell-app/pnhechapfaindjhompbnflcldabbghjo">安裝</a><br>
輸入 ssh<br>
<!-- 再輸入 fei@IP:<? echo$_COOKIE['port'];?><br> -->
<!-- 密碼：feifeiP@ssword!<br> -->
<br>

本題 LAB 需使用闖關伺服器，目前伺服器未開放！<br>
目前未開放，若有需要請洽資源頻道 敲 feifei<br>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>
<h2>LAB1</h2>
<p style="color:#FFFFFF">ls,cat</p>
<br>
<br>
<h2>LAB2</h2>
<p style="color:#FFFFFF">history</p>

<br>
<br>
<h2>LAB3</h2>
<p style="color:#FFFFFF">cd,cat</p>

<br>
<br>
<h2>LAB4</h2>
<p style="color:#FFFFFF">find,cat</p>

<br>
<br>
<h2>LAB5</h2>
<p style="color:#FFFFFF">cd,sudo,apt,unzip</p>

<br>
<br>
<h2>LAB6</h2>
<p style="color:#FFFFFF">su</p>

<br>
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
