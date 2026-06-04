<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Basic 課程摘要';
include('../../php-inc/header.php');

?>

<h1>網頁基礎課程摘要</h1>
1989 年，歐洲核子研究組織（CERN）的提摩西·約翰·柏內茲-李爵士，希望可以讓世界各地的學者互相分享知識。<br>
提出透過在電腦中顯示文字（超文字：HyperText），連成一個網狀結構的系統(全球資訊網：World Wide Web)。<br>
<br>
構建 World Wide Web 的三大技術：<br>
<ul>
<li>HTML（HyperText MarkupLanguage）：構建網頁的文字標記語言</li>
<li>HTTP（HyperText Transfer Protocol）：傳輸網頁的協定，屬於 TCP/IP 中的應用層</li>
<li>URL（UniformResource Locator）：定義網頁所在的地址</li>
</ul>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">課程名稱</th>
            <th scope="col">課程說明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td><a href="network.php">TCP/IP</a></td>
            <td>了解網路概論基礎，TCP/IP 四層各自有那些常見的協定。 </td>
        </tr>

        <tr>
            <th scope="row">2</th>
            <td><a href="en_decode.php">URL 與常見編碼</a></td>
            <td>在 URL 中有那些技術以及常見的編碼有哪些。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td><a href="http.php">HTTP 基礎</a></td>
            <td>了解 HTTP 封包的結構以及 HTTP 協定的特性</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td><a href="curl.php">curl</a></td>
            <td>認識 curl 工具，利用工具模擬瀏覽器送出封包</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td><a href="devtools.php">開發者工具</a></td>
            <td>認識開發者工具以 Chrome DevTools 為範例</td>

        </tr>
        <tr>
            <th scope="row">6</th>
            <td><a href="burp.php">Burp Suite</a></td>
            <td>認識 Burp Suite 工具</td>

        </tr>
        <tr>
            <th scope="row">7</th>
            <td><a href="combine-http.php">HTTP 綜合題</a></td>
            <td>HTTP 綜合題演練</td>

        </tr>
        <tr>
            <th scope="row">8</th>
            <td><a href="l5.php">加密演算法</a></td>
            <td>認識常見的加密雜湊演算法</td>

        </tr>

    </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>