<?php
header("Set-Cookie: Same=site; path=/; domain=/; SameSite=Lax");

setcookie("th1sCo0k1e", "HeyC0okle",time()+3600*24,'/');
setcookie("HttpOnlyCo0k1e", "HttpOnlyTrue",time()+3600*24,'/',$domain,0,True);
setcookie("secureCo0k1e", "secureTrue",time()+3600*24,'/',$domain,1,1);
// setcookie('foo','1',(time() + 86400), '/; samesite=lax', $domain,false,false);

echo "Hello Cookie";