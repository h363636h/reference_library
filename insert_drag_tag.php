<!-- 
이미지 내 태그 삽입
 -->
<html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=euc-kr"> 
</head>
<?php
include "lib/dbconn.php";
//tag drag

if(isset($_POST['tag'])){
    $get_tag = $_POST['tag'];
}else{
    $get_tag = null;
}

if(isset($_POST['path'])){
    $path = $_POST['path'];
}else{
    $path = null;
}

if(isset($_POST['img_id'])){
    $img_id = $_POST['img_id'];
}else{
    $img_id = null;
}

if(isset($_POST['img_name'])){
    $img_name = $_POST['img_name'];
}else{
    $img_name = null;
}

if(isset($_POST['end_frame'])){
    $end_frame = $_POST['end_frame'];
}else{
    $end_frame = null;
}

if(isset($_POST['end_time'])){
    $end_time = $_POST['end_time'];
    $interval_time = "0,".$end_time;
}else{
    $end_time = null;
}

if(isset($_POST['img_id_arr'])){
    $img_id_arr = $_POST['img_id_arr'];
    
}else{
    $img_id_arr = null;
}

if(isset($_POST['vid_id_arr'])){
    $vid_id_arr = $_POST['vid_id_arr'];
    
}else{
    $vid_id_arr = null;
}

