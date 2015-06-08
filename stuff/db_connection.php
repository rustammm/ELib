<?php
	/* VARIABLES & FUNCTIONS */
	
	require_once('settings.php');
	require_once('functions.php');
	
	/* MYSQL CONNECTION */
	
	$con = mysqli_connect($mysql_server, $mysql_username, $mysql_password , $database_name);
	if (!$con){
	  echo "Ошибка при подключении к базе данных";
	  elibDie();
	}
?>
