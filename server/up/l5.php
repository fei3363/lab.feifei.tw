<?php
if (isset($_POST["submit"])) {
    $file_name= $_FILES['file']['tmp_name'];
    $allow_ext = array('.jpg','.jpeg');
    $file_ext =  strrchr($_FILES['file']['name'],'.');
    if(in_array($file_ext,$allow_ext)){
        $uploaddir = 'upload/' ;
        if(file_exists("upload/".$_FILES["file"]["name"])){
            echo "檔案:".$_FILES["file"]["name"]."已經存在<br>"; 
            echo "無法儲存<br>"; 
        }else{
            move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
            echo "檔案儲存於：upload/".$_FILES["file"]["name"]."<br>"; 
        }
    }else{
        echo "此檔案類型禁止上傳<br>";
    }
}
?>

<html>
<head>
<meta charset="utf-8">
<title>白名單</title>
<body>
<h3>白名單+LFI 可能會有弱點</h3>
<form action="" method="post" enctype="multipart/form-data" name="upload">
上傳:<input type="file" name="file">
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>