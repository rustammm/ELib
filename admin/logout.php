<?php
	session_start();
	unset($_SESSION['admin']);
	unset($_SESSION['super_admin']);
	header('Location: ../');
?>