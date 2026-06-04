<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config2.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="SQL injection"){
        $challenges_name = "Camp-Vul-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="XSS"){
        $challenges_name = "Camp-Vul-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="越權"){
        $challenges_name = "Camp-Vul-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="flag{brother_have_luckey_money}"){
        $challenges_name = "Camp-Vul-4";
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
    $titlename='漏洞基礎';
	include_once('../../php-inc/header.php');
?>


<h1>漏洞基礎</h1>

<?php
$sqltmp = "SELECT money,date,reason FROM moneypig where who ='sister'";
$sql2 ="SELECT SUM(money) FROM myDb.moneypig where who ='sister'";

include('config.php');
if($result = mysqli_query($link_select, $sqltmp)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>零用錢</th>";
                    echo "<th>日期</th>";
                    echo "<th>理由</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['money'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['reason'] . "</td>";
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

<form method="POST" name="form" action="">
    <div class="form-group">
        <label for="query">查詢日期</label>
        <input type="text" class="form-control" id="query" name="query" aria-describedby="SQLqueryHelp"
            placeholder="查詢日期">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php





if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["query"])  ){
    
    $input_query = $_POST["query"];
    echo "<li>您查詢的日期：".$input_query."：</li>" ;
    echo "<li>SQL 查詢語言</li>";
    $sql="SELECT who,money,date,reason FROM moneypig where who ='".$_COOKIE["role"]."' and date='".$input_query."'";
    echo "<pre>";
    echo $sql ;
    echo "</pre><br>";
    include('config.php'); 
    if($result = mysqli_query($link_select, $sql)){
        echo "<li>查詢結果如下</li><div class='table-responsive'>";
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


<h2>小試身手</h2>
<ol>
<li>跟資料庫相關的網站弱點名稱</li>
<li>輸入框未過濾，惡意攻擊者輸入 JavaScript 後，瀏覽器可解析的弱點名稱</li>
<li>修改 Cookie 之後，可以瀏覽其他人的資料，這個弱點我們可以統稱為「**」</li>
<li>請找到隱藏在資料庫的 Flag Hint: 弟弟的紅包</li>
</ol>

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
	include_once('../../php-inc/footer.php');
?>