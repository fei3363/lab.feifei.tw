
<?php


session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("../basic/config.php");


$challengeList = array(


    "Camp-Pre-1" => "/practice/camp/pre.php", 
    "Camp-Pre-2" => "/practice/camp/pre.php",
    "Camp-Pre-3" => "/practice/camp/pre.php",
    "Camp-Pre-4" => "/practice/camp/pre.php",
    "Camp-Pre-5" => "/practice/camp/pre.php",
    "Camp-Pre-6" => "/practice/camp/pre.php",
    
    "Camp-PreWebSec-1" => "/practice/camp/l1.php",
    "Camp-PreWebSec-2" => "/practice/camp/l1.php",
    "Camp-PreWebSec-3" => "/practice/camp/l1.php",
    "Camp-PreWebSec-4" => "/practice/camp/l1.php",
    "Camp-PreWebSec-5" => "/practice/camp/l1.php",
    "Camp-PreWebSec-6" => "/practice/camp/l1.php",
    "Camp-PreWebSec-7" => "/practice/camp/l1.php",
    
    "Camp-PreHTML-1" => "/practice/camp/l2.php",
    "Camp-PreHTML-2" => "/practice/camp/l2.php",
    "Camp-PreHTML-3" => "/practice/camp/l2.php",
    "Camp-PreHTML-4" => "/practice/camp/l2.php",
    "Camp-PreHTML-5" => "/practice/camp/l2.php",
    "Camp-PreHTML-6" => "/practice/camp/l2.php",
    "Camp-PreHTML-7" => "/practice/camp/l2.php",
    
    "Camp-Vul-1" => "/practice/camp/l3.php",
    "Camp-Vul-2" => "/practice/camp/l3.php",
    "Camp-Vul-3" => "/practice/camp/l3.php",
    "Camp-Vul-4" => "/practice/camp/l3.php",


);


?>


<?php
    $titlename='Dashboard';
	include_once('../../php-inc/header.php');
?>

<h1>解題證明</h1>

<b>2022 年 澎湖資安體驗營</b><br>
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





<script>
$(document).ready(function() {
    $('#exam').DataTable();
});
</script>


<?php
    $titlename='Dashboard';
	include_once('../../php-inc/footer.php');
?>