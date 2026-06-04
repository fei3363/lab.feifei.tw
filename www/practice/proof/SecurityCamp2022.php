
<?php


session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("../basic/config.php");


$challengeList = array(


  "Networking-intr-1" => "/practice/basic/network.php",
  "Networking-intr-2" => "/practice/basic/network.php",
  "Networking-intr-3" => "/practice/basic/network.php",
  "Networking-intr-4" => "/practice/basic/network.php",
  "Networking-intr-5" => "/practice/basic/network.php",
  "Networking-intr-6" => "/practice/basic/network.php",
  "Networking-intr-7" => "/practice/basic/network.php",
  "Networking-intr-8" => "/practice/basic/network.php",
  
  
  "URL-and-Encoding-1" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-2" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-3" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-4" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-5" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-6" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-7" => "/practice/basic/en_decode.php",
  "URL-and-Encoding-8" => "/practice/basic/en_decode.php",
  
  
  "HTTP-Basic-1" => "/practice/basic/http.php",
  "HTTP-Basic-2" => "/practice/basic/http.php",
  "HTTP-Basic-3" => "/practice/basic/http.php",
  "HTTP-Basic-4" => "/practice/basic/http.php",
  "HTTP-Basic-5" => "/practice/basic/http.php",
  "HTTP-Basic-6" => "/practice/basic/http.php",
  "HTTP-Basic-7" => "/practice/basic/http.php",
  "HTTP-Basic-8" => "/practice/basic/http.php",
  
  
  "Curl-tool-1" => "/practice/basic/curl.php",
  "Curl-tool-2" => "/practice/basic/curl.php",
  "Curl-tool-3" => "/practice/basic/curl.php",
  "Curl-tool-4" => "/practice/basic/curl.php",
  "Curl-tool-5" => "/practice/basic/curl.php",
  "Curl-tool-6" => "/practice/basic/curl.php",
  
  "Developer-Tool-1" => "/practice/basic/devtools.php",
  "Developer-Tool-2" => "/practice/basic/devtools.php",
  "Developer-Tool-3" => "/practice/basic/devtools.php",
  "Developer-Tool-4" => "/practice/basic/devtools.php",
  "Developer-Tool-5" => "/practice/basic/devtools.php",
  
  "BurpSuite-tool-1" => "/practice/basic/burp.php",
  "BurpSuite-tool-2" => "/practice/basic/burp.php",
  
  "Combine-HTTP-3" => "/practice/basic/combine-http.php",
  "Combine-HTTP-1" => "/practice/basic/combine-http.php",
  "Combine-HTTP-2" => "/practice/basic/combine-http.php",
  
  "Cryptography-1-hash" => "/practice/basic/en_decode.php"
  
  

);


$challengeTwoList = array(
    "OWASP-Top-10-2021-intr-1" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-2" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-3" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-4" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-5" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-6" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-7" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-8" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-9" => "/practice/vulnbasic/intr.php",
  "OWASP-Top-10-2021-intr-10" => "/practice/vulnbasic/intr.php",
  
  "SQL-Basic-1" => "/practice/sqli/sql1.php",
  "SQL-Basic-2" => "/practice/sqli/sql1.php",
  "SQL-Basic-3" => "/practice/sqli/sql1.php",
  "SQL-Basic-4" => "/practice/sqli/sql1.php",
  "SQL-Basic-5" => "/practice/sqli/sql1.php",
  "SQL-Basic-6" => "/practice/sqli/sql1.php",
  "SQL-Basic-7" => "/practice/sqli/sql1.php",
  "SQL-Basic-8" => "/practice/sqli/sql1.php",
  "SQL-Injection-Stirng-1" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-2" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-3" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-4" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-5" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-6" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-7" => "/practice/sqli/sql2.php",
  "SQL-Injection-Stirng-8" => "/practice/sqli/sql2.php",
  "SQL-Injection-Numeric-1" => "/practice/sqli/sql3.php",
  "SQL-Injection-Numeric-2" => "/practice/sqli/sql3.php",
  "SQL-Injection-Numeric-3" => "/practice/sqli/sql3.php",
  "SQL-Injection-Numeric-4" => "/practice/sqli/sql3.php",
  "SQL-Injection-Union-1" => "/practice/sqli/sql4.php",
  "SQL-Injection-Union-2" => "/practice/sqli/sql4.php",
  "SQL-Injection-Union-3" => "/practice/sqli/sql4.php",
  "SQL-Injection-Blind-1" => "/practice/sqli/sql5.php",
  "SQL-Injection-bypass-1" => "/practice/sqli/sql6.php",
  
  
  
  "JavaScript-Basic-1" =>"/practice/xss/pre.php",
  "JavaScript-Basic-2" =>"/practice/xss/pre.php",
  "JavaScript-Basic-3" =>"/practice/xss/pre.php",
  "JavaScript-Basic-4" =>"/practice/xss/pre.php",
  "JavaScript-Basic-5" =>"/practice/xss/pre.php",
  "JavaScript-Basic-6" =>"/practice/xss/pre.php",
  "JavaScript-Basic-7" =>"/practice/xss/pre.php",
  "JavaScript-Basic-8" =>"/practice/xss/pre.php",

  
  
  "RCE-LFI-1" => "/practice/fi/l1.php",
  "RCE-LFI-2" => "/practice/fi/l1.php",
  "RCE-LFI-3" => "/practice/fi/l1.php",
  "RCE-LFI-4" => "/practice/fi/l1.php",
  "RCE-LFI-5" => "/practice/fi/l1.php",
  "RCE-LFI-6" => "/practice/fi/l1.php",
  "RCE-LFI-7" => "/practice/fi/l1.php",
  "RCE-LFI-8" => "/practice/fi/l1.php",
  "RCE-RFI-1" => "/practice/fi/l2.php"
    
  
  );


?>


<?php
    $titlename='Dashboard';
	include_once('../../php-inc/header.php');
?>

<h1>解題證明</h1>

<b>2022 年 CyberSecurity Camp 資訊安全營-中階課程</b><br>
帳號：<?php echo $_SESSION["username"] ?><br>


<?php
include_once('../challenges.php');
$num=0;
$ok_num=0;
$no_num=0;
foreach (array_keys($challengeList) as $key) {
    $alink = $challengeList[$key];
    $user_id = $_SESSION["id"];
    if (ChallengeStatus($link,$user_id,$key)=="已答題"){
        $ok_num  = $ok_num +1;
    }else{
        $no_num  = $no_num +1;
    }

    ;
    $num = $num +1;

  }
echo "課程總題數：".$num."<br>已完成題數：".$ok_num."<br>未完成題數：".$no_num;
?>

<br><br>
<b>2022 年 CyberSecurity Camp 資訊安全營-高階課程</b><br>
帳號：<?php echo $_SESSION["username"] ?><br>


<?php
include_once('../challenges.php');
$num=0;
$ok_num=0;
$no_num=0;
foreach (array_keys($challengeTwoList) as $key) {
    $alink = $challengeTwoList[$key];
    $user_id = $_SESSION["id"];
    if (ChallengeStatus($link,$user_id,$key)=="已答題"){
        $ok_num  = $ok_num +1;
    }else{
        $no_num  = $no_num +1;
    }

    ;
    $num = $num +1;

  }
echo "課程總題數：".$num."<br>已完成題數：".$ok_num."<br>未完成題數：".$no_num;
?>



<?php
    $titlename='Dashboard';
	include_once('../../php-inc/footer.php');
?>