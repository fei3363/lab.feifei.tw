<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='軟體發展生命週期';
include('../../php-inc/header.php');

?>


<h1>開發者注意的事項</h1>
<ul>
    <li>測試
        <ul>
            <li>何謂測試：被使用者使用之前確認網站和系統的品質、性能、可靠性。</li>
            <li>為什麼要進行測試：
                <ul>
                    <li>確保網站可用</li>
                    <li>確保網站安全性</li>
                </ul>
            </li>
            <li>什麼時候測試：軟體發展生命週期的每一個階段都要測試 System Development Life Cycle(SDLC)
                <ul>
                    <li>需求發展 DEFINE</li>
                    <li>設計 DESIGN</li>
                    <li>開發/測試 DEVELOP</li>
                    <li>建置 DEPLOY</li>
                    <li>維護 MAINTAIN</li>
                </ul>
            </li>
            <li>測試什麼：目前都以技術、功能為主，人跟流程比較少。
                <ul>
                    <li>人：確保有足夠的資安教育與資安意識</li>
                    <li>流程：有政策參考（隱私權政策、資安政策）、有標準流程，讓人可以遵守</li>
                    <li>技術、功能：確保功能有用</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>測試方法
        <ul>
            <li>人工檢查
                <ul>
                    <li>靈活，可適用多種情況</li>
                    <li>耗時、需要大量的人</li>
                </ul>
            </li>
            <li>威脅建模：使用標準─NIST 800-30；台灣稱為<strong>風險管理</strong>
                <ol>
                    <li>分析應用程式：手動檢查了解應用程式的執行流程、資產、功能和互相的連接性。</li>
                    <li>定義分類資產：將資產分成有形資產、無形資安產，根據業務重要性進行排序。</li>
                    <li>探索淺在漏洞：包含功能面、營運面、管理面的漏洞。</li>
                    <li>探索淺在威脅：利用威脅場景，從攻擊者的角度設定攻擊情境。</li>
                    <li>制定緩解策略：將找到的威脅制定緩解控制措施。</li>
                </ol>
                <ul>
                    <li><img src="image/nist-sp-800-30-flow-chart.jpg" alt="ssdlc" style="width: 50em;"></li>
                </ul>
            </li>
            <li>原始碼檢測
                <ul>
                    <li>完整性覆蓋程式碼、有效、準確</li>
                    <li>需要高技能的開發者、可能會忽略函式庫版本問題</li>
                </ul>
            </li>
            <li>滲透測試
                <ul>
                    <li>快速、測試實際部署的程式碼</li>
                    <li>於 SDLC 較晚、而且不全面</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>參考網址
        <ul>
            <li>NIST 800-30 https://csrc.nist.gov/publications/detail/sp/800-30/rev-1/final</li>
        </ul>
    </li>
</ul>


<h2>安全軟體發展生命週期</h2>
Secure System Development Life Cycle(SSDLC)<br>

<img src="image/ssdlc.png" alt="ssdlc" style="width: 50em;">

<ol>
    <li>需求發展:加入安全考量</li>
    <li>設計:進行安全設計</li>
    <li>開發/測試:安全程式碼開發與程式碼檢測</li>
    <li>建置:防火牆與資安設備(加入弱點掃描與滲透測試)</li>
    <li>維護:監控與資安鑑識(加入弱點掃描與滲透測試)</li>
</ol>




<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">課程名稱</th>
            <th scope="col">課程說明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td><a href="l1.php">需求分析</a></td>
            <td>在開發的時候要加入安全性相關的需求 </td>
        </tr>

        <tr>
            <th scope="row">2</th>
            <td><a href="l2.php">設計</a></td>
            <td>開始開發前先進行設計</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td><a href="l3.php">開發測試</a></td>
            <td>開發時要進行版本控制 & 進行測試</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td><a href="l4.php">建置部署</a></td>
            <td>部署網站到正式環境</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td><a href="l5.php">測試 & 維護</a></td>
            <td>讓網站活著，監控是否有攻擊</td>

        </tr>
        <tr>
            <th scope="row">6</th>
            <td><a href="l6.php">CodeIgniter</a></td>
            <td>CodeIgniter 安全</td>

        </tr>

    </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>