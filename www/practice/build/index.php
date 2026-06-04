<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}else{
    setcookie("role", 'sister',time()+3600*24,'/');
}

$titlename='資安新手村';
include('../../php-inc/header.php');

?>

萌新們，你們好！<br>
恭喜你們掉落到資安新手村<br>

<!-- <h3>挖寶日誌</h3>
<ul>
<li>瞭解資安與生活</li>
<li>瞭解網站相關安全</li> -->
    <!-- <li>學會網站的原理</li>
    <li>知道常用的檢測工具</li>
    <li>知道常見的網站漏洞</li> -->
<!-- </ul> -->


<!-- <a href="pre.php">前置關卡</a><br> -->
<!-- <a href="https://forms.gle/1thpYoT8LvvKrTmv7">分享你的以終為始目標</a><br> -->
<!-- <a href="https://feifei.tw/security-getting-started/">正著學</a><br> -->
<!-- <a href="l1.php">關卡一</a><br> -->
<!-- <a href="l2.php">關卡二</a><br> -->
<!-- <a href="l3.php">關卡三</a><br> -->

<h1>資安新手村</h1>

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
      <td><a href="pre.php">新手任務</a></td>
      <td>認識生活中的資訊安全，並了解資安相關民慈</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><a href="l1.php">前置開發、攻擊基礎</a></td>
      <td>了解駭客如何攻擊以及常見的資安專案</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><a href="l2.php">漏洞基礎</a></td>
      <td>科普常見的網站資安漏洞</td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><a href="l3.php">常見漏洞</a></td>
      <td>科普常見的網站資安漏洞</td>
    </tr>
    <tr>
      <th scope="row">★</th>
      <td><a href="https://feifei.tw/security-getting-started/">資安入門手冊</a></td>
      <td>給新手回家練習的資安手冊</td>
    </tr>
  </tbody>
</table>


<?php

include('../../php-inc/footer.php')


?>