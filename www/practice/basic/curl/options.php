<?php

if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
    header("Options: MEOW, GET, POST");
}else if($_SERVER["REQUEST_METHOD"] == "MEOW"){
    header("Flag: Flag{U_R_Cooooool_me0w_me0w!!!}");
}

echo $_SERVER["REQUEST_METHOD"];

?>