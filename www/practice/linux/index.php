<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Linux 課程摘要';
include('../../php-inc/header.php');

?>


<h1>Linux 課程摘要</h1>

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
      <th >1</th>
      <td><a href="l1.php">Linux 基礎指令</a></td>
      <td>了解常用的 Linux 指令，可自行安裝 Linux base 的機器進行練習</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><a href="pre.php">Linux 闖關</a></td>
      <td>利用闖關學習 Linux，需使用闖關伺服器進行練習</td>
    </tr>

  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
