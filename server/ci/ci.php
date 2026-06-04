<?php


if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if( isset( $_REQUEST[ 'ip' ]  ) ) {
$target = $_REQUEST[ 'ip' ];
$cmd = shell_exec( 'ping  -c 4 ' . $target );
echo "<pre>{$cmd}</pre>";
}

?>
<a href='?src'>Source Code</a>
