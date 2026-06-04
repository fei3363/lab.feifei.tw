<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="flag{you_bypass_js}"){
        $challenges_name = "upload-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    
    }else if($input_answer=="flag{you_bypass_MIME_Typpppe}"){
        $challenges_name = "upload-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    
    }else if($input_answer=="flag{you_bypass_M@gic_NUMBER}"){
        $challenges_name = "upload-3";
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
    $titlename='Command injection';
	include_once('../../php-inc/header.php');
?>

<h2>上傳漏洞</h2>
<div id="doc" class="markdown-body container-fluid comment-enabled comment-inner" data-hard-breaks="true"><h1 class="part in-view" data-startline="1" data-endline="1" id="檔案上傳漏洞" data-id="檔案上傳漏洞"><a class="anchor hidden-xs" href="#檔案上傳漏洞" title="檔案上傳漏洞" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="2" data-size="6">檔案上傳漏洞</span></h1><p class="part in-view" data-startline="2" data-endline="2" data-position="9" data-size="0"><img src="https://i.imgur.com/U9PU6n2.png" alt="" class="" data-position="9" data-size="36" loading="lazy"></p><h2 class="part in-view" data-startline="4" data-endline="4" id="成因" data-id="成因"><a class="anchor hidden-xs" href="#成因" title="成因" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="50" data-size="2">成因</span></h2><p class="part in-view" data-startline="5" data-endline="5" data-position="53" data-size="0"><span data-position="53" data-size="74">很多網站都有提供給使用者上傳檔案的功能，但如果沒有進行過濾，那惡意攻擊者可能就會上傳惡意程式，導致檔案上傳漏洞，進行造成敏感資料外洩或遠端指令執行。</span></p><h2 class="part in-view" data-startline="7" data-endline="7" id="原理" data-id="原理"><a class="anchor hidden-xs" href="#原理" title="原理" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="132" data-size="2">原理</span></h2><ol class="part in-view" data-startline="8" data-endline="10" data-position="135" data-size="0">
<li class="" data-startline="8" data-endline="8" data-position="138" data-size="0"><span data-position="138" data-size="15">前端瀏覽器 - 檔案上傳的頁面</span></li>
<li class="" data-startline="9" data-endline="10" data-position="157" data-size="0"><span data-position="157" data-size="15">後端伺服器 - 儲存上傳的檔案</span></li>
</ol><h2 class="part in-view" data-startline="11" data-endline="11" id="前端" data-id="前端"><a class="anchor hidden-xs" href="#前端" title="前端" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="177" data-size="2">前端</span></h2><ol class="part in-view" data-startline="12" data-endline="15" data-position="180" data-size="0">
<li class="" data-startline="12" data-endline="12" data-position="183" data-size="0"><span data-position="183" data-size="26">input 標籤屬性 type 類型需要是 file</span></li>
<li class="" data-startline="13" data-endline="15" data-position="213" data-size="0"><span data-position="213" data-size="6">利用表單上傳</span></li>
</ol><h3 class="part" data-startline="16" data-endline="16" id="簡單利用" data-id="簡單利用"><a class="anchor hidden-xs" href="#簡單利用" title="簡單利用" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="226" data-size="4">簡單利用</span></h3><ul class="part" data-startline="17" data-endline="18">
<li class="raw" data-startline="17" data-endline="17" data-position="233" data-size="0"><span data-position="233" data-size="4">lab:</span><a href="https://rcelab.feifei.tw/up/l1.php" target="_blank" rel="noopener"><span data-position="237" data-size="34">https://rcelab.feifei.tw/up/l1.php</span></a></li>
<li class="raw" data-startline="18" data-endline="18" data-position="274" data-size="0"><span data-position="274" data-size="7">上傳一句話後門</span></li>
</ul><pre class="part" data-startline="19" data-endline="21" data-position="282"><code>&lt;?php @eval($_GET['meow']);?&gt;
</code></pre><h3 class="part" data-startline="23" data-endline="23" id="前端檢查" data-id="前端檢查"><a class="anchor hidden-xs" href="#前端檢查" title="前端檢查" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="325" data-size="4">前端檢查</span></h3><ul class="part" data-startline="24" data-endline="33">
<li class="raw" data-startline="24" data-endline="24" data-position="332" data-size="0"><span data-position="332" data-size="4">lab:</span><a href="https://rcelab.feifei.tw/up/l2.php" target="_blank" rel="noopener"><span data-position="336" data-size="34">https://rcelab.feifei.tw/up/l2.php</span></a></li>
<li class="raw" data-startline="25" data-endline="25" data-position="373" data-size="0"><span data-position="373" data-size="8">利用 js 檢查</span></li>
<li class="raw" data-startline="26" data-endline="33" data-position="384" data-size="0"><span data-position="384" data-size="2">繞過</span>
<ul>
<li class="raw" data-startline="27" data-endline="27" data-position="393" data-size="0"><span data-position="393" data-size="21">刪除或停用 js --&gt; 開發者工具 設定</span></li>
<li class="raw" data-startline="28" data-endline="28" data-position="421" data-size="0"><span data-position="421" data-size="11">use Console</span></li>
<li class="raw" data-startline="29" data-endline="29" data-position="439" data-size="0"><span data-position="439" data-size="27">使用 burpsuite --&gt; 修改 HTTP 封包</span></li>
<li class="raw" data-startline="30" data-endline="33" data-position="473" data-size="0"><img src="https://i.imgur.com/EJJxDMa.png" alt="" class="" data-position="473" data-size="36" loading="lazy"></li>
</ul>
</li>
</ul><h3 class="part" data-startline="34" data-endline="34" id="MIME-類型檢查" data-id="MIME-類型檢查"><a class="anchor hidden-xs" href="#MIME-類型檢查" title="MIME-類型檢查" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="517" data-size="9">MIME 類型檢查</span></h3><ul class="part" data-startline="35" data-endline="47">
<li class="raw" data-startline="35" data-endline="35" data-position="529" data-size="0"><span data-position="529" data-size="4">lab:</span><a href="https://rcelab.feifei.tw/up/l3.php" target="_blank" rel="noopener"><span data-position="533" data-size="34">https://rcelab.feifei.tw/up/l3.php</span></a></li>
<li class="raw" data-startline="36" data-endline="39" data-position="570" data-size="0"><span data-position="570" data-size="7">MIME 類別</span>
<ul>
<li class="raw" data-startline="37" data-endline="37" data-position="584" data-size="0"><span data-position="584" data-size="45">媒體類別(多用途網際網路郵件擴展或是MIME類別)是一種表示文件、檔案或各式位元組的標準。</span></li>
<li class="raw" data-startline="38" data-endline="38" data-position="636" data-size="0"><span data-position="636" data-size="8">RFC 6838</span></li>
<li class="raw" data-startline="39" data-endline="39" data-position="651" data-size="0"><a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types" target="_blank" rel="noopener"><span data-position="651" data-size="88">https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types</span></a></li>
</ul>
</li>
<li class="raw" data-startline="40" data-endline="41" data-position="742" data-size="0"><span data-position="742" data-size="2">結構</span>
<ul>
<li class="raw" data-startline="41" data-endline="41" data-position="751" data-size="0"><span data-position="751" data-size="12">type/subtype</span></li>
</ul>
</li>
<li class="raw" data-startline="42" data-endline="42" data-position="766" data-size="0"><code data-position="767" data-size="23">$_FILES["file"]["type"]</code><span data-position="791" data-size="12"> 能取得 MIME 類型</span></li>
<li class="raw" data-startline="43" data-endline="47" data-position="806" data-size="0"><span data-position="806" data-size="2">繞過</span>
<ul>
<li class="raw" data-startline="44" data-endline="47" data-position="815" data-size="0"><span data-position="815" data-size="27">使用 burpsuite --&gt; 修改 HTTP 封包</span>
<ul>
<li class="raw" data-startline="45" data-endline="47" data-position="853" data-size="0"><span data-position="853" data-size="3">修改 </span><code data-position="857" data-size="13">Context-Type:</code></li>
</ul>
</li>
</ul>
</li>
</ul><h3 class="part" data-startline="48" data-endline="48" id="黑名單" data-id="黑名單"><a class="anchor hidden-xs" href="#黑名單" title="黑名單" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="878" data-size="3">黑名單</span></h3><ul class="part" data-startline="49" data-endline="56">
<li class="raw" data-startline="49" data-endline="49" data-position="884" data-size="0"><span data-position="884" data-size="4">lab:</span><a href="https://rcelab.feifei.tw/up/l4.php" target="_blank" rel="noopener"><span data-position="888" data-size="34">https://rcelab.feifei.tw/up/l4.php</span></a></li>
<li class="raw" data-startline="50" data-endline="56" data-position="925" data-size="0"><span data-position="925" data-size="6">利用模糊測試</span>
<ul>
<li class="raw" data-startline="51" data-endline="52" data-position="938" data-size="0"><span data-position="938" data-size="27">使用 burpsuite --&gt; 修改 HTTP 封包</span>
<ul>
<li class="raw" data-startline="52" data-endline="52" data-position="976" data-size="0"><span data-position="976" data-size="3">修改 </span><code data-position="980" data-size="11">fillname=""</code></li>
</ul>
</li>
<li class="raw" data-startline="53" data-endline="53" data-position="999" data-size="0"><span data-position="999" data-size="8">phtm,pht</span></li>
<li class="raw" data-startline="54" data-endline="56" data-position="1014" data-size="0"><a href="https://github.com/fuzzdb-project/fuzzdb/blob/master/attack/file-upload/alt-extensions-php.txt" target="_blank" rel="noopener"><span data-position="1014" data-size="94">https://github.com/fuzzdb-project/fuzzdb/blob/master/attack/file-upload/alt-extensions-php.txt</span></a></li>
</ul>
</li>
</ul><h3 class="part" data-startline="57" data-endline="57" id="白名單" data-id="白名單"><a class="anchor hidden-xs" href="#白名單" title="白名單" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="1115" data-size="3">白名單</span></h3><ul class="part" data-startline="58" data-endline="68">
<li class="raw" data-startline="58" data-endline="58" data-position="1121" data-size="0"><span data-position="1121" data-size="4">lab:</span><a href="https://rcelab.feifei.tw/up/l5.php" target="_blank" rel="noopener"><span data-position="1125" data-size="34">https://rcelab.feifei.tw/up/l5.php</span></a></li>
<li class="raw" data-startline="59" data-endline="59" data-position="1162" data-size="0"><span data-position="1162" data-size="8">需要搭配其他漏洞</span></li>
<li class="raw" data-startline="60" data-endline="68" data-position="1173" data-size="0"><span data-position="1173" data-size="20">.htaccess apache2 功能</span><pre><code>&lt;FilesMatch "meow"&gt;
    SetHandler application/x-httpd-php
&lt;/FilesMatch&gt;
</code></pre>
<ul>
<li class="raw" data-startline="66" data-endline="68" data-position="1301" data-size="0"><span data-position="1301" data-size="23">test.meow -&gt; 被當成 php 執行</span></li>
</ul>
</li>
</ul><h3 class="part" data-startline="69" data-endline="69" id="Magin-Header" data-id="Magin-Header"><a class="anchor hidden-xs" href="#Magin-Header" title="Magin-Header" smoothhashscroll=""><span class="octicon octicon-link"></span></a><span data-position="1331" data-size="12">Magin Header</span></h3><ul class="part" data-startline="70" data-endline="77">
<li class="raw" data-startline="70" data-endline="70" data-position="1346" data-size="0"><span data-position="1346" data-size="4">lab:</span><a href="https://rcelab.feifei.tw/up/l6.php" target="_blank" rel="noopener"><span data-position="1350" data-size="34">https://rcelab.feifei.tw/up/l6.php</span></a></li>
<li class="raw" data-startline="71" data-endline="72" data-position="1387" data-size="0"><span data-position="1387" data-size="17">各類型的 Magic Header</span>
<ul>
<li class="raw" data-startline="72" data-endline="72" data-position="1411" data-size="0"><a href="https://en.wikipedia.org/wiki/List_of_file_signatures" target="_blank" rel="noopener"><span data-position="1411" data-size="53">https://en.wikipedia.org/wiki/List_of_file_signatures</span></a></li>
</ul>
</li>
<li class="raw" data-startline="73" data-endline="77" data-position="1467" data-size="0"><span data-position="1467" data-size="9">利用 HEX 示範</span>
<ul>
<li class="raw" data-startline="74" data-endline="74" data-position="1483" data-size="0"><a href="https://mh-nexus.de/en/hxd/" target="_blank" rel="noopener"><span data-position="1483" data-size="27">https://mh-nexus.de/en/hxd/</span></a></li>
<li class="raw" data-startline="75" data-endline="77" data-position="1517" data-size="0"><img src="https://i.imgur.com/gPo6T4A.png" alt="" class="" data-position="1517" data-size="36" loading="lazy"></li>
</ul>
</li>
</ul></div>
<!-- https://rcelab.feifei.tw/up/l1.php<br> -->
<!-- https://rcelab.feifei.tw/up/l2.php<br>
https://rcelab.feifei.tw/up/l3.php<br>
https://rcelab.feifei.tw/up/l4.php<br>
https://rcelab.feifei.tw/up/l5.php<br>
https://rcelab.feifei.tw/up/l6.php<br>

<h2>小試身手</h2>

 -->


<!-- 
<ul>
    <li>請問 Command injection 是因為使用者的輸入被當作「XX」的一部份，因而可以控制伺服器(**)</li>
    <li><a href="https://rcelab.feifei.tw/ci/cals.php" target="_blank" rel="noopener noreferrer">LAB</a>可取得的權限為(********)</li>
    <li>防範 Command injection 的方法，可以「XX」參數的輸入，看是否是合法輸入嗎</li>
</ul> -->

<!-- <form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form> -->


<?php
	include_once('../../php-inc/footer.php');
?>



