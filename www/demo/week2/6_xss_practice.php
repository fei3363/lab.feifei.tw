<?php
// 6_xss_practice.php - XSS 綜合練習場（PHP 版本）
// ⚠️ 這個頁面故意包含多個 XSS 漏洞，僅供教學使用！

// 初始化變數
$exercise1 = $_POST['name1'] ?? '';
$exercise2 = $_POST['imageUrl'] ?? '';
$exercise3 = $_POST['search3'] ?? '';
$exercise5 = $_POST['bypass5'] ?? '';
$exercise6 = $_POST['safe6'] ?? '';

// 練習四：留言板（使用 session）
session_start();
if (!isset($_SESSION['comments'])) {
    $_SESSION['comments'] = [];
}

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'add_comment') {
        $_SESSION['comments'][] = [
            'text' => $_POST['comment4'] ?? '',
            'time' => date('Y-m-d H:i:s')
        ];
    } elseif ($_POST['action'] === 'clear_comments') {
        $_SESSION['comments'] = [];
    }
}

// 練習五：簡單過濾
$filtered5 = '';
if (!empty($exercise5)) {
    $filtered5 = str_ireplace('script', '', $exercise5);
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS 練習場 - PHP 版本</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Microsoft JhengHei', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .header h1 {
            color: #00b4db;
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 16px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }
        
        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .card-icon {
            font-size: 32px;
            margin-right: 15px;
        }
        
        .card-title {
            color: #333;
            font-size: 20px;
            font-weight: bold;
        }
        
        .card-subtitle {
            color: #999;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .difficulty {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .difficulty.easy {
            background: #c8e6c9;
            color: #2e7d32;
        }
        
        .difficulty.medium {
            background: #fff9c4;
            color: #f57f17;
        }
        
        .difficulty.hard {
            background: #ffcdd2;
            color: #c62828;
        }
        
        .card-content {
            color: #555;
            line-height: 1.8;
            margin: 15px 0;
        }
        
        .input-area {
            margin: 15px 0;
        }
        
        .input-area label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        
        .input-area input[type="text"],
        .input-area textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Arial', 'Microsoft JhengHei', sans-serif;
        }
        
        .input-area textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: #00b4db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        button:hover {
            background: #008fb3;
        }
        
        .btn-clear {
            background: #e53935;
        }
        
        .btn-clear:hover {
            background: #c62828;
        }
        
        .result-area {
            margin-top: 15px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
            min-height: 60px;
        }
        
        .hint {
            background: #e3f2fd;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 13px;
            color: #1565c0;
        }
        
        .hint strong {
            display: block;
            margin-bottom: 5px;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #666;
            background: white;
            padding: 20px;
            border-radius: 15px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎯 XSS 練習場（PHP 版本）</h1>
        <p>透過實際操作學習 XSS 漏洞與防禦技巧</p>
    </div>
    
    <div class="container">
        <!-- 練習一：簡單反射型 XSS -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">🎪</div>
                <div>
                    <div class="card-title">練習一：名字顯示</div>
                    <div class="card-subtitle">Reflected XSS</div>
                    <div class="difficulty easy">簡單</div>
                </div>
            </div>
            <div class="card-content">
                <p>請輸入你的名字，系統會顯示歡迎訊息。</p>
                <p><strong>目標：</strong>嘗試注入 XSS Payload。</p>
            </div>
            <form method="POST">
                <div class="input-area">
                    <label>你的名字：</label>
                    <input type="text" name="name1" placeholder="請輸入名字..." />
                    <button type="submit">送出</button>
                </div>
            </form>
            <?php if (!empty($exercise1)): ?>
            <div class="result-area">
                <!-- ❌ 不安全 -->
                👋 歡迎，<strong><?php echo $exercise1; ?></strong>！
            </div>
            <?php endif; ?>
            <div class="hint">
                <strong>💡 提示：</strong>
                試試輸入 <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code>
            </div>
        </div>
        
        <!-- 練習二：圖片標籤 XSS -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">🖼️</div>
                <div>
                    <div class="card-title">練習二：圖片網址</div>
                    <div class="card-subtitle">Image Tag XSS</div>
                    <div class="difficulty easy">簡單</div>
                </div>
            </div>
            <div class="card-content">
                <p>輸入圖片網址，系統會顯示圖片。</p>
                <p><strong>目標：</strong>使用 onerror 事件觸發 XSS。</p>
            </div>
            <form method="POST">
                <div class="input-area">
                    <label>圖片網址：</label>
                    <input type="text" name="imageUrl" placeholder="請輸入圖片 URL..." />
                    <button type="submit">顯示圖片</button>
                </div>
            </form>
            <?php if (!empty($exercise2)): ?>
            <div class="result-area">
                <!-- ❌ 不安全 -->
                <img src="<?php echo $exercise2; ?>" style="max-width: 100%; border-radius: 8px;" />
            </div>
            <?php endif; ?>
            <div class="hint">
                <strong>💡 提示：</strong>
                試試輸入 <code>x" onerror="alert('XSS')</code>
            </div>
        </div>
        
        <!-- 練習三：搜尋功能 -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">🔍</div>
                <div>
                    <div class="card-title">練習三：搜尋關鍵字</div>
                    <div class="card-subtitle">Search XSS</div>
                    <div class="difficulty medium">中等</div>
                </div>
            </div>
            <div class="card-content">
                <p>輸入搜尋關鍵字，系統會顯示搜尋結果。</p>
            </div>
            <form method="POST">
                <div class="input-area">
                    <label>搜尋關鍵字：</label>
                    <input type="text" name="search3" placeholder="請輸入關鍵字..." />
                    <button type="submit">搜尋</button>
                </div>
            </form>
            <?php if (!empty($exercise3)): ?>
            <div class="result-area">
                🔍 搜尋結果：<br>
                <!-- ❌ 不安全 -->
                <div style="margin-top: 10px;">你搜尋了：<?php echo $exercise3; ?></div>
            </div>
            <?php endif; ?>
            <div class="hint">
                <strong>💡 提示：</strong>
                試試 &lt;img&gt;、&lt;svg&gt; 等不同標籤
            </div>
        </div>
        
        <!-- 練習四：留言功能 -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">💬</div>
                <div>
                    <div class="card-title">練習四：留言板</div>
                    <div class="card-subtitle">Stored XSS</div>
                    <div class="difficulty medium">中等</div>
                </div>
            </div>
            <div class="card-content">
                <p>留言會被儲存在 Session 中。</p>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="add_comment">
                <div class="input-area">
                    <label>留言內容：</label>
                    <textarea name="comment4" placeholder="請輸入留言..."></textarea>
                    <button type="submit">送出留言</button>
                </div>
            </form>
            <div class="result-area">
                <div style="color: #333; font-weight: bold; margin-bottom: 10px;">
                    所有留言 (<?php echo count($_SESSION['comments']); ?>)：
                </div>
                <?php if (empty($_SESSION['comments'])): ?>
                    <div style="color: #999;">還沒有留言</div>
                <?php else: ?>
                    <?php foreach (array_reverse($_SESSION['comments']) as $comment): ?>
                        <div style="background: white; padding: 10px; border-radius: 5px; margin-bottom: 8px;">
                            <div style="font-size: 12px; color: #999;"><?php echo $comment['time']; ?></div>
                            <!-- ❌ 不安全 -->
                            <div style="margin-top: 5px;"><?php echo $comment['text']; ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="clear_comments">
                <button type="submit" class="btn-clear">清除所有留言</button>
            </form>
            <div class="hint">
                <strong>💡 提示：</strong>
                這是 Stored XSS，重新載入頁面仍會執行
            </div>
        </div>
        
        <!-- 練習五：繞過過濾 -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">🔐</div>
                <div>
                    <div class="card-title">練習五：繞過過濾</div>
                    <div class="card-subtitle">Bypass Filter</div>
                    <div class="difficulty hard">困難</div>
                </div>
            </div>
            <div class="card-content">
                <p>系統會過濾 "script" 字串。</p>
                <p><strong>目標：</strong>繞過過濾機制。</p>
            </div>
            <form method="POST">
                <div class="input-area">
                    <label>測試輸入：</label>
                    <input type="text" name="bypass5" placeholder="嘗試繞過過濾..." />
                    <button type="submit">測試</button>
                </div>
            </form>
            <?php if (!empty($exercise5)): ?>
            <div class="result-area">
                過濾後的結果：<br>
                <!-- ❌ 不安全的過濾 -->
                <div style="background: white; padding: 10px; border-radius: 5px; margin-top: 10px;">
                    <?php echo $filtered5; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="hint">
                <strong>💡 提示：</strong>
                &lt;script&gt; 被過濾了，試試 &lt;img&gt; 或 &lt;svg&gt;
            </div>
        </div>
        
        <!-- 練習六：安全實作 -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">🛡️</div>
                <div>
                    <div class="card-title">練習六：安全顯示</div>
                    <div class="card-subtitle">Security Practice</div>
                    <div class="difficulty medium">中等</div>
                </div>
            </div>
            <div class="card-content">
                <p>使用了適當的防護措施。</p>
            </div>
            <form method="POST">
                <div class="input-area">
                    <label>安全輸入：</label>
                    <textarea name="safe6" placeholder="隨便輸入什麼都不會被執行..."></textarea>
                    <button type="submit">安全顯示</button>
                </div>
            </form>
            <?php if (!empty($exercise6)): ?>
            <div class="result-area">
                ✅ 安全顯示：<br>
                <!-- ✅ 安全：使用 htmlspecialchars -->
                <div style="background: #c8e6c9; padding: 10px; border-radius: 5px; margin-top: 10px; color: #2e7d32;">
                    <?php echo htmlspecialchars($exercise6, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="hint">
                <strong>✅ 安全措施：</strong>
                使用 htmlspecialchars() 防止 XSS
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p><strong>⚠️ 重要提醒：</strong></p>
        <p>這些練習僅供教學使用，請勿在未經授權的網站上進行任何測試！</p>
        <p>PHP 版本能真正執行 XSS，請在安全的環境中練習。</p>
    </div>
</body>
</html>
