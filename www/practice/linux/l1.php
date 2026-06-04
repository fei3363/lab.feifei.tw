<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    $user_id = $_SESSION["id"];
    if($input_answer=="echo -n Hello"){
        $challenges_name = "Linux-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="ls -al" || $input_answer=="ls -la"){
        $challenges_name = "Linux-2";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="cat -n fei.txt"){
        $challenges_name = "Linux-3";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{good_job_to_touch_file}"){
        $challenges_name = "Linux-4";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="~"){
        $challenges_name = "Linux-5";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="root"){
        $challenges_name = "Linux-6";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="Flag{you_learned_export}"){
        $challenges_name = "Linux-7";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="460"){
        $challenges_name = "Linux-8";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="777"){
        $challenges_name = "Linux-9";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="cd ~"){
        $challenges_name = "Linux-10";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="sudo -u fei"){
        $challenges_name = "Linux-11";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else if($input_answer=="sudo apt install python3"){
        $challenges_name = "Linux-12";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }


}
$challenge_type =  $challenge_array[0];
$challenge_messange =  $challenge_array[1];
    

 
?>


<?php
    $titlename='Linux';
	include_once('../../php-inc/header.php');
?>






<h1>Linux</h1>

<b>以下 LAB 請於最下面的 flag 欄位填入答案。</b><br>
<br>
<h2>LAB1</h2>
指令 echo 中哪一個參數代表不需要換行<br>
請在答案輸入 echo -* Hello<br>
(找到參數後，將 * 取代成找到的參數)<br>

<br>

<h2>LAB2</h2>
指令 ls 中哪兩個參數代表<br>
1) 印出所有實體(all entries)：包含隱藏檔案<br>
2) 印出長列表(long list)：可以看到該檔案的屬性等<br>
請在答案輸入 ls -**<br>
(找到參數後，將 * 取代成找到的參數)<br>
<br>

<h2>LAB3</h2>
指令 cat 中哪一個參數代表輸出時有數字標號<br>
請在答案輸入 cat -* fei.txt<br>
(找到參數後，將 * 取代成找到的參數)<br>
<br>

<h2>LAB4</h2>
下載檔案 <a href="file/touch">download</a><br>
下載檔案 <a href="file/touchCh">中文版 download</a><br>
並嘗試解出 Flag <br>
<br>

<h2>LAB5</h2>
. 一個點是當前資料夾<br>
.. 是上一層資料夾<br>
請問哪一個符號表示 home 資料夾(自己的家目錄)<br>
<br>

<h2>LAB6</h2>
如果只輸入 su 預設是進入哪一個帳號呢<br>
<br>

<h2>LAB7</h2>
下載檔案 <a href="file/env">download</a><br>
下載檔案 <a href="file/envCh">中文版download</a><br>
並嘗試解出 Flag <br>
<br>

<h2>LAB8</h2>
哪些權限代表<br>
使用者可以讀取檔案<br>
群組可以讀取和寫入檔案<br>
而其他人不能讀取、不能寫入、不能執行文件<br>
輸入三位數字<br>
<br>



<h2>LAB9</h2>
哪些權限代表<br>
使用者可以讀取、寫入和執行檔案<br>
群組可以讀取、寫入和執行檔案<br>
其他任何人都可以讀取、寫入和執行文件<br>
輸入三位數字<br>
<br>

<h2>LAB10</h2>
如何切換到自己的家目錄(利用相對路徑)<br>
<br>

<h2>LAB11</h2>
sudo 中哪一個參數代表指定使用者<br>
sudo -* fei<br>
(找到參數後，將 * 取代成找到的參數)<br>
<br>

<h2>LAB12</h2>
利用 sudo 與 apt 安裝套件 python3<br>
sudo apt ******* *******<br>
<br>



<form method="POST">
    <div class="form-group">
        <label for="answer"><br><h4>Flag提交</h4></label>
        <input type="text" class="form-control" placeholder="Enter flag" id="answer" name="answer">
    </div>
    <input type="submit" class="btn btn-primary" value="送出">
    <br>
</form>


<?php
	include_once('../../php-inc/footer.php');
?>
