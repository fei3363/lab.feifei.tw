<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}





if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"]) ){
    $input_answer = $_POST["answer"];
    include('../challengesConfig.php');
    include_once('../challenges.php');
    if($input_answer=="SQL"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-1";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="所有欄位"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-2";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="4"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-3";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="5.7.13"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-4";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="information_schema"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-5";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Marketing"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-6";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="myDb"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-7";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Pedro"){
        $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Basic-8";
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert',' 答案錯誤');
    
    }
    $challenge_type =  $challenge_array[0];
    $challenge_messange =  $challenge_array[1];
}



?>

<?php
    $titlename='SQL 語法練習';
	include_once('../../php-inc/header.php');
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js"></script>
<h1>SQL Basic</h1>
<p>結構化查詢語言(Structured Query Language)，用來存取關聯式資料庫的內部結構與資料。</p>
<p>資料會儲存在資料表中，每一列代表一筆紀錄，可利用 SQL 語句跟資料庫作互動</p>
互動模式：
<ul>
    <li>INSERT：插入新紀錄</li>
    <li>SELECT：查詢紀錄</li>
    <li>UPDATE：更新紀錄</li>
    <li>DELETE：刪除紀錄</li>
</ul>
簡單架構：
<ul>

    <li>資料庫名稱 > 資料表名稱 > 資料欄位名稱 > 資料</li>
    <li>Database > Table > Column > Data</li>

</ul>
SQL 語法：

<pre class="hljs"
    style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;"><span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 新增資料庫</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">CREATE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">DATABASE</span> myTestDb;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 刪除資料庫</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">DROP</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">DATABASE</span> myTestDb;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 在資料庫 myDb 新增資料表 employees</span>
<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 五個欄位</span>
<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- AUTO_INCREMENT : 自動累加</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">CREATE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">TABLE</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`employees`</span> (
    <span class="hljs-string" style="color: rgb(86, 140, 59);">`id`</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">INT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span> PRIMARY <span class="hljs-keyword" style="color: rgb(107, 107, 184);">KEY</span> AUTO_INCREMENT,
    <span class="hljs-string" style="color: rgb(86, 140, 59);">`name`</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">VARCHAR</span>(<span class="hljs-number" style="color: rgb(147, 92, 37);">100</span>) <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span>,
    <span class="hljs-string" style="color: rgb(86, 140, 59);">`department`</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">VARCHAR</span>(<span class="hljs-number" style="color: rgb(147, 92, 37);">100</span>) <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span>,
    <span class="hljs-string" style="color: rgb(86, 140, 59);">`address`</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">VARCHAR</span>(<span class="hljs-number" style="color: rgb(147, 92, 37);">255</span>) <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span>,
    <span class="hljs-string" style="color: rgb(86, 140, 59);">`salary`</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">INT</span>(<span class="hljs-number" style="color: rgb(147, 92, 37);">10</span>) <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span>
);

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 新增資料表</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">CREATE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">TABLE</span> myDb.test (
 <span class="hljs-keyword" style="color: rgb(107, 107, 184);">id</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">INT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span> PRIMARY <span class="hljs-keyword" style="color: rgb(107, 107, 184);">KEY</span> AUTO_INCREMENT,
 <span class="hljs-keyword" style="color: rgb(107, 107, 184);">name</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">VARCHAR</span>(<span class="hljs-number" style="color: rgb(147, 92, 37);">100</span>) <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span>
);

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 新增欄位</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">ALTER</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">TABLE</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span> 
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">ADD</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`new_col`</span> <span class="hljs-built_in" style="color: rgb(147, 92, 37);">INT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">NOT</span> <span class="hljs-literal" style="color: rgb(147, 92, 37);">NULL</span> 
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">AFTER</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`name`</span>;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 修改欄位類型</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">ALTER</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">TABLE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">test</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">MODIFY</span> new_col <span class="hljs-built_in" style="color: rgb(147, 92, 37);">VARCHAR</span>(<span class="hljs-number" style="color: rgb(147, 92, 37);">9</span>);

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 刪除欄位</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">ALTER</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">TABLE</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">DROP</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">COLUMN</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`new_col`</span>;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 新增資料</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">INSERT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">INTO</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span> (<span class="hljs-string" style="color: rgb(86, 140, 59);">`id`</span>, <span class="hljs-string" style="color: rgb(86, 140, 59);">`name`</span>)
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">VALUES</span>
(<span class="hljs-number" style="color: rgb(147, 92, 37);">1</span>, <span class="hljs-string" style="color: rgb(86, 140, 59);">'Fei'</span>),
(<span class="hljs-number" style="color: rgb(147, 92, 37);">2</span>, <span class="hljs-string" style="color: rgb(86, 140, 59);">'Jeff'</span>);

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 查詢資料 * 所有欄位</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> * <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span>;
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">id</span>, <span class="hljs-keyword" style="color: rgb(107, 107, 184);">name</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span>;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 下條件</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">id</span>, <span class="hljs-keyword" style="color: rgb(107, 107, 184);">name</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">id</span> =<span class="hljs-number" style="color: rgb(147, 92, 37);">1</span>;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 更新資料</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">UPDATE</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span> 
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">SET</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">name</span>=<span class="hljs-string" style="color: rgb(86, 140, 59);">'Jay'</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">name</span>=<span class="hljs-string" style="color: rgb(86, 140, 59);">'Jeff'</span>;

