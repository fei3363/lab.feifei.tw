<?php


session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    if ($input_answer == "flag{xxe_easy_flag}") {
        $user_id = $_SESSION["id"];
        $challenges_name = "XML-External-Entities-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
    } else {
        $challenge_array = array('alert', '答案錯誤');
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];
    if ($input_username == "S0meUs1rn@m1" && $input_password == "p@5S_w0rd") {
        $user_id = $_SESSION["id"];
        $challenges_name = "SenSitive-Data-Exposure-2";
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
$titlename = 'XXE';
include_once('../../php-inc/header.php');
?>




<h1>XXE</h1>

<li>XML external entity (XXE) injection
    <ul>
        <li>XML external entity injection 也就是 XXE，可以透過惡意的請求查看伺服器的敏感資料</li>
        <li> 漏洞成因：<ul>
                <li>
                    許多網站透過 XML 格式的檔案進行傳輸，而後端所使用的函式庫或後端程式邏輯，針對 XML 處理的解析器預設開啟許多危險的功能，若沒有進行關閉或是限制，可能就會造成 XXE 攻擊。
                </li>
            </ul>
        </li>
    </ul>
</li>

<h2>XML</h2>
<li>要先了解何謂 XML 可延伸標記式語言（Extensible Markup Language）</li>
<br>
<pre style='color:#000000;background:#ffffff;'><span style='color:#004a43; '>&lt;?</span><span style='color:#800000; font-weight:bold; '>xml</span><span style='color:#004a43; '> </span><span style='color:#074726; '>version</span><span style='color:#808030; '>=</span><span style='color:#800000; '>"</span><span style='color:#7d0045; '>1.0</span><span style='color:#800000; '>"</span><span style='color:#004a43; '> </span><span style='color:#074726; '>standalone</span><span style='color:#808030; '>=</span><span style='color:#800000; '>"</span><span style='color:#0f4d75; '>yes</span><span style='color:#800000; '>"</span><span style='color:#004a43; '> </span><span style='color:#004a43; '>?></span>
<span style='color:#004a43; '>&lt;!</span><span style='color:#800000; font-weight:bold; '>DOCTYPE</span> <span style='color:#bb7977; font-weight:bold; '>author</span> <span style='color:#a65700; '>[</span>
  <span style='color:#004a43; '>&lt;!</span><span style='color:#800000; font-weight:bold; '>ELEMENT</span> <span style='color:#bb7977; font-weight:bold; '>author</span> <span style='color:#808030; '>(</span><span style='color:#004a43; '>#PCDATA</span><span style='color:#808030; '>)</span><span style='color:#004a43; '>></span>
  <span style='color:#004a43; '>&lt;!</span><span style='color:#800000; font-weight:bold; '>ENTITY</span> <span style='color:#bb7977; font-weight:bold; '>name</span> <span style='color:#800000; '>"</span><span style='color:#0000e6; '>Fei</span><span style='color:#800000; '>"</span><span style='color:#004a43; '>></span>
<span style='color:#a65700; '>]</span><span style='color:#004a43; '>></span>
<span style='color:#a65700; '>&lt;</span><span style='color:#5f5035; '>author</span><span style='color:#a65700; '>></span><span style='color:#074726; '>&amp;</span><span style='color:#074726; '>name</span><span style='color:#074726; '>;</span><span style='color:#a65700; '>&lt;/</span><span style='color:#5f5035; '>author</span><span style='color:#a65700; '>></span>
</pre>

<a href="xml/sample.xml" target="_blank">查看該 xml </a>

<h2>DTD</h2>
<pre style='color:#000000;background:#ffffff;'><span style='color:#004a43; '>&lt;?</span><span style='color:#800000; font-weight:bold; '>xml</span><span style='color:#004a43; '> </span><span style='color:#074726; '>version</span><span style='color:#808030; '>=</span><span style='color:#800000; '>"</span><span style='color:#7d0045; '>1.0</span><span style='color:#800000; '>"</span><span style='color:#004a43; '>?></span>
<span style='color:#004a43; '>&lt;!</span><span style='color:#800000; font-weight:bold; '>DOCTYPE</span> <span style='color:#bb7977; font-weight:bold; '>note</span> <span style='color:#004a43; '>SYSTEM</span> <span style='color:#800000; '>"</span><span style='color:#40015a; '>email.dtd</span><span style='color:#800000; '>"</span><span style='color:#004a43; '>></span>
<span style='color:#a65700; '>&lt;</span><span style='color:#5f5035; '>email</span><span style='color:#a65700; '>></span>
  <span style='color:#a65700; '>&lt;</span><span style='color:#5f5035; '>to</span><span style='color:#a65700; '>></span>fei@kiwissec.com<span style='color:#a65700; '>&lt;/</span><span style='color:#5f5035; '>to</span><span style='color:#a65700; '>></span>
  <span style='color:#a65700; '>&lt;</span><span style='color:#5f5035; '>from</span><span style='color:#a65700; '>></span>feifei@gmail.com<span style='color:#a65700; '>&lt;/</span><span style='color:#5f5035; '>from</span><span style='color:#a65700; '>></span>
  <span style='color:#a65700; '>&lt;</span><span style='color:#5f5035; '>subject</span><span style='color:#a65700; '>></span>Good News<span style='color:#a65700; '>&lt;/</span><span style='color:#5f5035; '>subject</span><span style='color:#a65700; '>></span>
  <span style='color:#a65700; '>&lt;</span><span style='color:#5f5035; '>body</span><span style='color:#a65700; '>></span>Congratulations<span style='color:#a65700; '>&lt;/</span><span style='color:#5f5035; '>body</span><span style='color:#a65700; '>></span>
<span style='color:#a65700; '>&lt;/</span><span style='color:#5f5035; '>email</span><span style='color:#a65700; '>></span>
</pre>
<li>注意 email.dtd</li>
<li><a href="xml/email.dtd" target="_blank">查看該 email.dtd </a></li>
<li><a href="xml/email.xml" target="_blank">查看該 email.xml </a></li>


<h2>XXE</h2>

<pre>
&lt;?xml version="1.0" encoding="utf-8"?>
&lt;!DOCTYPE foo [
&lt;!ELEMENT foo ANY>
&lt;!ENTITY xxe SYSTEM "file:///etc/passwd">
]>
&lt;foo>
&xxe;
&lt;/foo>


</pre>



<h2>lab</h2>
<li>上傳一個惡意的 xml </li>

<pre>

$creds = simplexml_import_dom($dom);
$user = $creds->user;
$pass = $creds->pass;
echo "You have logged in as user $user";

</pre>




<li>flag in /etc/.xmlflag</li>
<form enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
    <table>
        <tr>
            <td>Upload xml file below:</td>
        </tr>
        <tr>
            <td> <input type="file" name="file" /></td>
        </tr>
        <tr>
            <td><input type="submit" name="upload" value="upload" /></td>
        </tr>
    </table>
</form>
<hr>
<h3>解析內容</h3>
<?php
if (isset($_POST['upload'])) {
    $xmlfile    = file_get_contents($_FILES['file']['tmp_name']);
    libxml_disable_entity_loader(false);
    $dom = new DOMDocument();
    $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
    $creds = simplexml_import_dom($dom);
    $user = $creds->user;
    $pass = $creds->pass;
    echo "You have logged in as user $user";
}



?>



<form method="post">
    flag:<input type="text" name="answer"><br>
    <input type="submit" value="送出"><br>
</form>

<h3>防禦方法</h3>
<ul>
    <li>關閉 DTD
        <ul>
            <li>factory.setFeature("http://xml.org/sax/features/external-general-entities",false);</li>
            <li>factory.setFeature("http://xml.org/sax/features/external-parameter-entities",false);</li>
        </ul>
    </li>
</ul>




<?php
include_once('../../php-inc/footer.php');
?>