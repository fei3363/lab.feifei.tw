<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{ReflecTed_xSs}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Cross-Site-Scripting-1";
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
    $titlename='監控';
	include_once('../../php-inc/header.php');
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="./">SSDLC</a></li>
    <li class="breadcrumb-item active">監控</li>
</ol>

<h2 id="-">監控</h2>
<ul>
    <li>部署後，為確保服務可執行，發生問題有辦法確認異常和惡意行為：<ul>
            <li>日誌紀錄<ul>
                    <li>server log</li>
                    <li>功能 log</li>
                    <li>使用者操作(修改密碼、身分驗證)</li>
                    <li>log to web &amp; file<ul>
                            <li>不可寫入敏感資料<ul>
                                    <li>password</li>
                                    <li>IC card ID </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>監控<ul>
                    <li>回應時間和其他效能指標，異常能發出警報</li>
                    <li>伺服器效能<ul>
                            <li>回應過慢</li>
                        </ul>
                    </li>
                    <li>資料庫效能<ul>
                            <li>查詢過長</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>錯誤回報<ul>
                    <li>收集錯誤狀態 to webview</li>
                    <li>第三方服務 splunk 擷取 error log</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>第三方套件、服務<ul>
            <li>確認版本</li>
            <li>重大更新要安排更新</li>
        </ul>
    </li>
</ul>

<ul>
    <li>階段
        <ul>
            <li>5.1 進行營運管理審查
                <ul>
                    <li>需要有一個流程來詳細說明如何管理應用程式和基礎架構的營運方面。</li>
                </ul>
            </li>
            <li>5.2 進行定期健康檢查
                <ul>
                    <li>應每月或每季度對應用程式和基礎架構進行健康檢查，以確保沒有引入新的安全風險並且安全級別仍然完好無損。</li>
                </ul>
            </li>
            <li>5.3 確保變更驗證
                <ul>
                    <li>在 QA 在 QA 環境中批准和測試每個更改並部署到生產環境後，檢查更改以確保安全級別不受更改影響至關重要。</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<!-- <form method="POST" name="form" action="">
    <div class="input-group mb-3">
        <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案" aria-label="回答問題"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary  " type="submit">送出答案</button>
        </div>
    </div>
</form> -->






<?php
	include_once('../../php-inc/footer.php');
?>