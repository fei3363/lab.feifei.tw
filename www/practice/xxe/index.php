<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='XML External Entities 課程摘要';
include('../../php-inc/header.php');

?>



<h1>XML External Entities 課程摘要</h1>
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
      <td><a href="l1.php">XXE 基礎</a></td>
      <td>了解 XXE 攻擊手法 </td>
      <td><li>XML-External-Entities-1</li></td>
    </tr>


  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
