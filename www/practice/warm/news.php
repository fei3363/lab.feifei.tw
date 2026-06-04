<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="資安鑑識報告"){
        $challenges_name = "Warm-News-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="淺在威脅"){
        $challenges_name = "Warm-News-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="資安新聞"){
        $challenges_name = "Warm-News-3";
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
    $titlename='Warm up';
	include_once('../../php-inc/header.php');
?>






<h1>資安新聞學習資訊安全</h1>

<h2>資安鑑識報告</h2>
<br>
當發生資安事件時，需要進行資安鑑識，以確認事件的範圍、影響和根本原因，並且採取適當的措施以避免類似事件再次發生。資安鑑識報告是一份紀錄鑑識過程和結果的文件，它可以提供有關事件的詳細信息，包括鑑識結果、發現的安全問題和建議的改進措施等。鑑識報告通常是供相關方面參考，以便他們更好地了解事件並作出相應的決策。

<div><p>資安鑑識是一個複雜的過程，需要專業的知識和技能。以下是一般資安鑑識的步驟：</p><ol><li><p>收集證據：搜集和保護與事件相關的證據。證據可以包括電腦、手機、記憶卡、硬盤等數位儲存設備，以及相關的文件、通訊記錄等。</p></li><li><p>保存證據：保護證據以防止損壞或毀損。這可以通過制定和實施控制措施來實現，例如創建鏡像，使用數字簽名等。</p></li><li><p>分析證據：評估證據，確定其可信度和可用性，以及確定它們是否對事件有貢獻。這可以使用許多工具和技術來實現，例如恢復刪除的文件、分析網絡流量等。</p></li><li><p>重現事件：將證據應用到測試系統上，重建事件的場景，以了解事件發生的方式和過程。</p></li><li><p>確認損害程度：確定受影響系統和數據的損害程度，以及事件對業務運營的影響。</p></li><li><p>溯源追蹤：追蹤攻擊者的行動軌跡和入侵路徑，以了解他們如何進入系統，從而確定後續應對措施。</p></li><li><p>撰寫報告：編寫鑑識報告，評估發現的風險和建議的改進措施。這份報告應該詳細描述所有鑑識過程和結果，以便相關方面進行檢查和審核。</p></li><li><p>採取行動：基於鑑識結果和建議，採取適當的措施修復系統漏洞、加強安全控制措施等，從而避免類似的事件再次發生。</p></li></ol><p>需要注意的是，每個事件都有其獨特性，因此鑑識過程的步驟和方式可能會因事件類型和情況而異。</p></div>

<h2>淺在威脅</h2>
<br>
滲透測試就像身體健檢一樣，可以幫助機構找出其系統和應用程序中的潛在漏洞和安全弱點，從而找出淺在的威脅。通過模擬黑客攻擊，滲透測試可以評估系統的安全性並發現可能的風險，以確保系統的安全性。<br>
與身體健康檢查不同，滲透測試是一種主動的安全測試方法，由資安專業人員使用工具和技術，模擬攻擊者對系統進行攻擊，以發現應用程序和系統中可能存在的漏洞和弱點，並提出建議的修復方案。<br>
通過滲透測試，機構可以改善其安全措施，並增強其系統的安全性。<br>


<h2>資安新聞補充</h2>
<br>
<ol>
<li><a href="https://www.ithome.com.tw/tags/%E8%B3%87%E5%AE%89%E5%91%A8%E5%A0%B1"> iThome 資安週報</a></li>
<li><a href="https://www.nccst.nat.gov.tw/NewsRSS?RSSType=news"> 行政院國家資通安全會報技術服務中心 資安新聞</a></li>
<li><a href="https://www.twcert.org.tw/tw/lp-104-1.html"> TWCERT/CC 台灣電腦網路危機處理暨協調中心 資安新聞</a></li>
</ol>
<br>

<div><p>以下是建議學生從資安新聞衍生自己的資安學習目標的方法：</p><ol><li><p>關注資安新聞：建議學生經常關注資安相關的新聞和事件，了解最新的資安風險和趨勢。</p></li><li><p>分析事件原因：學生可以從事件的原因、攻擊方式、受影響的系統和應用程序等方面進行分析，以了解攻擊者的策略和漏洞的本質。</p></li><li><p>研究攻擊技術：學生可以研究報導中提到的攻擊技術，以了解它們的運作原理和防禦方法。</p></li><li><p>實踐測試：學生可以設計測試方案，以測試自己的系統和應用程序是否容易受到類似攻擊的影響。例如，學生可以使用滲透測試工具或模擬攻擊進行實踐。</p></li><li><p>繼續學習：學生可以通過資安相關的網路課程、證書考試、訓練課程、資訊安全社區等途徑持續學習和提高自己的資安知識和技能。</p></li></ol><p>總之，通過關注資安新聞並分析事件，學生可以找到自己感興趣的主題和領域，並進一步進行學習和實踐。</p></div>

<h2>小試身手</h2>
<ol>
    <li>發生資安事件如身體生病，需要看醫生，而鑑識結束後會取得，「資****告」</li>
    <li>滲透測試如同身體健檢，找出「淺**脅」</li>
    <li>可以從「資**聞」衍生自己的資安學習目標</li>
</ol>

<form method="POST">
    <div class="form-group">
        <label for="answer"><br><h4>答案繳交</h4></label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>
