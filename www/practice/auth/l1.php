<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include_once("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){


    $input_answer = $_POST["answer"];

    if($input_answer=="flag{hidden_value}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Authentication-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);

    }else if($input_answer=="flag{Trusting_cookies_is_not_s@fe}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Authentication-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);

    }else if($input_answer=="flag{Broken_Authentication}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Authentication-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{HTTP_Header_Not_Safe}"){
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




<h1>身分繞過</h1>

<ul>
    <li>
        常出現在設定或是邏輯錯誤中
        
        <ul>
        <li>
        在 HTML 中隱藏的參數
    </li>
    <li>
        刪除/修改封包中任意的參數
    </li>
    <li>直接訪問可能需要權限的頁面</li>
        </ul>
        </li>


</ul>





<h2>lab1</h2>
請觀察這個表單與送出的封包內容<br>
<form method="post">
    Name: <input type="text" name="name"><br>
    <label for="admin" hidden>是否為管理員</label>

    <select id="admin" name="admin" hidden>
    <option value="1">是</option>
    <option value="0" selected>否</option>
  </select>
    <input type="submit" value="送出"><br>
</form>


    <?php
echo '<h3>Welcome';
echo $_POST["name"]; 
echo'</h3>';

if($_POST["admin"]=='1'){
    echo "<b>You are find the hidden value</b></br>";
    echo "flag{hidden_value}";
}


 ?> 

<br>


<h2>lab2</h2>
<a href="auth.php">Auth!</a><br>
<br>

<h2>lab3</h2>
<a href="admin.php">admin!</a><br>
<br>

<h2>lab4</h2>
<a href="ip.php">ip!</a><br>
<br>


<h2>Flag 提交 </h2>
<li>本題有四個 flag，都透過這個表單送出</li><br>



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