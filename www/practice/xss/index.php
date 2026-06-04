<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
  exit;
}

$titlename = 'Cross-Site Scripting 課程摘要';
include('../../php-inc/header.php');


?>


<h1>Cross-Site Scripting</h1>

<ul>
  <li>在網站常常會出現，主要是因為開發者沒有在輸出的時候過濾使用者的輸入</li>
  <li>漏洞成因
    <ul>
      <li>若輸入 HTML 或 JavaScript 等程式碼，若前端沒有過濾</li>
      <li>導致瀏覽器解析就有機會造成 HTML injection or JavaScript injection 也就是 Cross-Site Scripting</li>
    </ul>
  </li>
  <li>先決知識
    <ul>
      <li>了解 HTML Tag</li>
      <li>了解 JavaScript</li>
    </ul>
  </li>
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
      <td><a href="pre.php">JavaScript 是什麼</a></td>
      <td>了解 JavaScript 是什麼</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><a href="cookie.php">Cookie vs Session</a></td>
      <td>了解 Cookie & Session</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><a href="xss1.php">XSS 簡介</a></td>
      <td>了解 XSS 類型</td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><a href="stored.php">儲存型 XSS</a></td>
      <td>了解儲存型的 XSS</td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><a href="refelect.php">反射型 XSS</a></td>
      <td>了解反射型的 XSS</td>

    </tr>

    <tr>
      <th scope="row">6</th>
      <td><a href="dom.php">DOM XSS</a></td>
      <td>了解 DOM 型的 XSS</td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><a href="1.php">惡意網站1</a></td>
      <td>了解 XSS 與 Session Hijacking 的應用</td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td><a href="2.php">惡意網站2</a></td>
      <td>了解 XSS 與 Cross-site request forgery 的應用</td>

    </tr>

    <tr>
      <th scope="row">9</th>
      <td><a href="defense.php">防禦手法</a></td>
      <td>了解 XSS 防禦手法</td>

    </tr>
  </tbody>
</table>

<?php

include('../../php-inc/footer.php')


?>