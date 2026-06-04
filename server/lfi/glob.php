<?php
$it = new DirectoryIterator($_GET['file']);
foreach($it as $f) {
 printf("%s", $f->getFilename());
	echo'</br>'; 
}
?>