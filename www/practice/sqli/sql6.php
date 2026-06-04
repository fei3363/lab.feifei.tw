<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["last_name"]) ){
    $input_last_name = $_POST["last_name"];
    
    // 判別空白
    if($input_last_name !== trim($input_last_name) ||  strpos($input_last_name, ' ') !== false){
        $challenge_array = array('alert','不得使用空白');
    }else{
        // 沒有空白進入 SQL query
        $input_last_name = preg_replace('/\s+/', '', $_POST["last_name"]);
        $sql = "SELECT USERID,FIRST_NAME,LAST_NAME FROM user_data WHERE last_name = '".$input_last_name."'";
        
        include('config.php');
        if($result = mysqli_query($link_select, $sql)){
            if(mysqli_num_rows($result) > 0){
                $result_row = $result;
                $challenge_array = array('success',' SQL query 成功，請根據以下題目作答');
            }
        }else{
            $challenge_array = array('alert',' SQL 語法錯誤');
        }
    // 提交答案
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_salary= $_POST["answer"];
    if($input_salary=="600000"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-bypass-1";
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


<h1>bypass</h1>

<ul>
    <li>黑名單過濾：無法輸入空白</li>
    <li>註解大法<pre class="hljs" style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;"><span class="hljs-built_in" style="color: rgb(147, 92, 37);">UNION</span><span class="hljs-comment" style="color: rgb(90, 123, 140);">/**/</span><span class="hljs-built_in" style="color: rgb(147, 92, 37);">SELECT</span><span class="hljs-comment" style="color: rgb(90, 123, 140);">/**/</span></pre></li>
</ul>



<div>
    <h2>SQL injection</h2>
    <pre class="hljs" style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;">"<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> USERID,FIRST_NAME,LAST_NAME <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">user_data</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> last_name = <span class="hljs-string" style="color: rgb(86, 140, 59);">'".$input_last_name."'</span><span class="hljs-string" style="color: rgb(86, 140, 59);">"
</span></pre>


    <form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="輸入 last name"
                aria-label="送出查詢" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出查詢</button>
            </div>
        </div>
    </form>
</div>
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
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
				echo "<td>" . $row[0] . "</td>";
				echo "<td>" . $row[1] . "</td>";
				echo "<td>" . $row[2] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        // Free result set
        mysqli_free_result($result);


		
	}

?>


<h2>小試身手</h2>
     <li> 請問 Pedro 的 salary
         <ul>
             <li>確認查詢有幾個欄位</li>
             <li>再確認每一個型態</li>
             <li>再找到在哪一個表</li>
             <li>最後找你要的資訊</li>
         </ul>
     </li>
 
    <form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案"
                aria-label="回答問題" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出答案</button>
            </div>
        </div>
    </form>
<?



include('../../php-inc/footer.php')


?>