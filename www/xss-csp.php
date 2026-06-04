<?php
/**
 * xss-csp.php
 * 
 * 範例目的：
 * - 設定一個簡易 CSP：script-src 允許 'self' 及 gist.githubusercontent.com
 * - 在網頁中反射 GET 參數 "user"
 * - 引用 GitHub Gist 中的外部腳本 test.js
 */

// 設定簡易的 Content Security Policy
// 允許同源及 gist.githubusercontent.com 載入 JS
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://*.githubusercontent.com 'unsafe-inline';");
// 輸出網頁
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XSS + CSP Demo</title>
</head>
<body>
    <h1>Hi, <?php echo $user; ?>!</h1>
    <p>
        這個範例設定了部分 CSP，但容許從外部 (gist.githubusercontent.com) 載入腳本。<br>
        檔案：
    </p>
    
    https://gist.githubusercontent.com/fei3363/95f42db50058056013cbcbe6e34a3547/raw/d4270410abb16d1e3302be4af38cfa6c56db0cfa/test.js

    <form method="GET">
        <input type="text" name="user" placeholder="Enter your name" value="">
        <button>Submit</button>
    </form>
</body>
</html>
