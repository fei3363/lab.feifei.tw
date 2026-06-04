<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}





if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Login_Count"]) && isset($_POST["User_Id"])  ){
	$input_login_count = $_POST["Login_Count"]; //正則表達 
	$input_user_id = $_POST["User_Id"];
	

	$sql = "SELECT * FROM user_data WHERE login_count = ".$input_login_count." AND userid = ".$input_user_id.";";
	
	include('config.php');
	if($result = mysqli_query($link_select, $sql)){
		if(mysqli_num_rows($result) > 0){
			$result_row = $result;
			$challenge_array = array('success',' SQL query 成功，請根據以下題目作答');
		}
    }else{
		$challenge_array = array('alert',' SQL 語法錯誤');
    
    }

}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
	$input_answer = preg_replace('/\s+/', '', $_POST["answer"]);
	if($input_answer=="數學運算"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Numeric-1";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="4916479384692027"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Numeric-2";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Cagle"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Numeric-3";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="6"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Numeric-4";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert',' 答案錯誤');
    
    }
	
}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];



?>

<?php
    $titlename='SQL 語法練習';
	include_once('../../php-inc/header.php');
?>


<h1>Numeric SQL injection</h1>

<ul>
    <li>數字型：WHERE 條件中無單引號(表示數字或布林)進行查詢</li>
    <li>起手式
        <ol>
            <li>觀察輸入點， GET、POST、Cookie 等參數</li>
            <li>會透過一些「數學運算」來確認後端的邏輯
                <ul>
                    <li>true</li>
                    <li>1</li>
                    <li>1&gt;0</li>
                    <li>2-1</li>
                    <li>0+1</li>
                    <li>1*1</li>
                    <li>1%2</li>
                    <li>1 &amp; 1</li>
                    <li>1&amp;1</li>
                    <li>1 &amp;&amp; 2</li>
                    <li>1&amp;&amp;2</li>
                </ul>
            </li>
            <li>當看到
                <ul>
                    <li>id=2 跟 id=1+1 的顯示結果一樣&nbsp;</li>
                    <li>500 error</li>
                    <li>有機會有弱點</li>
                </ul>
            </li>
        </ol>
    </li>
</ul>



<h3>練習查看 SQL 語法</h3>
<label for="login_count">login_count:</label>
<input id="login-count-preview-input" type="text" name="login_count" val=""><br>
<label for="userid">userid:</label>
<input id="user-id-preview-input" type="text" name="userid" val="">
<div class="listingblock">
    <div class="content">
        <pre class="hljs"
            style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;">"<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> * <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">user_data</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> login_count =  <span id="input-login-count-preview" style="font-weight: bold;color: rgb(147, 92, 37);"></span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AND</span> userid = <span id="input-user-id-preview" style="font-weight: bold;color: rgb(147, 92, 37);"></span> ;"</pre>
    </div>
</div>
<script>
$(document).ready(() => {
    $("#login-count-preview-input").on("keyup", (e) => {
        $("#input-login-count-preview").text(e.target.value);
    });
    $("#user-id-preview-input").on("keyup", (e) => {
        $("#input-user-id-preview").text(e.target.value);
    });
});
</script>


<h3>Numeric SQL injection</h3>
<pre class="hljs"
    style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;">"<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> * <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">user_data</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> login_count = <span class="hljs-string" style="color: rgb(86, 140, 59);">" + Login_Count + "</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AND</span> userid = <span class="hljs-string" style="color: rgb(86, 140, 59);">" + User_ID;"</span></pre>
<form method="POST" name="form" action="">
    <label for="Login_Count">login_count:</label>
    <input name="Login_Count" value="">
    <label for="User_Id">userid:</label>
    <input name="User_Id" value="">
    <button type="SUBMIT">Submit</button>
</form>



<?php
			echo "<p>輸入 SQL 指令：";
			echo $sql;
			echo "</p>";
			if($result_row){
			echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>USERID</th>";
                    echo "<th>FIRST_NAME</th>";
                    echo "<th>LAST_NAME</th>";
                    echo "<th>CC_NUMBER</th>";
                    echo "<th>CC_TYPE</th>";
                    echo "<th>COOKIE</th>";
                    echo "<th>LOGIN_COUNT</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
				echo "<td>" . $row['USERID'] . "</td>";
				echo "<td>" . $row['FIRST_NAME'] . "</td>";
				echo "<td>" . $row['LAST_NAME'] . "</td>";
				echo "<td>" . $row['CC_NUMBER'] . "</td>";
				echo "<td>" . $row['CC_TYPE'] . "</td>";
				echo "<td>" . $row['COOKIE'] . "</td>";
				echo "<td>" . $row['LOGIN_COUNT'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        // Free result set
		mysqli_free_result($result);


		
	}

?>



<p>&nbsp;</p>
<h2>小試身手</h2>
<p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. 如果是數字型的 SQL injection 會透過「****」來確認後端的邏輯</p>
<p>2. 找出登入次數為 4 的 卡號&nbsp;</p>
<p>3. 嘗試 1+1 -- # 誰是登入次數為兩次的人 的 LAST_NAME (*****)</p>
<p>4. 請嘗試找出 Joseph 的 登入次數</p>
<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form>







<?



include('../../php-inc/footer.php')


?>