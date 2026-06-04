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
    if($input_answer=="Flag{Get_data_s3kv}"){
        $challenges_name = "Curl-tool-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{Post_data_l3jy}"){
        $challenges_name = "Curl-tool-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{Get_cookie_sjyl}"){
        $challenges_name = "Curl-tool-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{Send_cookie_4gjk}"){
        $challenges_name = "Curl-tool-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{U_R_Cooooool_me0w_me0w!!!}"){
        $challenges_name = "Curl-tool-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{y0u_know_location}"){
        $challenges_name = "Curl-tool-6";
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






<h1>CURL</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>

<h2>LAB1</h2>
請求 <a href="curl/get.php"> curl/get.php </a>
取得 flag <br>
<br>

<h2>LAB2</h2>
請求 <a href="curl/post.php"> curl/post.php </a>
POST 參數名稱 data 參數值 good<br>
取得 flag <br>
<br>

<h2>LAB3</h2>
請求 <a href="curl/getcookie.php"> curl/getcookie.php </a>
取得 flag <br>
<br>


<h2>LAB4</h2>
請求 <a href="curl/sendcookie.php"> curl/sendcookie.php </a>
Cookie 參數名稱 flag 內容 givemeflag
取得 flag <br>
<br>


<h2>LAB5</h2>
請求 <a href="curl/options.php"> curl/options.php </a>
OPTIONS 找到 flag <br>
<br>

<h2>LAB6</h2>
請求 <a href="curl/location.php"> curl/location.php </a>
找到 flag <br>
<br>

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

