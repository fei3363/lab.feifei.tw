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
    if($input_answer=="指令"){
        $challenges_name = "Command-injection-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    
    }else if($input_answer=="www-data"){
        $challenges_name = "Command-injection-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    
    }else if($input_answer=="驗證"){
        $challenges_name = "Command-injection-3";
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
    $titlename='Command injection';
	include_once('../../php-inc/header.php');
?>

<h2>Command injection</h2>
使用者的輸入背後端當作指令的一部份

<h3>常見的危險函式</h3>
<style type="text/css">
.tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-baqh">程式語言</th>
    <th class="tg-baqh">危險函式</th>
    <th class="tg-baqh">說明</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-baqh">PHP</td>
    <td class="tg-baqh">eval</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">PHP</td>
    <td class="tg-baqh">assert</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">PHP</td>
    <td class="tg-baqh">create_function</td>
    <td class="tg-baqh">8.0 版本後移除</td>
  </tr>
  <tr>
    <td class="tg-baqh">Python</td>
    <td class="tg-baqh">exec</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">Python</td>
    <td class="tg-baqh">eval</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">JavaScript</td>
    <td class="tg-baqh">eval</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">JavaScript</td>
    <td class="tg-baqh">(new Fun(/* code */))()</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">JavaScript</td>
    <td class="tg-baqh">setTimeout / setInterval</td>
    <td class="tg-baqh"></td>
  </tr>
</tbody>
</table>


<h3>基本繞過</h3>

<style type="text/css">
.tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-baqh">常見繞過</th>
    <th class="tg-baqh">說明</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-baqh">A ; B</td>
    <td class="tg-baqh">結束前面的指令</td>
  </tr>
  <tr>
    <td class="tg-baqh">A | B</td>
    <td class="tg-baqh">pipe A 的結果給 B</td>
  </tr>
  <tr>
    <td class="tg-baqh">A &amp;&amp; B</td>
    <td class="tg-baqh">A 執行成功才會執行 B</td>
  </tr>
  <tr>
    <td class="tg-baqh">A || B</td>
    <td class="tg-baqh">A 執行成功就不會執行 B</td>
  </tr>
</tbody>
</table>

<h3>特殊用法</h3>
<style type="text/css">
.tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-baqh">指令代替</th>
    <th class="tg-baqh">說明</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-baqh">cat meow.txt $(id)</td>
    <td class="tg-baqh">$</td>
  </tr>
  <tr>
    <td class="tg-baqh">cat meow.txt `id`</td>
    <td class="tg-baqh">``</td>
  </tr>
  <tr>
    <td class="tg-baqh">ping "$(id)"</td>
    <td class="tg-baqh">優先執行</td>
  </tr>
</tbody>
</table>


<h3>繞過空白</h3>
<style type="text/css">
.tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-baqh">代替空白</th>
    <th class="tg-baqh">說明</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-baqh">cat&lt;TAB&gt;/flag</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">cat&lt;/flag</td>
    <td class="tg-baqh">管道指令</td>
  </tr>
  <tr>
    <td class="tg-baqh">{cat,/flag}</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-0lax">cat$IFS/flag</td>
    <td class="tg-0lax">輸入分隔字串(https://en.wikipedia.org/wiki/Input_Field_Separators))</td>
  </tr>
  <tr>
    <td class="tg-0lax">X=$'cat\x20/flag'&amp;&amp;$X</td>
    <td class="tg-baqh">宣告變數，執行變數</td>
  </tr>
</tbody>
</table>



<h3>繞過黑名單</h3>
<style type="text/css">
.tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-baqh">繞過黑名單</th>
    <th class="tg-baqh">說明</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-baqh">cat /f'la'g&nbsp;&nbsp;or cat /f"la"g</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">cat /f\l\ag</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">cat /f*</td>
    <td class="tg-baqh">萬用字元</td>
  </tr>
  <tr>
    <td class="tg-baqh">cat /f?a?</td>
    <td class="tg-baqh">萬用字元</td>
  </tr>
  <tr>
    <td class="tg-baqh">cat ${HOME:0:1}etc${HOME:0:1}</td>
    <td class="tg-baqh">#HOME = /home/USER 取第一個 /</td>
  </tr>
</tbody>
</table>


<h3>駭客利用手法</h3>
<ul>
    <li>確認可以控制該台設備，用指令 id 確認</li>
    <li>下載外部工具(curl or Wget)</li>
    <li>攻擊 kernal 或 作業系統弱點，讓自己的可以提升到管理員權限</li>
    <li>完全控制該台設備</li>
    <li>https://github.com/payloadbox/command-injection-payload-list</li>
</ul>


<h3>防禦方法</h3>
<ul>
    <li>驗證參數的輸入</li>
    <li>賦予最低可執行的權限</li>
    <li>時常更新作業系統、軟體，避免提權</li>
</ul>

<h2>小試身手</h2>





<ul>
    <li>請問 Command injection 是因為使用者的輸入被當作「XX」的一部份，因而可以控制伺服器(**)</li>
    <li><a href="https://rcelab.feifei.tw/ci/cals.php" target="_blank" rel="noopener noreferrer">LAB</a>可取得的權限為(********)</li>
    <li>防範 Command injection 的方法，可以「XX」參數的輸入，看是否是合法輸入嗎</li>
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



