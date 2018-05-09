<?php
session_start();
if(isset($_GET['name'])){
	$name= $_GET['name'];
}

if(isset($_POST['del_arr'])){
	$del =  $_POST['del_arr'];
}

if(isset($_GET['all'])){
    session_destroy();
}else if(isset($del)){
    $del_result = str_replace($del,'',$_SESSION['thum']);
    $_SESSION['thum'] = $del_result;
}else{
	$re = str_replace($name,'',$_SESSION['thum']);
	$_SESSION['thum'] = $re;
}

header("location:cart.php");
?>

