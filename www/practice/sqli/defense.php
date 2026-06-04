<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("config.php");

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
    $titlename='預防 SQL injection';
	include_once('../../php-inc/header.php');
?>

<h1>預防 SQL injection</h1>

<h2>Prepared statements 預置參數敘述句</h2>
<ul>
    <li>利用佔位符作為接收資料的變數 - 變數綁定 bind variable</li>
    <li>編譯之後，佔位符號會換成指定的值</li>
</ul>
<li>範例程式碼</li>
<pre class="php" style="font-family:monospace;"><span style="color: #000088;">$statement</span> <span style="color: #339933;">=</span> <span style="color: #000088;">$dbh</span><span style="color: #339933;">-&gt;</span><span style="color: #004000;">prepare</span><span style="color: #009900;">&#40;</span><span style="color: #0000ff;">&quot;select * from users where email = ?&quot;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span>
<span style="color: #000088;">$statement</span><span style="color: #339933;">-&gt;</span><span style="color: #004000;">execute</span><span style="color: #009900;">&#40;</span><span style="color: #990000;">array</span><span style="color: #009900;">&#40;</span>email<span style="color: #009900;">&#41;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span></pre>

<h2>ORM</h2>
<ul>
    <li>Object Relational Mapping</li>
    <li>不直接撰寫 SQL 語法</li>
</ul>
<li>範例程式碼</li>
<pre class="python" style="font-family:monospace;">Users.<span style="color: black;">objects</span>.<span style="color: #008000;">filter</span><span style="color: black;">&#40;</span><span style="color: #dc143c;">email</span><span style="color: #66cc66;">=</span><span style="color: #dc143c;">email</span><span style="color: black;">&#41;</span></pre>

<!-- 
<h2>小試身手</h2>
<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form> -->



<?php
	include_once('../../php-inc/footer.php');
?>