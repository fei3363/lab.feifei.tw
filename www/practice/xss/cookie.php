<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit();
}

include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    if ($input_answer == "瀏覽器") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-Session-1";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else if ($input_answer == "伺服器") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-Session-2";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      }else if ($input_answer == "JavaScript") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-Session-3";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else{
        $challenge_array = ["alert", "答案錯誤"];
    }
}
$challenge_type = $challenge_array[0];
$challenge_messange = $challenge_array[1];
?>


<?php
$titlename = "Cookie and Session";
include_once "../../php-inc/header.php";
?>



<h1> Cookie and Session </h1>

<li>HTTP
    <ul>
        <li>協定：訂下雙方怎麼溝通</li>
        <li>HTTP 無狀態通訊協定，不會記住以前傳送的請求或回應</li>
    </ul>
</li>

<li>Cookie
    <ul>
    
    <li>為什麼輸入帳號密碼後，短時間不用再輸入一次</li>
    <li>透過 Cookie
        <ul>
            <li>使用者成功登入網站後，伺服器會回傳並設置 Cookie 的值</li>
            <li>瀏覽器會儲存該值於瀏覽器中</li>
            <li>使用者再次存取網站，請求封包內標頭則會夾帶 Cookie 值</li>
            <li>伺服器接收封包後，透過 Cookie 來對應是哪個使用者</li>
        </ul>
    </li>
    <li>特性
        <ul>
            <li>指定網域: domain</li>
            <li>可指定路徑: path 在指定路徑才會送出 cookie，預設為 /</li>
            <li>有生命期限: expires </li>
            <li>在瀏覽器端容易被偽造</li>
            <li>其他屬性
                <ul>
                    <li>HttpOnly: 不能利用 JavaScript 存取</li>
                    <li>secure: 必須利用協定 https 才能傳輸 Cookie</li>
                    <li>maxAge: 倒數過期時間，單位毫秒</li>
                </ul>
            </li>
        </ul>

    </li>


    </ul>
</li>

<li>Session
    <ul>
        <li>儲存在伺服器中，瀏覽器端無法偽造</li>
        <li>原理<ul>
            <li>瀏覽器送出登入請求封包</li>
            <li>伺服器確認登入帳號密碼正確</li>
            <li>伺服器儲存登入資訊，並產出一組對應的 ID (對應哪個使用者) 儲放在 Session 相關資料庫/檔案</li>
            <li>該 ID 為 SessionID，並從回應封包回傳該值(set-cookie: seesionid=xxxxxxxxx)</li>
            <li>瀏覽器接收封包後儲存該值(到瀏覽器稱為 Cookie) </li>
            <li>再次瀏覽網站，夾帶 Cookie 值</li>
            <li>伺服器接收該封包，對應 Session 資料庫/檔案 確認該 seesionid 曾登入且還有效</li>
            <li>回傳登入後資訊給使用者</li>
        </ul></li>
    </ul>
</li>
<li>lab
    <ul>
    <li>curl lab:  https://lab.feifei.tw/practice/basic/curl.php</li>
    <li>cookie lab:  https://lab.feifei.tw/practice/xss/cookielab.php</li>
</ul>
</li>

    <h2>小試身手</h2>
    <p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
    <p>1. Cookie 儲存位置為(***)</p>
    <p>2. Session 儲存位置為(***)</p>
    <p>3. HttpOnly 無法被瀏覽器中哪個腳本語言存取 (**********)</p>



    <form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案"
                aria-label="回答問題" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出答案</button>
            </div>
        </div>
    </form>
    <?php include_once "../../php-inc/footer.php";
?>
