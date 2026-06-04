<?php
highlight_file(__FILE__);
$cmd = $_GET[ 'cmd'];
eval("\$ret = strtolower('$cmd');")
?>