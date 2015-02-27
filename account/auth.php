<?php
	require_once('../stuff/config.php');
	permission('main');
	if($_POST['sub']){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$pass = md5(md5($pass));
		debug($pass, $email);
		$student = sql_select($con, "students", "email = ? and password = ?", array($email, $pass));
		if($student->num_rows < 1){
			error(_("Вы ввели неправильный email или пароль!"));
		}else{
			$student = $student->fetch_assoc();
			$_SESSION['student']['status'] = true;
			$_SESSION['student']['id'] = $student['id'];
			$_SESSION['student']['name'] = $student['name'];
			echo '<script>window.location.href = "../";</script>';
		}
	}


?>


<center>
<h1 class = 'header'>
    <?php echo _("Авторизация"); ?>
</h1>
<form method = "post" align = "center" style = "vertical-align:middle" class = 'span6'>
<input data-transform='input-control' type = "email" name = "email" placeholder = "<?php echo _("Email"); ?>" required>
<input data-transform='input-control' type = "password" name = "pass" placeholder = "<?php echo _("Пароль"); ?>" required>
<input data-transform='input-control' type = "submit" name = "sub" value = "<?php echo _("Войти"); ?>" required class = 'primary'>
</form>
</center>

<?php
	require_once('../stuff/footer.php');
?>
