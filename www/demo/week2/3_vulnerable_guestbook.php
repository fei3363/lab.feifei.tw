<?php
// 3_vulnerable_guestbook.php - Stored XSS 示範（不安全）
// ⚠️ 這個頁面故意包含 XSS 漏洞，僅供教學使用！

// 使用文件存儲留言（模擬資料庫）
$dataFile = __DIR__ . '/messages.json';

// 顯示訊息變數
$successMessage = '';
$errorMessage = '';

// 初始化留言陣列
$messages = [];
if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    if ($content) {
        $messages = json_decode($content, true) ?? [];
    }
}

// 處理新增留言
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $author = trim($_POST['author'] ?? '');
        $content = trim($_POST['content'] ?? '');
        
        if (!empty($author) && !empty($content)) {
            $newMessage = [
                'author' => $author,
                'content' => $content,
                'time' => date('Y-m-d H:i:s')
            ];
            $messages[] = $newMessage;
            
            // 嘗試寫入文件
            $result = file_put_contents($dataFile, json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            
            if ($result !== false) {
                $successMessage = '✅ 留言送出成功！';
            } else {
                $errorMessage = '❌ 無法儲存留言，請檢查檔案權限。';
            }
        } else {
            $errorMessage = '❌ 請填寫完整資料！';
        }
    } elseif ($_POST['action'] === 'clear') {
        $messages = [];
        if (file_exists($dataFile)) {
            unlink($dataFile);
        }
        $successMessage = '✅ 所有留言已清除！';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言板 - Stored XSS 漏洞示範</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Microsoft JhengHei', sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
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
            color: #f5576c;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Arial', 'Microsoft JhengHei', sans-serif;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #f5576c;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
        }
        
        button {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-submit {
            background: #f5576c;
            color: white;
        }
        
        .btn-submit:hover {
            background: #e04556;
        }
        
        .btn-clear {
            background: #6c757d;
            color: white;
        }
        
        .btn-clear:hover {
            background: #5a6268;
        }
        
        .messages {
            margin-top: 40px;
        }
        
        .messages h2 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #f5576c;
        }
        
        .message-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .message-author {
            font-weight: bold;
            color: #f5576c;
            font-size: 16px;
        }
        
        .message-time {
            color: #999;
            font-size: 12px;
        }
        
        .message-content {
            color: #333;
            line-height: 1.6;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
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
            background: #ffebee;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .payload-box h3 {
            color: #c62828;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .payload-box code {
            display: block;
            background: white;
            padding: 8px;
            border-radius: 5px;
            margin: 8px 0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning">
            <strong>⚠️ 警告：</strong> 這是一個有 Stored XSS 漏洞的不安全留言板，僅供教學使用！
        </div>
        
        <h1>💬 留言板（PHP 版本）</h1>
        <p class="subtitle">Stored XSS 漏洞示範 - 惡意腳本會被儲存到檔案中</p>
        
        <?php if ($successMessage): ?>
        <div style="background: #d4edda; border: 2px solid #28a745; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <?php echo $successMessage; ?>
        </div>
        <?php endif; ?>
        
        <?php if ($errorMessage): ?>
        <div style="background: #f8d7da; border: 2px solid #dc3545; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <?php echo $errorMessage; ?>
        </div>
        <?php endif; ?>
        
        <?php if (!file_exists($dataFile)): ?>
        <div style="background: #fff3cd; border: 2px solid #ffc107; color: #856404; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            ℹ️ <strong>首次使用：</strong>messages.json 文件會在第一次送出留言時自動建立。
        </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <input type="hidden" name="action" value="add">
            
            <div class="form-group">
                <label for="author">姓名：</label>
                <input type="text" id="author" name="author" placeholder="請輸入你的姓名" required />
            </div>
            
            <div class="form-group">
                <label for="content">留言內容：</label>
                <textarea id="content" name="content" placeholder="請輸入留言內容..." required></textarea>
            </div>
            
            <div class="btn-group">
                <button type="submit" class="btn-submit">📝 送出留言</button>
            </div>
        </form>
        
        <form method="POST" action="" style="margin-top: 10px;" onsubmit="return confirm('⚠️ 確定要清除所有留言嗎？這個動作無法復原！');">
            <input type="hidden" name="action" value="clear">
            <button type="submit" class="btn-clear">🗑️ 清除所有留言</button>
        </form>
        
        <div class="messages">
            <h2>📋 所有留言 (共 <?php echo count($messages); ?> 則)</h2>
            
            <?php if (empty($messages)): ?>
                <div class="empty-state">還沒有任何留言，快來留下第一則留言吧！</div>
            <?php else: ?>
                <?php foreach (array_reverse($messages) as $msg): ?>
                <div class="message-card">
                    <div class="message-header">
                        <!-- ❌ 危險！直接輸出使用者輸入的姓名 -->
                        <div class="message-author"><?php echo $msg['author']; ?></div>
                        <div class="message-time"><?php echo $msg['time']; ?></div>
                    </div>
                    <!-- ❌ 危險！直接輸出使用者輸入的留言內容 -->
                    <div class="message-content"><?php echo $msg['content']; ?></div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="code-block">
<span class="comment">// PHP 不安全的程式碼（Stored XSS）</span>
<span class="keyword">$newMessage</span> = [
    <span class="string">'author'</span> => <span class="keyword">$_POST</span>[<span class="string">'author'</span>],
    <span class="string">'content'</span> => <span class="keyword">$_POST</span>[<span class="string">'content'</span>]
];

<span class="comment">// 儲存到檔案（沒有過濾！）</span>
<span class="keyword">$messages</span>[] = <span class="keyword">$newMessage</span>;
file_put_contents(<span class="string">'messages.json'</span>, json_encode(<span class="keyword">$messages</span>));

<span class="comment">// 顯示留言時也沒有過濾</span>
<span class="keyword">echo</span> <span class="keyword">$msg</span>[<span class="string">'content'</span>];

<span class="comment">// ✅ 安全做法：</span>
<span class="comment">// echo htmlspecialchars($msg['content'], ENT_QUOTES, 'UTF-8');</span>
        </div>
        
        <div class="payload-box">
            <h3>🧪 測試 Stored XSS Payload：</h3>
            <p>在留言內容中輸入以下內容，送出後每次重新載入頁面都會執行：</p>
            <code>&lt;script&gt;alert('Stored XSS 攻擊成功！')&lt;/script&gt;</code>
            <code>&lt;img src=x onerror=alert('每次載入都會執行！')&gt;</code>
            <code>&lt;svg onload=alert('持久性 XSS')&gt;</code>
            <code>&lt;iframe src="javascript:alert('XSS')"&gt;&lt;/iframe&gt;</code>
        </div>
        
        <div style="margin-top: 20px; padding: 15px; background: #e3f2fd; border-radius: 10px; font-size: 13px; color: #1565c0;">
            <strong>💡 Stored XSS 的危險性：</strong><br>
            1. 惡意腳本被永久儲存在伺服器<br>
            2. 每個瀏覽該頁面的使用者都會受到攻擊<br>
            3. 可以竊取所有訪客的 Cookie 和敏感資訊<br>
            4. 攻擊者不需要誘騙受害者點擊連結<br>
            5. 影響範圍比 Reflected XSS 更大
        </div>
        
        <div style="margin-top: 20px; padding: 15px; background: #f5f5f5; border-radius: 10px; font-size: 13px;">
            <strong>🔧 除錯資訊：</strong><br>
            文件路徑：<code><?php echo $dataFile; ?></code><br>
            文件狀態：<?php echo file_exists($dataFile) ? '✅ 已存在' : '❌ 尚未建立'; ?><br>
            <?php if (file_exists($dataFile)): ?>
            文件權限：<?php echo substr(sprintf('%o', fileperms($dataFile)), -4); ?><br>
            文件大小：<?php echo filesize($dataFile); ?> bytes<br>
            <?php endif; ?>
            目前留言數：<?php echo count($messages); ?> 則<br>
            PHP 版本：<?php echo PHP_VERSION; ?>
        </div>
    </div>
</body>
</html>l