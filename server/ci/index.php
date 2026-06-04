<?php

if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if( isset( $_REQUEST[ 'string' ]  ) ) {
    $target = $_REQUEST[ 'string' ];
    // $cmd = shell_exec('echo '.$_GET['string']);
    $cmd = shell_exec('ls -al '.$_GET['string']);
    echo "<pre>{$cmd}</pre>";
}
?>
<a href='?src'>Source Code</a>
