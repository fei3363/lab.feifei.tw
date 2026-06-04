<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    echo var_dump($_POST);
}else if($_SERVER['REQUEST_METHOD'] == "GET"){
    echo var_dump($_GET);
}

?>