<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{7cKwb2lv7SpxWyMO}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SenSitive-Data-Exposure-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }

}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"]))
{
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];
    if($input_username=="S0meUs1rn@m1" && $input_password=="p@5S_w0rd"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SenSitive-Data-Exposure-2";
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




<h1>敏感資料外洩</h1>

<ul>
    <li>
        常出現在設定問題

        <ul>
            <li>
                目錄遍歷
            </li>
            <li>
                明文傳輸封包
            </li>
            <li>資料庫存明文密碼</li>
            <li>GitHub 存放 API Key</li>
        </ul>
    </li>


</ul>





<h2>lab1</h2>
<img class="img-fluid" src="secret/majo018.jpg" alt="majo">

<form method="post">
    flag:<input type="text" name="answer"><br>
    <input type="submit" value="送出"><br>
</form>

<h2>lab2</h2>
<button onclick="submit_secret_credentials()">Clink</button>

<form method="post">
    帳號<input type="text" name="username"><br>
    密碼<input type="text" name="password"><br>
    <input type="submit" value="送出"><br>
</form>


<script>
function submit_secret_credentials() {
    var xhttp = new XMLHttpRequest();
    xhttp['open']('POST', 'secret/login.php', true);
    var _0xb7f9 = ["\x53\x30\x6d\x65\x55\x73\x31\x72\x6e\x40\x6d\x31", "\x70\x40\x35\x53\x5f\x77\x30\x72\x64",
        "\x73\x74\x72\x69\x6E\x67\x69\x66\x79", "\x73\x65\x6E\x64"
    ];
    xhttp[_0xb7f9[3]](JSON[_0xb7f9[2]]({
        username: _0xb7f9[0],
        password: _0xb7f9[1]
    }));
    console.log(0xb7f9);
}
</script>


<?php
	include_once('../../php-inc/footer.php');
?>