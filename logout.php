<?php
	//include 'config.php';
	
	session_start();
	
	//if (session_destroy()) {
	//	header("location: index.php");
	//	exit;
	//}
	if (session_destroy()) {
    unset($_SESSION['eName']);
    header('location:index.php');
    exit;
	}
?>