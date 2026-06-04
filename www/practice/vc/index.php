<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Vulnerable Components 課程摘要';
include('../../php-inc/header.php');

?>


<h1>Vulnerable Components 課程摘要</h1>
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
      <td><a href="l1.php">Jquery UI XSS</a></td>
      <td>常見的 library 已知弱點 </td>
      <td><li>Vulnerable-Components-1</li></td>
    </tr>


  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
