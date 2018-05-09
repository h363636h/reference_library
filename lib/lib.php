<?php
function connect_db() {
	$connect = mysqli_connect("localhost","root","macro_Adm1n");
	mysqli_select_db($connect, "mg_library");
	mysqli_query($connect, "set names utf8");
	mysqli_query($connect, "set sql_mode=''");
	return $connect;
}

?>
