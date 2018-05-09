<?php
include "lib/dbconn.php";
session_start();
$cart = $_POST['thum_arr'];

if($_SESSION['thum'] == null){
$_SESSION['thum'] = $cart;
} else{
$_SESSION['thum'] = array_merge($_SESSION['thum'],$cart);
}

$_SESSION['thum'] = array_unique($_SESSION['thum']);
?>