<?php

$file = fopen("shell.php","w");


fputs($file,"<?php phpinfo();?>");

fclose($file);




?>