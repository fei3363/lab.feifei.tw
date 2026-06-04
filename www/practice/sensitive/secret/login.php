<?php
$post_values = file_get_contents("php://input");
$post_array = json_decode($post_values, true);

if($post_array['username']=="S0meUs1rn@m1" && $post_array['password']=="p@5S_w0rd"){
    echo "登入成功!";
}else{
    echo "登入失敗!";
}


?>