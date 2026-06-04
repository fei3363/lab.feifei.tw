<?php

require("hello.php");//存在檔案


require("no.php");//不存在的檔案，require 噴 error 不會執行以下 

echo "Hello 結尾";

?>