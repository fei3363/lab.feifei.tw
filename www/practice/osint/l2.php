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
    if($input_answer=="nsztm2.digi.ninja"){
        $challenges_name = "Zone-Transfer-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="5.196.105.14"){
        $challenges_name = "Zone-Transfer-2";
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






<h1>Zone Transfer</h1>
攻擊目標：zonetransfer.me <br>

<h2>檢測是否有Zone Transfer </h2>

<h3>查看有哪寫 Name Server</h3>

Linux: <br>
<pre class="bash" style="font-family:monospace;"><span style="color: #c20cb9; font-weight: bold;">dig</span> +nostats +nocomments +nocmd NS zonetransfer.me</pre>
Windows <br>
<pre class="bash" style="font-family:monospace;">nslookup <span style="color: #660033;">-type</span>=ns zonetransfer.me</pre>



<h3>確認是否可從外網存取 DNS Server</h3>

Linux: <br>
<pre class="bash" style="font-family:monospace;"><span style="color: #c20cb9; font-weight: bold;">dig</span> axfr zonetransfer.me <span style="color: #000000; font-weight: bold;">@</span>nsztm1.digi.ninja</pre>

Windows: <br>
<pre class="bash" style="font-family:monospace;">nslookup
server  nsztm1.digi.ninja
<span style="color: #c20cb9; font-weight: bold;">ls</span> <span style="color: #660033;">-d</span> zonetransfer.me</pre>



<h2>修復方式</h2>
vim  /etc/named.conf <br>

<pre class="apache" style="font-family:monospace;"><span style="color: #00007f;">options</span> {
    allow-transfer {
        1.2.3.4;
        5.6.7.8;
    };
};</pre>


<h2>小試身手</h2>
<ul>
    <li>請輸入 nsztm1.digi.ninja. 之外的 Name Server</li>
    <li>請輸入 zonetransfer.me. A 紀錄對應的 IP</li>
</ul>



<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>
