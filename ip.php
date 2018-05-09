<?php
{ $f = fopen("ip_chk.txt", "a");
$tp="(".date('Y/m/d-H:i:s',strtotime('+9hours')).") ".$_SERVER['REMOTE_ADDR'];
//$refe=$_SERVER['HTTP_REFERER'];
$useragent=$_SERVER['HTTP_USER_AGENT'];

$lang=$_SERVER['HTTP_ACCEPT_LANGUAGE'];

fwrite($f, $tp."\n"); fclose($f); }

?>
