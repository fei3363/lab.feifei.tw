<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Client Side 課程摘要';
include('../../php-inc/header.php');

?>



<h1>Client Side 課程摘要</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">課程名稱</th>
      <th scope="col">課程說明</th>
      <th scope="col">課程 LAB</th>
    </tr>
  </thead>
  <!-- <tbody>
    <tr>
      <th scope="row">1</th>
      <td><a href="l1.php">HTTP 基礎</a></td>
      <td>了解常見封包 HTTP </td>
      <td><li>HTTP-1</li></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><a href="l2.php">HTTP Proxy</a></td>
      <td>攔截封包並修改</td>
      <td><li>HTTP-2</li></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><a href="l3.php">開發者工具</a></td>
      <td>認識開發者工具</td>
      <td>
      <li>Developer-Tool-1-tooken</li>
      <li>Developer-Tool-2-number</li>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><a href="l4.php">常見編碼</a></td>
      <td>認識常見的編碼</td>
      <td>
      <li>Encoding-1-base64</li>
      <li>Encoding-2-rot13</li>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><a href="l5.php">加密演算法</a></td>
      <td>認識常見的加密雜湊演算法</td>
      <td>
      <li>Cryptography-1-hash</li>
      <li>Cryptography-2-crypto</li>
      </td>
    </tr>

  </tbody> -->
</table>

        <?php

include('../../php-inc/footer.php')


?>
