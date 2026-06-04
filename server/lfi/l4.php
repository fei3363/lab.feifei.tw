<pre><?php 


echo "確認設定：<br>";
echo("allow_url_include:".ini_get("allow_url_include"));
echo "<br>";
echo("allow_url_fopen:".ini_get("allow_url_fopen"));

if (isset($_GET['src'])){
    highlight_file(__FILE__);}
else if(isset($_GET["url"])){
    include($_GET["url"]);
}

?></pre>
<a href="?url=hello.php">點擊</a>
<a href='?src'>Source Code</a>


<a href="/lfi/index.php">level 1</a>
<a href="/lfi/l2.php">level 2</a>
<a href="/lfi/l3.php">level 3</a>
<a href="/lfi/l4.php">level 4</a>