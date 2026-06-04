<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hidden1"]) && isset($_POST["hidden2"]) && isset($_POST["hidden3"])){
    $input_hidden1 = $_POST["hidden1"];
    $input_hidden2 = $_POST["hidden2"];
    $input_hidden3 = $_POST["hidden3"];

    $input_array = array ($input_hidden1,$input_hidden2,$input_hidden3);
    $answer_array = array("userlist","admin","config");

    $result=array_diff($input_array,$answer_array);
    if (count($result) == 0){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Access-Control-3";
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
    $titlename='HTTP-1';
	include_once('../../php-inc/header.php');
?>




<h1>Missing Function Level Access Control</h1>

<ul>
    <li>
        開發者沒注意到的問題

        <ul>
            <li>
                會員資料
            </li>
            <li>
                圖片
            </li>
            <li>Session</li>
        </ul>
    </li>


</ul>





<h2>lab1</h2>



請找出可能隱藏的功能名稱



<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="#">News</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">User</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">info</a>
      <a class="dropdown-item" href="#">Add</a>
      <a class="dropdown-item" href="#">list</a>
    </div>
  </li>
  <li class="nav-item dropdown d-none">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">userlist</a>
      <a class="dropdown-item" href="#">admin</a>
      <a class="dropdown-item" href="#">config</a>
    </div>
  </li>
</ul>




<form  method="POST">
  <div class="form-group">
    <label for="hidden1">HiddenValue1:</label>
    <input type="text" class="form-control" placeholder="Enter flag" id="hidden1" name="hidden1">
  </div>
  <div class="form-group">
    <label for="hidden2">HiddenValue2:</label>
    <input type="text" class="form-control" placeholder="Enter flag" id="hidden2" name="hidden2">
  </div>
  <div class="form-group">
    <label for="hidden3">HiddenValue3:</label>
    <input type="text" class="form-control" placeholder="Enter flag" id="hidden3" name="hidden3">
  </div>
  <input type="submit" class="btn btn-primary" value="送出">
  <br>
</form>




<?php
	include_once('../../php-inc/footer.php');
?>




