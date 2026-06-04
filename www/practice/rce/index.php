<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='Remote Code Execution';
include('../../php-inc/header.php');

?>


<h1>Remote Code Execution</h1>

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
      <th scope="row">1</th>
      <td><a href="l1.php">滲透測試演練</a></td>
      <td></td>
    </tr>

  <!-- <tr>
      <th scope="row">1</th>
      <td><a href="l1.php">Local File include</a></td>
      <td>LFI</td>
    </tr>
    <tr>
      <th >2</th>
      <td><a href="l2.php">Remote File Inclusion </a></td>
      <td>RFI</td>
    </tr>
    <tr>
      <th >3</th>
      <td><a href="l3.php">Command injection</a></td>
      <td>CMDI</td>
    </tr> -->
    <!-- <tr>
      <th >4</th>
      <td><a href="l4.php">Reverse Shell</a></td>
      <td></td>
    </tr>
    <tr>
      <th >5</th>
      <td><a href="l5.php">已知漏洞</a></td>
      <td></td>
    </tr> -->
  </tbody>
</table>

        <?php

include('../../php-inc/footer.php')


?>
