<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
  exit;
}


$titlename='Broken Access Control 課程摘要';
include('../../php-inc/header.php');

?>


<h1>Broken Access Control 課程摘要</h1>
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
      <td><a href="l1.php">Insecure Direct Object References</a></td>
      <td>不安全的物件參照</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><a href="l2.php">Missing Function Level Access Control</a></td>
      <td>缺乏功能性的權限控制</td>
    </tr>

  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
