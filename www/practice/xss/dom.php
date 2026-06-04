<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{D0M_XSS}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Cross-Site-Scripting-3";
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
//
//echo "<script>var flag = 'flag{D0M_XSS}';</script>";
//
//
//
//
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
?>
<script>
function imageSelect(num)
{
    var img = "<img src='img/" + num + ".jpg'  style='width: 100%; display: block' >";
    $("#img-content").html(img);
    window.location.hash = num;
}

$(document).ready(function(){
    imageSelect(self.location.hash.substr(1) || "1");
});
</script>


<h1>DOM XSS </h1>

<h2>lab1</h2>



<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button onclick="imageSelect(1)" class="btn btn-default" id="image-1">1</button>
                <button onclick="imageSelect(2)" class="btn btn-default" id="image-2">2</button>
                <button onclick="imageSelect(3)" class="btn btn-default" id="image-3">3</button>
            </div>
            <div class="panel-body" id="img-content">

            </div>
        </div>
    </div>
</div>








<?php
	include_once('../../php-inc/footer.php');
?>