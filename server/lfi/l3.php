<pre><?php 
if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if(isset($_GET["url"])){
    include($_GET["url"].'.php');
}
?></pre>
<a href="?url=hello">點擊</a>
<a href='?src'>Source Code</a>

<br><br>
1. %00 僅在PHP 5.3.0 以下可用 <br>



<a href="/lfi/index.php">level 1</a>
<a href="/lfi/l2.php">level 2</a>
<a href="/lfi/l3.php">level 3</a>
<a href="/lfi/l4.php">level 4</a>
