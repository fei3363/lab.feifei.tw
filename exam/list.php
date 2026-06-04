<?php

if ($_SERVER['HTTP_USER_AGENT']=='userisadmin'&& $_COOKIE["role"]=="admin"){
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user"]) )
    {
        $input_id = $_GET["user"];
    
        switch ($input_id) {
            case "user":
                $messange = '<style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                  overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg .tg-baqh{text-align:center;vertical-align:top}
                </style>
                <table class="tg">
                <thead>
                  <tr>
                    <th class="tg-baqh">帳號</th>
                    <th class="tg-baqh">user</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="tg-baqh">書本名稱</td>
                    <td class="tg-baqh">資安這條路：領航新手的 Web Security 指南，以自建漏洞環境學習網站安全（iT邦幫忙鐵人賽系列書）</td>
                  </tr>
                  <tr>
                    <td class="tg-baqh">連結</td>
                    <td class="tg-baqh">https://feifei.tw</td>
                  </tr>
                  <tr>
                    <td class="tg-baqh">聯絡</td>
                    <td class="tg-baqh">https://feifei.com.tw</td>
                  </tr>
                </tbody>
                </table>';
                break;
            case "admin":
                $messange = '<style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                  overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg .tg-baqh{text-align:center;vertical-align:top}
                </style>
                <table class="tg">
                <thead>
                  <tr>
                    <th class="tg-baqh">帳號</th>
                    <th class="tg-baqh">admin</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="tg-baqh">書本名稱</td>
                    <td class="tg-baqh">flag{you_get_lastone_flag}</td>
                  </tr>
                  <tr>
                    <td class="tg-baqh">連結</td>
                    <td class="tg-baqh">https://lab.feifei.tw</td>
                  </tr>
                  <tr>
                    <td class="tg-baqh">聯絡</td>
                    <td class="tg-baqh">http://fb.me/fei3363</td>
                  </tr>
                </tbody>
                </table>';
                break;
          
            default:
                $messange = "No User";
         }
    
    }
    
      
}else{
    echo 'you are not admin';
}



?>








<?php echo $messange;?>
