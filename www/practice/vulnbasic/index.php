<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='網站漏洞簡介';
include('../../php-inc/header.php');

?>

<h1>網站漏洞簡介</h1>

<h2><a href="https://owasp.org/" target="_blank" rel="noopener noreferrer">OWASP</a></h2>
<ul>
    <li>Open Web Application Security Project</li>
    <li>開放 Web 應用程式(軟體) 安全專案</li>
    <li>非營利組織，全世界各處都有</li>
    <li>希望提出 Web 軟體安全標準、工具與技術文件</li>
    <li>底下有很多專案
        <ul>
            <li>WEB 相關
                <ul>
                    <li>OWASP Top 10</li>
                    <li>OWASP Web Security Testing Guide</li>
                </ul>
            </li>
            <li>Mobile 相關
                <ul>
                    <li>OWASP Mobile Top 10</li>
                    <li>OWASP Mobile Security Testing Guide</li>
                </ul>
            </li>
            <li>IoT 相關
                <ul>
                    <li>OWASP IOT Top 10</li>
                    <li>OWASP Firmware Security Testing Methodology</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>


<h3>OWASP Top 10</h3>
<ul>
    <li>統計網站前十大弱點</li>
    <li>目前版本：2021</li>
    <li>歷史版本：2017、2013、2010、2004</li>
</ul>



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
            <td><a href="intr.php">簡介 2021 十大弱點</a></td>
            <td>了解 2021 版本有哪十大弱點。 </td>
        </tr>

        <tr>
            <th scope="row">2</th>
            <td><a href="../sqli">SQL injection</a></td>
            <td>了解何謂 SQL injection 以及攻擊手法<br>A03:2021-Injection</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td><a href="../xss">Cross Site Script</a></td>
            <td>了解何謂 Cross Site Script 以及攻擊手法<br>A03:2021-Injection</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td><a href="../fi">File inclusion</a></td>
            <td>了解何謂 File inclusion，包含他的類型與攻擊手法<br>A03:2021-Injection</td>
        </tr>


    </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>