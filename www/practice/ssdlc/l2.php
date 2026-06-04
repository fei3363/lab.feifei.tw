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
    $titlename='設計';
	include_once('../../php-inc/header.php');
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="./">SSDLC</a></li>
    <li class="breadcrumb-item active">設計</li>
</ol>

<h1 id="-">設計</h1>
<ul>
    <li>
        <p>UML</p>
        <ul>
            <li>統一建模語言</li>
            <li>使用案例圖（Use-case diagram）<ul>
                    <li>一個使用案例可說明系統提供的一項功能</li>
                </ul>
            </li>
            <li>類別圖（Class diagram）<ul>
                    <li>描述不同的個體（人、事物和資料）相互的關係</li>
                </ul>
            </li>
            <li>循序圖（Sequence diagram）<ul>
                    <li>描述特定使用案例或是特定使用案例的一部份詳細的流程</li>
                </ul>
            </li>
            <li>狀態圖（Statechart diagram）<ul>
                    <li>狀態圖為一個類別模擬了所有可能的狀態，還有該類別要如何從一個狀態轉換到另一個狀態</li>
                </ul>
            </li>
            <li>活動圖（Activity diagram）<ul>
                    <li>活動圖用來描述在進行一項活動時，兩個或是多個類別物件之間程序的控制流程。</li>
                </ul>
            </li>
            <li>元件圖（Component diagram）<ul>
                    <li>元件圖描述系統的實體狀況。它的目的在於描述該系統中的軟體跟其他軟體元件的依存關係</li>
                </ul>
            </li>
            <li>部署圖（Deployment diagram）<ul>
                    <li>部署圖描述一個系統要如何部署到實際的硬體環境上，它的目的是要表示系統裡面不同元件實際上所要運作的地點，還有這些元件要如何互相溝通。</li>
                </ul>
            </li>
            <li><a
                    href="http://www.dotspace.idv.tw/Jyemii/umlcolumn/articles/umlwriting/UMLBasics/UMLBasics.htm">參考資料</a>
            </li>
        </ul>
    </li>
    <li>
        <p>設計模式</p>
        <ul>
            <li>對軟體設計中普遍存在（反覆出現）的各種問題，所提出的解決方案</li>
            <li>建立型模式<ul>
                    <li>單例模式 (獨體模式) ( Singleton Pattern )</li>
                    <li>工廠方法模式 ( Factory Method Pattern )</li>
                    <li>抽象工廠模式 ( Abstract Factory Pattern )</li>
                    <li>建造者模式 ( Builder Pattern )</li>
                    <li>原形模式 ( Prototype Pattern)</li>
                </ul>
            </li>
            <li>結構型模式<ul>
                    <li>轉接器模式 ( Adapter Pattern )</li>
                    <li>橋接模式 ( Bridge Patern )</li>
                    <li>組合模式 ( Composite Pattern )</li>
                    <li>裝飾模式 ( Decorator Pattern )</li>
                    <li>外觀模式 ( Facade Pattern )</li>
                    <li>享元模式 ( Flyweight Pattern )</li>
                    <li>代理模式 ( Proxy Pattern )</li>
                </ul>
            </li>
            <li>行為型模式<ul>
                    <li>觀察者模式 ( Observer Pattern )</li>
                    <li>範本方法模式 ( TemplateMethod Pattern )</li>
                    <li>命令模式 ( Command Pattern )</li>
                    <li>狀態模式 ( State Pattern )</li>
                    <li>責任鍊模式 ( Chain of Responsibility )</li>
                    <li>解釋器模式 ( Interpreter )</li>
                    <li>中介者模式 ( Mediator )</li>
                    <li>訪問者模式 ( Visitor )</li>
                    <li>策略模式 ( Strategy )</li>
                    <li>備忘錄模式 ( Memoto )</li>
                    <li>迭代器模式 ( Iterator )</li>
                </ul>
            </li>
            <li><a
                    href="https://zh.wikipedia.org/zh-tw/%E8%AE%BE%E8%AE%A1%E6%A8%A1%E5%BC%8F_(%E8%AE%A1%E7%AE%97%E6%9C%BA)">參考資料</a>
            </li>
        </ul>
    </li>
</ul>

<ul>
    <li>階段
        <ul>
            <li>2.1 審查安全要求
                <ul>
                    <li>安全需求從安全角度定義了應用程式的執行方式。
                        <ul>
                            <li>測試：需求中做出的假設並測試以查看需求定義中是否存在差距。</li>
                            <li>例如
                                <ul>
                                    <li>如果有一項安全要求規定用戶必須先註冊才能訪問網站的白皮書部分，這是否意味著用戶必須在系統中註冊，還是應該對用戶進行身份驗證？確保要求盡可能明確。</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>在尋找需求差距時，請考慮查看安全機制，例如：
                        <ul>
                            <li>User management</li>
                            <li>Authentication</li>
                            <li>Authorization</li>
                            <li>Data confidentiality</li>
                            <li>Integrity</li>
                            <li>Accountability</li>
                            <li>Session management</li>
                            <li>Transport security</li>
                            <li>Tiered system segregation</li>
                            <li>Legislative and standards compliance (including privacy, government, and industry
                                standards)</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>2.2 審查設計和架構
                <ul>
                    <li>應用程式應該要有文件，這個文件包含整體設計和架構，如模型等。</li>
                    <li>測試這些文件可以確保設計和系統結構執行需求中定義的適當安全層級是必不可少的。</li>
                    <li>在設計階段辨識安全漏洞不僅是最具成本效益的地方之一，而且可能是進行更改的最有效的地方之一。</li>
                    <li>例如
                        <ul>
                            <li>如果確定設計要求在多個地方做出授權行為，則考慮使用中央授權元件可能是合適的。如果應用程式在多個地方執行資料驗證，那麼開發一個中央驗證框架可能是合適的（即在一個地方而不是在數百個地方修復輸入驗證要便宜得多）。
                            </li>
                        </ul>
                    </li>
                    <li>如果發現弱點，則應將它們提供給系統架構師以尋找替代方法。</li>
                </ul>
            </li>
            <li>2.3 創建和審查 UML 模型
                <ul>
                    <li>設計和架構完成後，構建描述應用程式如何工作的統一建模語言 (UML) 模型。</li>
                    <li>使用這些模型與系統設計人員確認對應用程式如何工作的準確理解。</li>
                    <li>如果發現弱點，則應將它們提供給系統架構師以尋找替代方案。</li>
                </ul>
            </li>
            <li>2.4 創建和審查威脅模型
                <ul>
                    <li>借助設計和架構審查以及準確解釋系統工作原理的 UML 模型，進行威脅建模練習。制定現實的威脅情景。分析設計和架構，以確保這些威脅已得到緩解、企業接受或分配給第三方，例如保險公司。</li>
                    <li>當辨識出的威脅沒有緩解政策時，請與系統架構師一起重新審視設計和架構以修改設計。</li>
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