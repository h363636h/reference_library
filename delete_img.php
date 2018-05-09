<!-- 
*이미지 내 이미지 태그 삭제
 -->
<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script src="js/tag.js"></script>		

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


$sql = "delete from img_tag where idx='$idx' and tag='$tag'";

mysql_query($sql,$connect);

mysql_close();

echo("<script>
		window.opener.reloadDiv('$path')
		window.close()
	</script>");
?>

<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script src="js/tag.js"></script>		
