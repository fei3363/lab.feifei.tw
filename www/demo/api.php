<?php
/**
 * RESTful API 範例 - 後端教學用（修正版）
 * 檔案名稱: api.php
 * 
 * 部署說明:
 * 1. 將此檔案上傳到支援 PHP 的伺服器
 * 2. 確保 Apache mod_rewrite 已啟用 (如需美化 URL)
 * 3. 訪問: https://yourdomain.com/demo/api.php
 */

// 設定 HTTP Headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");  // 允許跨域請求
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 自訂 Response Headers - FLAG 片段藏在這裡！
header("X-API-Version: 1.0");
header("X-Powered-By: KIWIS-Backend-Framework");
header("X-Secret-Message: KIWIS{B4ck3nd_");  // FLAG 第一部分
header("X-Developer: PHP-Master");

// 處理 OPTIONS 請求（CORS 預檢）
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 取得請求方法
$method = $_SERVER['REQUEST_METHOD'];

// 修正的路徑解析邏輯
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];

// 移除 query string
$request_path = parse_url($request_uri, PHP_URL_PATH);

// 移除 script name 本身，只保留後面的路徑
// 例如: /demo/api.php/users/1 -> /users/1
if (strpos($request_path, $script_name) === 0) {
    $path = substr($request_path, strlen($script_name));
} else {
    $path = $request_path;
}

// 清理路徑並分割
$path = trim($path, '/');
$path_parts = $path === '' ? [] : explode('/', $path);

// 模擬資料庫（實際應用中應該連接真實資料庫）
$users = [
    1 => [
        "id" => 1,
        "name" => "張小明",
        "email" => "ming@example.com",
        "role" => "管理員",
        "created_at" => "2024-01-15"
    ],
    2 => [
        "id" => 2,
        "name" => "李大華",
        "email" => "hua@example.com",
        "role" => "使用者",
        "created_at" => "2024-02-20"
    ],
    3 => [
        "id" => 3,
        "name" => "王美麗",
        "email" => "mei@example.com",
        "role" => "使用者",
        "created_at" => "2024-03-10"
    ]
];

