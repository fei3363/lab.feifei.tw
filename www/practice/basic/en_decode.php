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
  if($input_answer==":"){
      $challenges_name = "URL-and-Encoding-1";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="?"){
      $challenges_name = "URL-and-Encoding-2";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="#"){
      $challenges_name = "URL-and-Encoding-3";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="%20"){
      $challenges_name = "URL-and-Encoding-4";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="%E7%B7%A8%E7%A2%BC"){
      $challenges_name = "URL-and-Encoding-5";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="root:password"){
      $challenges_name = "URL-and-Encoding-6";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="admin:youGotIt"){
      $challenges_name = "URL-and-Encoding-7";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else if($input_answer=="FEIFEI"){
      $challenges_name = "URL-and-Encoding-8";
      include_once('../challenges.php');
      $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
  }else{
      $challenge_array = array('alert','答案錯誤');
  }
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['string'])) {
    $text = $_POST['string'];

    $textInBase64Enc = base64_encode($text);
    $textInBase64Dec = base64_decode($text);

    $textEntityEnc = htmlentities($text);
    $textEntityDec = html_entity_decode($text);

    $textURLEnc = urlencode($text);
    $textURLDec = urldecode($text);

    $textROT13 = str_rot13($text);

}

$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];


?>


<?php
  $titlename='Encoding';
  include_once('../../php-inc/header.php');
?>

<h1>URL 與常見編碼</h1>
<h2>URL</h2>
<p>打開瀏覽器常常會在上面輸入網址，這個網址統稱為 URL （Uniform Resource Locator），也就是定義網頁的「位置」。</p>
<p>在 RFC 規範中定義 URI（Uniform Resource Identifier），URL 為 URI 的子集。</p>
<h2>URI</h2>
<ul>
    <li>RFC2396 定義
        <ul>
            <li>Uniform
                <ul>
                    <li>定義統一的格式</li>
                </ul>
            </li>
            <li>Resource
                <ul>
                    <li>資源，可識別的內容，包含網頁、圖片、影片、js 檔案、css 檔案</li>
                </ul>
            </li>
            <li>Identifier
                <ul>
                    <li>可識別的符號</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>URL：一種統一定義的格式，可以用來表示資源的符號</li>
    <li>RFC3986 定義通用的語法
        <ul>
            <li>http://feifei.com.tw</li>
            <li>ftp://ftp.feifei.tw/hello.txt</li>
            <li>ldap://[2400:8902::f03c:93ff:fe98:d11f]/c=GetHelloWorld</li>
            <li>mailto:feifei3363@gmail.com</li>
            <li>news:feifei.com.tw</li>
            <li>tel:+886-090-000-0000</li>
        </ul>
    </li>
</ul>
<h2>URI 格式</h2>
<p>demo：https://lab.feifei.tw/practice/basic/en_decode/uri.php</p>
<pre><code>http://username:password@hostname:9090/path?arg=value#anchor
array (<br /> 'scheme' =&gt; 'http', // 協定 ://<br /> 'user' =&gt; 'username', // 帳號 :
 'pass' =&gt; 'password', // 密碼
 'host' =&gt; 'hostname', // 伺服器位置 @
 'port' =&gt; 9090, // 伺服器 port :
 'path' =&gt; '/path', // 路徑 /
 'query' =&gt; 'arg=value', // 查詢字串 ?
 'fragment' =&gt; 'anchor', // 片段識別碼 #
);<br /><br /></code></pre>
<h2>編碼 vs 解碼</h2>
<ul>
    <li>編碼（Encoding）：為了統一格式或收集資訊，會轉換成特定的格式</li>
    <li>解碼（Decoding）：還原已經被編碼過的字串，轉成原本的內容</li>
