<?php
session_start();

// 初始化留言板資料（使用 Session 模擬資料庫）
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}

// 處理有漏洞的留言提交
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'vulnerable_post') {
        $_SESSION['messages'][] = [
            'name' => $_POST['name'] ?? '匿名',
            'message' => $_POST['message'] ?? '',
            'time' => date('H:i:s'),
            'type' => 'vulnerable'
        ];
        header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=tab4');
        exit;
    }
    
    if ($_POST['action'] === 'safe_post') {
        $_SESSION['messages'][] = [
            'name' => htmlspecialchars($_POST['name'] ?? '匿名', ENT_QUOTES, 'UTF-8'),
            'message' => htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8'),
            'time' => date('H:i:s'),
            'type' => 'safe'
        ];
        header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=tab4');
        exit;
    }
    
    if ($_POST['action'] === 'clear_messages') {
        $_SESSION['messages'] = [];
        header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=tab4');
        exit;
    }
}

// 處理反射型 XSS 示範
$reflected_xss_demo = '';
if (isset($_GET['error']) && isset($_GET['demo'])) {
    // 有漏洞的版本
    $reflected_xss_demo = $_GET['error'];
}

// 處理搜尋功能
$search_query = $_GET['search'] ?? '';
$search_type = $_GET['search_type'] ?? '';

