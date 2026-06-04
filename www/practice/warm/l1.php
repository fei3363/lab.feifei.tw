<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="Repeater"){
        $challenges_name = "Warm-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="CVE-2020-10385"){
        $challenges_name = "Warm-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="CVE-2016-1240"){
        $challenges_name = "Warm-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }


}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];
    

 
?>


<?php
    $titlename='Warm up';
	include_once('../../php-inc/header.php');
?>






<h1>Google 暖身題目</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>
<h2>LAB1</h2>

請問工具 Burp Suite 中，需要重複送出封包，可以使用該工具的什麼功能(R*******)<br>
<img src="file/1.jpg"><br>
<br>


<h3>漏洞資料庫</h3>
<li>MITRE CVE：資安弱點情資分享，漏洞資料庫，記錄每一個 CVE 的內容</li>
https://cve.mitre.org/
<li>MITRE ATT&CK：資安威脅情資分享，攻擊防禦資料庫</li>
https://attack.mitre.org/
<li>ExploitDB：許多可驗證漏洞存在的 POC</li>
https://www.exploit-db.com/
<li>NVD：漏洞資料庫，來自 CVE 並加強搜尋與關聯軟體、產品列表</li>
https://nvd.nist.gov/vuln/search
<br>




<h2>LAB2</h2>
找出 WPForms 2020 年漏洞類型為 XSS 的 CVE 編號(CVE-YEAR-NUMBER)<br>
<br>

<h2>LAB3</h2>
2016 年 Debian 版本的 Apache Tomcat 有提權漏洞<br>
請問該漏洞的 CVE 編號(CVE-YEAR-NUMBER)<br>
<br>


<form method="POST">
    <div class="form-group">
        <label for="answer"><br><h4>Flag提交</h4></label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>
