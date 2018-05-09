<?php
if(isset($_GET['start_time'])){
	$start_time = $_GET['start_time'];
}

if(isset($_GET['end_time'])){
	$end_time = $_GET['end_time'];
}

if(isset($_GET['path'])){
	$path = $_GET['path'];
}

$start_time_arr = explode(":",$start_time);

$start_hour = $start_time_arr[0]*60*60;
$start_min = $start_time_arr[1]*60;
$start_sec = $start_time_arr[2];

$end_time_arr = explode(":", $end_time);

$end_hour = $end_time_arr[0]*60*60;
$end_min = $end_time_arr[1]*60;
$end_sec = $end_time_arr[2];

echo $start_hour;
echo "<br>";
echo $start_min;
echo "<br>";
echo $start_sec;
echo "<br>";

$start_sum = $start_hour + $start_min + $start_sec;
$end_sum = $end_hour + $end_min + $end_sec;


echo $start_sum;
echo "<br>";
echo $end_sum;


echo ("<script>
		window.opener.reloadDiv_interval('$start_sum','$end_sum','$path')
		window.close()
		</script>");
?>

