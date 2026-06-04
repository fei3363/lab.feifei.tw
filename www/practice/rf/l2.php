<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="GET"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Request-Forgeries-1";
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
    $titlename='CSRF with a GET request';
	include_once('../../php-inc/header.php');
?>






<h1>SSRF</h1>

<h2>lab1</h2>



lab1

<form method="GET">
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" class="form-control" placeholder="輸入 URL" id="url" name="url">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["url"])){
$url = $_GET['url'];;
echo file_get_contents($url);
}
?>


<?php
	include_once('../../php-inc/footer.php');
?>





