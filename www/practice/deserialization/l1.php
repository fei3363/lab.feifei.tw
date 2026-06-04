<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{deserialization_easy_flag}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Insecure-Deserialization-1";
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






<h1>反序列化 </h1>

<h2>lab1</h2>

<pre style='color:#000000;background:#ffffff;'><span style='color:#5f5035;  '></span><span style='color:#000000;  '></span>
<span style='color:#000000;  '></span>
<span style='color:#800000;  font-weight:bold; '>class</span><span style='color:#000000;  '> Logger</span>
<span style='color:#800080;  '>{</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800000;  font-weight:bold; '>public</span><span style='color:#000000;  '> </span><span style='color:#797997;  '>$FileName</span><span style='color:#000000;  '> </span><span style='color:#808030;  '>=</span><span style='color:#000000;  '> </span><span style='color:#0000e6;  '>'error.log'</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800000;  font-weight:bold; '>public</span><span style='color:#000000;  '> </span><span style='color:#800000;  font-weight:bold; '>function</span><span style='color:#000000;  '> </span><span style='color:#400000;  '>__toString</span><span style='color:#808030;  '>(</span><span style='color:#808030;  '>)</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800080;  '>{</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800000;  font-weight:bold; '>return</span><span style='color:#000000;  '> </span><span style='color:#400000;  '>file_get_contents</span><span style='color:#808030;  '>(</span><span style='color:#797997;  '>$</span><span style='color:#800000;  font-weight:bold; '>this</span><span style='color:#808030;  '>-></span><span style='color:#797997;  '>FileName</span><span style='color:#808030;  '>)</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800080;  '>}</span><span style='color:#000000;  '></span>
<span style='color:#800080;  '>}</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '></span>
<span style='color:#800000;  font-weight:bold; '>class</span><span style='color:#000000;  '> Person </span><span style='color:#800080;  '>{</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>	</span><span style='color:#800000;  font-weight:bold; '>public</span><span style='color:#000000;  '> </span><span style='color:#797997;  '>$num</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800000;  font-weight:bold; '>public</span><span style='color:#000000;  '> </span><span style='color:#797997;  '>$name</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span>
<span style='color:#000000;  '>	</span><span style='color:#800000;  font-weight:bold; '>public</span><span style='color:#000000;  '> </span><span style='color:#800000;  font-weight:bold; '>function</span><span style='color:#000000;  '> </span><span style='color:#400000;  '>__construct</span><span style='color:#808030;  '>(</span><span style='color:#797997;  '>$num</span><span style='color:#808030;  '>,</span><span style='color:#797997;  '>$name</span><span style='color:#808030;  '>)</span><span style='color:#800080;  '>{</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>		</span><span style='color:#797997;  '>$</span><span style='color:#800000;  font-weight:bold; '>this</span><span style='color:#808030;  '>-></span><span style='color:#797997;  '>num</span><span style='color:#000000;  '> </span><span style='color:#808030;  '>=</span><span style='color:#000000;  '> </span><span style='color:#797997;  '>$num</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>		</span><span style='color:#797997;  '>$</span><span style='color:#800000;  font-weight:bold; '>this</span><span style='color:#808030;  '>-></span><span style='color:#797997;  '>name</span><span style='color:#000000;  '> </span><span style='color:#808030;  '>=</span><span style='color:#000000;  '> </span><span style='color:#797997;  '>$name</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>	</span><span style='color:#800080;  '>}</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800000;  font-weight:bold; '>public</span><span style='color:#000000;  '> </span><span style='color:#800000;  font-weight:bold; '>function</span><span style='color:#000000;  '> </span><span style='color:#400000;  '>__toString</span><span style='color:#808030;  '>(</span><span style='color:#808030;  '>)</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800080;  '>{</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800000;  font-weight:bold; '>return</span><span style='color:#000000;  '> </span><span style='color:#797997;  '>$</span><span style='color:#800000;  font-weight:bold; '>this</span><span style='color:#808030;  '>-></span><span style='color:#797997;  '>name</span><span style='color:#800080;  '>;</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#800080;  '>}</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '></span>
<span style='color:#800080;  '>}</span><span style='color:#000000;  '></span>
<span style='color:#000000;  '></span>
<span style='color:#5f5035;  '></span>
</pre>


<?php

class Logger
{
    public $FileName = 'error.log';
         
    public function __toString()
    {
        return file_get_contents($this->FileName);
    }
}

class Person {
	public $num;
    public $name;
    
	public function __construct($num,$name){
		$this->num = $num;
		$this->name = $name;
	}
    
    public function __toString()
    {
        return $this->name;
    }

}

$obj = new Person(10,"Leo");
echo serialize($obj);


?>

<form method="GET">
    <div class="form-group">
        <label for="obj">serialize:</label>
        <input type='text' class='form-control' value='<?php echo serialize($obj);?>' id='obj' name='obj'>
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>
<b>flag is in "/etc/.desflag"</b>

<?php
echo "<h3>Unserialize</h3>";
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["obj"])){
    $ready_serialized_object=unserialize($_GET['obj']);
    echo var_dump($ready_serialized_object);
    echo "<br>Name is :";
    echo $ready_serialized_object;
}



?>

<form method="POST">
    <div class="form-group">
        <label for="answer"><br><h4>Flag提交</h4></label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>