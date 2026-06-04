<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="Flag{e@sy_IDOR}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Access-Control-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{IDOR_with_ID}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Broken-Access-Control-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }

}else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) )
{
    $input_id = $_GET["id"];

    switch ($input_id) {
        case "10001":
            $messange = "<h3> Hi  , Welcome to Here</h3>";
            break;
        case "10002":
            $messange = "<h3> Hi May , Welcome to Here</h3>Email:May@feifei.tw<br>手機號碼:0900000000<br>";
            break;
        case "10003":
            $messange = "<h3> Hi Jeff , Welcome to Here</h3>Email:Jeff@feifei.tw<br>手機號碼:0900000000<br>";
            break;
        case "10004":
            $messange = "<h3> Hi Lib , Welcome to Here</h3>Email:Lib@feifei.tw<br>手機號碼:0900000000<br>";
            break;
        case "10005":
            $messange = "<h3> Hi Liz , Welcome to Here</h3>Email:Liz@feifei.tw<br>手機號碼:0900000000<br>";
            break;
        case "10006":
            $messange = "<h3> Hi Andy , Welcome to Here</h3>Email:Andy@feifei.tw<br>手機號碼:0900000000<br>";
            break;
        case "10007":
            $messange = "<h3> Hi Admin , Welcome to Here</h3>Email:Admin@feifei.tw<br>手機號碼:0900000000<br>flag{IDOR_with_ID}";
            break;
        case "10008":
            $messange = "<h3> Hi Cool , Welcome to Here</h3>Email:Cool@feifei.tw<br>手機號碼:0900000000<br>";
            break;
        default:
            $messange = "No User";
     }

}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];
    

 
?>


<?php
    $titlename='HTTP-1';
	include_once('../../php-inc/header.php');
?>




<h1>Insecure Direct Object References</h1>

Insecure Direct Object References (IDOR) 是一種常見的安全漏洞，指的是系統中的某些功能或資源未經適當授權即可被訪問或修改。在應用程式中，IDOR 漏洞通常會發生在使用者可以輸入參數的地方，例如會員資料、圖片或 Session 等。<br>
為了避免 IDOR 漏洞的發生，開發人員需要仔細觀察所有可列入參數的地方，確保這些參數都有被適當地授權、驗證和控制。開發人員還應該使用不易被猜測的標識符來識別和保護敏感資源，例如會員資料或圖片等。<br>
如果 IDOR 漏洞被利用，攻擊者可能會訪問、修改或刪除未授權的資源，進而導致系統被破壞、數據被竊取或用戶隱私被侵犯。因此，開發人員需要重視 IDOR 漏洞的風險，採取有效的安全措施來保護系統和使用者。<br>

<ul>
    <li>
        觀察所有可列入參數的地方

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




<div class="container">

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/1.jpg" alt="1" style="height: 225px; width: 100%; display: block;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/2.jpg" alt="2" style="height: 225px; width: 100%; display: block;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/3.jpg" alt="3" style="height: 225px; width: 100%; display: block;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/5.jpg" alt="5" style="height: 225px; width: 100%; display: block;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/6.jpg" alt="6" style="height: 225px; width: 100%; display: block;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/7.jpg" alt="7" style="height: 225px; width: 100%; display: block;">
            </div>
        </div>

    </div>

</div>






<h2>lab2</h2>


<a href="l1.php?id=10001">GET info</a>

<?php echo $messange;?>



<form  method="POST">
  <div class="form-group">
    <label for="answer">Flag:</label>
    <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
  </div>
  <input type="submit" class="btn btn-primary" value="送出">
  <br>
</form>




<?php
	include_once('../../php-inc/footer.php');
?>