// 取得當前 Tab
$current_tab = $_GET['tab'] ?? 'tab1';
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS 跨站腳本攻擊互動式教學系統 (PHP 版)</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Microsoft JhengHei', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            text-align: center;
        }

        h1 {
            color: #f5576c;
            margin-bottom: 10px;
            font-size: 2.5em;
        }

        .subtitle {
            color: #666;
            font-size: 1.1em;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tab-button {
            padding: 15px 25px;
            background: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-decoration: none;
            color: #333;
            display: inline-block;
        }

        .tab-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        .tab-button.active {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .content-section {
            display: none;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .content-section.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #f5576c;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #f5576c;
        }

        h3 {
            color: #f093fb;
            margin: 25px 0 15px 0;
        }

        h4 {
            color: #666;
            margin: 15px 0 10px 0;
        }

        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            position: relative;
        }

        .code-block code {
            display: block;
            white-space: pre;
        }

        .keyword { color: #ff79c6; }
        .string { color: #f1fa8c; }
        .comment { color: #6272a4; font-style: italic; }
        .function { color: #8be9fd; }
        .tag { color: #ff79c6; }
        .attribute { color: #50fa7b; }
        .value { color: #f1fa8c; }

        .demo-box {
            background: #f7f9fc;
            border: 2px solid #f5576c;
            border-radius: 10px;
            padding: 25px;
            margin: 20px 0;
        }

        .vulnerable-demo {
            border-color: #ff4444;
            background: #fff5f5;
        }

        .safe-demo {
            border-color: #00c853;
            background: #f0fff4;
        }

        .input-group {
            margin: 15px 0;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .input-group input, .input-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
            font-family: 'Microsoft JhengHei', Arial, sans-serif;
        }

        .input-group input:focus, .input-group textarea:focus {
            outline: none;
            border-color: #f5576c;
        }

        .input-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s;
            margin: 5px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(245, 87, 108, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        }

        .btn-success {
            background: linear-gradient(135deg, #00c853 0%, #009624 100%);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
        }

        .result-box {
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            min-height: 80px;
        }

        .result-box.vulnerable {
            border-color: #ff4444;
            background: #fff5f5;
        }

        .result-box.safe {
            border-color: #00c853;
            background: #f0fff4;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }

        .alert-danger {
            background: #fff5f5;
            border-left: 4px solid #ff4444;
            color: #c53030;
        }

        .alert-success {
            background: #f0fff4;
            border-left: 4px solid #00c853;
            color: #0e7490;
        }

        .alert-warning {
            background: #fffbeb;
            border-left: 4px solid #ffa726;
            color: #92400e;
        }

        .alert-info {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            color: #1e40af;
        }

        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .two-column {
                grid-template-columns: 1fr;
            }
        }

        .tip-box {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 5px solid #f59e0b;
        }

        .tip-box strong {
            color: #92400e;
        }

        ul, ol {
            margin: 15px 0 15px 30px;
        }

        li {
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f5576c;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background: #f7f9fc;
        }

        .xss-preview {
            border: 3px dashed #f5576c;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            background: white;
            min-height: 100px;
        }

        .xss-preview h4 {
            color: #f5576c;
            margin-bottom: 10px;
        }

        .message-board {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            max-height: 400px;
            overflow-y: auto;
        }

        .message-item {
            padding: 12px;
            margin: 8px 0;
            background: #f7f9fc;
            border-radius: 6px;
            border-left: 3px solid #f5576c;
        }

        .message-item strong {
            color: #f5576c;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin: 0 5px;
        }

        .badge-reflected {
            background: #ff9800;
            color: white;
        }

        .badge-stored {
            background: #f44336;
            color: white;
        }

        .security-level {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .security-level.high-risk {
            background: #ff4444;
            color: white;
        }

        .comparison-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }

        .comparison-item {
            padding: 15px;
            border-radius: 8px;
        }

        .comparison-item.bad {
            background: #fff5f5;
            border: 2px solid #ff4444;
        }

        .comparison-item.good {
            background: #f0fff4;
            border: 2px solid #00c853;
        }

        .practice-area {
            background: #f0f4f8;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🔐 XSS 跨站腳本攻擊互動式教學 (PHP 版)</h1>
            <p class="subtitle">從 JavaScript 基礎到 XSS 防護完全指南</p>
        </header>

        <div class="tabs">
            <a href="?tab=tab1" class="tab-button <?php echo $current_tab === 'tab1' ? 'active' : ''; ?>">📖 JavaScript 基礎</a>
            <a href="?tab=tab2" class="tab-button <?php echo $current_tab === 'tab2' ? 'active' : ''; ?>">⚠️ XSS 成因</a>
            <a href="?tab=tab3" class="tab-button <?php echo $current_tab === 'tab3' ? 'active' : ''; ?>">🔴 反射型 XSS</a>
            <a href="?tab=tab4" class="tab-button <?php echo $current_tab === 'tab4' ? 'active' : ''; ?>">💾 儲存型 XSS</a>
            <a href="?tab=tab5" class="tab-button <?php echo $current_tab === 'tab5' ? 'active' : ''; ?>">🌐 PHP 防護實作</a>
        </div>

        <!-- Tab 1: JavaScript 基礎 -->
        <div id="tab1" class="content-section <?php echo $current_tab === 'tab1' ? 'active' : ''; ?>">
            <h2>📖 JavaScript 基礎：DOM 與 BOM</h2>

            <div class="alert alert-info">
                <strong>💡 為什麼要學 JavaScript？</strong><br>
                XSS 攻擊的核心就是注入惡意的 JavaScript 程式碼。了解 JavaScript 如何操作網頁，才能理解 XSS 的威力和危險性。
            </div>

            <h3>🔹 常用的 DOM 操作方法</h3>

            <div class="code-block">
<code><span class="comment">// 1. 選取元素</span>
<span class="keyword">document</span>.<span class="function">getElementById</span>(<span class="string">'title'</span>)
<span class="keyword">document</span>.<span class="function">querySelector</span>(<span class="string">'.content'</span>)

<span class="comment">// 2. 修改內容（危險！容易被 XSS 攻擊）</span>
element.<span class="attribute">innerHTML</span> = <span class="string">'&lt;b&gt;新內容&lt;/b&gt;'</span>      <span class="comment">// ⚠️ 會解析 HTML</span>
element.<span class="attribute">textContent</span> = <span class="string">'純文字'</span>         <span class="comment">// ✅ 不會解析 HTML</span></code>
            </div>

            <div class="demo-box">
                <h4>💡 互動練習：DOM 操作</h4>
                <div id="domPlayground" style="padding: 15px; background: #fff; border: 2px solid #ddd; border-radius: 8px; margin: 15px 0;">
                    <h3 id="playgroundTitle">原始標題</h3>
                    <p id="playgroundContent">這是一段文字內容</p>
                </div>

                <div class="input-group">
                    <label>輸入要設定的標題：</label>
                    <input type="text" id="domInput" placeholder="試試輸入：<b>粗體標題</b>">
                </div>

                <button class="btn btn-danger" onclick="setInnerHTML()">使用 innerHTML（不安全）</button>
                <button class="btn btn-success" onclick="setTextContent()">使用 textContent（安全）</button>

                <div class="alert alert-warning" style="margin-top: 15px;">
                    <strong>⚠️ 觀察差異：</strong><br>
                    innerHTML 會把 HTML 標籤解析出來，但也可能執行惡意程式碼！<br>
                    textContent 只會當作純文字，比較安全。
                </div>
            </div>

            <div class="tip-box">
                <strong>🎯 重點整理：</strong>
                <ul>
                    <li><strong>DOM</strong>：操作網頁「內容」（HTML 元素）</li>
                    <li><strong>BOM</strong>：操作瀏覽器「功能」（視窗、網址、Cookie）</li>
                    <li><strong>XSS 攻擊</strong>：利用這些功能來竊取資料或執行惡意操作</li>
                </ul>
            </div>
        </div>

        <!-- Tab 2: XSS 成因 -->
        <div id="tab2" class="content-section <?php echo $current_tab === 'tab2' ? 'active' : ''; ?>">
            <h2>⚠️ XSS（跨站腳本攻擊）成因</h2>

            <div class="alert alert-danger">
                <strong>🚨 什麼是 XSS？</strong><br>
                XSS (Cross-Site Scripting) 是一種網路攻擊，攻擊者將惡意的 JavaScript 程式碼注入到網頁中，當其他使用者瀏覽該網頁時，惡意程式碼就會被執行。
            </div>

            <h3>🔹 PHP 中的 XSS 漏洞</h3>

            <div class="comparison-box">
                <div class="comparison-item bad">
                    <h4>❌ 有漏洞的 PHP 程式碼</h4>
                    <div class="code-block">
<code><span class="comment">// 直接輸出使用者輸入</span>
<span class="keyword">&lt;?php</span>
<span class="keyword">echo</span> <span class="string">"歡迎, "</span> . <span class="keyword">$_GET</span>[<span class="string">'name'</span>];
<span class="keyword">?&gt;</span>

<span class="comment">// 搜尋結果</span>
<span class="keyword">&lt;?php</span>
<span class="keyword">$search</span> = <span class="keyword">$_GET</span>[<span class="string">'q'</span>];
<span class="keyword">echo</span> <span class="string">"搜尋結果: $search"</span>;
<span class="keyword">?&gt;</span></code>
                    </div>
                </div>

                <div class="comparison-item good">
                    <h4>✅ 安全的 PHP 程式碼</h4>
                    <div class="code-block">
<code><span class="comment">// 使用 htmlspecialchars 編碼</span>
<span class="keyword">&lt;?php</span>
<span class="keyword">$name</span> = <span class="function">htmlspecialchars</span>(
    <span class="keyword">$_GET</span>[<span class="string">'name'</span>], 
    ENT_QUOTES, 
    <span class="string">'UTF-8'</span>
);
<span class="keyword">echo</span> <span class="string">"歡迎, $name"</span>;
<span class="keyword">?&gt;</span></code>
                    </div>
                </div>
            </div>

            <h3>🔹 PHP 搜尋功能示範</h3>

            <div class="demo-box vulnerable-demo">
                <h4>⚠️ 有漏洞的搜尋（PHP 直接輸出）</h4>
                <form method="GET" action="">
                    <input type="hidden" name="tab" value="tab2">
                    <input type="hidden" name="search_type" value="vulnerable">
                    <div class="input-group">
                        <label>搜尋關鍵字：</label>
                        <input type="text" name="search" placeholder="試試輸入：<script>alert('XSS')</script>">
                    </div>
                    <button type="submit" class="btn btn-danger">🔍 搜尋（有漏洞）</button>
                </form>

                <?php if ($search_type === 'vulnerable' && !empty($search_query)): ?>
                <div class="result-box vulnerable">
                    <h4>搜尋結果：</h4>
                    <!-- 危險！直接輸出 -->
                    <p>你搜尋了：<?php echo $search_query; ?></p>
                </div>
                <?php endif; ?>
            </div>

            <div class="demo-box safe-demo">
                <h4>✅ 安全的搜尋（使用 htmlspecialchars）</h4>
                <form method="GET" action="">
                    <input type="hidden" name="tab" value="tab2">
                    <input type="hidden" name="search_type" value="safe">
                    <div class="input-group">
                        <label>搜尋關鍵字：</label>
                        <input type="text" name="search" placeholder="試試輸入一樣的攻擊內容">
                    </div>
                    <button type="submit" class="btn btn-success">🔍 搜尋（安全版）</button>
                </form>

                <?php if ($search_type === 'safe' && !empty($search_query)): ?>
                <div class="result-box safe">
                    <h4>搜尋結果：</h4>
                    <!-- 安全！使用 htmlspecialchars -->
                    <p>你搜尋了：<?php echo htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="alert alert-success">
                    <strong>✅ 為什麼安全？</strong><br>
                    使用 htmlspecialchars() 將特殊字元轉換：<br>
                    &lt; 變成 &amp;lt;<br>
                    &gt; 變成 &amp;gt;<br>
                    " 變成 &amp;quot;<br>
                    這樣 HTML 標籤就不會被執行！
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tab 3: 反射型 XSS -->
        <div id="tab3" class="content-section <?php echo $current_tab === 'tab3' ? 'active' : ''; ?>">
            <h2>🔴 反射型 XSS（Reflected XSS）</h2>

            <div class="alert alert-info">
                <strong>📖 什麼是反射型 XSS？</strong><br>
                惡意程式碼透過 URL 參數或表單提交，「立即反射」回網頁並執行。
                <span class="badge badge-reflected">反射型</span>
            </div>

            <h3>🔹 真實案例：錯誤訊息頁面</h3>

            <div class="demo-box vulnerable-demo">
                <h4>⚠️ 有漏洞的錯誤頁面</h4>
                <p>點擊下面的連結查看效果：</p>
                
                <div class="code-block">
<code><span class="comment">// 惡意 URL 範例</span>
?tab=tab3&demo=1&error=<span class="tag">&lt;script&gt;</span><span class="function">alert</span>(<span class="string">'XSS'</span>)<span class="tag">&lt;/script&gt;</span>

<span class="comment">// 或使用圖片標籤</span>
?tab=tab3&demo=1&error=<span class="tag">&lt;img src=x onerror=alert('XSS')&gt;</span></code>
                </div>

                <a href="?tab=tab3&demo=1&error=<script>alert('反射型XSS')</script>" class="btn btn-danger">
                    測試有漏洞版本
                </a>
                <a href="?tab=tab3&demo=1&error=<img src=x onerror=alert('XSS')>" class="btn btn-warning">
                    測試圖片攻擊
                </a>

                <?php if (isset($_GET['demo']) && isset($_GET['error'])): ?>
                <div class="xss-preview">
                    <h4>錯誤訊息：</h4>
                    <!-- 危險！直接輸出 -->
                    <div style="color: red; padding: 10px; border: 1px solid red;">
                        錯誤: <?php echo $_GET['error']; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="tip-box">
                <strong>🛡️ 防禦反射型 XSS：</strong>
                <ol>
                    <li><strong>永遠使用 htmlspecialchars()</strong></li>
                    <li><strong>設定正確的參數</strong>：ENT_QUOTES（轉換單引號和雙引號）、'UTF-8'</li>
                    <li><strong>輸入驗證</strong>：檢查資料格式</li>
                    <li><strong>Content Security Policy</strong>：設定 CSP Header</li>
                </ol>
            </div>
        </div>

        <!-- Tab 4: 儲存型 XSS -->
        <div id="tab4" class="content-section <?php echo $current_tab === 'tab4' ? 'active' : ''; ?>">
            <h2>💾 儲存型 XSS（Stored XSS）</h2>

            <div class="alert alert-danger">
                <strong>🚨 什麼是儲存型 XSS？</strong><br>
                惡意程式碼被永久儲存在伺服器上，每個瀏覽該內容的使用者都會受到攻擊。
                <span class="badge badge-stored">儲存型</span>
                <span class="security-level high-risk">高危險</span>
            </div>

            <h3>🔹 PHP 留言板示範</h3>

            <div class="demo-box vulnerable-demo">
                <h4>⚠️ 有漏洞的留言板（PHP Session 儲存）</h4>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="vulnerable_post">
                    <div class="input-group">
                        <label>你的名字：</label>
                        <input type="text" name="name" placeholder="輸入你的名字">
                    </div>
                    <div class="input-group">
                        <label>留言內容：</label>
                        <textarea name="message" placeholder="試試輸入：<img src=x onerror=alert('儲存型XSS')>"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">💬 發布留言（有漏洞）</button>
                    <button type="submit" name="action" value="clear_messages" class="btn">🗑️ 清空留言</button>
                </form>

                <div class="message-board">
                    <?php 
                    $vulnerable_messages = array_filter($_SESSION['messages'], function($msg) {
                        return $msg['type'] === 'vulnerable';
                    });
                    
                    if (empty($vulnerable_messages)): 
                    ?>
                        <p style="color: #999; text-align: center;">目前沒有留言</p>
                    <?php else: ?>
                        <?php foreach ($vulnerable_messages as $msg): ?>
                        <div class="message-item">
                            <!-- 危險！直接輸出 -->
                            <strong><?php echo $msg['name']; ?></strong> 
                            <span style="color: #999; font-size: 0.9em;"><?php echo $msg['time']; ?></span><br>
                            <?php echo $msg['message']; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="alert alert-danger">
                    <strong>⚠️ 危險！</strong><br>
                    這個留言板會執行任何 HTML/JavaScript 程式碼，所有訪客都會受到影響！
                </div>
            </div>

            <div class="demo-box safe-demo">
                <h4>✅ 安全的留言板</h4>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="safe_post">
                    <div class="input-group">
                        <label>你的名字：</label>
                        <input type="text" name="name" placeholder="輸入你的名字">
                    </div>
                    <div class="input-group">
                        <label>留言內容：</label>
                        <textarea name="message" placeholder="試試輸入一樣的攻擊內容"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">💬 發布留言（安全版）</button>
                </form>

                <div class="message-board">
                    <?php 
                    $safe_messages = array_filter($_SESSION['messages'], function($msg) {
                        return $msg['type'] === 'safe';
                    });
                    
                    if (empty($safe_messages)): 
                    ?>
                        <p style="color: #999; text-align: center;">目前沒有留言</p>
                    <?php else: ?>
                        <?php foreach ($safe_messages as $msg): ?>
                        <div class="message-item">
                            <!-- 安全！已經用 htmlspecialchars 編碼過 -->
                            <strong><?php echo $msg['name']; ?></strong> 
                            <span style="color: #999; font-size: 0.9em;"><?php echo $msg['time']; ?></span><br>
                            <?php echo $msg['message']; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="alert alert-success">
                    <strong>✅ 安全防護：</strong><br>
                    在儲存到 Session 之前，使用 htmlspecialchars() 編碼所有內容！
                </div>
            </div>
        </div>

        <!-- Tab 5: PHP 防護實作 -->
        <div id="tab5" class="content-section <?php echo $current_tab === 'tab5' ? 'active' : ''; ?>">
            <h2>🌐 PHP XSS 防護實作</h2>

            <div class="alert alert-info">
                <strong>📖 本章重點</strong><br>
                學習如何在 PHP 中實作完整的 XSS 防護機制
            </div>

            <h3>🔹 1. htmlspecialchars() 完整用法</h3>

            <div class="code-block">
<code><span class="comment">// 基本用法</span>
<span class="keyword">&lt;?php</span>
<span class="keyword">$safe</span> = <span class="function">htmlspecialchars</span>(<span class="keyword">$input</span>, ENT_QUOTES, <span class="string">'UTF-8'</span>);
<span class="keyword">?&gt;</span>

<span class="comment">// 參數說明：</span>
<span class="comment">// ENT_QUOTES - 轉換單引號和雙引號</span>
<span class="comment">// 'UTF-8' - 字元編碼</span>

<span class="comment">// 建立輔助函數</span>
<span class="keyword">&lt;?php</span>
<span class="keyword">function</span> <span class="function">h</span>(<span class="keyword">$str</span>) {
    <span class="keyword">return</span> <span class="function">htmlspecialchars</span>(<span class="keyword">$str</span>, ENT_QUOTES, <span class="string">'UTF-8'</span>);
}

<span class="comment">// 使用</span>
<span class="keyword">echo</span> <span class="function">h</span>(<span class="keyword">$_GET</span>[<span class="string">'name'</span>]);
<span class="keyword">?&gt;</span></code>
            </div>

            <h3>🔹 2. 輸入驗證</h3>

            <div class="code-block">
<code><span class="keyword">&lt;?php</span>
<span class="comment">// 驗證電子郵件</span>
<span class="keyword">if</span> (!<span class="function">filter_var</span>(<span class="keyword">$email</span>, FILTER_VALIDATE_EMAIL)) {
    <span class="keyword">die</span>(<span class="string">"無效的電子郵件"</span>);
}

<span class="comment">// 驗證整數</span>
<span class="keyword">$id</span> = <span class="function">filter_input</span>(INPUT_GET, <span class="string">'id'</span>, FILTER_VALIDATE_INT);

<span class="comment">// 驗證 URL</span>
<span class="keyword">if</span> (!<span class="function">filter_var</span>(<span class="keyword">$url</span>, FILTER_VALIDATE_URL)) {
    <span class="keyword">die</span>(<span class="string">"無效的 URL"</span>);
}

<span class="comment">// 白名單驗證</span>
<span class="keyword">$allowed_types</span> = [<span class="string">'user'</span>, <span class="string">'admin'</span>, <span class="string">'guest'</span>];
<span class="keyword">if</span> (!<span class="function">in_array</span>(<span class="keyword">$type</span>, <span class="keyword">$allowed_types</span>)) {
    <span class="keyword">die</span>(<span class="string">"無效的類型"</span>);
}
<span class="keyword">?&gt;</span></code>
            </div>

            <h3>🔹 3. Content Security Policy (CSP)</h3>

            <div class="code-block">
<code><span class="keyword">&lt;?php</span>
<span class="comment">// 設定 CSP Header</span>
<span class="function">header</span>(<span class="string">"Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:;"</span>);

<span class="comment">// 或更嚴格的設定</span>
<span class="function">header</span>(<span class="string">"Content-Security-Policy: default-src 'none'; script-src 'self'; style-src 'self'; img-src 'self';"</span>);
<span class="keyword">?&gt;</span></code>
            </div>

            <h3>🔹 4. HttpOnly Cookie</h3>

            <div class="code-block">
<code><span class="keyword">&lt;?php</span>
<span class="comment">// 設定安全的 Cookie</span>
<span class="function">setcookie</span>(
    <span class="string">'session_id'</span>,
    <span class="keyword">$session_id</span>,
    [
        <span class="string">'expires'</span> => <span class="function">time</span>() + 3600,
        <span class="string">'path'</span> => <span class="string">'/'</span>,
        <span class="string">'domain'</span> => <span class="string">''</span>,
        <span class="string">'secure'</span> => <span class="keyword">true</span>,      <span class="comment">// 只在 HTTPS</span>
        <span class="string">'httponly'</span> => <span class="keyword">true</span>,    <span class="comment">// 防止 JS 讀取</span>
        <span class="string">'samesite'</span> => <span class="string">'Strict'</span>  <span class="comment">// 防止 CSRF</span>
    ]
);
<span class="keyword">?&gt;</span></code>
            </div>

            <h3>🔹 5. 完整的安全函數庫</h3>

            <div class="code-block">
<code><span class="keyword">&lt;?php</span>
<span class="keyword">class</span> <span class="function">SecurityHelper</span> {
    
    <span class="comment">// HTML 編碼</span>
    <span class="keyword">public static function</span> <span class="function">escape</span>(<span class="keyword">$str</span>) {
        <span class="keyword">return</span> <span class="function">htmlspecialchars</span>(<span class="keyword">$str</span>, ENT_QUOTES, <span class="string">'UTF-8'</span>);
    }
    
    <span class="comment">// 移除所有 HTML 標籤</span>
    <span class="keyword">public static function</span> <span class="function">stripTags</span>(<span class="keyword">$str</span>) {
        <span class="keyword">return</span> <span class="function">strip_tags</span>(<span class="keyword">$str</span>);
    }
    
    <span class="comment">// 驗證並清理 URL</span>
    <span class="keyword">public static function</span> <span class="function">sanitizeUrl</span>(<span class="keyword">$url</span>) {
        <span class="keyword">$url</span> = <span class="function">filter_var</span>(<span class="keyword">$url</span>, FILTER_SANITIZE_URL);
        <span class="keyword">if</span> (!<span class="function">filter_var</span>(<span class="keyword">$url</span>, FILTER_VALIDATE_URL)) {
            <span class="keyword">return</span> <span class="keyword">false</span>;
        }
        <span class="keyword">return</span> <span class="keyword">$url</span>;
    }
    
    <span class="comment">// 產生 CSRF Token</span>
    <span class="keyword">public static function</span> <span class="function">generateToken</span>() {
        <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="keyword">$_SESSION</span>[<span class="string">'csrf_token'</span>])) {
            <span class="keyword">$_SESSION</span>[<span class="string">'csrf_token'</span>] = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(32));
        }
        <span class="keyword">return</span> <span class="keyword">$_SESSION</span>[<span class="string">'csrf_token'</span>];
    }
    
    <span class="comment">// 驗證 CSRF Token</span>
    <span class="keyword">public static function</span> <span class="function">verifyToken</span>(<span class="keyword">$token</span>) {
        <span class="keyword">return</span> <span class="function">isset</span>(<span class="keyword">$_SESSION</span>[<span class="string">'csrf_token'</span>]) && 
               <span class="function">hash_equals</span>(<span class="keyword">$_SESSION</span>[<span class="string">'csrf_token'</span>], <span class="keyword">$token</span>);
    }
}
<span class="keyword">?&gt;</span></code>
            </div>

            <div class="tip-box">
                <strong>🎯 PHP XSS 防護檢查清單：</strong>
                <ol>
                    <li>✅ 所有輸出都使用 htmlspecialchars()</li>
                    <li>✅ 使用 ENT_QUOTES 和 UTF-8 參數</li>
                    <li>✅ 輸入驗證（filter_var, filter_input）</li>
                    <li>✅ 使用白名單而非黑名單</li>
                    <li>✅ 設定 Content Security Policy</li>
                    <li>✅ Cookie 設定 HttpOnly 和 Secure</li>
                    <li>✅ 使用 prepared statements 防止 SQL Injection</li>
                    <li>✅ 定期更新 PHP 版本</li>
                </ol>
            </div>

            <div class="alert alert-info">
                <strong>📚 延伸學習資源：</strong>
                <ul>
                    <li><strong>OWASP PHP Security Cheat Sheet</strong></li>
                    <li><strong>PHP.net Security</strong> - 官方安全文件</li>
                    <li><strong>Symfony Security Component</strong> - 企業級安全框架</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // DOM 操作示範
        function setInnerHTML() {
            const input = document.getElementById('domInput').value;
            document.getElementById('playgroundTitle').innerHTML = input;
            alert('⚠️ 使用 innerHTML - 如果輸入 <script> 標籤可能會有危險！');
        }

        function setTextContent() {
            const input = document.getElementById('domInput').value;
            document.getElementById('playgroundTitle').textContent = input;
            alert('✅ 使用 textContent - 所有內容都會被當作純文字，安全！');
        }
    </script>
</body>
</html>