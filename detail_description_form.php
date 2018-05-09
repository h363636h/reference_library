<?php
include "lib/dbconn.php";

if(isset($_GET['frame_id'])){
	$frame_id = $_GET['frame_id'];
}else{
	$frame_id = null;
}

if(isset($_GET['description'])){
	$description = $_GET['description'];
}else{
	$description = null;
}

if(isset($_POST['description'])){
	$post_description = $_POST['description'];
	echo $post_description;

	$update_sql = "update img_frame set description='$post_description' where frame_id='$frame_id'";
	mysql_query($update_sql,$connect);

    echo "<script>
            opener.location.reload();
            window.close();</script>";
	// echo $_POST['description'];

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
			height : auto;
			border:2px solid #e2b41b;
			margin : 10px;
			background-color : white;
			color :#012874;
			text-align :center;
			font-family: 'Raleway', sans-serif;
		}
        textarea{
            overflow-y: scroll;
            resize : none;
        }
    </style>
</head>
<body>
<!-- <h4><b>description 등록</b></h4> -->

<form method="post">
	<h3>Description </h3>
	<textarea name='description' rows="9" cols="60" onclick="this.select()" onfocus="this.select()"><?php echo $description;?></textarea><br><br>
	<input type="submit" value="등록" class="btn btn-primary">
    <br><br>
</form>
</body>
</html>