if(isset($_POST['type'])){

    if(isset($img_id)){

        $select_type_sql = "select * from img_tag where img_id='$img_id' and tag='$get_tag'";
        // echo $select_type_sql;
        $select_type_result = mysql_query($select_type_sql,$connect);
        $select_type_cnt = mysql_num_rows($select_type_result);

        if($select_type_cnt ==0){
            $insert_type_sql = "insert into img_tag(img_id,tag)values('$img_id','$get_tag')";
            mysql_query($insert_type_sql,$connect);
            echo "<script>window.reloadDiv('$path');</script>";

        }else{
            echo "<script> alert('이미 존재하는 태그 입니다.');window.reloadDiv('$path');</script>";
        }
    }else{
        foreach($img_id_arr as $img_id2){
            $select_type_sql2 = "select * from img_tag where img_id='$img_id2' and tag='$get_tag'";
            // echo $select_type_sql2;
            $select_type_result2 = mysql_query($select_type_sql2,$connect);
            $select_type_cnt2 = mysql_num_rows($select_type_result2);

            if($select_type_cnt2 != 0){
                echo "<script> alert('이미 존재하는 태그 입니다.');window.reloadDiv('$path');</script>";
            }else{
                $insert_type_sql2 = "insert into img_tag(img_id,tag) values('$img_id2','$get_tag')";
                mysql_query($insert_type_sql2,$connect);
                echo "<script>window.reloadDiv('$path');</script>";
            }
        }
    }
       
}else{
    if(isset($vid_id_arr)){
        // echo "oo";
        $key = array_search('on',$vid_id_arr);
        // $vid_id_arr = array_search(needle, haystack)
        array_splice($vid_id_arr,$key,1);

        foreach($vid_id_arr as $vid_id){
            // echo $vid_id;
            // echo "<br>";
            // echo $get_tag;
            $select_path_sql = "select img_path,img_name from img where img_id='$vid_id'";
            $select_path_result = mysql_query($select_path_sql,$connect);
            $select_path_row = mysql_fetch_array($select_path_result);

            $full_path = $select_path_row[0].$select_path_row[1];

            $frame= exec("./ffmpeg -i \"$full_path\" 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");

            $hour = explode(":",$frame)[0]*60*60;
            $min = explode(":",$frame)[1]*60;
            $sec = explode(":",$frame)[2];

            $end_time = $hour + $min + $sec;
            $interval_time_arr = "0,".$end_time;
            $end_frame = (int)($end_time*24);

            $select_interval_sql = "select * from img_frame where img_name='$select_path_row[1]' and start_frame=0 and end_frame=$end_frame";   //중복 확인
            $select_interval_result = mysql_query($select_interval_sql,$connect);
            $select_interval_cnt = mysql_num_rows($select_interval_result);

            // echo $select_interval_sql;
            // echo "<br>";
            // echo $select_interval_cnt;
            // echo "<br>";

            if($select_interval_cnt == 0 ){
                $insert_interval_arr_sql = "insert into img_frame(img_name,start_frame,end_frame,interval_time) values(\"$select_path_row[1]\",'0','$end_frame','$interval_time_arr')";
                mysql_query($insert_interval_arr_sql,$connect);

                $select_frameid_sql = "select frame_id from img_frame where img_name=\"$select_path_row[1]\" and start_frame='0' and end_frame='$end_frame'";
                $select_frameid_result = mysql_query($select_frameid_sql,$connect);
                $select_frameid_row = mysql_fetch_array($select_frameid_result);

                $frame_id = $select_frameid_row['frame_id'];

                $insert_frame_sql = "insert into img_tag(img_id,frame_id,tag) values('$vid_id','$frame_id','$get_tag')";
                mysql_query($insert_frame_sql,$connect);
                // echo $insert_frame_sql;
                // echo "<script>window.reloadDiv('$path');</script>";
            }else{

            }

        }

        // echo json_encode($vid_id_arr);
    }else if(empty($vid_id_arr)){
        // echo "xx";
        $select_frameid_sql = "select frame_id from img_frame where img_name=\"$img_name\" and start_frame='0' and end_frame='$end_frame' and interval_time = '$interval_time'";
    $select_frameid_result = mysql_query($select_frameid_sql,$connect);
    $select_frameid_row = mysql_fetch_array($select_frameid_result);

    // echo "<br>";
    // echo $select_frameid_sql;
    $frame_id = $select_frameid_row['frame_id'];

    $select_tag_sql = "select * from img_frame where img_name=\"$img_name\" and start_frame='0' and end_frame='$end_frame' and interval_time='$interval_time'";
    // echo $select_tag_sql;
    $select_tag_result = mysql_query($select_tag_sql, $connect);
    $select_tag_cnt = mysql_num_rows($select_tag_result);


    // echo "<br>";
    // echo $select_tag_sql;
    $select_frame_sql = "select * from img_tag where img_id='$img_id' and frame_id='$frame_id' and tag='$get_tag'";
    $select_frame_result = mysql_query($select_frame_sql,$connect);
    $select_frame_cnt = mysql_num_rows($select_frame_result);

    if($select_tag_cnt ==1 && $select_frame_cnt ==1){
        echo("<script>window.reloadDiv('$path');</script>");
        }else{
            if($select_tag_cnt == 0){
                $insert_tag_sql = "insert into img_frame(img_name,start_frame,end_frame,interval_time)";
                $insert_tag_sql .="values(\"$img_name\",'0','$end_frame','$interval_time')";
                mysql_query($insert_tag_sql,$connect);

                $select_frameid_sql = "select frame_id from img_frame where img_name=\"$img_name\" and start_frame='0' and end_frame='$end_frame' and interval_time = '$interval_time'";
                $select_frameid_result = mysql_query($select_frameid_sql,$connect);
                $select_frameid_row = mysql_fetch_array($select_frameid_result);

                $frame_id = $select_frameid_row['frame_id'];

                $insert_frame_sql = "insert into img_tag(img_id,frame_id,tag) values('$img_id','$frame_id','$get_tag')";
                mysql_query($insert_frame_sql,$connect);
                echo "<script>window.reloadDiv('$path');</script>";

            }else{
                $insert_frame_sql = "insert into img_tag(img_id,frame_id,tag) values('$img_id','$frame_id','$get_tag')";
                mysql_query($insert_frame_sql,$connect);
                echo "<script>window.reloadDiv('$path');</script>";
            }
        }
    }
        echo "<script>window.reloadDiv('$path');</script>";    
}
?>
