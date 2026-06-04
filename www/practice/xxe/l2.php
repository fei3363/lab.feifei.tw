<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{xxe_easy_flag}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "XML-External-Entities-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }

}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"]))
{
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];
    if($input_username=="S0meUs1rn@m1" && $input_password=="p@5S_w0rd"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SenSitive-Data-Exposure-2";
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
    $titlename='XXE';
	include_once('../../php-inc/header.php');
?>




<h1>XXE</h1>


<form enctype="multipart/form-data"  method="post">
<textarea name="xxe" required rows="6" cols="40"></textarea>
<input type="submit" name="submit" value="submit" />
</table>
</form>
<hr>
<h3>解析內容</h3>
<?php 


//Make sure that this is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    //If it isn't, send back a 405 Method Not Allowed header.
    header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
    exit;
}


//Get the raw POST data from PHP's input stream.
//This raw data should contain XML.
//$postData = trim(file_get_contents('php://input'));
$postData = trim($_POST['xxe']);


//Use internal errors for better error handling.
libxml_use_internal_errors(true);


//Parse the POST data as XML.
$xml = simplexml_load_string($postData);


//If the XML could not be parsed properly.
if($xml === false) {
    //Send a 400 Bad Request error.
    header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request", true, 400);
    //Print out details about the error and kill the script.
    foreach(libxml_get_errors() as $xmlError) {
        echo $xmlError->message . "\n";
    }
    exit;
}





//var_dump the structure, which will be a SimpleXMLElement object.
var_dump($xml);

// if(isset($_POST['xxe']))
// {
// 	libxml_disable_entity_loader (false);
// 	$dom = new DOMDocument();
//     $dom->loadXML($_POST['xxe'], LIBXML_NOENT | LIBXML_DTDLOAD);
//     $creds = simplexml_import_dom($dom);
//     echo " $creds";

// }



?>








<?php
	include_once('../../php-inc/footer.php');
?>