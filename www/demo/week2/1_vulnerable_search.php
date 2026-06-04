<?php
// 1_vulnerable_search.php - Reflected XSS 示範（不安全）
// ⚠️ 這個頁面故意包含 XSS 漏洞，僅供教學使用！

$searchKeyword = '';
$showResult = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['q'])) {
    // 從 POST 或 GET 取得搜尋關鍵字
    $searchKeyword = $_POST['search'] ?? $_GET['q'] ?? '';
    $showResult = true;
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜尋頁面 - Reflected XSS 漏洞示範</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Microsoft JhengHei', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
        }
        
        .warning {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #856404;
        }
        
        .warning strong {
            color: #d32f2f;
        }
        
        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        input[type="text"] {
            flex: 1;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button {
            padding: 15px 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #5568d3;
        }
        
        .result {
            background: #f5f5f5;
            border-radius: 10px;
            padding: 20px;
            min-height: 100px;
            <?php if (!$showResult) echo 'display: none;'; ?>
        }
        
        .result-title {
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .result-content {
            color: #666;
            line-height: 1.6;
        }
        
        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            overflow-x: auto;
        }
        
        .code-block .comment {
            color: #75715e;
        }
        
        .code-block .keyword {
            color: #f92672;
        }
        
        .code-block .string {
            color: #e6db74;
        }
        
        .payload-box {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .payload-box strong {
            color: #1565c0;
        }
        
        .payload-box code {
            background: white;
            padding: 5px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning">
            <strong>⚠️ 警告：</strong> 這是一個有 Reflected XSS 漏洞的不安全網頁，僅供教學使用！
        </div>
        
        <h1>🔍 搜尋頁面（PHP 版本）</h1>
        <p class="subtitle">Reflected XSS 漏洞示範 - 使用 PHP 後端處理</p>
        
        <form method="POST" action="">
            <div class="search-box">
                <input type="text" name="search" placeholder="請輸入搜尋關鍵字..." value="<?php echo htmlspecialchars($_POST['search'] ?? '', ENT_QUOTES); ?>" />
                <button type="submit">搜尋</button>
            </div>
        </form>
        
        <?php if ($showResult): ?>
        <div class="result">
            <div class="result-title">搜尋結果：</div>
            <div class="result-content">
                <!-- ❌ 危險！直接輸出使用者輸入，沒有任何過濾 -->
                你搜尋了：<strong><?php echo $searchKeyword; ?></strong>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="code-block">
<span class="comment">// PHP 不安全的程式碼（有 XSS 漏洞）</span>
<span class="keyword">$searchKeyword</span> = <span class="keyword">$_POST</span>[<span class="string">'search'</span>];

<span class="comment">// ❌ 危險！直接 echo 使用者輸入</span>
<span class="keyword">echo</span> <span class="string">"你搜尋了：&lt;strong&gt;"</span> . <span class="keyword">$searchKeyword</span> . <span class="string">"&lt;/strong&gt;"</span>;

<span class="comment">// ✅ 安全做法應該要用：</span>
<span class="comment">// echo htmlspecialchars($searchKeyword, ENT_QUOTES, 'UTF-8');</span>
        </div>
        
        <div class="payload-box">
            <strong>🧪 測試 Payload：</strong><br>
            試試在搜尋框輸入以下內容：<br>
            <code>&lt;script&gt;alert('XSS 成功！')&lt;/script&gt;</code><br>
            <code>&lt;img src=x onerror=alert('XSS')&gt;</code><br>
            <code>&lt;svg onload=alert('XSS')&gt;</code><br>
            <code>&lt;body onload=alert('XSS')&gt;</code>
        </div>
        
        <div style="margin-top: 20px; padding: 15px; background: #ffebee; border-radius: 10px; font-size: 13px; color: #c62828;">
            <strong>⚠️ 為什麼 PHP 版本可以成功執行 XSS？</strong><br>
            因為 PHP 在伺服器端處理並輸出 HTML，瀏覽器接收到的就是包含惡意腳本的完整 HTML，
            不像純前端 JavaScript 操作 DOM 時會受到瀏覽器的安全限制。
        </div>
    </div>
</body>
</html>
