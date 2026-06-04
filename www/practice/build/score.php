
<?php


session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


require_once("../basic/config.php");


$challengeList = array(


    "Build-Pre-1" => "/practice/build/l1.php", 
    "Build-Pre-2" => "/practice/build/l1.php",
    "Build-Pre-3" => "/practice/build/l1.php",
    "Build-Pre-4" => "/practice/build/l1.php",
    "Build-Pre-5" => "/practice/build/l1.php",
    "Build-Pre-6" => "/practice/build/l1.php",
    "Build-Pre-7" => "/practice/build/l1.php",
    "Build-Pre-8" => "/practice/build/l1.php",
    "Build-Pre-9" => "/practice/build/l1.php",
    "Build-Pre-10" => "/practice/build/l1.php",
    "Build-Pre-11" => "/practice/build/l1.php",
    "Build-Pre-12" => "/practice/build/l1.php",
    "Build-Pre-13" => "/practice/build/l1.php",
    "Build-Pre-14" => "/practice/build/l1.php",
    "Build-Pre-15" => "/practice/build/l1.php",
    "Build-Pre-16" => "/practice/build/l1.php",
    "Build-Pre-17" => "/practice/build/l1.php",
    "Build-Pre-18" => "/practice/build/l1.php",
    "Build-Pre-19" => "/practice/build/l1.php",
    "Build-Pre-20" => "/practice/build/l1.php",
    "Build-Pre-21" => "/practice/build/l1.php",
    "Build-Pre-22" => "/practice/build/l1.php",

);


?>


<?php
    $titlename='Dashboard';
	include_once('../../php-inc/header.php');
?>

<h1>解題證明</h1>

<b>2023 年 02/06 台中高工</b><br>
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