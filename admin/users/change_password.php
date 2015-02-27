<?php
	require_once('../../stuff/config.php');
	permission("super");
?>
<center>
<form method="post" class = 'span6'> 
<input data-transform="input-control" type = "password" name = "pass" placeholder = "<?php echo _("Пароль"); ?>">
<input data-transform="input-control" type = "submit" name = "passed" value = "<?php echo _("Изменить"); ?>" class = 'primary'>
</form>
</center>
<?php
	if(isset($_GET['id']) and isset($_POST['passed']) and isset($_GET['nick'])){
		$id = $_GET['id'];
		$pass = $_POST['pass'];
		$pass = md5(md5($pass));
		$res = sql_update($con, 'users', array("password"), array($pass), "id = ?", array($id));
		if($res){
			success(_("Изменён"));
            put_in_history($con, -1,  "Изменён пароль у пользователя {$_GET['nick']}", "Пользователи:Изменение");
		}else{
			error(_("Ошибка"));
		}	
	}
	require_once("../../stuff/footer.php");
?>
