<?php
if(isset($_POST['path'])){
    $path = $_POST['path'];
    $path = str_replace("00000","'",$path);
}
//$team = $_POST[team];

// $path = str_replace(" ","\\ ", $path);
$cmd = exec("python /DATA/reference_library/python/thumnail.py \"$path\"");

echo $cmd;

echo("<script>
		window.reloadDiv('$path');
		</script>
");

?>
