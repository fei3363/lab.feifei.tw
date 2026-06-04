<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include_once("config.php");


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"]) ){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="版本"){
        $challenges_name = "HTTP-Basic-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="CRLF"){
        $challenges_name = "HTTP-Basic-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Host"){
        $challenges_name = "HTTP-Basic-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Content-Type"){
        $challenges_name = "HTTP-Basic-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Content-Length"){
        $challenges_name = "HTTP-Basic-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="POST"){
        $challenges_name = "HTTP-Basic-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Set-Cookie"){
        $challenges_name = "HTTP-Basic-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="瀏覽器"){
        $challenges_name = "HTTP-Basic-8";
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
<style type="text/css">
.tg {
    border-collapse: collapse;
    border-spacing: 0;
}

.tg td {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
}

.tg th {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
}

.tg .tg-nrix {
    text-align: center;
    vertical-align: middle
}
</style>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/highlight.min.js"></script>
<script>
hljs.highlightAll();
</script>


<h1>HTTP</h1>
<p>進入網頁觀察封包：<a
        href="https://lab.feifei.tw/practice/basic/http/hello.php">https://lab.feifei.tw/practice/basic/hello.php</a></strong>
</p>
<p>請求：由瀏覽器（使用者端）送出「請求封包」給伺服器端（接收端）</p>

<ul>
    <li>請求封包起始行
        <ul>
            <li>請求方法 request method：GET</li>
            <li>請求路徑 request-URI：/practice/basic/http/hello.php （URI 中的資源)</li>
            <li>請求版本：HTTP/1.1</li>
        </ul>
    </li>
    <li>請求標頭 Request Headers
        <ul>
            <li>請求目標：<span class="hljs-symbol">Host:</span> lab.feifei.tw&nbsp;</li>
            <li>使用媒介：<span class="hljs-symbol">User-Agent:</span> Mozilla/5.0 (Windows NT 10.0; Win64; x64)
                AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36
                <ul>
                    <li>Robots.txt</li>
                </ul>

            </li>
        </ul>
    </li>
    <li>空一行　\r\n
        <ul>
            <li>CR：Carriage Return，對應 ASCII 中轉義字元 \r ，表示 Enter</li>
            <li>LF：Linefeed，對應 ASCII 中轉義字元 \n ，表示換行</li>
        </ul>
    </li>
    <li>請求實體 entity body
        <ul>
            <li>無內容</li>
        </ul>
    </li>
</ul>

<div class="output">
    <pre><code class="http hljs"><span class="hljs-keyword">GET</span> <span class="hljs-string">/practice/basic/hello.php</span> HTTP/1.1
<span class="hljs-attribute">Host</span>: lab.feifei.tw
User-Agent:</span> Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36
<span class="undefined">
</span></code></pre>
</div>


<p>回應：伺服器收到後處理完畢回傳「回應封包」給瀏覽器</p>

<ul>
    <li>回應封包起始行
        <ul>
            <li>回應版本：HTTP/1.1</li>
            <li>回應狀態 status code：200</li>
            <li>狀態說明 reason-phrase：OK</li>
        </ul>
    </li>
    <li>回應標頭 Response Headers
        <ul>
            <li>Server: nginx/1.18.0 (Ubuntu)
                <ul>
                    <li>告訴請求端目前伺服器安裝的 HTTP 伺服器軟體的資訊</li>
                </ul>
            </li>
            <li>Date: Tue, 08 Mar 2022
                17:42:07 GMT
                <ul>
                    <li>回應封包的日期</li>
                </ul>
            </li>
            <li>Content-Type: text/html; charset=UTF-8
                <ul>
                    <li>回應實體的媒體類型</li>
                </ul>
            </li>
            <li>Content-Length: 9
                <ul>
                    <li>回應實體 Body 的大小</li>
                    <li>單位為 word</li>
                </ul>
            </li>
            <li>Connection: keep-alive
                <ul>
                    <li>管理目前連接狀態，持久連接</li>
                </ul>
            </li>
            <li>X-Powered-By: PHP/7.0.30
                <ul>
                    <li>X 代表非標準標頭</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>空一行　\r\n</li>
    <li>回應實體 entity body
        <ul>
            <li>Hello Fei</li>
        </ul>
    </li>
</ul>

