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
    if($input_answer=="失效"){
        $challenges_name = "OWASP-Top-10-2021-intr-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="未加密"){
        $challenges_name = "OWASP-Top-10-2021-intr-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="injection"){
        $challenges_name = "OWASP-Top-10-2021-intr-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="安全"){
        $challenges_name = "OWASP-Top-10-2021-intr-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="版本"){
        $challenges_name = "OWASP-Top-10-2021-intr-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="更新"){
        $challenges_name = "OWASP-Top-10-2021-intr-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="密碼字典檔"){
        $challenges_name = "OWASP-Top-10-2021-intr-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="完整性"){
        $challenges_name = "OWASP-Top-10-2021-intr-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="日誌"){
        $challenges_name = "OWASP-Top-10-2021-intr-9";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="受害伺服器"){
        $challenges_name = "OWASP-Top-10-2021-intr-10";
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
    $titlename='OWASP Top 10 2021';
	include_once('../../php-inc/header.php');
?>

<h1>OWASP Top 10 2021</h1>

<ul>
    <li>A01:2021-Broken Access Control
        <ul>
            <li>權限控管「失效」</li>
            <li>權限控管：登入後，只能使用自己的權限做事
                <ul>
                    <li>如登入自己的 Line 後只能查看自己的 Line 對話</li>
                </ul>
            </li>
            <li>失效的權限控管
                <ul>
                    <li>知道內部的網址，直接存取可以看到敏感資料</li>
                    <li>修改 GET、POST 參數，可用自己的身分查看他人的資料</li>
                </ul>
            </li>

        </ul>
    </li>
    <li>A02:2021-Cryptographic Failures
        <ul>
            <li>加密機制故障或缺乏加密機制</li>
            <li>誰需要被加密？
                <ul>
                    <li>網頁傳輸過程中
                        <ul>
                            <li>「未加密」的協定：HTTP、SMTP、FTP</li>
                        </ul>
                    </li>
                    <li>儲存在資料庫內的資料</li>
                </ul>
            </li>

        </ul>
    </li>
    <li>A03:2021-Injection
        <ul>
            <li>注入惡意指令或程式碼</li>
            <li>哪裡會被注入「injection」
                <ul>
                    <li>所有可以輸入的地方</li>
                    <li>所有參數</li>
                    <li>URL</li>
                    <li>Cookie</li>
                    <li>Json 格式的檔案</li>
                    <li>XML 格式的檔案</li>
                </ul>
            </li>

        </ul>
    </li>
    <li>A04:2021-Insecure Design
        <ul>
            <li>「不安全的設計」，強調網站整體設計與結構相關的弱點</li>
            <li>期待設計與開發網站加入安全
                <ul>
                    <li>針對需求與資源進行管理：我開始開發的時候也要加入資訊安全的考量</li>
                    <li>安全設計：開發過程不斷評估確保安全，防止已知的攻擊手法</li>
                    <li>安全的開發週期：單元測試、網段分離、限制資源消耗</li>
                </ul>
            </li>
            <li>舉例
                <ul>
                    <li>搶票程式 --> 網站沒有防止短時間大量購買的機制</li>
                    <li>忘記密碼 --> 利用自己定義的問題跟答案取回密碼 --> 失去唯一且可信度低</li>
                    <li>同時訂購 --> 短時間訂購 --> 網站是否能負擔</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>A05:2021-Security Misconfiguration
        <ul>
            <li>安全設定錯誤</li>
            <li>舉例
                <ul>
                    <li>使用雲端平台架設，但權限設定有問題</li>
                    <li>安裝或開啟不必要的功能，測試帳號、測試頁面</li>
                    <li>預設帳號密碼沒有修改或刪除</li>
                    <li>debug 模式沒有關閉 --> 有機會看到「版本」</li>
                    <li>開啟目錄資料夾列表功能 --> 看到資料夾其他資料</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>A06:2021-Vulnerable and Outdated Components
        <ul>
            <li>有缺陷或過版本的元件</li>
            <li>元件
                <ul>
                    <li>網站使用的套件</li>
                    <li>伺服器安裝的軟體：資料庫、伺服器軟體、資料庫管理系統、API</li>
                </ul>
            </li>
            <li>已知漏洞攻擊 --> 沒有進行「更新」 --> 透過版本確認是否有漏洞 --> 現成攻擊腳本</li>
        </ul>
    </li>
    <li>A07:2021-Identification and Authentication Failures
        <ul>
            <li>身分識別和身分驗證失效或錯誤</li>
            <li>例如
                <ul>
                    <li>爆破密碼攻擊 --> 使用「密碼字典檔」</li>
                    <li>預設/脆弱/常見 密碼</li>
                    <li>Session 相關弱點</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>A08:2021-Software and Data Integrity Failures
        <ul>
            <li>軟體和資料完整性失效或錯誤</li>
            <li>資料「完整性」：傳輸、儲存資訊或資料的過程中，確保資訊或資料不被未授權的篡改或在篡改後能夠被迅速發現</li>
            <li>例如
                <ul>
                    <li>軟體或韌體未驗證完整性就更新</li>
                    <li>更新檔包含惡意程式</li>
                    <li>不安全的反序列化</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>A09:2021-Security Logging and Monitoring Failures
        <ul>
            <li>安全日誌和監控失效</li>
            <li>例如
                <ul>
                    <li>沒有「日誌」(log) --> 追查不到攻擊來源、時間點</li>
                    <li>發生資安事件 --> 沒有即時通報</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>A10:2021-Server-Side Request Forgery
    <ul>
            <li>伺服器來源請求</li>
            <li>例如
                <ul>
                    <li>網站提供功能：該功能以「受害伺服器」的身分去請求內容</li>
                    <li>請求內容若無過濾，可能造成
                        <ul>
                            <li>掃描內部網路架構的端口</li>
                            <li>敏感資料外洩</li>
                            <li>取得雲端伺服器的 metadata </li>
                            <li>濫用導致攻擊內部網路</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>




<h2>小試身手</h2><li>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</li>

<ol>
    <li>請問網址 ?user=fei 修改成 ?user=admin 可以看到管理員的內容，導致權限控管__(**)</li>
    <li>請問駭客攔截 HTTP 封包，可看到封包的內容如帳號密碼，主要是因為 HTTP 是一個____的協定(***)</li>
    <li>請問駭客在搜尋欄輸入惡意程式碼，而後端沒有過濾，導致影響程式邏輯，可能造成敏感資料外洩，這稱為(i*****)</li>
    <li>購票系統未防止駭客進行搶票，這是因為開發網站的時候沒有考量___的設計(**)</li>
    <li>debug 模式可能會洩漏伺服器的____(**)，導致駭客可以進一步攻擊</li>
    <li>在已知漏洞中，工程師是因為沒有幫軟體/程式/函式庫進行____(**)，才導致可被現成的攻擊腳本攻擊。</li>
    <li>若使用預設、脆弱、或常見的密碼，可能會遭到駭客使用_______進行爆破密碼攻擊(*****)</li>
    <li>更新軟體的時候，會檢查資料沒有被竄改，是要確保資料的_____(***)</li>
    <li>發生資安事件後，如果沒有____(**)，可能沒有辦法追查發生的時間與方式</li>
    <li>SSRF 是以_________(*****)的身分進行請求內容</li>
</ol>
<li>請一次輸入一個答案</li>
<form method="POST">
    <div class="form-group">
        <label for="answer">Answer:</label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>

<?php
	include_once('../../php-inc/footer.php');
?>