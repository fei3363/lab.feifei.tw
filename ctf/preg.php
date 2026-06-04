<?php
    highlight_file(__FILE__);
    $cmd = $_GET[ 'cmd'];
    preg_replace('/<data>(.*)<\/data>/e','$ret="\\1";',$cmd);
    ?>
