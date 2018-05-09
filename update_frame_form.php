<?php
include "lib/dbconn.php";

if(isset($_GET['frame_id'])){
    $frame_id = $_GET['frame_id'];
}

if(isset($_GET['img_name'])){
    $img_name = $_GET['img_name'];
}

if(isset($_GET['start_frame'])){
    $start_frame = $_GET['start_frame'];
    $start_time = $start_frame/24;
}

if(isset($_GET['end_frame'])){
    $end_frame = $_GET['end_frame'];
    $end_time = $end_frame/24;
}

if(isset($_POST['start_frame'])){
    $update_start_frame = $_POST['start_frame'];
    $update_start_time = $_POST['start_frame']/24;

    $update_end_frame =  $_POST['end_frame'];
    $update_end_time = $_POST['end_frame']/24;

    $interval_frame = $update_start_time.",".$update_end_time;
    
    $select_sql = "select * from img_frame where img_name='$img_name' and start_frame='$update_start_frame' and end_frame='$update_end_frame'";
    $select_result = mysql_query($select_sql,$connect);
    $select_cnt = mysql_num_rows($select_result);
    
    if($select_cnt !=0){
        echo "<script>alert('해당 구간은 이미 존재합니다.');history.go(-1);</script>";
    }else{
    
    $update_sql = "update img_frame set start_frame='$update_start_frame', end_frame='$update_end_frame', interval_time='$interval_frame' where frame_id='$frame_id'";
    echo $update_sql;
    mysql_query($update_sql,$connect);
    
    echo "<script>opener.location.reload();window.close();</script>";
    }
    
}else{
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/button.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
    <script src="js/dialog.js"></script>
    <style>
        a{
            color : #00a4d3;
            text-decoration:none;
        }
        a:hover{
            color : white;
        }
        body{
			height : 190px;		
			border:2px solid #e2b41b;
			margin : 10px;
			background-color : white;
			color :#012874;
			text-align :center;
			font-family: 'Raleway', sans-serif;
            padding : 20px;
		}
    </style>
</head>

<body>
<h4><b>구간 수정</b></h4>
    <form method="post" action="">
        <b>start frame &nbsp;&nbsp;</b><input type="text" name="start_frame" value="<?php echo $start_frame?>"><br><br>
        <b>end frame &nbsp;&nbsp;</b><input type="text" name="end_frame" value="<?php echo $end_frame?>"><br><br>
        <input type="submit" value="수정" class='btn btn-primary'>
        <button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
    </form>
</body>
</html>