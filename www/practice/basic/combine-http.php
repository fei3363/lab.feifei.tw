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
    if($input_answer=="flag{cute_cat_in_here}"){
        $challenges_name = "Combine-HTTP-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }
}else if(isset($_POST["method_answer"]) && isset($_POST["magic_answer"]) ){
        
    $input_answer = strtolower($_POST["method_answer"]);
    $input_magic_answer = $_POST["magic_answer"];
    $input_magic_num = $_POST["magic_num"];
    if( $input_answer=="post"  && $input_magic_answer == $input_magic_num){
        $user_id = $_SESSION["id"];
        $challenges_name = "Combine-HTTP-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }       
}else if(isset($_POST["ans"]) ){
    $input_answer = strtolower($_POST["ans"]);
    if($input_answer=="application/json"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Combine-HTTP-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }
}else if($_SERVER["REQUEST_METHOD"] == "GET") {
    $challenge_array = array('','');
}else{
        $challenge_array = array('alert','答案錯誤');
}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];
    

 
?>


<?php
    $titlename='HTTP 綜合演練';
	include_once('../../php-inc/header.php');
?>

<h2>LAB1 練習</h2>


<form method="post">
    表單<br>
    請觀察目前這個表單<br>
    這個表單使用什麼 HTTP method ?(可查看 HTML form tag )<br>
    <input type="text" name="method_answer"><br>
    在這一個表單當中隱藏一個 magic_num，<br>
    請試著找出封包中的 magic number <br>
    <input type="text" name="magic_answer"><br>
    <input type="hidden" name="magic_num" id="magic_num" value=""><br>
    <input type="submit" value="送出"><br>
</form>


<h2>LAB2 練習</h2>
確認 <a href='combine-http/json.php'>網頁的</a> Content-type

<form method="post">
    Content-type: <input type="text" name="ans"><br>
    <input type="submit" value="送出"><br>
</form>


<script>
var x = Math.floor((Math.random() * 100) + 1);
document.getElementById("magic_num").value = x;
</script>


<h2>LAB3 練習</h2>
確認 Robots.txt 內，使用指定的 User-agent 找到答案 

<h2>小試身手</h2>
<form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案"
                aria-label="回答問題" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出答案</button>
            </div>
        </div>
    </form>



<?php
	include_once('../../php-inc/footer.php');
?>