<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Broken Authentication 課程摘要';
include('../../php-inc/header.php');

?>

<h1>Broken Authentication 課程摘要</h1>
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
      <td><a href="l1.php">Bypass Auth</a></td>
      <td>常見繞過驗證的方法 </td>
      <td>
      <li>Broken-Authentication-1</li>
      <li>Broken-Authentication-2</li>
      <li>Broken-Authentication-3</li>
      </td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td><a href="l2.php">GitHack</a></td>
      <td>GitHack </td>
      <td>
      <li>Broken-Authentication-4</li>

      </td>
    </tr>

  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
