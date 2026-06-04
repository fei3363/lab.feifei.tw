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
    $titlename='建置部署';
	include_once('../../php-inc/header.php');
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="./">SSDLC</a></li>
    <li class="breadcrumb-item active">建置部署</li>
</ol>

<h1 id="-">建置</h1>
<ul>
    <li>步驟<ol>
            <li>從版本控制系統拿到原始碼</li>
            <li>複製到正式環境</li>
            <li>安裝套件、插件、更新 --&gt; 重新啟動</li>
        </ol>
    </li>
    <li>滿足條件<ul>
            <li>可靠性<ul>
                    <li>建置期間原始碼、元件、設定檔案 --&gt; 都是正確</li>
                    <li>若不可靠，可能造成問題<ul>
                            <li>會透過 hash 確認是否版本正確 or 被修改</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>可重現<ul>
                    <li>不同主機上仍是相同內容</li>
                    <li>建置若有步驟，建議使用自動化部署確保任意主機皆重現</li>
                </ul>
            </li>
            <li>可復原<ul>
                    <li>有 roll-back 機制</li>
                    <li>若新版本建置有問題，可立即退回上一個穩定版本，確保服務正常</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>選擇建置的平台<ul>
            <li>Paas 平台即服務<ul>
                    <li>提供應用程式基本的執行環境</li>
                    <li>EX<ul>
                            <li>Heroku</li>
                            <li>Google App Engine</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>Laas 基礎架構即服務<ul>
                    <li>雲端 Server 可控度高</li>
                    <li>EX<ul>
                            <li>GCP</li>
                            <li>AWS EC2</li>
                            <li>Linode</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>DevOps<ul>
            <li>制定標準部署方案、腳本模組化，讓部署更方便</li>
            <li>tool<ul>
                    <li>Puppet</li>
                    <li>Chef</li>
                    <li>Ansible</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>容器化<ul>
            <li>將執行環境、程式碼包成映像檔 image</li>
            <li>EX<ul>
                    <li>docker</li>
                    <li>docker swarm</li>
                    <li>Kubernetes</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>自動化部署<ul>
            <li>安裝相依元件(第三方函式庫)<ul>
                    <li>元件版本更新</li>
                </ul>
            </li>
            <li>編譯程式碼</li>
            <li>資料庫更動腳本<ul>
                    <li>更新或退回要能自動更新資料庫結構</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<ul>
    <li>階段
        <ul>
            <li>4.1 應用程式滲透測試
                <ul>
                    <li>在測試了需求、分析了設計並執行了程式碼審查之後，可以假設所有問題都已被發現。</li>
                    <li>部署應用程式後對其進行滲透測試會提供額外的檢查，以確保沒有遺漏任何內容。</li>
                </ul>
            </li>
            <li>4.2 設定管理測試
                <ul>
                    <li>應用程式滲透測試應該包括檢查基礎設施是如何部署和保護的。針對檢查設定方面，確保沒有任何可能被利用的預設設定留下。</li>
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