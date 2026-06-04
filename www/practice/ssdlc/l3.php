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
    $titlename='開發測試';
	include_once('../../php-inc/header.php');
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="./">SSDLC</a></li>
    <li class="breadcrumb-item active">開發測試</li>
</ol>


<h1 id="-">開發/測試</h1>
<h2 id="-">開發</h2>
<ul>
    <li>版本控制<ul>
            <li>版本更新</li>
            <li>版本日誌</li>
            <li>git <ul>
                    <li>分散式版本控制系統</li>
                </ul>
            </li>
            <li>github<ul>
                    <li>利用 git 儲存程式碼</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>分支<ul>
            <li>git branch</li>
            <li>發 PR<ul>
                    <li>合併分支</li>
                    <li>四眼原則<ul>
                            <li>兩個人一人開發一人審核</li>
                            <li><strong>安全程式碼</strong></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>版本衝突</li>
        </ul>
    </li>
    <li>問題追蹤軟體 issue</li>
    <li>安全性問題<ul>
            <li>.git 洩漏</li>
            <li>有原始碼可以進行 code review</li>
        </ul>
    </li>
</ul>
<h2 id="-">測試</h2>
<ul>
    <li>測試原則<ul>
            <li>功能可用<ul>
                    <li>手動測試</li>
                    <li>單元測試 Unit Test</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>覆蓋率 coverage<ul>
            <li>使用單元測試時會呼叫函式<ul>
                    <li>呼叫函式樹/程式碼內所有函式</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>持續整合伺服器<ol>
            <li>程式碼更新 checkout 新版本</li>
            <li>建置程式 + 跑 Unit Test</li>
            <li>建構失敗 --&gt; 通知成員</li>
            <li>覆蓋率不足 --&gt; 通知成員</li>
        </ol>
    </li>
    <li>
        測試環境
        <ul>
            <li>跟正式環境相同設定</li>
            <li>資料庫版本相同但不相連</li>
            <li>不可與正式環境互通: 隔離環境 </li>
        </ul>
    </li>
    <li>
        安全問題
        <ul>
            <li>測試環境有正式資料</li>
            <li>測試環境外網可連<ul>
                    <li>debug 模式未關</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>

<ul>
    <li>階段
        <ul>
            <li>3.1 程式碼演練
                <ul>
                    <li>安全團隊應該與開發人員一起執行程式碼演練，在某些情況下，還應與系統架構師一起執行。</li>
                    <li>在此期間開發人員可以解釋已實現程式碼的邏輯和流程。</li>
                    <li>它允許程式碼審查團隊對程式碼有一個大致的了解，開發人員解釋為什麼某些事情會以他們的方式開發。</li>
                    <li>目的不是執行程式碼審查，而是從高層次理解構成應用程序的程式碼的流程、佈局和結構。</li>
                </ul>
            </li>
            <li>3.2 程式碼審查
                <ul>
                    <li>充分了解程式碼的結構以及邏輯後，測試人員現在可以檢查實際程式碼中的安全缺陷。</li>
                    <li>靜態程式碼審查根據一組清單驗證程式碼，包括
                        <ul>
                            <li>可用性、機密性和完整性的業務要求</li>
                            <li>OWASP Guide or Top 10 Checklists</li>
                            <li>與所使用的語言或框架相關的特定問題，例如用於 PHP 的 Scarlet 論文或用於 ASP.NET 的 Microsoft 安全編碼清單</li>
                            <li>任何行業特定要求，例如 Sarbanes-Oxley 404、COPPA、ISO/IEC 27002、APRA、HIPAA、Visa Merchant 指南或其他標準。
                            </li>
                        </ul>
                    </li>
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