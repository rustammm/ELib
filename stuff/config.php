<?php
	/* Connection + functions + settings */
	require_once('db_connection.php');
	
	/* SCHOOL DATABASE CHECK */  // Actually not database, just column in tables
	session_start();
	if(isset($_SESSION['school_id'])){
		$library_id = $_SESSION['school_id'];
		$library_name = $_SESSION['school_name'];
	}else{
		echo "<meta http-equiv='refresh' content='0; url=$http_adress/select_lib'>";
		die;
	}
	/* Permission Variables  */
	
	$ADMIN = $_SESSION["admin"];
	$SUPER_ADMIN = $_SESSION['super_admin'];
    $SADMIN_ID = $_SESSION['said'];
	$HOSTER = $_SESSION['hoster'];	
	$STUDENT = $_SESSION["student"]["status"];
	
	/* ChangeLibrary button */
	$lib_change_link = 
	"<a class='element place-right' href='$http_adress/select_lib' data-hint = '"._("Поменять Библеотеку")."'>
		$library_name <span class='icon-switch on-right-more'></span>
	</a>"; 
	
	/* CSS + JS + JQuery including */
	
	require_once('header.php');
	require_once('menu.php');
?>
