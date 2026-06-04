<?php
if ($_POST["file"]){
    $data = file_get_contents($_POST["file"]);
    $test = new SimpleXMLElement($data);
    echo $test->name;

}




?>


<form method="post" enctype="multipart/form-data">
    XML File: <input type="file" name="file_upload">
    <input type="submit">
</form>