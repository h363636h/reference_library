<?php
header('content-type:text/html;charset=utf-8');
include "lib/dbconn.php";

if(isset($_POST['detail_tag'])){
	$tag = $_POST['detail_tag'];
}else{
	$tag = null;
}

if(isset($_POST['path'])){
	$path = $_POST['path'];
}else{
	$path = null;
}

if(isset($_POST['description'])){
	$description = $_POST['description'];
}else{
	$description = null;
}

if(isset($_POST['img_name'])){
	$img_name = $_POST['img_name'];
}else{
	$img_name = null;
}

if(isset($_POST['img_id'])){
	$img_id = $_POST['img_id'];
}else{
	$img_id = null;
}

if(isset($_POST['img_path'])){
	$img_path = $_POST['img_path'];
}else{
	$img_path = null;
}

if(isset($_POST['path'])){
	$path = $_POST['path'];
}else{
	$path = null;
}

if(isset($_POST['start_frame'])){
	$start_frame = $_POST['start_frame'];
}else{
	$start_frame = null;
}

if(isset($_POST['end_frame'])){
	$end_frame = $_POST['end_frame'];
}else{
	$end_frame = null;
}



if($tag != ""){
	$select_tag_sql = "select * from tag where tag='$tag'";
	$select_tag_result = mysql_query($select_tag_sql,$connect);
	$select_tag_cnt = mysql_num_rows($select_tag_result);

	if($select_tag_cnt == 0){
		$select_max_position = "select max(position) as position from tag_dept";
		$select_max_result = mysql_query($select_max_position,$connect);
		$select_max_row = mysql_fetch_array($select_max_result);
		$max_num =$select_max_row['position']+1;

		$select_root_num = "select max(substring(parent_id,3)+0) as parent_id from tag_dept where parent_id like '0%'";
		$select_root_result = mysql_query($select_root_num,$connect);
		$select_root_row = mysql_fetch_array($select_root_result);
		$root_num = $select_root_row['parent_id']+1;

		$new_root_id= '0-'.$root_num;
		// echo $new_root_id;

		$insert_root_sql = "insert into tag_dept (parent_id,tag,position) values('$new_root_id','$tag','$max_num')";
		mysql_query($insert_root_sql,$connect);
				
		$insert_tag_sql = "insert into tag(tag) values('$tag')";
		mysql_query($insert_tag_sql,$connect);	

	}

	$json = json_encode($_POST['files']);

	foreach ($_POST['files'] as $val){
		// echo $json;

		$explode = explode("&&",$val);
		$img_name = $explode[1];
		$frame_id = $explode[2];
		// echo $img_name;

		$select_sql = "select * from img where img_name=\"$img_name\"";
		$select_result = mysql_query($select_sql,$connect);
		$select_row = mysql_fetch_array($select_result);

		$img_id = $select_row[0];

		$insert_sql = "insert into img_tag(img_id,frame_id,tag) values($img_id,$frame_id,'$tag')";
		// echo $insert_sql;
		mysql_query($insert_sql,$connect);
	}
	// $rep_img_name = str_replace("&","000",$img_name);
	// echo "bbb";
	echo ("<script>
			window.opener.reloadDiv('$path');
			location.href=\"detail.php?img_id=$img_id&img_name=$img_name&img_path=$img_path&path=$path\";
			</script>");
}else{
	// echo "aaaa";
	// if(isset($start_frame) && isset($end_frame)){
	$start_time = $start_frame/24;
	$end_time = $end_frame/24;

	$interval = $start_time.",".$end_time;
// echo $interval;
	$select_sql = "select * from img_frame where img_name=\"$img_name\" and start_frame='$start_frame' and end_frame='$end_frame'";
	$select_result = mysql_query($select_sql,$connect);
	$select_cnt = mysql_num_rows($select_result);
	$rep_img_name = str_replace("&","000",$img_name);
	// echo $select_sql;
	// echo $select_cnt;
	// echo "<br>";
	// echo $img_name;
	// echo "<br>";
	// echo $rep_img_name;

	if($select_cnt !=0){
		echo "<script> alert('해당 구간은 이미 존재합니다.')</script>";
		echo "<script> location.href=\"detail.php?img_id=$img_id&img_name=$rep_img_name&img_path=$img_path&path=$path\"</script>";
	}else{
		

		$insert_frame_sql = "insert into img_frame(img_name,start_frame,end_frame,interval_time) values(\"$img_name\",'$start_frame','$end_frame','$interval')";
		// echo $insert_frame_sql;
		mysql_query($insert_frame_sql,$connect);
		echo "<script> location.href=\"detail.php?img_id=$img_id&img_name=$rep_img_name&img_path=$img_path&path=$path\"</script>";
	}


}

?>