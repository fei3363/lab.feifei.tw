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
    $titlename='XSS-1';
	include_once('../../php-inc/header.php');
?>

<?php

// echo "<script>var flag = 'flag{ReflecTed_xSs}';</script>";



//<script>
//var theOriginalAlert = alert;
//window.alert = function(msg) {
//    if (typeof flag != 'undefined' && msg == 'flag') {
//        theOriginalAlert(flag);
//    } else if (typeof flag == 'undefined') {
//        theOriginalAlert(msg);
//    } else {
//        theOriginalAlert('請 alert("flag") 才有 flag');
//    }
//};
//</script> 

?>
<h1>反射型 XSS </h1>

<h2>lab1</h2>







<form method="GET" class="form-inline">
    <div class="form-group">
        <label for="text">搜尋商品名稱:</label>
        <input type="text" class="form-control" placeholder="輸入商品名稱" id="text" name="text">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php echo $_GET['text']  ?>




<?php
	include_once('../../php-inc/footer.php');
?>