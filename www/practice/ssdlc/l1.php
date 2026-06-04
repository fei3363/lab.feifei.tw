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
    $titlename='需求分析';
	include_once('../../php-inc/header.php');
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="./">SSDLC</a></li>
    <li class="breadcrumb-item active">需求分析</li>
</ol>


<h1 id="-">需求分析</h1>
<ul>
    <li>與業主/客戶確認需求<ul>
            <li>使用者需求</li>
            <li>使用者研究<ul>
                    <li>先進行研究利用小樣本並跟客戶確認是否符合他們預期</li>
                </ul>
            </li>
            <li>使用者故事<ul>
                    <li>從使用者角度寫出他的故事</li>
                    <li>角色:誰使用這個服務<ul>
                            <li>身為一個OOO</li>
                        </ul>
                    </li>
                    <li>描述:這個人利用服務完成什麼事<ul>
                            <li>我想要OOO</li>
                        </ul>
                    </li>
                    <li>目標:為什麼這個使用者需要這個服務<ul>
                            <li>因此我可以得到OOO</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>目標：讓程式符合客戶需求</li>
        </ul>
    </li>
    <li> <b style="color:red">加入安全考量</b>
        <ul>
            <li>使用者故事<ul>
                    <li>權限:這個功能還有誰可以使用?</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>

<ul>
    <li>階段
        <ul>
            <li>1.1 定義 SDLC
                <ul>
                    <li>在應用程式開發開始之前，必須定義適當的 SDLC，其中每個階段都具有增加安全性的考量。</li>
                </ul>
            </li>
            <li>1.2 審查政策和標準
                <ul>
                    <li>確保有適當的政策、標準和文件。如果可以提供文件，可以為開發團隊有一個可遵循的指導方針和政策。</li>
                    <li>舉例<br />
                        <ul>
                            <li>如果要使用 Java 開發應用程式，則必須有 Java 安全程式碼標準。</li>
                            <li>如果應用程式要使用密碼學，則必須有一個密碼學標準。</li>
                            <li>沒有任何政策或標準可以涵蓋開發團隊將面臨的所有情況。</li>
                            <li>通過記錄常見和可預測的問題，在開發過程中需要做出的決定將會減少。</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>1.3 定義標準與度量標準並確保可追溯性
                <ul>
                    <li>在開發開始之前，定義標準與度量方式。</li>
                    <li>通過定義需要測量的標準，它提供了對過程和產品中缺陷的可見性。</li>
                    <li>在開發開始之前定義指標至關重要，因為可能需要修改流程以收集資料。</li>
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