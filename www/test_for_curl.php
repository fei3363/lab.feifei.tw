<?php
// 設定回應的 Content-Type
header('Content-Type: application/json');

// 取得 HTTP 方法
$method = $_SERVER['REQUEST_METHOD'];

// 建立統一的回傳格式
$response = [
    'method' => $method,
    'headers' => getallheaders(),
    'query' => $_GET,
    'post_data' => $_POST,
    'raw_input' => file_get_contents('php://input'),
    'timestamp' => date('Y-m-d H:i:s'),
];

// 特殊處理 TRACE 與 OPTIONS 方法
switch ($method) {
    case 'OPTIONS':
        header('Allow: GET, POST, PUT, DELETE, OPTIONS, TRACE, HEAD');
        break;

    case 'TRACE':
        // 回顯收到的請求內容
        header('Content-Type: message/http');
        echo $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . " HTTP/1.1\r\n";
        foreach (getallheaders() as $name => $value) {
            echo $name . ": " . $value . "\r\n";
        }
        echo "\r\n";
        echo file_get_contents('php://input');
        exit;

    case 'HEAD':
        // 不輸出內容，只保留標頭
        http_response_code(200);
        exit;

    default:
        // 對其餘方法輸出 JSON 回應
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;
}
?>
