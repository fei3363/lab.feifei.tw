<?php

session_start();
$_SESSION["lang"] = 'hello';
?>

<a href="/lfi/">lfi</a>
<a href="/ci/">command injection</a>
<a href="/up/">上傳漏洞</a>