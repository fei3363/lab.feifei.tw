<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='SenSitive Data Exposure 課程摘要';
include('../../php-inc/header.php');

?>


<h1>SenSitive Data Exposure 課程摘要</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">課程名稱</th>
      <th scope="col">課程說明</th>
      <th scope="col">課程 LAB</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><a href="l1.php">敏感資料外洩</a></td>
      <td>許多設定造成敏感資料外洩</td>
      <td><li>SenSitive-Data-Exposure-1</li><li>SenSitive-Data-Exposure-2</li></td>
    </tr>

  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
