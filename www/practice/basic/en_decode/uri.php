<?php


$url = 'http://username:password@hostname:9090/path?arg=value#anchor';
// echo 'url='.$url.'<br>';
// echo '<pre>'.var_dump(parse_url($url)).'</pre>';
highlight_string("<?php\n\$url = '".$url."';\n" . var_export(parse_url($url), true) . ";\n?>");
// echo '<pre>' . var_export(parse_url($url), true) . '</pre>';

?>