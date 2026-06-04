<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='IOT 課程摘要';
include('../../php-inc/header.php');

?>


<h1>IOT 課程摘要</h1>

<h3>使用命令提示字元</h3>
ssh fei@IP -p <? echo$_COOKIE['port'];?><br>
密碼：feifeiP@ssword!<br>
<br>


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
      <td><a href="l1.php">IOT GOAT </a></td>
      <td>物聯網漏洞挖掘</td>
    </tr>


  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
