<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}





if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["account"]) && isset($_POST["operator"]) && isset($_POST["injection"]) ){
	$input_account = $_POST["account"];
	$input_operator = $_POST["operator"];
	$input_injection = $_POST["injection"];
	
	$sql = "SELECT * FROM user_data WHERE first_name = 'Everett' AND last_name = '".$input_account." ".$input_operator." ".$input_injection."'";
	
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
	if($input_answer=="字串拼接"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-1";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="條件"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-2";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="空白"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-3";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="500"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-4";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="4556795722831232"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-5";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="diamonds"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-6";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="meat"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-7";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{You_g0t_aDmIn}"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Stirng-8";
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


<h1>SQL injection </h1>
<ul>
    <li>漏洞成因：時常出現在「字串拼接」時</li>
    <li>發生位置
        <ul>
            <li>最常發生 SELECT 查詢中的 WHERE 條件</li>
            <li>
                <style type="text/css">
                .tg {
                    border-collapse: collapse;
                    border-spacing: 0;
                }

                .tg td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    overflow: hidden;
                    padding: 10px 5px;
                    word-break: normal;
                }

                .tg th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 10px 5px;
                    word-break: normal;
                }

                .tg .tg-zi4g {
                    background-color: #F8D7CD;
                    text-align: center;
                    vertical-align: top
                }

                .tg .tg-tl7g {
                    background-color: #ED7D31;
                    text-align: center;
                    vertical-align: top
                }

                .tg .tg-s71k {
                    background-color: #FCECE8;
                    text-align: center;
                    vertical-align: top
                }
                </style>
                <table class="tg">
                    <thead>
                        <tr>
                            <th class="tg-tl7g"><span style="font-weight:bold;color:white">語法</span>&nbsp;&nbsp;&nbsp;
                            </th>
                            <th class="tg-tl7g"><span style="font-weight:bold;color:white">地方</span>&nbsp;&nbsp;&nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tg-zi4g"><span style="color:black">UPDATE</span>&nbsp;&nbsp;&nbsp;</td>
                            <td class="tg-zi4g"><span style="color:black">更新值或是 WHERE
                                    子句中</span>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tg-s71k"><span style="color:black">INSERT</span>&nbsp;&nbsp;&nbsp;</td>
                            <td class="tg-s71k"><span style="color:black">插入新的值</span>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tg-zi4g"><span style="color:black">SELECT</span>&nbsp;&nbsp;&nbsp;</td>
                            <td class="tg-zi4g"><span style="color:black">在 table 名稱或
                                    column&nbsp;&nbsp;&nbsp;名稱</span>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tg-s71k"><span style="color:black">SELECT</span>&nbsp;&nbsp;&nbsp;</td>
                            <td class="tg-s71k"><span style="color:black">在 ORDER BY
                                    子句中</span>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ul>
    </li>
    <li>漏洞影響：
        <ul>
            <li>繞過登入驗證</li>
            <li>繞過程式邏輯</li>
            <li>查詢、刪除、修改資料庫的資料</li>
            <li>進階：讀檔(/etc/passwd)、寫檔(webshell)、執行指令(RCE)</li>
        </ul>
    </li>
    <li>類型
        <ul>
            <li>字串型：WHERE 條件中有單引號(表示字串)進行查詢</li>
            <li>數字型：WHERE 條件中無單引號(表示數字或布林)進行查詢</li>
        </ul>
    </li>
    <li>註解
        <ul>
            <li>
                <style type="text/css">
                .tg {
                    border-collapse: collapse;
                    border-spacing: 0;
                }

                .tg td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    overflow: hidden;
                    padding: 10px 5px;
                    word-break: normal;
                }

                .tg th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 10px 5px;
                    word-break: normal;
                }

                .tg .tg-72pf {
                    background-color: #ED7D31;
                    border-color: inherit;
                    text-align: center;
                    vertical-align: top
                }

                .tg .tg-sr87 {
                    background-color: #F8D7CD;
                    border-color: inherit;
                    text-align: center;
                    vertical-align: top
                }

                .tg .tg-3jxr {
                    background-color: #FCECE8;
                    border-color: inherit;
                    text-align: center;
                    vertical-align: top
                }
                </style>
                <table class="tg">
                    <thead>
                        <tr>
                            <th class="tg-72pf"><span
                                    style="font-weight:bold;color:white">資料庫軟體</span>&nbsp;&nbsp;&nbsp;</th>
                            <th class="tg-72pf"><span style="font-weight:bold;color:white">註解方法</span>&nbsp;&nbsp;&nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tg-sr87"> <span style="color:black">Oracle</span> </td>
                            <td class="tg-sr87"><span style="color:black">--comment</span> </td>
                        </tr>
                        <tr>
                            <td class="tg-3jxr"> <span style="color:black">Microsoft</span></td>
                            <td class="tg-3jxr"> <span style="color:black">--comment</span><br> <span
                                    style="color:black">/*comment*/</span> </td>
                        </tr>
                        <tr>
                            <td class="tg-sr87"> <span style="color:black">PostgreSQL</span> </td>
                            <td class="tg-sr87"><span style="color:black">--comment</span><br> <span
                                    style="color:black">/*comment*/</span> </td>
                        </tr>
                        <tr>
                            <td class="tg-3jxr"> <span style="color:black">MySQL</span> </td>
                            <td class="tg-3jxr"> <span style="color:black">#comment</span><br> <span
                                    style="color:black">--
                                    comment [</span><span style="color:#000">注意</span><span style="color:black">有空白 ]
                                </span><br><span style="color:black">/*comment*/</span> </td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ul>
    <li>
        順序
        <ul>
            <li> and > or</li>
            <li> or 會把左右兩邊當作條件</li>
        </ul>
    </li>
    <li>起手式
        <ol>
            <li>觀察輸入點， GET、POST、Cookie 等參數</li>
            <li>會透過一些特殊符號來確認後端的邏輯
                <ul>
                    <li>空</li>
                    <li>'</li>
                    <li>"</li>
                    <li>`</li>
                    <li>')</li>
                    <li>")</li>
                    <li>`)</li>
                    <li>'))</li>
                    <li>"))</li>
                    <li>`))</li>
                </ul>
            </li>
            <li>當看到 500 error 有機會有弱點</li>
        </ol>
    </li>
    </li>
</ul>





<br><br>
<h3>練習查看 SQL 語法</h3>
<label for="username-preview">Username:</label>
<input id="preview-input" type="text" name="username" val="">
<div class="listingblock">
    <div class="content">
        <pre class="hljs"
            style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;">"<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> * <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">user_data</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> first_name = <span class="hljs-string" style="color: rgb(86, 140, 59);">'Everett'</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AND</span> last_name = <span class="hljs-string" style="color: rgb(86, 140, 59);">'</span><span id="input-preview" style="font-weight: bold;color: rgb(86, 140, 59);"></span>'";</pre>
    </div>
</div>
<script>
$(document).ready(() => {
    $("#preview-input").on("keyup", (e) => {
        $("#input-preview").text(e.target.value);
    });
});
</script>

<h3>字串型 SQL injection(String SQL injection)</h3>
<form class="attack-form" method="POST" name="form" action="">
    <table>
        <tbody>
            <tr>
                <td>SELECT * FROM user_data WHERE first_name = 'Everett' AND last_name = '</td>
                <td><select name="account">
                        <option>Hale</option>
                        <option>'Hale</option>
                        <option>'</option>
                        <option>'Hale'</option>
                        <option>Hale'</option>
                    </select></td>
                <td>
                    <select name="operator">
                        <option>or</option>
                        <option>and</option>
                        <option>and not</option>
                    </select>
                </td>
                <td>
                    <select name="injection">
                        <option>1 = 1</option>
                        <option>1 = 2</option>
                        <option>1' = '2</option>
                        <option>'1' = '1</option>
                        <option>'1' = '2</option>
                        <option>Last_Name = 'Hale</option>
                    </select>
                </td>
                <td>'</td>
                <td><input name="Get Account Info" value="送出" type="SUBMIT"></td>
            </tr>
        </tbody>
    </table>
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
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        // Free result set
		mysqli_free_result($result);


		
	}

?>


<br>
<h3>繞過程式邏輯</h3>
<p>1. 取得尚未 released 的禮物名稱</p>
<p>2. 除了禮物之外的類別是哪一個</p>
<a href="released.php?category=Gifts">商品連結</a>

<br>
<h3>繞過登入驗證邏輯</h3>
<p>請嘗試登入，不需要密碼</p>
<a href="https://lab.feifei.tw/account/login.php">登入連結</a>





<p>&nbsp;</p>
<h2>小試身手</h2>
<p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. SQL injection 時常出現在「____」的時候 (****)</p>
<p>2. WHERE 在 SQL 查詢語言代表指定____什麼(**)</p>
<p>3. 在 MySQL 中如果要使用 -- 當作註解要記得後面要加上____(**)</p>
<p>4. 測試過程中看到狀態碼 ____ 有機會有 SQL injection(***)</p>
<p>5. [字串型] 請問 Katharine 的 VISA 信用卡卡號為多少</p>
<p>6. [繞過程式邏輯] 取得尚未 released 的禮物名稱</p>
<p>7. [繞過程式邏輯] 除了禮物之外的類別是哪一個</p>
<p>8. [繞過登入驗證邏輯] 嘗試登入後，取得 index.php 上的 flag</p>

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