<?php

if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if(isset($_GET['expression'])){
    echo "輸入字串: ".$_GET['expression'];
    echo "<br>";
    echo "計算結果: ";
    echo "<pre>";
    echo eval("return ".$_GET['expression'].";");
    echo "</pre>";
}

?>

<br>
<br>


<form action="cals.php" method="get">
輸入計算式：<input type="text" name="expression" value='7*7'>
<input type="submit" value="submit">
</form>

<a href='?src'>Source Code</a>

