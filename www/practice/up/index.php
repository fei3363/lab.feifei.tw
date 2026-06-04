<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='上傳漏洞';
include('../../php-inc/header.php');

?>

<h1>上傳漏洞</h1>



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
      <td><a href="l1.php">上傳漏洞 </a></td>
      <td>上傳漏洞  </td>

    </tr>
 
  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
