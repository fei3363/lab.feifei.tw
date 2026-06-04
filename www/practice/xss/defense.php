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
    } else if ($input_answer == "JavaScript") {
        $user_id = $_SESSION["id"];
        $challenges_name = "Cookie-Session-3";
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
$titlename = "防範 XSS";
include_once "../../php-inc/header.php";
?>



<h1> 防禦手法 </h1>

<li>同源政策 (Same Origin Policy)
    <ul>
        <li>保護瀏覽器，瀏覽器的安全策略</li>
        <li>不同網域的腳本，在沒授權的狀況下,無法讀取對方的資源</li>
        <li>限定：同協定、同域名、同端口</li>
        <li>如果沒有 SOP feifei.com.tw 可以存取 google.com 的 Cooke</li>
    </ul>
</li>

<li>CORS
    <ul>
        <li>
        當我們在撰寫網站的時候，常常會遇到要去別的域名引入資源到自己的網站，當自己的網站有弱點，且可以引入外部網站資源，有些駭客會選擇引入自己撰寫的惡意 JavaScript 或是惡意檔案，透過弱點造成各大的危害。
因此瀏覽器有一個機制是可以限定引入的外部資源是否合法。
        </li>
        <li>擴充同源政策</li>
        <li>錯誤的 CORS 設定也會造成弱點
            <ul>
            <li>永遠不要相信來自瀏覽器的資料</li>
            <li>CORS 無法取代伺服器的安全策略，並須加強身分驗證與 Session 的管理</li>
            <li>不要使用 null 作為白名單使用 Access-Control-Allow-Origin: null</li>
            <li>切勿使用萬用字元 *</li>
            <li>只允許信任網站 Access-Control-Allow-Origin</li>
            <li>任何包含敏感資料的網站，若使用 CORS 請務必了解並設定正確的 CORS 設定</li>
            </ul>
        </li>
        
    </ul>
</li>


<li>手法
    <ul>
        <li>任何傳給伺服器端的內容都需要被清理</li>
        <li>DOM 解析 (不能單純仰賴該清理方法)
            <ul>
                <li>innerHTML: 不會清理，若值包含 HTML 標籤會被解析</li>
                <li>innerText: 清理文字，若值包含 HTML 標籤會被轉義 escape </li>
            </ul>
        </li>
        <li>常見的攻擊向量與較危險的 API
            <ul>
                <li>element.innerHTML / element.outerHTML</li>
                <li>Btob</li>
                <li>SVG</li>
                <li>document.write / document.writeIn</li>
                <li>DOMParser.parseFromString</li>
                <li>document.implementation</li>
            </ul>
        </li>
        <li>其他攻擊媒介: CSS
            <ul>
                <li>具備送出 HTTP 請求的屬性</li>
                <li>
                    <pre class="css" style="font-family:monospace;">input<span style="color: #00AA00;">&#91;</span>name<span style="color: #00AA00;">=</span><span style="color: #ff0000;">&quot;secret&quot;</span><span style="color: #00AA00;">&#93;</span><span style="color: #00AA00;">&#91;</span><span style="color: #F5758F;">value</span><span style="color: #00AA00;">^=</span><span style="color: #ff0000;">&quot;a&quot;</span><span style="color: #00AA00;">&#93;</span> <span style="color: #00AA00;">&#123;</span>
  <span style="color: #000000; font-weight: bold;">background</span><span style="color: #00AA00;">:</span> <span style="color: #9932cc;">url</span><span style="color: #00AA00;">&#40;</span><span style="color: #ff0000; font-style: italic;">https://feifei.tw/hack.php?q=a</span><span style="color: #00AA00;">&#41;</span>
<span style="color: #00AA00;">&#125;</span></pre>
                </li>
            </ul>
        </li>
        <li>利用內容安全性原則(Content Security Policy (CSP) )保護
            <ul>
                <li>CSP: 可定義可載入哪些腳本、允許載入、允許執行</li>
                <li>會寫在回應封包中標頭，利用 content-security-policy:</li>
                <li>腳本來源: JS 來自駭客撰寫的(相對危險) : 是否能限制來源</li>
                <li>'self': 代表目前的 url</li>
                <ul>
                    <li>
                        使用白名單限制來源
                    </li>
                    <li>
                        <pre class="php" style="font-family:monospace;">content<span style="color: #339933;">-</span>security<span style="color: #339933;">-</span>policy<span style="color: #339933;">:</span> default<span style="color: #339933;">-</span>src <span style="color: #0000ff;">'none'</span><span style="color: #339933;">;</span> <span style="color: #666666; font-style: italic;">// 完全阻擋</span>
Content<span style="color: #339933;">-</span>Security<span style="color: #339933;">-</span>Policy<span style="color: #339933;">:</span> frame<span style="color: #339933;">-</span>ancestors <span style="color: #0000ff;">'self'</span><span style="color: #339933;">;</span> <span style="color: #666666; font-style: italic;">// 讓瀏覽器阻止其他網站嵌入這個網頁</span>
Content<span style="color: #339933;">-</span>Security<span style="color: #339933;">-</span>Policy<span style="color: #339933;">:</span> frame<span style="color: #339933;">-</span>ancestors feifei<span style="color: #339933;">.</span>tw <span style="color: #339933;">;</span></pre>
                    </li>
                </ul>
                <li>確認工具: https://csp-evaluator.withgoogle.com/</li>
                <li>參考網站：https://content-security-policy.com/</li>
                <li>各版本
                    <style type="text/css">
                        .tg {
                            border-collapse: collapse;
                            border-color: #aaa;
                            border-spacing: 0;
                        }

                        .tg td {
                            background-color: #fff;
                            border-color: #aaa;
                            border-style: solid;
                            border-width: 1px;
                            color: #333;
                            font-family: Arial, sans-serif;
                            font-size: 14px;
                            overflow: hidden;
                            padding: 10px 5px;
                            word-break: normal;
                        }

                        .tg th {
                            background-color: #f38630;
                            border-color: #aaa;
                            border-style: solid;
                            border-width: 1px;
                            color: #fff;
                            font-family: Arial, sans-serif;
                            font-size: 14px;
                            font-weight: normal;
                            overflow: hidden;
                            padding: 10px 5px;
                            word-break: normal;
                        }

                        .tg .tg-d1dx {
                            background-color: #FFF;
                            color: #212529;
                            text-align: center;
                            vertical-align: middle
                        }

                        .tg .tg-daoi {
                            background-color: #FFF;
                            color: #212529;
                            text-align: center;
                            vertical-align: middle
                        }

                        .tg .tg-8vzr {
                            background-color: #FFF;
                            color: #212529;
                            text-align: left;
                            vertical-align: middle
                        }

                        .tg .tg-4fhu {
                            background-color: #FFF;
                            border-color: inherit;
                            color: #212529;
                            text-align: center;
                            vertical-align: top
                        }

                        .tg .tg-6omd {
                            background-color: #FFF;
                            border-color: inherit;
                            color: #212529;
                            text-align: center;
                            vertical-align: top
                        }

                        .tg .tg-59xz {
                            background-color: #FFF;
                            border-color: inherit;
                            color: #212529;
                            text-align: left;
                            vertical-align: top
                        }

                        .tg .tg-rmlg {
                            background-color: #FFF;
                            border-color: inherit;
                            color: #212529;
                            text-align: left;
                            vertical-align: top
                        }

                        .tg .tg-w6eq {
                            background-color: #FFF;
                            color: #212529;
                            text-align: center;
                            vertical-align: top
                        }

                        .tg .tg-25gk {
                            background-color: #FFF;
                            color: #212529;
                            text-align: left;
                            vertical-align: top
                        }

                        .tg .tg-b6h1 {
                            background-color: #FFF;
                            color: #212529;
                            text-align: center;
                            vertical-align: top
                        }

                        .tg .tg-mfw7 {
                            background-color: #FFF;
                            color: #212529;
                            text-align: left;
                            vertical-align: top
                        }

                        .tg .tg-ylrw {
                            background-color: #FFF;
                            color: #212529;
                            text-align: left;
                            vertical-align: middle
                        }
                    </style>
                    <table class="tg">
                        <thead>
                            <tr>
                                <th class="tg-4fhu"><span style="font-weight:normal">CSP 版本</span></th>
                                <th class="tg-4fhu"><span style="font-weight:normal">名稱</span></th>
                                <th class="tg-4fhu"><span style="font-weight:normal">說明</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tg-6omd">Level 1</td>
                                <td class="tg-6omd">default-src</td>
                                <td class="tg-59xz">預設值，沒定義到都會遵守該值(可設定 'none' 或 'self')</td>
                            </tr>
                            <tr>
                                <td class="tg-4fhu">Level 1</td>
                                <td class="tg-4fhu">img-src</td>
                                <td class="tg-rmlg">&lt;img src="..."&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-6omd">Level 1</td>
                                <td class="tg-6omd">media-src</td>
                                <td class="tg-59xz">&lt;video&gt; &lt;audio&gt; &lt;source&gt; &lt;track&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-4fhu">Level 1</td>
                                <td class="tg-4fhu">style-src</td>
                                <td class="tg-rmlg">&lt;link rel="stylesheet" href="style.css"&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-6omd">Level 1</td>
                                <td class="tg-6omd">script-src</td>
                                <td class="tg-59xz">&lt;script&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-4fhu">Level 1</td>
                                <td class="tg-4fhu">font-src</td>
                                <td class="tg-rmlg">@font-face</td>
                            </tr>
                            <tr>
                                <td class="tg-6omd">Level 1</td>
                                <td class="tg-6omd">frame-src</td>
                                <td class="tg-59xz">&lt;iframe&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-4fhu">Level 1</td>
                                <td class="tg-4fhu">object-src</td>
                                <td class="tg-rmlg">&lt;object&gt; &lt;embed&gt; &lt;applet&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-w6eq">Level 1</td>
                                <td class="tg-w6eq">connect-src</td>
                                <td class="tg-25gk">XMLHttpRequest() WebSocket() EventSource() sendBeacon() fetch()</td>
                            </tr>
                            <tr>
                                <td class="tg-b6h1">Level 1</td>
                                <td class="tg-b6h1">sandbox</td>
                                <td class="tg-mfw7">指定&lt;iframe&gt; sandbox的屬性</td>
                            </tr>
                            <tr>
                                <td class="tg-daoi">Level 2</td>
                                <td class="tg-daoi">base-uri</td>
                                <td class="tg-ylrw">&lt;base&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-d1dx">Level 2</td>
                                <td class="tg-d1dx">child-src</td>
                                <td class="tg-8vzr">&lt;iframe&gt; Worker() 用 frame-src 和 worker-src 個別定義 比較好</td>
                            </tr>
                            <tr>
                                <td class="tg-daoi">Level 2</td>
                                <td class="tg-daoi">form-action</td>
                                <td class="tg-ylrw">限制&lt;form action="..."&gt;action所指向的目標</td>
                            </tr>
                            <tr>
                                <td class="tg-d1dx">Level 2</td>
                                <td class="tg-d1dx">frame-ancestors</td>
                                <td class="tg-8vzr">&lt;frame&gt;, &lt;iframe&gt;, &lt;object&gt;, &lt;embed&gt;, or &lt;applet&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-daoi">Level 2</td>
                                <td class="tg-daoi">plugin-types</td>
                                <td class="tg-ylrw">限制&lt;embed&gt;, &lt;object&gt; or &lt;applet&gt;的MIME類型</td>
                            </tr>
                            <tr>
                                <td class="tg-d1dx">Level 3</td>
                                <td class="tg-d1dx">report-to</td>
                                <td class="tg-8vzr">違反 CSP 時，可設定回傳給伺服器接收的網址(HTTP POST json格式)</td>
                            </tr>
                            <tr>
                                <td class="tg-daoi">Level 3</td>
                                <td class="tg-daoi">manifest-src</td>
                                <td class="tg-ylrw">icon圖標 &lt;link rel="manifest" href="mainfest.json"&gt;</td>
                            </tr>
                            <tr>
                                <td class="tg-d1dx">Level 3</td>
                                <td class="tg-d1dx">worker-src</td>
                                <td class="tg-8vzr">Worker()</td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </li>
        <li>設定方法
            HTTPheader
            <pre class="php" style="font-family:monospace;"><span style="color: #666666; font-style: italic;">//HTTPHeader</span>
content<span style="color: #339933;">-</span>security<span style="color: #339933;">-</span>policy<span style="color: #339933;">:</span> default<span style="color: #339933;">-</span>src <span style="color: #0000ff;">'none'</span><span style="color: #339933;">;</span> img<span style="color: #339933;">-</span>src <span style="color: #0000ff;">'self'</span> data<span style="color: #339933;">:;</span>
&nbsp;
<span style="color: #666666; font-style: italic;">// Apache</span>
<span style="color: #339933;">&lt;</span>IfModule mod_headers<span style="color: #339933;">.</span>c<span style="color: #339933;">&gt;</span>
<span style="color: #990000;">Header</span> set content<span style="color: #339933;">-</span>security<span style="color: #339933;">-</span>policy<span style="color: #339933;">:</span> default<span style="color: #339933;">-</span>src <span style="color: #0000ff;">'none'</span><span style="color: #339933;">;</span> img<span style="color: #339933;">-</span>src <span style="color: #0000ff;">'self'</span> data<span style="color: #339933;">:;</span>
<span style="color: #339933;">&lt;/</span>IfModule<span style="color: #339933;">&gt;</span>
&nbsp;
<span style="color: #666666; font-style: italic;">// Nginx</span>
add_header Content<span style="color: #339933;">-</span>Security<span style="color: #339933;">-</span>Policy <span style="color: #0000ff;">&quot;default-src 'self';&quot;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #666666; font-style: italic;">//PHP</span>
<span style="color: #990000;">header</span><span style="color: #009900;">&#40;</span><span style="color: #0000ff;">&quot;Content-Security-Policy: default-src 'none'; img-src 'self' data:;&quot;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #666666; font-style: italic;">//HTML</span>
<span style="color: #339933;">&lt;</span>meta http<span style="color: #339933;">-</span>equiv<span style="color: #339933;">=</span><span style="color: #0000ff;">&quot;Content-Security-Policy&quot;</span> content<span style="color: #339933;">=</span><span style="color: #0000ff;">&quot;default-src 'none'; img-src 'self' data:;&quot;</span><span style="color: #339933;">&gt;</span>
&nbsp;
&nbsp;</pre>
        </li>
        <li>CSP 語法
        <style type="text/css">
.tg  {border-collapse:collapse;border-color:#aaa;border-spacing:0;}
.tg td{background-color:#fff;border-color:#aaa;border-style:solid;border-width:1px;color:#333;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#f38630;border-color:#aaa;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-4fhu{background-color:#FFF;border-color:inherit;color:#212529;text-align:center;vertical-align:top}
.tg .tg-6omd{background-color:#FFF;border-color:inherit;color:#212529;text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-4fhu">CSP 語法</th>
    <th class="tg-4fhu">說明</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-6omd">'none'</td>
    <td class="tg-6omd">全部不允許</td>
  </tr>
  <tr>
    <td class="tg-4fhu">'self'</td>
    <td class="tg-4fhu">允許同網域</td>
  </tr>
  <tr>
    <td class="tg-6omd">指定網域<br>host-source</td>
    <td class="tg-6omd">feifei.tw<br>*.example.com<br>https://example.com<br>https://*.example.com<br>wss://example.com<br>wss://*.example.com</td>
  </tr>
  <tr>
    <td class="tg-4fhu">指定 scheme<br>scheme-source</td>
    <td class="tg-4fhu">http:<br>https:<br>data:<br>mediastream:<br>blob:<br>filesystem:</td>
  </tr>
  <tr>
    <td class="tg-6omd">*</td>
    <td class="tg-6omd">危險，允許所有 URL<br>除了data: blob: filesystem:</td>
  </tr>
  <tr>
    <td class="tg-4fhu">'unsafe-inline' </td>
    <td class="tg-4fhu">危險，允許 html 中的 css 或 js<br>XSS 最常出現的地方</td>
  </tr>
  <tr>
    <td class="tg-6omd">'unsafe-eval'</td>
    <td class="tg-6omd">危險，允許 eval()</td>
  </tr>
  <tr>
    <td class="tg-4fhu">'nonce-&lt;base64-value&gt;'<br>'&lt;hash-algorithm&gt;-&lt;base64-value&gt;'</td>
    <td class="tg-4fhu">驗證碼比對</td>
  </tr>
</tbody>
</table>
        </li>
    </ul>
</li>


<!-- <h2>小試身手</h2>
<p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. Cookie 儲存位置為(***)</p>
<p>2. Session 儲存位置為(***)</p>
<p>3. HttpOnly 無法被瀏覽器中哪個腳本語言存取 (**********)</p>



<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form> -->
<?php include_once "../../php-inc/footer.php";
?>