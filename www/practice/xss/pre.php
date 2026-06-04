<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit();
}

include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    if ($input_answer == "DOM") {
        $user_id = $_SESSION["id"];
        $challenges_name = "JavaScript-Basic-1";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else if ($input_answer == "BOM") {
        $user_id = $_SESSION["id"];
        $challenges_name = "JavaScript-Basic-2";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else if ($input_answer == "<script>") {
        $user_id = $_SESSION["id"];
        $challenges_name = "JavaScript-Basic-3";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else if ($input_answer == "onerror") {
        $user_id = $_SESSION["id"];
        $challenges_name = "JavaScript-Basic-4";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "onload") {
      $user_id = $_SESSION["id"];
      $challenges_name = "JavaScript-Basic-5";
      include_once "../challenges.php";
      $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "alert()") {
      $user_id = $_SESSION["id"];
      $challenges_name = "JavaScript-Basic-6";
      include_once "../challenges.php";
      $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "prompt()") {
      $user_id = $_SESSION["id"];
      $challenges_name = "JavaScript-Basic-7";
      include_once "../challenges.php";
      $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
  } else if ($input_answer == "confirm()") {
    $user_id = $_SESSION["id"];
    $challenges_name = "JavaScript-Basic-8";
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
$titlename = "JavaScript-Basic-1";
include_once "../../php-inc/header.php";
?>



<h1>JavaScript 是什麼 </h1>

<li>JavaScript
    <ul>
    <!-- https://www.w3schools.com/JSREF/dom_obj_event.asp -->
        <li>腳本語言，可在瀏覽器執行</li>
        <li>程式語言：宣告變數、迴圈</li>
        <li><a href="js.php">認識 JavaScript 程式語言</a></li>
        <li>基本</li>
        <li>其他特性
            <ul>
                <li>
                    文件物件模型（Document Object Model, DOM）
                    <ul>
                        <li>HTML、XML 和 SVG 文件的程式介面</li>
                        <li>可使用 JavaScript 來存取 DOM
                        </li>
                        <li>常用的 DOM 介面
                            <ul>
                                <li>Document</li>
                                <li>URL</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>瀏覽器物件模型（Browser Object Model,BOM）
                    <ul>
                        <li>沒有官方的文件明確定義，因為有很多瀏覽器</li>
                        <li>可使用 JavaScript 來跟瀏覽器作互動
                        </li>
                        <li>常用的 BOM 介面
                            <ul>
                                <li>Window</li>
                            </ul>
                        </li>
                    </ul>

                </li>
            </ul>
        </li>
    </ul>

<li>HTML vs JavaScript
<ul>
        <li>HTML 中引入 JS 的方法
            <ul>
                <li>插入程式碼 <code>&lt;script type="text/javascript"&gt;JavaScript程式碼&lt;/script&gt;</code></li>
                <li>插入檔案 <code>&lt;script src="myScript.js"&gt;&lt;/script&gt;</code></li>
            </ul>
        </li>
        <li> tag 中有些屬性可以執行 JS
            <ul>
                <li>錯誤而執行 onerror 內的程式碼
                    <ul>
                        <li><code>&lt;img src="" onerror=JavaScript程式碼&gt;</code></li>
                        <li><code>&lt;audio src="" onerror=JavaScript程式碼&gt;&lt;/audio&gt;</code></li>
                        <li><code>&lt;video  src="" onerror=JavaScript程式碼&gt;&lt;/video&gt;</code></li>
                        <li><code>&lt;body src="" onerror=JavaScript程式碼&gt;&lt;/body&gt;</code></li>
                        <li><code>&lt;script  src="" onerror=JavaScript程式碼&gt;&lt;/script&gt;</code></li>
                    </ul>
                </li>
                <li>網頁載入完成後，觸發特定的 JavaScript
                    <ul>
                        <li><code>&lt;svg onload=JavaScript程式碼&gt;</code></li>
                        <li><code>&lt;iframe onLoad=JavaScript程式碼&gt;&lt;/iframe&gt;</code></li>
                        <li><code>&lt;body onLoad=JavaScript程式碼&gt;&lt;/body&gt;</code></li>
                        <li><code>&lt;script onLoad=JavaScript程式碼&gt;&lt;/script&gt;</code></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>常用來 POC 的 Window Object Methods
            <ul>
                <li>alert()</li>
                <li>confirm()</li>
                <li>prompt()</li>
            </ul>
        </li>
    </ul>
</li>

    <h3></h3>





    <label for="text">輸入 javascript 字串:</label>
    <form method="POST" class="form-inline">
        <textarea id="text" name="text" rows="4" cols="50"
            class="form-control">&lt;script type="text/javascript"&gt;alert("Hello")&lt;/script&gt;</textarea>
        <input type="submit" class="btn btn-primary" value="送出">
    </form>


    <?php echo isset($_POST["text"]) ? $_POST["text"] : ""; ?>





    <h2>小試身手</h2>
    <p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
    <p>1. JavaScript 中可以跟 HTML 互動，請問該模型簡稱什麼(***)</p>
    <p>2. JavaScript 中可以跟瀏覽器互動，請問該模型簡稱什麼(***)</p>
    <p>3. HTML 中 要引入 JavaScript 需要寫 HTML 哪一個標籤(<******>)</p>
    <p>4. HTML 中 tag 中有個屬性是「發生錯誤時而執行 JavaScript」，該屬性名稱_____(*******)</p>
    <p>5. HTML 中 tag 中有個屬性是「載入完成後執行 JavaScript」，該屬性名稱_____(******)</p>
    <p>6. 請問 JavaScript 中，使用 Window Object Methods 彈出視窗，可以顯示指定的文字(*****())</p>
    <p>7. 請問 JavaScript 中，使用 Window Object Methods 彈出視窗，可以顯示讓使用者輸入文字(******())</p>
    <p>8. 請問 JavaScript 中，使用 Window Object Methods 彈出視窗，可以顯示讓使用者點選確認或取消(*******())</p>


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