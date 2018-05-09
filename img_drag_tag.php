<?php

//tag drag
if(isset($_GET['tag'])){
    $get_tag = $_GET['tag'];
}else{
    $get_tag = null;
}

if(isset($_GET['path'])){
    $path = $_GET['path'];
}else{
    $path = null;
}

if(isset($_GET['img_id'])){
    $img_id = $_GET['img_id'];
}else{
    $img_id = null;
}

if(isset($_GET['img_id_arr'])){
    $img_id_arr = $_GET['img_id_arr'];
}else{
    $img_id_arr = null;
}

// echo "img_id_arr => " .$img_id_arr."<br>";
// echo "path => " .$path."<br>";
// echo "get_tag=>". $get_tag."<br>";
// echo "img_id =>".$img_id."<br>";
// echo "team =>".$team."<br>";

$img_id_arr = explode(",",$img_id_arr);

include "lib/dbconn.php";

if(isset($img_id)){
    $select_tag_sql = "select * from img_tag where img_id='$img_id' and tag='$get_tag'";
    $select_tag_result = mysql_query($select_tag_sql, $connect);
    $select_tag_cnt = mysql_num_rows($select_tag_result);
    
    if($select_tag_cnt ==1){
        echo("
 				<script>
 					alert('이미 존재하는 태그입니다');
  					window.reloadDiv('$path','$team');
 				</script>
 		");
    }else{
        $insert_tag_sql = "insert into img_tag(img_id,tag)";
        $insert_tag_sql .="values('$img_id','$get_tag')";
        mysql_query($insert_tag_sql,$connect);
        echo "<script>
    			window.reloadDiv('$path');
    		</script>
    	";
    }
}else{
    foreach ($img_id_arr as $img_id2){
    	$select_tag_sql2 = "select * from img_tag where img_id='$img_id2' and tag='$get_tag'";
    	$select_tag_result2 = mysql_query($select_tag_sql2,$connect);
    	$select_tag_cnt2 = mysql_num_rows($select_tag_result2);
    
    	if($select_tag_cnt2 !=0){
    		echo("
    				<script>
    					alert('이미 존재하는 태그입니다');
    					window.reloadDiv('$path');
    				</script>
    		");
    	}else{
    		$insert_tag_sql2 = "insert into img_tag(img_id,tag)";
    		$insert_tag_sql2 .="values('$img_id2','$get_tag')";
        	mysql_query($insert_tag_sql2,$connect);
       	}
    }
        
    echo "<script>
       	window.reloadDiv('$path');
       	</script>";
}
?>
