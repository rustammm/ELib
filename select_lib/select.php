<?php
	session_start();
	session_destroy();
	session_start();
	require_once('../stuff/settings.php');
	$con = mysqli_connect($mysql_server ,$mysql_username, $mysql_password , $database_name);
	if($_GET['id'] == '')
		elibDie();
	$id = intval($_GET['id']);
	$query = "SELECT * FROM libraries WHERE id = $id";
	$lib = mysqli_query($con, $query);
	$lib = $lib->fetch_assoc();
	$_SESSION['school_name'] = $lib['school_name'];
	$_SESSION['school_id'] = $lib['id'];
	echo "<meta http-equiv='refresh' content='0; url=$http_adress'>";
?>