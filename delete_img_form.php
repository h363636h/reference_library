<!-- 
*이미지 내 태그 삭제 시, 삭제 확인 팝업
 -->
<?php
include "lib/dbconn.php";
if(isset($_GET['idx'])){
    $idx = $_GET['idx'];
}
if(isset($_GET['tag'])){
    $tag = $_GET['tag'];
}
if(isset($_GET['path'])){
    $path = $_GET['path'];
}

if(isset($_POST['idx'])){
    $post_idx = $_POST['idx'];
    $post_tag = $_POST['tag'];
    // echo $post_tag;
    // echo $post_idx;
    $sql = "delete from img_tag where idx='$post_idx' and tag='$post_tag'";
    echo $sql;
    mysql_query($sql,$connect);
    mysql_close();
echo "<script>opener.location.reload();window.close();</script>";

    // echo "<script>opener.location.reload();window.close();</script>";
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
<?php 
	echo("
			<form name='add_tag' method='post'>
			<BR><label>삭제하시겠습니까?</label><Br><Br>
            <input type='hidden' value='$idx' name='idx'>
            <input type='hidden' value='$tag' name='tag'>
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'></span> 확인</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>    
			</form>
			
			");
	

?>
