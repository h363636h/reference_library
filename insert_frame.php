<?php
include "lib/dbconn.php";

if(isset($_POST['start_frame'])){
	$start_frame = $_POST['start_frame'];
	$start_time = $start_frame/24;
}

if(isset($_POST['end_frame'])){
	$end_frame = $_POST['end_frame'];
	$end_time = $end_frame/24;
}

$interval = $start_time.",".$end_time;

if(isset($_POST['img_name'])){
	$img_name = $_POST['img_name'];
}

if(isset($_POST['img_id'])){
	$img_id = $_POST['img_id'];
}

if(isset($_POST['img_path'])){
	$img_path = $_POST['img_path'];
}

if(isset($_POST['path'])){
	$path = $_POST['path'];
}


$select_sql = "select * from img_frame where img_name='$img_name' and start_frame='$start_frame' and end_frame='$end_frame'";
$select_result = mysql_query($select_sql,$connect);
$select_cnt = mysql_num_rows($select_result);

if($select_cnt !=0){
    echo "<script>alert('해당 구간은 이미 존재합니다.');history.go(-1);</script>";
}else{
    $insert_sql = "insert into img_frame(img_name,start_frame,end_frame,interval_time) values('$img_name','$start_frame','$end_frame','$interval')";
    mysql_query($insert_sql,$connect);
    echo $insert_sql;
    echo "<script> location.href='detail.php?img_id=$img_id&img_name=$img_name&img_path=$img_path&path=$path'</script>";
}
?>