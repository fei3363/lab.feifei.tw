<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Warm Up 課程摘要';
include('../../php-inc/header.php');

?>



<h1>Warm Up 課程摘要</h1>
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
      <td><a href="news.php">資安新聞</a></td>
      <td>利用資安新聞學習資訊安全</td>
    </tr>    
  <tr>
      <th scope="row">2</th>
      <td><a href="pt.php">PT 認識滲透測試</a></td>
      <td>了解滲透測試流程</td>
    </tr>    
    <tr>
      <th scope="row">3</th>
      <td><a href="l1.php">利用 Google 找答案</a></td>
      <td>訓練自己的搜尋技巧 & 認識漏洞資料庫</td>
    </tr>



  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
