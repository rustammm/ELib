<?php
	require_once('../../stuff/config.php');
	permission("super");
?>
<?php
	if(isset($_GET['id'])and isset($_GET['status'])){
		$id = $_GET['id'];
		$stat = $_GET['status'];
		if($stat == 'user'){
			$stat = 1;
		}else{
			$stat = 0;
		}
		$res = sql_update($con, 'users', array("status"), array($stat), "id = ?", array($id));
		if($res){
			success(_("Изменён"));
		}else{
			error(_("Ошибка"));
		}
	
	}
	require_once('../../stuff/footer.php');
?>
