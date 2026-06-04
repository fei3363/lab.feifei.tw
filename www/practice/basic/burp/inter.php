<?php
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["changeMe"])){
    $input_changeMe = $_GET["changeMe"];
    $header_check = $_SERVER['HTTP_X_REQUEST_INTERCEPTED'];
    if($header_check==true && $input_changeMe=="Happy Meow"){
        echo 'flag{You_can_use_burp_suite}';
    }else if(isset($header_check)==FALSE){
        echo '請加上指定標頭 x-request-intercepted: true';
    }else{
        echo '請確認 ?changeMe= 的指定內容 記得空白會被解析成 +';
    }

}else if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo '請使用 GET 完成題目需求';
}else if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo '請加上 ?changeMe= 指定內容 記得空白會被解析成 +';
}
?>