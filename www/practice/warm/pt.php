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
    if($input_answer=="PT-01-ANS-2"){
        $challenges_name = "Warm-PT-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="1.19.0"){
        $challenges_name = "Warm-PT-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="2.3.1"){
        $challenges_name = "Warm-PT-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="OpenVAS、OWASP ZAP" || $input_answer=="OWASP ZAP、OpenVAS"){
        $challenges_name = "Warm-PT-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="21"){
        $challenges_name = "Warm-PT-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="2.3.4"){
        $challenges_name = "Warm-PT-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="CVE-2011-2523"){
        $challenges_name = "Warm-PT-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="use exploit/unix/ftp/vsftpd_234_backdoor"){
        $challenges_name = "Warm-PT-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="RHOSTS"){
        $challenges_name = "Warm-PT-9";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{vsftpd_hand_on_L@b}"){
        $challenges_name = "Warm-PT-10";
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






<h1>暖身題目</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>






<h2>滲透測試</h2>
協助企業找到企業網站的弱點，並撰寫報告供企業修復
<br>
<br>


<h3>LAB1: 下列何者是正確的選項</h3>
<li>PT-01-ANS-1 不需經過他人的同意，任意攻擊他人網站系統</li>
<li>PT-01-ANS-2 取得合法的滲透權限，進行合約內允許的檢測</li>
ps. 如果第一個選項正確，請在最下面的 flag 欄位輸入<b>PT-01-ANS-1</b>

<br>
<br>
<h3>LAB2: 收集階段:請找出以下網站的 </h3>
<a href="http://testhtml5.vulnweb.com/">testhtml5</a><br>
1. Nginx 的版本<br>
2. bootstrap css 版本<br>
<br>
<h3>LAB3: 收集階段：弱點掃描軟體</h3>
答案提示：(*******、********)<br>
下列哪一些弱點掃描軟體是開源的？
<li>服務弱點掃描工具</li>
Nessus<br>
OpenVAS<br>
<li>網頁弱點掃描工具</li>
IBM AppScan<br>
Acunetix Web Vulnerability Scanner<br>
OWASP ZAP<br>


<h3>LAB4: HandOn</h3>
1. 請確認自己可 SSH 連線到 Kali (不用回答)<br><br>
2. 利用 ip addr 確認自己的 IP(內網 172/192/10) 開頭)(不用回答)<br><br>
3. 利用 nmap 掃描網段<br>
<b>(回答: 請問目標機器開啟哪一個 port，請在下方直接輸入數字)</b><br><br>
4. 利用 nmap 查看版本<br>
<b>(回答: 請問目標服務的版本為多少，請在下方直接輸入數字)</b><br><br>
5. 查詢該服務有哪一個嚴重的 CVE 弱點<br>
<b>(回答: 請填寫 CVE 編號，請在下方直接輸入 CVE 編號)</b><br><br>
6. 使用 msfconsole 開啟介面進行攻擊<br>
<b>(回答: 使用哪一個 exploit，請在下方輸入 use exploit/xxxxxxxxxx)</b><br><br>
7. 請問要設定目標 IP 要利用哪一個參數<br>
<b>(回答: 請在下方直接輸入參數名稱(全大寫))</b><br><br>
8. <b>回答: 請輸入 flag.txt 的內容</b><br>
(/tmp 資料夾內)<br>

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
