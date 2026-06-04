<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{Save_xSs}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Cross-Site-Scripting-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["context"]) &&isset($_POST["title"])){
    include_once("xssconfig.php");
    $param_title =$_POST["title"];
    $param_context =$_POST["context"];
    $param_id =$_SESSION["id"];
    $sql = "INSERT INTO `xss_data` (`id`, `title`, `context`, `user_id`) VALUES (NULL, '$param_title', '$param_context', '$param_id');";
    if($result = mysqli_query($link_xss, $sql)){
        $challenge_array = array('success','成功新增');
    } else{
        $challenge_array = array('alert',$sql);
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

//echo "<script>var flag = 'flag{Save_xSs}';</script>";


//
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
//
?>
<h1>儲存型 XSS </h1>

<h2>lab1</h2>


<?php
include_once("xssconfig.php");
$sql = "SELECT * FROM xss_data";
if($result = mysqli_query($link_xss, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>id</th>";
                    echo "<th>title</th>";
                    echo "<th>context</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                if($row['user_id']==$_SESSION["id"]){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['context'] . "</td>";
                echo "</tr>";
            }
            }
            echo "</tbody>";                            
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link_select);
}






?>






<form method="POST" >
    <div class="form-group">
        <label for="title">輸入標題:</label>
        <input type="text" class="form-control" placeholder="Enter 標題" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="text">輸入內容:</label>
        <input type="text" class="form-control" placeholder="Enter 內容" id="context" name="context">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>







<?php
	include_once('../../php-inc/footer.php');
?>