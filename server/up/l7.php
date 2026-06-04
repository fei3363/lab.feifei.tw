<?php
if (isset($_POST["submit"])) {
    $file_name= $_FILES['file']['tmp_name'];
    $allow_ext = array('image/png', 'image/gif', 'image/jpeg', 'image/bmp');
    $file_ext =  strrchr($_FILES['file']['name'],'.');
    if( move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"])){
        if(in_array($file_ext,$allow_ext)){
            echo "檔案儲存於：upload/".$_FILES["file"]["name"]."<br>"; 
        }else{
            sleep(5);
            unlink("upload/".$_FILES["file"]["name"]);
        }

    }


}
?>

<html>
<head>
<meta charset="utf-8">
<title>條件競爭</title>
<body>
<h3>條件競爭</h3>
<form action="" method="post" enctype="multipart/form-data" name="upload">
上傳:<input type="file" name="file">
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>