<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{Vulnerable_Components}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Vulnerable-Components-1";
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
    $titlename='Vulnerable Components';
	include_once('../../php-inc/header.php');
?>

<?php

echo "<script>var flag = 'flag{Vulnerable_Components}';</script>";

?>

<script>
var theOriginalAlert = alert;
window.alert = function(msg) {
    if (typeof flag != 'undefined' && msg == 'flag') {
        theOriginalAlert(flag);
    } else if (typeof flag == 'undefined') {
        theOriginalAlert(msg);
    } else {
        theOriginalAlert('請 alert("flag") 才有 flag');
    }
};
</script>


<h1>VulnerableComponents </h1>

<h2>lab1</h2>



  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script>
		function clink() {

			$( "#dialog" ).dialog({
				closeText: $('#closetext').val(), 
			});
        };
    </script>
</head>
<body>
<input id="closetext" value="OK<script>alert('XSS')</script>" type="TEXT"><input name="SUBMIT" value="Go!" type="SUBMIT" onclick="clink()">


<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-draggable ui-resizable" tabindex="-1" role="dialog" style="position: absolute; height: auto; width: 300px; top: 238px; left: 402px; display: none;" aria-describedby="dialog" aria-labelledby="ui-id-1"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">jquery-ui-1.10.4</span><button class="ui-button ui-widget ui-state-default ui-corner-all ui-dialog-titlebar-close ui-button-icon-only" role="button" aria-disabled="false" title=""><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text"></span></button></div><div id="dialog" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 88px; max-height: none; height: auto;">This dialog should have exploited a known flaw in jquery-ui:1.10.4 and allowed a XSS attack to occur</div><div class="ui-resizable-handle ui-resizable-n" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-w" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-sw" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-ne" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-nw" style="z-index: 90;"></div></div>


<form method="POST">
    <div class="form-group">
        <label for="answer">Flag:</label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>



<?php
	include_once('../../php-inc/footer.php');
?>