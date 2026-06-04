<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>第二堂課 - PHP 版本教學網頁</title>
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
            padding: 40px 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            background: white;
            padding: 50px 30px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            margin-bottom: 40px;
        }
        
        .header h1 {
            color: #667eea;
            font-size: 42px;
            margin-bottom: 15px;
        }
        
        .header .subtitle {
            color: #666;
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .header .info {
            color: #999;
            font-size: 16px;
        }
        
        .header .php-badge {
            display: inline-block;
            background: #777bb4;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }
        
        .section h2 {
            color: #667eea;
            font-size: 28px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
        }
        
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            padding: 25px;
            transition: all 0.3s;
            cursor: pointer;
            border: 3px solid transparent;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border-color: #667eea;
        }
        
        .card.vulnerable {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        }
        
        .card.practice {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }
        
        .card-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .card-desc {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .card-tag {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .tag-danger {
            background: #ff7675;
            color: white;
        }
        
        .tag-practice {
            background: #fdcb6e;
            color: #2d3436;
        }
        
        .warning-box {
            background: #fff3cd;
            border: 3px solid #ffc107;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            color: #856404;
        }
        
        .warning-box h3 {
            color: #d32f2f;
            margin-bottom: 10px;
            font-size: 20px;
        }
        
        .info-box {
            background: #e3f2fd;
            border: 3px solid #2196f3;
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            color: #0c5460;
        }
        
        .info-box h3 {
            color: #1565c0;
            margin-bottom: 10px;
            font-size: 20px;
        }
        
        .info-box ul {
            margin-left: 20px;
            margin-top: 10px;
        }
        
        .info-box li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
        
        a {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .setup-box {
            background: #f3e5f5;
            border: 3px solid #9c27b0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .setup-box h3 {
            color: #9c27b0;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .setup-box code {
            background: #2d2d2d;
            color: #4caf50;
            padding: 15px;
            border-radius: 8px;
            display: block;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
        }
        
        .footer {
            text-align: center;
            color: white;
            margin-top: 40px;
            padding: 20px;
        }
        
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 第二堂課教學網頁</h1>
            <p class="subtitle">使用開發者工具看網站 & 入門漏洞示範</p>
            <p class="info">網站安全工作坊 - 第三期 | 2025/10/27</p>
            <span class="php-badge">🐘 PHP 版本 - 真正可執行的 XSS</span>
        </div>


        
        <div class="warning-box">
            <h3>⚠️ 重要聲明</h3>
            <p><strong>這些 PHP 網頁包含真正的 XSS 漏洞，可以實際執行惡意腳本！</strong></p>
            <p>所有示範的漏洞網頁都是為了教學目的而設計。請勿在未經授權的網站上使用這些技術。
            未經授權的攻擊行為是違法的，可能會受到法律制裁。</p>
        </div>
        
<!-- 開發者工具教學 -->
        <div class="section">
            <h2>🛠️ 開發者工具教學</h2>
            <div class="cards">
                <a href="7_devtools_tutorial.html" target="_blank">
                    <div class="card tutorial">
                        <div class="card-icon">🔧</div>
                        <div class="card-title">開發者工具完整教學</div>
                        <div class="card-desc">
                            學習使用瀏覽器開發者工具的各個面板：Elements、Console、Network、Application、Sources。包含實作練習和任務指導。
                        </div>
                        <span class="card-tag tag-tutorial">互動教學</span>
                    </div>
                </a>
            </div>
        </div>


        <div class="setup-box">
            <h3>🚀 如何執行 PHP 網頁？</h3>
            <p><strong>方法一：使用 PHP 內建伺服器（推薦）</strong></p>
            <code>cd 網頁所在目錄<br>php -S localhost:8000</code>
            <p style="margin-top: 10px;">然後在瀏覽器開啟：<strong>http://localhost:8000</strong></p>
            
            <p style="margin-top: 20px;"><strong>方法二：使用 XAMPP 或 MAMP</strong></p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>將 PHP 文件放到 htdocs 資料夾</li>
                <li>啟動 Apache 伺服器</li>
                <li>在瀏覽器開啟 http://localhost/檔案名稱.php</li>
            </ul>
        </div>
        
        <!-- XSS 漏洞示範 -->
        <div class="section">
            <h2>🔓 XSS 漏洞示範（PHP 版本）</h2>
            <p style="margin-bottom: 20px; color: #666;">這些頁面使用 PHP 後端處理，能夠真正執行 XSS 攻擊</p>
            <div class="cards">
                <a href="1_vulnerable_search.php" target="_blank">
                    <div class="card vulnerable">
                        <div class="card-icon">🔍</div>
                        <div class="card-title">1. 搜尋頁面（Reflected XSS）</div>
                        <div class="card-desc">
                            PHP 從表單接收輸入，直接 echo 到 HTML 中，沒有任何過濾。
                            展示真實的反射型 XSS 攻擊。
                        </div>
                        <span class="card-tag tag-danger">⚠️ 有漏洞 - PHP</span>
                    </div>
                </a>
                
                <a href="3_vulnerable_guestbook.php" target="_blank">
                    <div class="card vulnerable">
                        <div class="card-icon">💬</div>
                        <div class="card-title">3. 留言板（Stored XSS）</div>
                        <div class="card-desc">
                            使用檔案系統儲存留言，每次載入頁面都會從檔案讀取並直接顯示，
                            造成持久性的 XSS 攻擊。
                        </div>
                        <span class="card-tag tag-danger">⚠️ 有漏洞 - PHP</span>
                    </div>
                </a>
                
                <a href="5_dom_based_xss.php" target="_blank">
                    <div class="card vulnerable">
                        <div class="card-icon">🌐</div>
                        <div class="card-title">5. DOM-based XSS</div>
                        <div class="card-desc">
                            展示兩種方式：PHP 伺服器端直接輸出 URL 參數，以及 JavaScript 
                            前端操作 DOM。完整呈現 DOM-based XSS 的原理。
                        </div>
                        <span class="card-tag tag-danger">⚠️ 有漏洞 - PHP+JS</span>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- 綜合練習 -->
        <div class="section">
            <h2>🎯 綜合練習場</h2>
            <div class="cards">
                <a href="6_xss_practice.php" target="_blank">
                    <div class="card practice">
                        <div class="card-icon">🎪</div>
                        <div class="card-title">6. XSS 練習場（PHP 版本）</div>
                        <div class="card-desc">
                            包含 6 個不同難度的練習題，全部使用 PHP 處理。學生可以實際測試
                            各種 XSS Payload，並觀察真實的攻擊效果。練習四使用 Session 儲存留言。
                        </div>
                        <span class="card-tag tag-practice">🏋️ 綜合練習 - PHP</span>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- 為什麼 PHP 版本可以成功執行 XSS -->
        <div class="info-box" style="background: #fff3e0; border-color: #ff9800;">
            <h3 style="color: #e65100;">💡 為什麼 PHP 版本可以成功執行 XSS？</h3>
            <ul>
                <li><strong>伺服器端渲染：</strong>PHP 在伺服器端處理請求並生成 HTML，瀏覽器接收到的是完整的 HTML</li>
                <li><strong>無安全限制：</strong>不像純前端 JavaScript 會受到瀏覽器的安全策略限制（如 CSP）</li>
                <li><strong>直接輸出：</strong>使用 echo 直接輸出使用者輸入，惡意腳本被包含在 HTML 中</li>
                <li><strong>真實情境：</strong>這更接近真實世界中的 Web 應用程式運作方式</li>
            </ul>
        </div>
        
        <!-- 使用說明 -->
        <div class="info-box">
            <h3>📖 使用說明</h3>
            <ul>
                <li><strong>環境需求：</strong>需要 PHP 7.0 或更高版本</li>
                <li><strong>檔案權限：</strong>留言板會在同一目錄建立 messages.json 文件，請確保有寫入權限</li>
                <li><strong>測試建議：</strong>建議在本地端測試，不要部署到公開網路</li>
                <li><strong>清理資料：</strong>測試完成後記得刪除 messages.json 文件</li>
                <li><strong>Session：</strong>練習場使用 PHP Session 儲存留言，關閉瀏覽器後會清除</li>
            </ul>
        </div>
        
        <!-- 測試 Payload -->
        <div class="info-box" style="background: #ffebee; border-color: #f44336;">
            <h3 style="color: #c62828;">🧪 常用測試 Payload</h3>
            <ul>
                <li><code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code> - 最基本的 XSS</li>
                <li><code>&lt;img src=x onerror=alert('XSS')&gt;</code> - 使用圖片標籤</li>
                <li><code>&lt;svg onload=alert('XSS')&gt;</code> - 使用 SVG 標籤</li>
                <li><code>&lt;iframe src="javascript:alert('XSS')"&gt;</code> - 使用 iframe</li>
                <li><code>&lt;body onload=alert(document.cookie)&gt;</code> - 竊取 Cookie</li>
            </ul>
        </div>
        
        <!-- 學習路徑 -->
        <div class="info-box" style="background: #e8f5e9; border-color: #4caf50; color: #2e7d32;">
            <h3 style="color: #2e7d32;">🎓 建議學習路徑</h3>
            <ul>
                <li><strong>第 1 步：</strong>架設 PHP 本地伺服器</li>
                <li><strong>第 2 步：</strong>測試「搜尋頁面」，理解 Reflected XSS 原理</li>
                <li><strong>第 3 步：</strong>測試「留言板」，觀察 Stored XSS 的持久性</li>
                <li><strong>第 4 步：</strong>測試「DOM-based XSS」，理解 URL 參數攻擊</li>
                <li><strong>第 5 步：</strong>到「練習場」完成所有 6 個練習</li>
                <li><strong>第 6 步：</strong>查看程式碼，理解防禦方法</li>
            </ul>
        </div>
        
        <div class="footer">
            <p><strong>網站安全工作坊 - 第三期（PHP 版本）</strong></p>
            <p>© 2025 | 僅供教學使用 | 需要 PHP 環境</p>
        </div>
    </div>
</body>
</html>
