<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{ReflecTed_xSs}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Cross-Site-Scripting-1";
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
    $titlename='CodeIgniter';
	include_once('../../php-inc/header.php');
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="./">SSDLC</a></li>
    <li class="breadcrumb-item active">CodeIgniter 安全</li>
</ol>

<h1>CodeIgniter 安全</h1>
<br>

<h2>XSS</h2>
<br>
<code>
    $data = $this->security->xss_clean($data);
</code>
<br>
<br>

<h2>SQL Injection</h2>
<br>
<h3>escape</h3>
<code>
   $username = $this->input->post('username');<br>
   $query = 'SELECT * FROM subscribers_tbl WHERE user_name = '.
      $this->db->escape($username);<br>
   $this->db->query($query);<br>
</code><br>


<h3>escape</h3>
<code>
$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";<br>
$this->db->query($sql, array(3, 'live', 'Rick'));
</code><br>
<br>

<h3>escape</h3>
<code>
$this->db->get_where('subscribers_tbl',array('status'=> active','email' => 'info@arjun.net.in'));
</code><br>
<br>

<h2>錯誤訊息</h2>
<br>
<h3>隱藏錯誤訊息</h3>
/index.php<br>
error_reporting()<br>
<br>


<h3>資料庫錯誤訊息</h3>
application/config/database.php<br>
<code>$db['default']['db_debug'] = FALSE;</code><br>
<br>

<h3>錯誤輸出到日誌文件</h3>
application/cofig/config.php<br>
<code>$config['log_threshold'] = 1;</code><br>
<br>

<h2>CSRF 預防</h2>
application/cofig/config.php<br>
<code>$config['csrf_protection'] = TRUE;</code><br>
插入表單的時候會自動插入 csrf token <br>
<br>

<h2>密碼處理</h2>
<ul>
<li>不要以純文字格式儲存密碼。</li>
<li>始終對密碼進行 hash 處理。</li>
<li>不要使用 Base64 或類似的編碼來儲存密碼。</li>
<li>不要使用弱或損壞的雜湊演算法，如 MD5 或 SHA1。只使用強大的密碼雜湊演算法，，如 BCrypt，它用於 PHP 自己的密碼雜湊函數。</li>
<li>切勿以純文字格式顯示或發送密碼。</li>
<li>不要對您的用戶密碼設定不必要的限制。</li>
</ul>



<?php
	include_once('../../php-inc/footer.php');
?>