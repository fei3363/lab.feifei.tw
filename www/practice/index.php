<?php


session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("basic/config.php");


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
  
  "Cryptography-1-hash" => "/practice/basic/l5.php",

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



  // 'Warm-1' => '/practice/warm/l1.php',
  // 'Warm-2' => '/practice/warm/l1.php',
  // 'Warm-3' => '/practice/warm/l1.php',

  // 'Linux-1' => '/practice/linux/l1.php',
  // 'Linux-2' => '/practice/linux/l1.php',
  // 'Linux-3' => '/practice/linux/l1.php',
  // 'Linux-4' => '/practice/linux/l1.php',
  // 'Linux-5' => '/practice/linux/l1.php',
  // 'Linux-6' => '/practice/linux/l1.php',
  // 'Linux-7' => '/practice/linux/l1.php',
  // 'Linux-8' => '/practice/linux/l1.php',
  // 'Linux-9' => '/practice/linux/l1.php',
  // 'Linux-10' => '/practice/linux/l1.php',
  // 'Linux-11' => '/practice/linux/l1.php',
  // 'Linux-12' => '/practice/linux/l1.php',

  // 'Linux-pre-1' => '/practice/linux/pre.php',
  // 'Linux-pre-2' => '/practice/linux/pre.php',
  // 'Linux-pre-3' => '/practice/linux/pre.php',
  // 'Linux-pre-4' => '/practice/linux/pre.php',
  // 'Linux-pre-5' => '/practice/linux/pre.php',
  // 'Linux-pre-6' => '/practice/linux/pre.php',



    // 'DNS-1' => '/practice/basic/ns.php',
    // 'HTTP-1' => '/practice/basic/l1.php',
    // 'HTTP-json' => '/practice/basic/l1.php',
    // 'HTTP-2' => '/practice/basic/l2.php',

    // 'Curl-1' => '/practice/basic/curl.php',
    // 'Curl-2' => '/practice/basic/curl.php',
    // 'Curl-3' => '/practice/basic/curl.php',
    // 'Curl-4' => '/practice/basic/curl.php',

    // 'Curl-5' => '/practice/basic/curl.php',
    // 'Developer-Tool-1-token' => '/practice/basic/l3.php',
    // 'Developer-Tool-2-number' => '/practice/basic/l3.php',

    // 'Encoding-1-base64' => '/practice/basic/l4.php',
    // 'Encoding-2-rot13' => '/practice/basic/l4.php',
    // 'Cryptography-1-hash' => '/practice/basic/l5.php',

    // 'ci-1' => '/practice/ci/l1.php',
    // 'Broken-Access-Control-4' => '/practice/access/l3.php',

    // 'OSINT-Tool-1' => '/practice/osint/l1.php',
    // 'OSINT-Tool-2' => '/practice/osint/l1.php',
    // 'OSINT-Tool-3' => '/practice/osint/l1.php',
    // 'Broken-Authentication-1' => '/practice/auth/l1.php',
    // 'Broken-Authentication-2' => '/practice/auth/l1.php',
    // 'Broken-Authentication-3' => '/practice/auth/l1.php',
    // 'Broken-Authentication-4' => '/practice/auth/l2.php',
    // 'Broken-Access-Control-1' => '/practice/access/l1.php',
    // 'Broken-Access-Control-2' => '/practice/access/l1.php',
    // 'Broken-Access-Control-3' => '/practice/access/l2.php',
    // 'Broken-Access-Control-4' => '/practice/access/l3.php',
    // 'Request-Forgeries-1' => '/practice/rf/l1.php',

    // 'SQL-Injection-1' => '/practice/sqli/sql1.php',
    // 'SQL-Injection-1.1' => '/practice/sqli/sql1.php',
    // 'SQL-Injection-1.2' => '/practice/sqli/sql1.php',
    // 'SQL-Injection-2' => '/practice/sqli/sql2.php',
    // 'SQL-Injection-3' => '/practice/sqli/sql3.php',
    // 'SQL-Injection-4' => '/practice/sqli/sql4.php',
    // 'SQL-Injection-5' => '/practice/sqli/sql5.php',
    // 'SQL-Injection-6' => '/practice/sqli/sql6.php',

    // 'SenSitive-Data-Exposure-1' => '/practice/sensitive/l1.php',
    // 'SenSitive-Data-Exposure-2' => '/practice/sensitive/l1.php',
    // 'XML-External-Entities-1' => '/practice/xxe/l1.php',

    // 'Cross-Site-Scripting-1' => '/practice/xss/l1.php',
    // 'Cross-Site-Scripting-2' => '/practice/xss/l2.php',
    // 'Cross-Site-Scripting-3' => '/practice/xss/l3.php',
    // 'Insecure-Deserialization-1' => '/practice/deserialization/l1.php',
    // 'Vulnerable-Components-1' => '/practice/vc/l1.php',
);





?>


<?php
    $titlename='Dashboard';
	include_once('../php-inc/header.php');
?>

<?php
if($_SESSION["username"]=="admin"){
  echo 'Hi admin<br> Your Flag is flag{You_g0t_aDmIn}<br>';
}
?>
<h1>題目狀況</h1>

<table class="table" id="exam">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">題目名稱</th>
            <th scope="col">是否解題</th>
        </tr>
    </thead>
    <tbody>

        <?php
include_once('challenges.php');
$num=1;
foreach (array_keys($challengeList) as $key) {
    $alink = $challengeList[$key];
    $user_id = $_SESSION["id"];
    echo '<tr>';
    echo '<th scope="row">'.$num.'</th>';
    echo '<td><a href="'.$alink.'">'.$key.'</a></td>';
    echo '<td>'.ChallengeStatus($link,$user_id,$key).'</td>';
    $num = $num +1;

  }

?>

    </tbody>
</table>


<a href="https://lab.feifei.tw/practice/proof/SecurityCamp2022.php">2022 年 CyberSecurity Camp 資訊安全營學員解題證明</a>



<script>
$(document).ready(function() {
    $('#exam').DataTable();
});
</script>

<?php
    $titlename='Dashboard';
	include_once('../php-inc/footer.php');
?>