<?php
	require_once("config.php");
	if($HOSTER)
	{
		echo "<meta http-equiv='refresh' content='0; URL= admin.php' >";
		die;
	}
	permission("main");
	if($_POST['sub']){
		if($_POST['pass'] == $super_password){
			$_SESSION['hoster'] = true;
			echo "<meta http-equiv='refresh' content='0; URL= admin.php' >";
			die;
		}else{
			error(_("Вы ввели неправильный пароль"));
		}
	}

?>
<center>
	<h1 class = "header">
	ELib
	<br>
        <?php echo _("Администратор"); ?>
	</h1>
	<h3 class = "subheader">
        <?php echo _("Авторизация"); ?>
	</h3>
	<div class = "vcenter">
	<form method = "post" class = "span6">
		<input data-transform="input-control" type = "password" name = "pass" placeholder = "<?php echo _("Пароль"); ?>" data-transform = "input data-transform=\"input-control\"-control" required>
		<br>
		<input data-transform="input-control" class = "button primary" type = "submit" name = "sub" placeholder = "<?php echo _("Войти"); ?>">
	</form>
	</div>
</center>
<?php
	require_once('../stuff/footer.php');
?>