<span class="hljs-comment" style="color: rgb(90, 123, 140);">-- 刪除資料</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">DELETE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-string" style="color: rgb(86, 140, 59);">`myDb`</span>.<span class="hljs-string" style="color: rgb(86, 140, 59);">`test`</span>
<span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">id</span> = <span class="hljs-number" style="color: rgb(147, 92, 37);">2</span>;</pre>

SQL 基礎語法練習：
<ul>
    <li>資料表名稱: employees</li>
    <li>資料欄位: id, name, department, address, salary </li>
    <li>目前資料庫內容如下 </li>
</ul>

<?php
$sql = "SELECT id,name,address,salary FROM employees";

include('config.php');
if($result = mysqli_query($link_select, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Address</th>";
                    echo "<th>Salary</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['salary'] . "</td>";
                echo "</tr>";
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

<li>請利用以下的輸入框輸入 SQL 語法查詢指定的欄位</li>
<li>參考範例如下</li>
<pre>
SELECT id, name, department, address, salary FROM employees;
</pre>


<form method="POST" name="form" action="">
    <div class="form-group">
        <label for="query">SQL Query</label>
        <input type="text" class="form-control" id="query" name="query" aria-describedby="SQLqueryHelp"
            placeholder="請輸入 SQL 查詢語言">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php

echo "<li>查詢結果如下</li>";



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

<br>
<p><span style="font-weight: 400;">MySQL Functions</span></p>
<ul>
    <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">user() / current_user()</span></li>
    <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">version()</span></li>
    <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">database() / schema()</span></li>
    <ul>
        <li style="font-weight: 400;" aria-level="2"><span style="font-weight: 400;">current database</span></li>
    </ul>
    <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">&hellip;&hellip;&nbsp;</span></li>
</ul>
<a href="https://www.w3schools.com/mysql/mysql_ref_functions.asp">參考資料</a><br>



<h3>MySQL 資訊資料庫</h3>
<p>information_schema 存放所有資料庫、資料表、資料欄位</p>
SELECT schema_name FROM information_schema.schemata <br>
會找到資料庫名稱的列表 在 information_schema.schemata 找到 schema_name <br>
<br>
SELECT table_name FROM information_schema.tables WHERE table_schema='資料庫名稱' <br>
會找到資料表名稱的列表在 information_schema.tables 中的 table_schema 找到 table_name <br>
<br>
SELECT column_name FROM information_schema.columns WHERE table_name='資料表名稱' <br>
會找到欄位名稱的列表在 information_schema.columns 中的 table_name 找到 column_name <br>
<br>
SELECT 欄位名稱 FROM 資料庫名稱.資料表名稱 <br>
會找到資料列表 ，如果在同一個資料庫就不用寫資料庫名稱<br>
<br>


<h2>小試身手</h2>
<p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
<p>1. 想跟資料庫進行互動可以透過___(***)</p>
<p>2. SELECT * FROM users 中 * 代表什麼意思(****)</p>
<p>3. SELECT id,name,address,salary FROM employees 查詢了幾個欄位(*)</p>
<p>4. 目前資料庫的版本為何 ____&nbsp;</p>
<p>5. MySQL 中有一個資料庫，存放所有資料庫、資料表、資料欄位，請問這個資料庫的名稱為何(******************)</p>
<p>6. [練習語法] 請找出 Bob 的 department</p>
<p>7. [使用 SQL function] 目前 employees 在哪一個資料庫</p>
<p>8. [跨表查詢] 在某一張表中，有欄位 password 為 123four56 的使用者是誰</p>
<p style="padding-left: 40px;">a.先透過資訊資料庫找出其他表</p>
<p style="padding-left: 40px;">b.查看表的欄位</p>
<p style="padding-left: 40px;">c.找到指定的使用者</p>
<form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form>



<?php

include('../../php-inc/footer.php')


?>