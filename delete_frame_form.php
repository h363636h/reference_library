<?php
/*
구간 삭제 확인 폼
*/
include "lib/dbconn.php";

// $frame_id = $_GET['frame_id'];
// echo $frame_id;
if(isset($_GET['frame_id'])){
    $frame_id = $_GET['frame_id'];
}

if(isset($_GET['path'])){
    $path = $_GET['path'];
}

if(isset($_POST['frame_id'])){
    $post_frame_id = $_POST['frame_id'];
    // echo $post_frame_id;
    $delete_img_frame = "delete from img_frame where frame_id='$post_frame_id'";
    // echo $sql;
    mysql_query($delete_img_frame,$connect);
    // mysql_close();

    $delete_img_tag = "delete from img_tag where frame_id='$post_frame_id'";
    mysql_query($delete_img_tag,$connect);
    
    mysql_close();
    
    echo "<script>
            opener.opener.reloadDiv('$path');
            opener.location.reload();
            window.close();</script>";
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
			height : 100px;
		
			border:2px solid #e2b41b;
			margin : 10px;
			background-color : white;
			color :#012874;
			text-align :center;
			font-family: 'Raleway', sans-serif;
		}
    </style>
</head>
<body>
			<form name='add_tag' method='post' action=''>
			<BR><label>해당 구간을 삭제하시겠습니까?</label><Br><Br>
            <input type='hidden' name="frame_id" value="<?php echo $frame_id?>">
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'></span> 확인</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
			</form>
			</body>
</html>
