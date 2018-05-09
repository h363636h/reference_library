<?php
include "lib/dbconn.php";
if(isset($_GET['start_time'])){
	$start_time = $_GET['start_time'];
}

if(isset($_GET['end_time'])){
	$end_time = $_GET['end_time'];
}

$interval = $start_time.",".$end_time;

if(isset($_GET['img_name'])){
	$img_name = $_GET['img_name'];
}

if(isset($_GET['path'])){
	$path = $_GET['path'];
}

$select_sql = "select * from img_interval where interval_time='$interval' and img_name='$img_name'";
$select_result = mysql_query($select_sql,$connect);
$select_cnt = mysql_num_rows($select_result);

// echo $select_cnt;

if($select_cnt !=0){
    echo "<script>alert('해당 구간은 이미 존재 합니다.');</script>";
}else{
	$insert_sql = "insert into img_interval(img_name,start_time,end_time,interval_time) values('$img_name','$start_time','$end_time','$interval')";
	mysql_query($insert_sql,$connect);
}

echo "<script>
        window.reloadDiv('$path');
    </script>";

?>