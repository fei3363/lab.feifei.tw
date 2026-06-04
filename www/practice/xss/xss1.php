<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit();
}

include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    if ($input_answer == "資料庫") {
        $user_id = $_SESSION["id"];
        $challenges_name = "XSS-Basic-1";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "瀏覽器") {
        $user_id = $_SESSION["id"];
        $challenges_name = "XSS-Basic-2";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "程式碼") {
        $user_id = $_SESSION["id"];
        $challenges_name = "XSS-Basic-3";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else {
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



<h1> XSS </h1>

<li>XSS
    <ul>
        <li>作用範圍: 瀏覽器</li>
        <li>瀏覽器執行非原本網站開發者所撰寫的腳本語言(JavaScript)</li>
        <li>類型
            <ul>
                <li>儲存型(Stored XSS): 惡意腳本執行前，先儲存在資料庫</li>
                <li>反射型(Refelect XSS): 無儲存，直接在瀏覽器反應</li>
                <li>DOM 型(DOM-base XSS): 儲存在程式碼(js) 中</li>
            </ul>
        </li>
        <li>特性
            <ul>
                <li>可在背景執行 JavaScript 不會被使用者知道</li>
                <li>可讀取網頁上內容</li>
                <li>無過濾使用者所儲存/傳輸的內容，進而被利用</li>
            </ul>
        </li>
    </ul>
    <li>影響
        <ul>
            <li>
                製作釣魚網站，竊取機密
            </li>
            <li>竊取 Cookie，取得他人身分</li>
            <li>跨站請求，送出非使用者原本想送出的請求 https://superlogout.com/</li>
        </ul>
    </li>
</li>

<h2>小試身手</h2>
<p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. 儲存型 XSS 會先儲存在伺服器中的(***)</p>
<p>2. 反射型 XSS 會直接反應在(***)</p>
<p>3. DOM 型 XSS 會先儲存在(***)中</p>



<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form>
<?php include_once "../../php-inc/footer.php";
?>