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
    if($input_answer=="IoTGoat"){
        $challenges_name = "IoTLAB-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="5000"){
        $challenges_name = "IoTLAB-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="5515"){
        $challenges_name = "IoTLAB-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="65534"){
        $challenges_name = "IoTLAB-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="2.73"){
        $challenges_name = "IoTLAB-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="DOS/MBR boot sector"){
        $challenges_name = "IoTLAB-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="sensordata.db"){
        $challenges_name = "IoTLAB-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="7ujMko0vizxv"){
        $challenges_name = "IoTLAB-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="cmdinject"){
        $challenges_name = "IoTLAB-9";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="shellback"){
        $challenges_name = "IoTLAB-10";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="MQTT"){
        $challenges_name = "IoTLAB-11";
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
    $titlename='物聯網漏洞挖掘';
	include_once('../../php-inc/header.php');
?>






<h1>物聯網漏洞挖掘</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>
<h2>LAB1</h2>

本次使用的 LAB 名稱為(I*****t)

<br>

<h2>LAB2</h2>
哪一個 port 開啟 upnp 服務(****)
<br>

<h2>LAB3</h2>
哪一個 port 有 backdoor (****)

<br>

<h2>LAB4</h2>
哪一個 port 開啟 Telnet
<br>

<h2>LAB5</h2>
請問 dns 服務的版本(****)
<br>

<h2>LAB6</h2>
利用 file 指令找到 img 格式為(D*****************r)
<br>

<h2>LAB7</h2>
利用 firmwalker 找到的 db 名稱(s***********b)
<br>

<h2>LAB8</h2>
找到 iotgoatuser 的密碼(7**********v)
<br>

<h2>LAB9</h2>
找到 Web 後門(c*******t)
<br>

<h2>LAB10</h2>
5515 背後執行的程式名稱(s*******k)
<br>

<h2>LAB11</h2>
除了 HTTP , Websocket 之外的用於 IOT 設備的通訊協定(M**T)
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
