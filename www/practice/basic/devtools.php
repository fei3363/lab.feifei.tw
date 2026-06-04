<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("config.php");
$user_id = $_SESSION["id"];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"]) ){
    $input_answer = $_POST["answer"];
    
    if($input_answer=="flag{this_is_comment}"){
        $challenges_name = "Developer-Tool-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer==$_SESSION['token']){
      $challenges_name = "Developer-Tool-2";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="dashboard.css"){
      $challenges_name = "Developer-Tool-3";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer==$_SESSION['networknum']){
      $challenges_name = "Developer-Tool-4";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer==$_SESSION['port']){
      $challenges_name = "Developer-Tool-5";
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
    $titlename='Developer-Tool';
	include_once('../../php-inc/header.php');
?>


<h1>Developer Tools</h1>
<b>以下為開發者工具的四種開啟方式(以 Chrome DevTools 為範例)<br></b>
<ul>
  <li>鍵盤：F12</li>
  <li>右鍵:chrome-檢查/Firefox-檢測</li>
  <li>瀏覽器工具 > 更多工具 > 開發人員工具 </li>
  <li>Ctrl + shift + I</li>
</ul>

<h2>Elements</h2>
利用查看原始碼的方式找到「註解」<br>
註解內藏有一個答案<br>
<!-- flag{this_is_comment} -->
<br>
<br>
<h2>Console</h2>
<ul>
  <li>打開 Console 工具後嘗試執行 Javacript 程式碼</li>
  <li>請執行函式，該函式名稱 getToken()</li>
  <li>可嘗試輸入 getToken --> 不加上()</li>
</ul>

<h2>Sources</h2>
請利用 Sources 工具找到 php-inc 的 css 檔案名稱(d********.css)
<br>
<br>
<h2>Network</h2>
<ul>
<li>
打開 Network 觀察封包
</li>
<li>
點擊 <input type="button" value="Click me" onclick="getnumber()">
<li>
  觀察回應封包，該值為答案
</li>

</ul>

<h2>Application</h2>
請找出 Storage 中的 Cookies 中的 port 的數值，該值則為答案

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


<script>
function getToken(){

    fetch("/practice/basic/devtools/token.php", {
  "headers": {
    "accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "accept-language": "zh-TW,zh;q=0.9,en;q=0.8,zh-CN;q=0.7",
    "cache-control": "no-cache",
    "pragma": "no-cache",
    "upgrade-insecure-requests": "1"
  },
  "referrerPolicy": "strict-origin-when-cross-origin",
  "body": null,
  "method": "POST",
  "mode": "cors",
  "credentials": "include"
}).then(function(response) {
    return response.text();
  })
  .then(function(mytext) {
    console.log("Token is:" + mytext);
  });



}


function getnumber(){

fetch("/practice/basic/devtools/networknum.php", {
"headers": {
"accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"accept-language": "zh-TW,zh;q=0.9,en;q=0.8,zh-CN;q=0.7",
"cache-control": "no-cache",
"pragma": "no-cache",
"upgrade-insecure-requests": "1"
},
"referrerPolicy": "strict-origin-when-cross-origin",
"body": null,
"method": "POST",
"mode": "cors",
"credentials": "include"
}).then(function(response) {
return response.text();
});



}


</script>


<?php
	include_once('../../php-inc/footer.php');
?>