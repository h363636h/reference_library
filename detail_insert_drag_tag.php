<!-- 
이미지 내 태그 삽입
 -->
<html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=euc-kr"> 
</head>
<?php
//tag drag

if(isset($_GET['tag'])){
    $get_tag = $_GET['tag'];
}else{
    $get_tag = null;
}

if(isset($_GET['frame_id'])){
    $frame_id = $_GET['frame_id'];
}else{
    $frame_id = null;
}

if(isset($_GET['img_id'])){
    $img_id = $_GET['img_id'];
}else{
    $img_id_arr = null;
}

include "lib/dbconn.php";

$select_tag_sql = "select * from img_tag where frame_id='$frame_id' and tag='$get_tag'";
    $select_tag_result = mysql_query($select_tag_sql, $connect);
    $select_tag_cnt = mysql_num_rows($select_tag_result);
    
    if($select_tag_cnt ==1){
        echo("
 								<script>
 								alert('이미 존재하는 태그입니다');
 								</script>
 				");
    }else{
        $insert_tag_sql = "insert into img_tag(img_id,frame_id,tag)";
        $insert_tag_sql .="values('$img_id','$frame_id','$get_tag')";
        mysql_query($insert_tag_sql,$connect);

    }

?>
