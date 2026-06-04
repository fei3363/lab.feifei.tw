<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}else{
    setcookie("role", 'sister',time()+3600*24,'/');
}

$titlename='HITCON 2022';
include('../../php-inc/header.php');

?>

各位好<br>
歡迎來到 HITCON 2022 Workshop <br>
欸！原來這個網站有洞：手把手帶你認識網站常見漏洞<br>
本次會介紹三個駭客說的話來認識網站常見漏洞<br>
本次共筆：https://hackmd.io/u18rG7HkTXSI8pCVF-sKhA<br>

<h3>欸日誌</h3>
<ul>
<li>駭客說：我看得到網站的程式碼</li>
<li>駭客說：我有管理員的權限</li>
<li>駭客說：我拿到你的資料了</li>

</ul>


<a href="l1.php">駭客說：我看得到網站的程式碼</a><br>
<!-- <a href="l2.php">關卡二</a><br>
<a href="l3.php">關卡三</a><br> -->


<?php

include('../../php-inc/footer.php')


?>