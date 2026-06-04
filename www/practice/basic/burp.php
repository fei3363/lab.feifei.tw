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
    if($input_answer=="flag{You_can_use_burp_suite}"){
        $challenges_name = "BurpSuite-tool-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{you_can_use_Intruder}"){
        $challenges_name = "BurpSuite-tool-2";
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
    $titlename='HTTP-2';
	include_once('../../php-inc/header.php');
?>


<h1>Burp Suite</h1>
用來做安全測試的工具，可以攔截封包，重送封包，掃描的工具。<br>
<br>
<p>功能：</p>
<ul>
    <li>Proxy: 代理，以「中間人攻擊」的原理，置換憑證，使 burp suite 軟體介於瀏覽器與伺服器之間，可攔截、查看、修改封包。</li>
    <li>Intruder:　進行爆破攻擊的工具。
        <ul>
            <li>Positions： 可制定四種爆破方式，指定要填寫「字典檔」的位置以 $val$ 為例。</li>
            <li>Payloads： 輸入字典檔與字典類型。</li>
        </ul>
    </li>
    <li>Repeater: 重送封包，將 Proxy 狀態的封包，可傳送到 Repeater，重複進行測試，查看回應。</li>
    <li>Sequencer: 動態分析封包的差異性，可針對 token 進行檢測</li>
    <li>Decoder: 編碼轉換工具。</li>
    <li>Comparer: 比較兩個封包之間的差別。</li>
    <li>Logger: 紀錄日誌。</li>
    <li>Extender: 外掛工具。</li>
</ul>
<p>攔截封包步驟：</p>
<ol>
    <li>開啟 burpsuite</li>
    <li>開啟 proxy</li>
    <li>開啟 攔截封包</li>
</ol>
<br>

<h2>LAB1</h2>
<p>請嘗試攔截以下的封包，並修改成以下條件：</p>
<ul>
    <li>Method 更改為 GET</li>
    <li>changeMe 內容更改為「Happy Meow」</li>
    <li>Header 新增 x-request-intercepted:true</li>
</ul>

<form class="attack-form" name="intercept-request" method="POST" action="burp/inter.php">
    changeMe:<input type="text" value="The text" name="changeMe">
    <input type="submit" value="Submit">

</form>
<br><br>
<h2>LAB2</h2>
<p>請嘗試爆破 <a href="burp/login.php">登入系統</a></p>
字典檔：https://github.com/danielmiessler/SecLists/blob/master/Passwords/darkweb2017-top100.txt <br>
找長度不一致的封包，登入之後會拿到 FLAG<br>
<br>

<h2>小試身手</h2>
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