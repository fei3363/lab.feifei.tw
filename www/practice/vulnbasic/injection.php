<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='注入型漏洞';
include('../../php-inc/header.php');

?>

<h1>注入型漏洞</h1>

駭客注入惡意語法（SQL語法、系統指令、惡意程式語言)可能造成嚴重風險。

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
            <td><a href="../sqli">SQL injection</a></td>
            <td>資料庫注入攻擊</td>
        </tr>

        <tr>
            <th scope="row">2</th>
            <td><a href="../ci">command injection</a></td>
            <td>指令注入攻擊</td>
        </tr>

        <tr>
            <th scope="row">3</th>
            <td><a href="../fi">File inclusion</a></td>
            <td>LFI / RFI</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td><a href="../up">Upload</a></td>
            <td>上傳漏洞</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td><a href="../xxe">XXE</a></td>
            <td> XML External Entities</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td><a href="../xss">XSS</a></td>
            <td> Cross Site Script </td>
        </tr>
                   
    </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>