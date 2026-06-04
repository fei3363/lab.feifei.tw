<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}





if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["last_name"]) ){
    $input_last_name = $_POST["last_name"];
    
    
	

	$sql = "SELECT * FROM user_data WHERE last_name = '".$input_last_name."'";
	
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
	$input_answer= $_POST["answer"];
	if($input_answer=="查詢"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Union-1";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="數量"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Union-2";
        include('../challengesConfig.php');
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="asdFgh"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Union-3";
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


<h1>SQL injection 一些特性</h1>

<ul>
    <li>註解
        <ul>

            <li>
                /* */
            </li>
            <li>-- , #</li>
            <li> SELECT * FROM users WHERE name = 'admin' --AND pass = 'pass'</li>
        </ul>
    </li>
    <li>多行 SQL 語法：
        <ul>
            <li>
                ;</li>
            <li>SELECT * FROM users; DROP TABLE users;</li>
        </ul>
    </li>
    <li>字串
        <ul>
            <style type="text/css">
            .tg {
                border-collapse: collapse;
                border-color: #93a1a1;
                border-spacing: 0;
            }

            .tg td {
                background-color: #fdf6e3;
                border-color: #93a1a1;
                border-style: solid;
                border-width: 1px;
                color: #002b36;
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg th {
                background-color: #657b83;
                border-color: #93a1a1;
                border-style: solid;
                border-width: 1px;
                color: #fdf6e3;
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

            .tg .tg-aldu {
                background-color: #ED7D31;
                border-color: inherit;
                font-weight: bold;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-nmh0 {
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
                        <th class="tg-72pf"> <span style="font-weight:bold;color:white">資料庫軟體</span> </th>
                        <th class="tg-aldu"><span style="font-weight:bold">字串串接</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-nmh0"> <span style="color:black">Oracle</span> </td>
                        <td class="tg-nmh0">'fei' || 'good'</td>
                    </tr>
                    <tr>
                        <td class="tg-3jxr"> <span style="color:black">Microsoft</span></td>
                        <td class="tg-3jxr">'fei' + 'good'</td>
                    </tr>
                    <tr>
                        <td class="tg-nmh0"> <span style="color:black">PostgreSQL</span> </td>
                        <td class="tg-nmh0">'fei' || 'good' </td>
                    </tr>
                    <tr>
                        <td class="tg-3jxr"> <span style="color:black">MySQL</span> </td>
                        <td class="tg-3jxr">'fei' 'good' (中間有空白)<br>CONCAT('fei','good')</td>
                    </tr>
                </tbody>
            </table>
            <li>Char()</li>
            <li>group_concat()</li>
            <li>SELECT * FROM users WHERE name = '+char(27) OR 1=1</li>

        </ul>
    </li>
    <li>UNION SELECT 原則
        <ul>
            <li>用來合併多個查詢結果（取聯集）</li>
            <li>兩個原則(查詢數量一樣、每個欄位的型態一樣)</li>
        </ul>
    </li>
    <li>Join
        <ul>
            <li>合併查詢語句
            </li>
        </ul>

    </li>
    <li>資訊資料庫
        <ul>
            <li>information_schema 存放所有資料庫、資料表、資料欄位</li>
            <li>找資料庫名稱
                <ul>
                    <li>
                        SELECT schema_name FROM information_schema.schemata
                    </li>
                </ul>
            </li>
            <li>資料表名稱
                <ul>
                    <li>
                        SELECT table_name FROM information_schema.tables WHERE table_schema='資料庫名稱'
                    </li>
                </ul>
            </li>
            <li>找欄位名稱
                <ul>
                    <li>SELECT column_name FROM information_schema.columns WHERE table_name='資料表名稱'</li>
                </ul>
            </li>
            <li>找資料
                <ul>
                    <li>SELECT 欄位名稱 FROM 資料庫名稱.資料表名稱</li>
                    <li>如果在同一個資料庫就不用寫資料庫名稱</li>
                </ul>
            </li>



        </ul>
    </li>
</ul>

<h4>練習 Union Select & group_concat()</h4>

<pre class="hljs"
    style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;"><span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-number" style="color: rgb(147, 92, 37);">1</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AS</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">'第一個欄位'</span>,<span class="hljs-number" style="color: rgb(147, 92, 37);">2</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AS</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">'第二個欄位'</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">UNION</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-number" style="color: rgb(147, 92, 37);">3</span>,<span class="hljs-number" style="color: rgb(147, 92, 37);">4</span>;
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">'mEOW'</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AS</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">'第一個欄位'</span>,<span class="hljs-number" style="color: rgb(147, 92, 37);">2</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">AS</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">'第二個欄位'</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">UNION</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">'cAT'</span>,<span class="hljs-number" style="color: rgb(147, 92, 37);">4</span>;
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">group_concat</span>(schema_name) <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> information_schema.schemata;</pre>

<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="query" name="query" type="text" class="form-control" placeholder="請輸入 SQL 查詢語言"
            aria-label="請輸入 SQL 查詢語言" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">送出查詢</button>
        </div>
    </div>
</form>


<?php



if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["query"])  ){
    $input_query = $_POST["query"];
    echo "<li>使用者輸入的 SQL 查詢語言</li>";
    echo "<pre>";
    echo $input_query ;
    echo "</pre><br>";

    $sql=$input_query;
    
    include('config.php'); 
    if($result = mysqli_query($link_select, $sql)){
        echo "<li>查詢結果如下</li><div class='table-responsive'>";
        // $row = mysqli_fetch_array($result);
        // echo build_table($row);
        // $num_count =  count($row);
        $check_first = 0;
        while($row = mysqli_fetch_array($result)){
            
            if($check_first==0){
                echo "<table class='table table-sm table-hover'><tr>";
                foreach($row as $key => $item) {
                    if (is_int($key) == 0){
                        echo "<th>".$key."</th>";
                    }
                }
                $check_first = $check_first +1;
                echo "</tr>";
            }
            $num_count =  count($row);
           
            echo "<tr>";
            for ( $i=0 ; $i<$num_count ; $i++ ) {
                echo "<td>".$row[$i]."</td>";
            }
            echo "</tr>";
            

        }
        echo "</table></div>";
    }else{
        echo "SQL Error";
    }
}

?>




<div>
    <h3>Union SQL injection</h3>
    <form method="POST" name="form" action="">
        <label for="last_name">last_name:</label>
        <input name="last_name" value="">

        <button type="SUBMIT">Submit</button>
    </form>
    <ol>
        <li>參考名字：Carter、Morales、Cagle</li>
        <li>先確認有多少欄位</li>
        <li>再確認每一個型態</li>
        <li>再去找你要的資訊</li>
    </ol>

    <?php
			echo "<h4>查詢結果</h4>";
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
				echo "<td>" . $row[0] . "</td>";
				echo "<td>" . $row[1] . "</td>";
				echo "<td>" . $row[2] . "</td>";
				echo "<td>" . $row[3] . "</td>";
				echo "<td>" . $row[4] . "</td>";
				echo "<td>" . $row[5] . "</td>";
				echo "<td>" . $row[6] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
        


		
	}

?>



    <h2>小試身手</h2>
    <p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
    <p>1. Union Select 被用來合併多個_______(**)</p>
    <p>2. Union Select 要注意原則，查詢的____要一樣，且每個欄位類別要相同。(**)</p>
    <p>3. 請利用 Union Select 找出 Joseph 的 密碼 </p>
    <ul>
        <li>先找到在哪一個表(table)</li>
        <li>找出這張表的欄位</li>
        <li>最後找你要的資料</li>
    </ul>
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