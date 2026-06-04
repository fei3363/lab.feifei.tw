<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='SQL injection 課程摘要';
include('../../php-inc/header.php');

?>

<h1>SQL injection 課程摘要</h1>
<p>網站中常程式碼可能會跟資料庫進行互動，如載入資料、新讀改刪(CRUD)資料。</p>
<p>資料庫起源於 1960 年代，希望可以數位化與集中保存資料。</p>
<ul>
    <li>
        資料庫類型
        <ul>
            <li>SQL 資料庫
              <ul>
                <li>關聯式資料庫
                  <ul>
                    <li>每一張表有唯一主鍵 primary key</li>
                    <li>利用外鍵 Foreign Key 參考到其他資料表的資料</li>
                  </ul>
                </li>
                <li>儲存多張資料表</li>
                <li>利用正規化建立關聯</li>
                <li>欄位有事先定義格式</li>
                <li>特性 <ul>
                  <li>資料完整性約束，如唯一值、不能是空值</li>
                  <li>資料庫交易：一次執行多條 SQL 語法，會批次執行</li>
                  <li>交易性：批次處理的其中一條失效，全部都失敗</li>
                  <li>一致性：交易失敗後，資料庫的狀態不會被改變</li>
                </ul></li>
              </ul>
            </li>
            <li>NoSQL資料庫<ul>
              <li>被發明來解決 SQL資料庫的缺點 - 回應效率過低</li>
              <li>犧牲完整性</li>
              <li>無綱要特性：新增欄位不需要更新資料結構　--> 常用 key-value 的狀態</li>
              <li>無絕對一致，只保證最後結果一致</li>
            </ul></li>
        </ul>
    </li>

</ul>
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
            <td><a href="sql1.php">SQL 基礎簡介</a></td>
            <td>練習 SQL 指令 </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td><a href="sql2.php">String SQL injection</a></td>
            <td>字串型 SQL injection</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td><a href="sql3.php">Numeric SQL injection</a></td>
            <td>數字型 SQL Injection</td>

        </tr>
        <tr>
            <th scope="row">4</th>
            <td><a href="sql4.php">Union SQL Injection</a></td>
            <td>認識 Union SQL Injection</td>

        </tr>
        <tr>
            <th scope="row">5</th>
            <td><a href="sql5.php">Blind SQL injection </a></td>
            <td>Blind SQL injection</td>

        </tr>
        <tr>
            <th scope="row">6</th>
            <td><a href="sql6.php">Bypass WAF</a></td>
            <td>Bypass WAF</td>

        </tr>
        <tr>
            <th scope="row">7</th>
            <td><a href="defense.php">防範手法</a></td>
            <td>如何防禦 SQL injection</td>

        </tr>
    </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>