// 路由處理
if (count($path_parts) === 0) {
    // 根路徑 - 顯示 API 說明文件
    echo json_encode([
        "success" => true,
        "message" => "歡迎使用 KIWIS Backend API",
        "version" => "1.0",
        "endpoints" => [
            "GET /users" => "取得所有使用者",
            "GET /users/{id}" => "取得指定使用者",
            "POST /users" => "新增使用者",
            "PUT /users/{id}" => "更新使用者",
            "DELETE /users/{id}" => "刪除使用者",
            "GET /flag" => "隱藏的 FLAG endpoint"
        ],
        "hint" => "檢查 Response Headers 找尋秘密訊息！",
        "debug_info" => [
            "request_uri" => $request_uri,
            "script_name" => $script_name,
            "parsed_path" => $path,
            "path_parts" => $path_parts
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

// 路由邏輯
$resource = $path_parts[0] ?? '';
$id = isset($path_parts[1]) ? intval($path_parts[1]) : null;

switch ($resource) {
    case 'users':
        handleUsers($method, $id, $users);
        break;
        
    case 'flag':
        handleFlag();
        break;
        
    default:
        sendResponse(404, false, "找不到此資源", [
            "requested_resource" => $resource,
            "available_resources" => ["users", "flag"]
        ]);
}

/**
 * 處理使用者相關的 API 請求
 */
function handleUsers($method, $id, &$users) {
    switch ($method) {
        case 'GET':
            if ($id === null) {
                // GET /users - 取得所有使用者
                sendResponse(200, true, "取得使用者清單成功", [
                    "users" => array_values($users),
                    "total" => count($users)
                ]);
            } else {
                // GET /users/{id} - 取得單一使用者
                if (isset($users[$id])) {
                    sendResponse(200, true, "取得使用者成功", [
                        "user" => $users[$id],
                        // FLAG 第二部分藏在這裡（Base64 編碼）
                        "_metadata" => [
                            "timestamp" => time(),
                            "request_id" => uniqid(),
                            "hint" => "這個 secret 欄位是 Base64 編碼，試著解碼它！",
                            "secret" => base64_encode("4P1_M45t3r}"),  // FLAG 第二部分
                            "decode_tip" => "使用 JavaScript 的 atob() 或 PHP 的 base64_decode()"
                        ]
                    ]);
                } else {
                    sendResponse(404, false, "使用者不存在");
                }
            }
            break;
            
        case 'POST':
            // POST /users - 新增使用者
            $input = json_decode(file_get_contents('php://input'), true);
            
            // 驗證輸入
            if (empty($input['name']) || empty($input['email'])) {
                sendResponse(400, false, "缺少必要欄位：name 和 email");
                return;
            }
            
            // 驗證 email 格式
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                sendResponse(400, false, "Email 格式不正確");
                return;
            }
            
            // 建立新使用者
            $new_id = max(array_keys($users)) + 1;
            $new_user = [
                "id" => $new_id,
                "name" => htmlspecialchars($input['name']),  // 防止 XSS
                "email" => $input['email'],
                "role" => $input['role'] ?? "使用者",
                "created_at" => date('Y-m-d H:i:s')
            ];
            
            $users[$new_id] = $new_user;
            
            sendResponse(201, true, "使用者建立成功", ["user" => $new_user]);
            break;
            
        case 'PUT':
            // PUT /users/{id} - 更新使用者
            if ($id === null) {
                sendResponse(400, false, "請提供使用者 ID");
                return;
            }
            
            if (!isset($users[$id])) {
                sendResponse(404, false, "使用者不存在");
                return;
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            
            // 更新欄位
            if (isset($input['name'])) {
                $users[$id]['name'] = htmlspecialchars($input['name']);
            }
            if (isset($input['email'])) {
                if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    $users[$id]['email'] = $input['email'];
                } else {
                    sendResponse(400, false, "Email 格式不正確");
                    return;
                }
            }
            if (isset($input['role'])) {
                $users[$id]['role'] = $input['role'];
            }
            
            sendResponse(200, true, "使用者更新成功", ["user" => $users[$id]]);
            break;
            
        case 'DELETE':
            // DELETE /users/{id} - 刪除使用者
            if ($id === null) {
                sendResponse(400, false, "請提供使用者 ID");
                return;
            }
            
            if (!isset($users[$id])) {
                sendResponse(404, false, "使用者不存在");
                return;
            }
            
            $deleted_user = $users[$id];
            unset($users[$id]);
            
            sendResponse(200, true, "使用者刪除成功", ["deleted_user" => $deleted_user]);
            break;
            
        default:
            sendResponse(405, false, "不支援的請求方法");
    }
}

/**
 * 處理隱藏的 FLAG endpoint
 */
function handleFlag() {
    sendResponse(200, true, "恭喜找到隱藏的 endpoint！", [
        "message" => "你已經接近答案了！",
        "hint_1" => "第一個 FLAG 片段在 Response Headers 中",
        "hint_2" => "查看 X-Secret-Message 這個自訂標頭",
        "hint_3" => "第二個片段在 GET /users/{id} 的回應中",
        "hint_4" => "它藏在 _metadata.secret 欄位（Base64 編碼）",
        "hint_5" => "組合方式: Header 片段 + 解碼後的 secret = 完整 FLAG",
        "example" => "KIWIS{B4ck3nd_ + 4P1_M45t3r} = KIWIS{B4ck3nd_4P1_M45t3r}",
        "tools" => [
            "開發者工具" => "按 F12 開啟，切換到 Network 分頁",
            "Base64 解碼" => "JavaScript: atob('編碼字串'), PHP: base64_decode('編碼字串')",
            "線上工具" => "https://www.base64decode.org/"
        ]
    ]);
}

/**
 * 統一的回應函式
 */
function sendResponse($code, $success, $message, $data = null) {
    http_response_code($code);
    
    $response = [
        "success" => $success,
        "message" => $message,
        "status_code" => $code
    ];
    
    if ($data !== null) {
        $response["data"] = $data;
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

/**
 * 錯誤處理
 */
function handleError($errno, $errstr, $errfile, $errline) {
    sendResponse(500, false, "伺服器內部錯誤", [
        "error" => $errstr,
        "file" => $errfile,
        "line" => $errline
    ]);
}

set_error_handler('handleError');
?>