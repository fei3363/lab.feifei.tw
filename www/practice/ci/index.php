<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Command injection 課程摘要';
include('../../php-inc/header.php');

?>

<h1>Command injection 課程摘要</h1>

<style type="text/css">
.tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-baqh">   <br><span style="font-weight:bold;color:white">ls</span>   </th>
    <th class="tg-baqh">   <br><span style="font-weight:bold;color:white">dir</span>   </th>
    <th class="tg-baqh">   <br><span style="font-weight:bold;color:white">列出當前目錄檔案</span>   </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-baqh">   <br><span style="color:black">mkdir</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">md</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">建立資料夾</span>   </td>
  </tr>
  <tr>
    <td class="tg-baqh">   <br><span style="color:black">id</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">id</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">當前使用者的   </span><span style="font-weight:normal;font-style:normal;color:black">UID 和 GID</span>   </td>
  </tr>
  <tr>
    <td class="tg-baqh">   <br><span style="color:black">cat</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">type</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">讀取檔案</span>   </td>
  </tr>
  <tr>
    <td class="tg-baqh">   <br><span style="color:black">ping</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">ping</span>   </td>
    <td class="tg-baqh">   <br><span style="color:black">使用   ICMP 協定(測試與目標的網路是否連線正常)</span>   </td>
  </tr>
</tbody>
</table>


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
      <td><a href="l1.php">Command injection </a></td>
      <td>Command injection  </td>
      <td><li>Command-injection-1</li></td>
    </tr>
 
  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
