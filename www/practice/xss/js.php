<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit();
}

include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])) {
    $input_answer = $_POST["answer"];
    if ($input_answer == "全域") {
        $user_id = $_SESSION["id"];
        $challenges_name = "JavaScript-VarFuc-1";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else if ($input_answer == "const") {
        $user_id = $_SESSION["id"];
        $challenges_name = "JavaScript-VarFuc-2";
        include_once "../challenges.php";
        $challenge_array = CheckChallenges($link, $user_id, $challenges_name);
      } else{
        $challenge_array = ["alert", "答案錯誤"];
    }
}
$challenge_type = $challenge_array[0];
$challenge_messange = $challenge_array[1];
?>


<?php
$titlename = "JavaScript-Basic-1";
include_once "../../php-inc/header.php";
?>



<h1>JavaScript 基礎 </h1>

<h2>變數</h2>
<pre class="javascript" style="font-family:monospace;"><span style="color: #006600; font-style: italic;">// 全域變數</span>
name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 變數範圍: function() 內;若不是在函式內定義，則為全域變數</span>
<span style="color: #000066; font-weight: bold;">var</span> name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// ESMAScript 6 引入規範，變數範圍: 程式碼區塊{}</span>
let name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// ESMAScript 6 引入規範，變數範圍: 程式碼區塊{}，且不能變更內容(常數性質)</span>
<span style="color: #000066; font-weight: bold;">const</span> name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
</pre>

<h3>範例</h3>
<pre class="javascript" style="font-family:monospace;"><span style="color: #006600; font-style: italic;">// 全域變數</span>
name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>name<span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 fei</span>
console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>window.<span style="color: #660066;">name</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 fei</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 變數範圍: function() 內;若不是在函式內定義，則為全域變數</span>
<span style="color: #000066; font-weight: bold;">function</span> main<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
    <span style="color: #000066; font-weight: bold;">if</span> <span style="color: #009900;">&#40;</span><span style="color: #003366; font-weight: bold;">true</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
        <span style="color: #000066; font-weight: bold;">var</span> name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 作用範圍在整個 main 之中</span>
    <span style="color: #009900;">&#125;</span>
    console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>name<span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 fei</span>
<span style="color: #009900;">&#125;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// ESMAScript 6 引入，變數範圍: 程式碼區塊{}</span>
<span style="color: #000066; font-weight: bold;">function</span> main<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
    <span style="color: #000066; font-weight: bold;">if</span> <span style="color: #009900;">&#40;</span><span style="color: #003366; font-weight: bold;">true</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
        let name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 作用範圍在 if 這個程式碼區塊範圍之內</span>
    <span style="color: #009900;">&#125;</span>
    console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>name<span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 undefined</span>
<span style="color: #009900;">&#125;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// ESMAScript 6 引入，變數範圍: 程式碼區塊{}，且不能變更內容(常數性質)</span>
<span style="color: #000066; font-weight: bold;">function</span> main<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
    <span style="color: #000066; font-weight: bold;">const</span> name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span> 
    name <span style="color: #339933;">=</span><span style="color: #3366CC;">&quot;feifei&quot;</span><span style="color: #339933;">;</span><span style="color: #006600; font-style: italic;">// 出錯：Uncaught TypeError: Assignment to constant variable.</span>
<span style="color: #009900;">&#125;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 如果 const 是物件仍可更改屬性與值，只是該物件所指到的記憶體指標不會被改變</span>
<span style="color: #000066; font-weight: bold;">const</span> person <span style="color: #339933;">=</span> <span style="color: #000066; font-weight: bold;">new</span> <span style="">Object</span><span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span>
person.<span style="color: #660066;">name</span> <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
person.<span style="color: #660066;">school</span> <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;NTUST&quot;</span><span style="color: #339933;">;</span>
&nbsp;</pre><pre class="javascript" style="font-family:monospace;"><span style="color: #006600; font-style: italic;">// 全域變數</span>
name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>name<span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 fei</span>
console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>window.<span style="color: #660066;">name</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 fei</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 變數範圍: function() 內;若不是在函式內定義，則為全域變數</span>
<span style="color: #000066; font-weight: bold;">function</span> main<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
    <span style="color: #000066; font-weight: bold;">if</span> <span style="color: #009900;">&#40;</span><span style="color: #003366; font-weight: bold;">true</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
        <span style="color: #000066; font-weight: bold;">var</span> name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 作用範圍在整個 main 之中</span>
    <span style="color: #009900;">&#125;</span>
    console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>name<span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 fei</span>
<span style="color: #009900;">&#125;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// ESMAScript 6 引入，變數範圍: 程式碼區塊{}</span>
<span style="color: #000066; font-weight: bold;">function</span> main<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
    <span style="color: #000066; font-weight: bold;">if</span> <span style="color: #009900;">&#40;</span><span style="color: #003366; font-weight: bold;">true</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
        let name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 作用範圍在 if 這個程式碼區塊範圍之內</span>
    <span style="color: #009900;">&#125;</span>
    console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span>name<span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span> <span style="color: #006600; font-style: italic;">// 印出 undefined</span>
<span style="color: #009900;">&#125;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// ESMAScript 6 引入，變數範圍: 程式碼區塊{}，且不能變更內容(常數性質)</span>
<span style="color: #000066; font-weight: bold;">function</span> main<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>
    <span style="color: #000066; font-weight: bold;">const</span> name <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span> 
    name <span style="color: #339933;">=</span><span style="color: #3366CC;">&quot;feifei&quot;</span><span style="color: #339933;">;</span><span style="color: #006600; font-style: italic;">// 出錯：Uncaught TypeError: Assignment to constant variable.</span>
<span style="color: #009900;">&#125;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 如果 const 是物件仍可更改屬性與值，只是該物件所指到的記憶體指標不會被改變</span>
<span style="color: #000066; font-weight: bold;">const</span> person <span style="color: #339933;">=</span> <span style="color: #000066; font-weight: bold;">new</span> <span style="">Object</span><span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span>
person.<span style="color: #660066;">name</span> <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #339933;">;</span>
person.<span style="color: #660066;">school</span> <span style="color: #339933;">=</span> <span style="color: #3366CC;">&quot;NTUST&quot;</span><span style="color: #339933;">;</span>
&nbsp;</pre>

<h2>函式(是一種物件)</h2>
<pre class="javascript" style="font-family:monospace;"><span style="color: #006600; font-style: italic;">// 匿名函式</span>
<span style="color: #000066; font-weight: bold;">function</span><span style="color: #009900;">&#40;</span>number<span style="color: #009900;">&#41;</span> <span style="color: #009900;">&#123;</span><span style="color: #000066; font-weight: bold;">return</span> number <span style="color: #339933;">*</span> number<span style="color: #009900;">&#125;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 全域一般函式</span>
fuc <span style="color: #339933;">=</span> <span style="color: #000066; font-weight: bold;">function</span><span style="color: #009900;">&#40;</span>number<span style="color: #009900;">&#41;</span> <span style="color: #009900;">&#123;</span><span style="color: #000066; font-weight: bold;">return</span> number <span style="color: #339933;">*</span> number<span style="color: #009900;">&#125;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 一般函式，範圍:函式內</span>
<span style="color: #000066; font-weight: bold;">var</span> fuc <span style="color: #339933;">=</span> <span style="color: #000066; font-weight: bold;">function</span><span style="color: #009900;">&#40;</span>number<span style="color: #009900;">&#41;</span> <span style="color: #009900;">&#123;</span><span style="color: #000066; font-weight: bold;">return</span> number <span style="color: #339933;">*</span> number<span style="color: #009900;">&#125;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 一般函式，範圍:程式區塊範圍</span>
let fuc <span style="color: #339933;">=</span> <span style="color: #000066; font-weight: bold;">function</span><span style="color: #009900;">&#40;</span>number<span style="color: #009900;">&#41;</span> <span style="color: #009900;">&#123;</span><span style="color: #000066; font-weight: bold;">return</span> number <span style="color: #339933;">*</span> number<span style="color: #009900;">&#125;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 一般函式，範圍:程式區塊範圍，不能代表其他函式</span>
<span style="color: #000066; font-weight: bold;">const</span> fuc <span style="color: #339933;">=</span> <span style="color: #000066; font-weight: bold;">function</span><span style="color: #009900;">&#40;</span>number<span style="color: #009900;">&#41;</span> <span style="color: #009900;">&#123;</span><span style="color: #000066; font-weight: bold;">return</span> number <span style="color: #339933;">*</span> number<span style="color: #009900;">&#125;</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #006600; font-style: italic;">// 立即執行函式表達式(IIFE)</span>
<span style="color: #009900;">&#40;</span>funcition<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span><span style="color: #009900;">&#125;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span>
<span style="color: #009900;">&#40;</span><span style="color: #000066; font-weight: bold;">function</span><span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#123;</span>console.<span style="color: #660066;">log</span><span style="color: #009900;">&#40;</span><span style="color: #3366CC;">&quot;fei&quot;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span><span style="color: #009900;">&#125;</span><span style="color: #009900;">&#41;</span><span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span><span style="color: #339933;">;</span></pre>





    <h2>小試身手</h2>
    <p>請回答以下的問題，並於 answer 的欄位填寫「答案」，* 字號代表該答案的字數。</p>
    <p>1. **變數，任何範圍都能存取，該宣告方法不安全，容易造成漏洞或功能錯誤</p>
    <p>2. 宣告該變數不能修改值(*****)，若為物件則可修改屬性與內容</p>



    <form method="POST" name="form" action="">
        <div class="input-group mb-3">
            <input id="answer" name="answer" type="text" class="form-control" placeholder="回答問題，請一次輸入一個答案"
                aria-label="回答問題" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary  " type="submit">送出答案</button>
            </div>
        </div>
    </form>
    <?php include_once "../../php-inc/footer.php";
?>
