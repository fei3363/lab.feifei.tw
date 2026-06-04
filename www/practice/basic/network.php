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
    if($input_answer=="協定"){
        $challenges_name = "Networking-intr-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="HTTP"){
        $challenges_name = "Networking-intr-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="應用層"){
        $challenges_name = "Networking-intr-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="封裝"){
        $challenges_name = "Networking-intr-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="ARP"){
        $challenges_name = "Networking-intr-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="三方交握"){
        $challenges_name = "Networking-intr-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="DNS"){
        $challenges_name = "Networking-intr-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="172.104.100.165"){
        $challenges_name = "Networking-intr-8";
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
    $titlename='網路概論基礎';
	include_once('../../php-inc/header.php');
?>

<h1>網路概論基礎</h1>
<h2>TCP/IP</h2>
<h3>TCP/IP 協定</h3>
<p><strong>制定溝通方式的規則</strong></p>
<p>網路利用 TCP/IP 各種協定在運作，網路設備如果要互相溝通，必須要使用相同的「溝通方式」，</p>
<ol>
<li>如何找到溝通的目標</li>
<li>誰先開始進行溝通</li>
<li>用什麼語言溝通</li>
<li>怎麼樣才算是結束溝通 &hellip;等等</li>
</ol>
<p><strong>需要定義以上種種規則，這些規則就叫做「協定」(protocol)</strong></p>
<h3>TCP/IP 分層管理</h3>
<p><strong>分層好處多多</strong></p>
<p>1. 分層讓管理更方便<br />2. 分層讓設計更簡單<br />3. 簡單分成四層<br />(1) 應用層<br />(2) 傳輸層<br />(3) 網路層<br />(4) 連結層</p>
<h3>TCP/IP 傳輸方向</h3>
<p><strong>了解每一層傳輸過程中做了什麼事情</strong></p>
<ul>
<li>請求封包： 使用者端(應用層 -&gt; 傳輸層 -&gt; 網路層 -&gt; 連結層 ) -&gt; 伺服器端(連結層 -&gt; 網路層 -&gt; 傳輸層 -&gt; 應用層)</li>
<li>回傳封包： 伺服器端(應用層 -&gt; 傳輸層 -&gt; 網路層 -&gt; 連結層 ) -&gt; 使用者端(連結層 -&gt; 網路層 -&gt; 傳輸層 -&gt; 應用層)</li>
</ul>
<p>經過每一層會加上該層的 header：把封包包裝起來-&gt;封裝 encapsulate</p>
<h3>網頁傳輸過程中會遇到的協定</h3>
<ol>
<li>網路層 &mdash; Internet Protocol</li>
<li>傳輸層 &mdash; Transmission Control Protocol&nbsp;</li>
<li>應用層 &mdash; Domain Network System (DNS) protocol</li>
</ol>
<p><strong>網路層 &mdash; Internet Protocol</strong></p>
<p>將各種「封包」確實傳送給目的地，需要具備 IP address 和 MAC address。</p>
<ol>
<li>IP address：該設備被分派到的網路地址。</li>
<li>MAC address：網路卡固定的地址，基本上不會改變。</li>
</ol>
<p>在 IP 中互相溝通，必須仰賴 MAC Address，透過 ARP 協定（Address Resolution Protocol）解析地址，可協定將 IP address 反查對應的 MAC addreess。</p>
<p>傳輸過程中，會經過很多電腦、網路設備如 Router、AP、小烏龜、基地台等，找到一台可到目的地的路徑稱為 路由（Routing）。</p>
<p><strong>傳輸層 &mdash; Transmission Control Protocol&nbsp;</strong></p>
<p>為了確保傳輸過程中「確實」將封包傳給目的地，在傳輸層中使用 TCP 協定，會將封包切成較小的格式（segment），進行傳輸。</p>
<p>並透過「三方交握」的方式：</p>
<p>(1) 發送 SYN（synchronize） 給對方</p>
<p>(2) 對方回傳 SYN/ACK</p>
<p>(3) 再發 ACK（acknowledgement） 給對方</p>
<p>之後就會進入連線模式，如果斷線會進行相同的步驟，發送原本的封包，以確保封包的可靠性。</p>

<p><strong>應用層 &mdash; Domain Network System (DNS) protocol</strong></p>
<p>DNS 用來解析域名與 IP 的系統。</p>
<p>因為人腦並不擅長記 IP。</p>

<h2>小試身手</h2><p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. 請問設備想進行溝通，會先訂下規則，請問這規則稱為__(**)</p>
<p>2. 負責傳輸網頁的協定為______(****)</p>
<p>3. 呈上，這個協定為 TCP/IP 的哪一層(***)</p>
<p>4. 在 TCP/IP 中，傳輸過程在每一層會加上該層的標頭，請問這個動作稱為___(**)</p>
<p>5. 在 網路層 中，封包會透過_____協定，找到對應的 MAC address。(***)</p>
<p>6. 在 傳輸層 中，為了確保增加傳輸封包的可靠性，請問會利用 TCP 的________進入連線模式。(****)</p>
<p>7. 在 應用層 中，因為人類不好記下 IP 位置，因此會透過____服務，用來解析域名找到 IP。(***)</p>
<p>8. 請問 域名 lab.feifei.tw 對應到哪一個 IP？</p>




<form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案"
                aria-label="回答問題" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出答案</button>
            </div>
        </div>
    </form>


<?php
	include_once('../../php-inc/footer.php');
?>