</ul>
<h3>URL 編碼 (=百分號編碼(Percent-encoding))</h3>
<ul>
    <li>URI 有定義
        <ul>
            <li>保留字元
                <ul>
                    <li>可看到 URI 格式中 ://、:、@、?、/、# 都是保留字元</li>
                    <li>RFC 3986（section 2.2&nbsp;<em>保留字元）</em></li>
                </ul>
            </li>
            <li>未保留字元但合法
                <ul>
                    <li>A-Z、a-Z、0-9、-、_、.、~</li>
                    <li>RFC 3986（section 2.3 未保留字元）</li>
                </ul>
            </li>
            <li>未保留字元(不合法)：未被定義
                <ul>
                    <li>使用 URL 編碼，%XX --&gt; 16 進位</li>
                    <li>如：中文字</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>特殊
        <ul>
            <li>空白
                <ul>
                    <li>RFC 3986 URI: 「%20」</li>
                    <li>W3C HTML 4.01 : 「+」<br />
                        <ul>
                            <li>Content-Type： MIME類型為 application/x-www-form-urlencoded</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<h3>其他編碼</h3>
<ul>
    <li>base64
        <ul>
            <li>利用 64 個可以列印的字元來表示二進位資料&nbsp;</li>
            <li>特徵：等號</li>
            <li>原理：先把文字轉成 ASCII 編碼 --&gt; 轉成 bit --&gt; 6 個一組 --&gt; 變成索引 --&gt; 對應編碼</li>
            <li>查看原理：https://lab.feifei.tw/practice/basic/en_decode/base64.php</li>
            <li>一般文字可編碼：Hello &lt;==&gt; SGVsbG8=</li>
            <li>十六進位也可編碼：0x4d 0x61 &lt;==&gt; TWE=</li>
            <li>常用網站：https://www.base64encode.org/</li>
            <li>於 HTTP/1.0 中使用基礎認證，會在標頭 Authorization: Basic Z3Vlc3Q6Z3Vlc3Q=
                <ul>
                    <li>代表 guest:guest</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>rot13
        <ul>
            <li>簡易的替換式密碼</li>
            <li>古羅馬開發凱撒加密變體</li>
            <li><tt>A</tt>換成<tt>N</tt>、<tt>B</tt>換成<tt>O</tt>、依此類推到<tt>M</tt>換成<tt>Z</tt></li>
            <li>常用網站：https://rot13.com/</li>
        </ul>
    </li>
    <li>摩斯密碼
        <ul>
            <li>Morse code&nbsp;</li>
            <li>測試網站：https://codepen.io/hdsbook/pen/rNOBrdL</li>
        </ul>
    </li>
    <li>編碼常用網站：https://www.asciitohex.com/</li>
</ul>
<h2>小試身手</h2>
<p>請回答以下的問題，並於 flag 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. 在 URI 格式中伺服器位置跟 port 之間會用哪一個特殊符號？(*)</p>
<p>2. 在 URI 格式中查詢字串會用哪一個特殊符號？(*)</p>
<p>3. 在 URI 格式中片段識別碼會用哪一個特殊符號？(*)</p>
<p>4. 在 URL 編碼中空白會被編碼成什麼?(***)</p>
<p>5. 請將「編碼」這兩個字用 URL 編碼?(******************)</p>
<p>6. 目前這個網站使用 HTTP/1.0 並利用 base64 進行身分驗證，其中他的登入字串如下：</p>
<p>Authorization: Basic cm9vdDpwYXNzd29yZA==</p>
<p>請找到帳號跟密碼(*************)</p>
<p>7. 以下有一個字串被 ROT13 編碼，是否能嘗試將此字串編碼成明文</p>
<p>hfreanzr: nqzva, cnffjbeq:lbhTbgVg</p>
<p>請輸入帳號:密碼 的格式(**************)</p>
<p>8. 請解開摩斯密碼「..-. . .. ..-. . ..」所代表的明文(******)</p>
<form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案"
                aria-label="回答問題" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出答案</button>
            </div>
        </div>
    </form>


<h3>工具</h3>
<p>以下是 PHP 內建的函式：</p>

<form name="" method="POST" action="">
    可輸入字串進行測試編碼 <input type="text" value="" name="string">
    <input type="submit" value="Submit">
</form>


<li>htmlentities：<?php echo $textEntityEn;?> </li>
<li>html_entity_decode：<?php echo $textEntityDec;?> </li>
<li>urlencode：<?php echo $textURLEnc;?> </li>
<li>urldecode：<?php echo $textURLDec;?> </li>
<li>str_rot13：<?php echo $textROT13;?> </li>
<li>base64_encode：<?php echo $textInBase64Enc;?> </li>
<li>base64_decode：<?php echo$textInBase64Dec;?> </li>


<?php
include_once('../../php-inc/footer.php');
?>