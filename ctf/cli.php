<?php
function getFlag(){
    echo 'flag(123qsaaaaaa)';
}

if(isset($_GET['code'])){
    $code = $_GET[ 'code'];
    if(preg_match("/[A-Za-z0-0]+/" , $code)){
        die("no");
    }
    echo $code;
    eval($code);
}else{
    highlight_file(__FILE__);
}
