<?php
session_start();

if(isset($_POST['session_val'])){
    unset($_SESSION['thum']);
}

?>
