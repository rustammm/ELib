<?php
require_once("config.php");
permission("hoster");
?>
<?php
	if(!isset($_GET['name']) and !isset($_GET['type'])){
		header('Location: ./index.php');
	}
	if($_GET['type'] == "file"){
		unlink($_GET['name']);
			success(_( "Удалён"));
		
	}
	if($_GET['type'] == "dir"){
		rmdir($_GET['name']);
			success(_("Удалён"));
		
	}
	require_once("../../stuff/footer.php");
?>