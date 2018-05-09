<?php
include "lib/dbconn.php";

if(isset($_GET['position'])){
    $position= $_GET['position']; //root 인지 아닌지 확인
}

if(isset($_GET['path'])){
    $path = $_GET['path']; //refresh
}

if(isset($_POST['tag'])){
    $tag = $_POST['tag'];
}


//중복 tag 확인
$select_tag_sql = "select * from tag where tag='$tag'";
$select_tag_result = mysql_query($select_tag_sql,$connect);
$select_tag_cnt = mysql_num_rows($select_tag_result);

if($select_tag_cnt !=0){
	echo "<script> alert('이미 존재하는 태그 입니다.');window.close();</script>";
}else{

	//position 최대값 
	$select_max_position = "select max(position)as position from tag_dept";
	$select_max_result = mysql_query($select_max_position,$connect);
	$select_max_row = mysql_fetch_array($select_max_result);
	$max_num =$select_max_row['position']+1;
	
	
	if($position== "root"){
		$select_root_num = "select max(substring(parent_id,3)+0) as parent_id from tag_dept where parent_id like '0%'";
		$select_root_result = mysql_query($select_root_num,$connect);
		$select_root_row = mysql_fetch_array($select_root_result);
		$root_num = $select_root_row['parent_id']+1;
		
		$new_root_id= '0-'.$root_num;
		echo $new_root_id;
		
		$insert_root_sql = "insert into tag_dept (parent_id,tag,position) values('$new_root_id','$tag','$max_num')";
		mysql_query($insert_root_sql,$connect);
		
		$insert_tag_sql = "insert into tag(tag) values('$tag')";
		mysql_query($insert_tag_sql,$connect);
				echo("<script>
						window.close();
						window.opener.reloadDiv('$path');
						</script>
					");
	}else{
		$insert_node_sql = "insert into tag_dept(parent_id,tag,position) values('$position','$tag','$max_num')";
		mysql_query($insert_node_sql,$connect);
		
		$insert_tag_sql = "insert into tag(tag) values('$tag') ";
		mysql_query($insert_tag_sql,$connect);
		
		echo("<script>
				window.close();
				window.opener.reloadDiv('$path');
				</script>
			");
	}
}
?>