<pre><code class="http hljs">HTTP/1.1 <span class="hljs-number">200</span> OK
<span class="hljs-attribute">Server</span>: nginx/1.18.0 (Ubuntu)
<span class="hljs-attribute">Date</span>: Tue, 08 Mar 2022 17:42:07 GMT
<span class="hljs-attribute">Content-Type</span>: text/html; charset=UTF-8
<span class="hljs-attribute">Content-Length</span>: 9
<span class="hljs-attribute">Connection</span>: keep-alive
<span class="hljs-attribute">X-Powered-By</span>: PHP/7.0.30

<span class="nginx"><span class="hljs-attribute">Hello</span> Fei</span></code></pre>

<h3>HTTP 特性</h3>
<ul>
    <li>無狀態
        <ul>
            <li>stateless 不保存狀態，不紀錄傳輸內容</li>
            <li>為了能處理更大量的事物</li>
            <li>後來引入 Cookie 與 Session 處理</li>
        </ul>
    </li>
    <li>持久連線
        <ul>
            <li>HTTP/1.0 的版本，每次連接都需要 建立 TCP 連線&nbsp;</li>
            <li>新版可持久連線</li>
        </ul>
    </li>
    <li>管線化
        <ul>
            <li>HTTP 請求不需要等待回應回來，可以先發下一個封包</li>
        </ul>
    </li>
    <li>常用方法
        <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-nrix {
            text-align: center;
            vertical-align: middle
        }
        </style>
        <table class="tg">
            <thead>
                <tr>
                    <th class="tg-nrix">方法</th>
                    <th class="tg-nrix">說明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tg-nrix">GET</td>
                    <td class="tg-nrix">取得資源</td>
                </tr>
                <tr>
                    <td class="tg-nrix">POST</td>
                    <td class="tg-nrix">傳輸資源</td>
                </tr>
                <tr>
                    <td class="tg-nrix">PUT</td>
                    <td class="tg-nrix">更改資源</td>
                </tr>
                <tr>
                    <td class="tg-nrix">HEAD</td>
                    <td class="tg-nrix">取得標頭</td>
                </tr>
                <tr>
                    <td class="tg-nrix">DELETE</td>
                    <td class="tg-nrix">刪除資源</td>
                </tr>
                <tr>
                    <td class="tg-nrix">OPTIONS</td>
                    <td class="tg-nrix">詢問伺服器可以支援的方法</td>
                </tr>
                <tr>
                    <td class="tg-nrix">TRACE</td>
                    <td class="tg-nrix">追蹤路徑</td>
                </tr>
                <tr>
                    <td class="tg-nrix">CONNECT</td>
                    <td class="tg-nrix">要求用 tunnel 連接到其他代理</td>
                </tr>
            </tbody>
        </table>
    </li>
    <li>Cookie &amp; Session
        <ul>
            <li>當登入或電子商務平台要記錄購物車等情境，會使用 Cookie 技術，來記錄你是誰</li>
            <li>進入登入後，伺服器會在回傳封包中 加入 標頭 Set-Cookie&nbsp;</li>
            <li>瀏覽器看到這個標頭會儲存於瀏覽器中</li>
            <li>再次請求會在請求封包內 自動加入 標頭 Cookie</li>
        </ul>
    </li>
</ul>


<h2>小試身手</h2>
<p>請回答以下的問題，並於 flag 的欄位填寫「答案」，* 字號代表該答案的字數。</p>

<p>1. 請問在請求封包中，第一行起始行，除了請求方法、請求路徑，還有請求的___(**)</p>
<p>2. 不管是請求還是回應封包，標頭跟實體之間需要空行，表示 Enter 跟 換行 的字元為何(C***)</p>
<p>3. 請問請求封包中，想要請求的目標，會在請求標頭中加上 ____(H***)</p>
<p>4. 請問回應封包中，伺服器會利用_____標頭，告訴我們目前實體的「媒體類型」(C***********)</p>
<p>5. 請問回應封包中，伺服器會利用_____標頭，告訴我們目前實體的「回應實體 Body 的大小」(c*************)</p>
<p>6. 如果想要進行登入，會使用表單，而表單通常會使用哪一個 Method (P***)</p>
<p>7. 因為 HTTP 是無狀態的特性，因此會透過 Cookie 來管理是否有登入過，請問登入成功後「回應封包」會使用_____標頭，告訴我們要設定 Cookie(***********)</p>
<p>8. 當回傳封包有設定 Cookie 的標頭，這個 Cookie 會被存在_____中(***)</p>

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