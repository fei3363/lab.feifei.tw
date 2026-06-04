<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Request Forgeries 課程摘要';
include('../../php-inc/header.php');

?>



<h1>Request Forgeries 課程摘要</h1>
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
      <td><a href="l1.php">CSRF</a></td>
      <td>CSRF</td>
      <td><li>Request-Forgeries-1</li></td>
    </tr>

  
  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
