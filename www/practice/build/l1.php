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
    if($input_answer=="GUI"){
        $challenges_name = "Build-Pre-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="80,443"){
        $challenges_name = "Build-Pre-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="前"){
        $challenges_name = "Build-Pre-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="後"){
        $challenges_name = "Build-Pre-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="document"){
        $challenges_name = "Build-Pre-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="瀏覽器"){
        $challenges_name = "Build-Pre-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="style"){
        $challenges_name = "Build-Pre-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="script"){
        $challenges_name = "Build-Pre-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="link"){
        $challenges_name = "Build-Pre-9";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="src"){
        $challenges_name = "Build-Pre-10";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="timestamp"){
        $challenges_name = "Build-Pre-11";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="取得"){
        $challenges_name = "Build-Pre-12";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="200"){
        $challenges_name = "Build-Pre-13";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="body"){
        $challenges_name = "Build-Pre-14";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="16"){
        $challenges_name = "Build-Pre-15";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Proxy"){
        $challenges_name = "Build-Pre-16";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Repeater"){
        $challenges_name = "Build-Pre-17";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="root:root"){
        $challenges_name = "Build-Pre-18";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Set-Cookie"){
        $challenges_name = "Build-Pre-19";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="tmp"){
        $challenges_name = "Build-Pre-20";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="3306"){
        $challenges_name = "Build-Pre-21";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="SQL"){
        $challenges_name = "Build-Pre-22";
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
    $titlename='02月06日課程';
	include_once('../../php-inc/header.php');
?>

<h1>02月06日課程</h1>

<ol>
    <li> XAMPP 是 GUI or CLI ，請輸入「***」</li>
    <li> 開啟 Apache 中兩個數字為何，請輸入「**,***」</li>
    <li> 瀏覽器看到的內容，屬於 * 端範疇</li>
    <li> 伺服器的內容，屬於 * 端範疇</li>
    <li> Javascript 中的 DOM 是跟 HTML 的 「d*******」 進行互動</li>
    <li> Javascript 中的 BOM 是跟 *** 進行互動</li>
    <li>若將 CSS 的內容寫在同一個 html 檔案中，使用 <*****> 標籤</li>
    <li>若將 JS 的內容寫在同一個 html 檔案中，使用 <******> 標籤</li>
    <li>若將 CSS 檔案要“引入”於 html 使用 <****> 標籤</li>
    <li>若將 JS 檔案要”引入”於 html 使用 script 標籤的 *** 屬性</li>
    <li>PHP 當中使用函式 time() 會回傳現在時間的 「t*******」 </li>
    <li>HTTP Method GET 通常是用來「**」資料</li>
    <li>如果是成功取得伺服器的內容，通常會收到 OK 其狀態碼為何</li>
    <li>HTTP POST Method 參數會在請求方法中的「****」內</li>
    <li>在 URL 編碼中，遇到不合法的字元會以「**」進位表示</li>
    <li>BurpSuite 中的「P****」可以用來攔截封包</li>
    <li>BurpSuite 中的「R*******」可以用來重送封包</li>
    <li>嘗試還原 Authorization: Basic cm9vdDpyb290 帳號密碼</li>
    <li>當 PHP 開啟 Session 機制，該回應封包會利用「***-******」設定 PHPSESSID</li>
    <li>常見的 Session 檔案會位於 *** 資料夾</li>
    <li>資料庫預設開啟的 Port 為 ****</li>
    <li>SQL injection 是指惡意攻擊者輸入惡意的「***」語法進而影響資料庫</li>

</ol>


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