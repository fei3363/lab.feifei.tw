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
        //move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
        echo "<h3>上傳成功</h3>";
        if ($_FILES["file"]["type"]=="application/octet-stream"){
            echo "<h3>flag{you_bypass_js}</h3>";
        }else{
            echo "請上傳 php 才拿得到 flag";
        }
        

        //echo "檔案儲存於：upload/".$_FILES["file"]["name"]."<br>"; 
        echo "<br><br>";
    }
    
}}?>


<head>
    <meta charset="utf-8">
    <title>前端驗證</title>
    <script type="text/javascript">
    function checkFile() {
        var file = document.getElementsByName('file')[0].value;
        if (file == null || file == "") {
            alert("尚未選擇檔案，無法進行上傳");
            return false;
        }
        var allow_ext = ".jpg|.jpeg|.png|.gif|.bmp|";
        var ext_name = file.substring(file.lastIndexOf("."));

        //判別是否能上傳
        if (allow_ext.indexOf(ext_name + "|") == -1) {
            var errMsg = "該檔案禁止上傳，請上傳" + allow_ext + "類型的檔案，\n目前檔案類型為" + ext_name;
            alert(errMsg);
            return false;
        }
    }
    </script>

<body>

    <form action="" method="post" enctype="multipart/form-data" name="upload" onsubmit="return checkFile()">
        <label for="file">檔案:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="submit" value="提交">
    </form>
</body>