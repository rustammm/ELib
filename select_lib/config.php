<?php
	session_start();
	/* VARIABLES & FUNCTIONS*/
	require_once('../stuff/settings.php');
	require_once('../stuff/functions.php');
	
	/* Is admin, sa, hoster  */
		$ADMIN = $_SESSION["admin"];
		$SUPER_ADMIN = $_SESSION["super_admin"];
		$HOSTER = $_SESSION["hoster"];
	    $STUDENT = $_SESSION["student"]["status"];
	/* MYSQL CONNECTION */
	
	$con = mysqli_connect($mysql_server ,$mysql_username, $mysql_password , $database_name);
	if (!$con){
	  error("Failed to connect to MySQL", mysqli_connect_error());
	}
	require_once('../stuff/header.php');
	require_once('../stuff/menu.php');
?>
