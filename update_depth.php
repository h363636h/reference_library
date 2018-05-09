<?php
/*
태그 트리

태그 이동(drag and drop)
카테고리 변경

*/
include "lib/dbconn.php";
if(isset($_GET['update_depth'])){
	$update_dept =  $_GET['update_depth'];
}

if(isset($_GET['path'])){
	$path =  $_GET['path'];
}

if(isset($_GET['tag'])){
	$tag=  $_GET['tag'];
}

if(isset($_GET['root'])){	//태그를 최상단으로 이동할 경우
	$select_max_parent = "select max(parent_id) from tag_dept where parent_id like '0-%'";
	$select_max_parent_result = mysql_query($select_max_parent,$connect);
	while($select_max_parent_rs = mysql_fetch_array($select_max_parent_result)){
		$max_parent_id = $select_max_parent_rs[0];
	}

	$split_parent_id = split("-",$max_parent_id)[1]+1;
	$update_parent_id = "0-".$split_parent_id;
	$update_parent_sql = "update tag_dept set parent_id='$update_parent_id' where tag='$tag'";

	echo $update_parent_sql;
	mysql_query($update_parent_sql,$connect);

}else{



	$select_update_id= "select position from tag_dept where tag='$update_dept'";

	$select_update_result= mysql_query($select_update_id,$connect);
	while($select_update_rs = mysql_fetch_array($select_update_result)){
		$parent_id = $select_update_rs[0];
	}

	$update_id_sql = "update tag_dept set parent_id='$parent_id' where tag='$tag'";
	mysql_query($update_id_sql,$connect);
// echo $parent_id;

}
echo("<script>
	window.reloadDiv('$path');
	</script>
");

?>