<?php
if (isset($_POST["submit"])) {
if ($_FILES["file"]["error"]>0){
    echo "發生錯誤: ".$_FILES["file"]["error"]."<br>";
}else{

    echo "上傳檔案名稱：".$_FILES["file"]["name"]."<br>";
    echo "上傳檔案類型：".$_FILES["file"]["type"]."<br>";
    echo "上傳檔案大小：".($_FILES["file"]["size"]/1024)."kb<br>";
    echo "上傳檔案臨時儲存位置：".$_FILES["file"]["tmp_name"]."<br>";
    if(file_exists("upload/".$_FILES["file"]["name"])){
        echo "<h3>上傳失敗</h3>";
        echo "檔案:".$_FILES["file"]["name"]."已經存在<br>"; 
        echo "無法儲存<br><br>"; 
    }else{
        move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
        echo "<h3>上傳成功</h3>";
        echo "檔案儲存於：upload/".$_FILES["file"]["name"]."<br>"; 
        echo "<br><br>";
    }
    
}}?>

<html>

<head>
    <meta charset="utf-8">
    <title>檔案上傳</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">檔案:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="submit" value="提交">
    </form>
</body>
</htm1>