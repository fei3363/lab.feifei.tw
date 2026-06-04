<?php
    $limit_num=15;
    highlight_file(__FILE__);
    $cmd = $_GET['cmd'];
    if(strlen($cmd)<$limit_num){
        $output = shell_exec($cmd);
        echo "<pre>".$output."</pre>";
    }else{
        exit('too long');
    }
?>