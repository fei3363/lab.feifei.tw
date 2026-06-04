

<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include_once("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){


    $input_answer = $_POST["answer"];

    if($input_answer=="flag{git_leak_demo}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Authentication-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }

    $challenge_type =  $challenge_array[0];
    $challenge_messange =  $challenge_array[1];
}

    

 
?>


<?php
    $titlename='HTTP-1';
	include_once('../../php-inc/header.php');
?>




<h1>GitHack</h1>







<h2>lab1</h2>
<ul>
    <li>工具一<ul>
<li>git clone https://github.com/lijiejie/GitHack.git</li>
<li>cd GitHack</li>
<li>python GitHack.py http://IP/.git</li>
<li>ls 查看一下有新增什麼資料夾</li>
<li>cd 該資料夾查看裡面的內容</li>
</ul>
</li>
<li>工具二
<ul>
<li>git clone https://github.com/denny0223/scrabble</li>
<li>cd scrabble</li>
<li>./scrabble https://lab.feifei.tw/</li>
<li>ls</li>
<li>git log</li>
<li>git checkout [hash value]</li>
<li>ls</li>
</ul>
</li>
</ul>




<form method="POST">
    <div class="form-group">
        <label for="answer"><br><h4>Flag 提交</h4></label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>