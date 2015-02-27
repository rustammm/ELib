<?php
	require_once('../stuff/config.php');
	permission('student');
	require_once("../public/data.php");
?>



<?php
	$type = $_POST['type'];
	$pass = $_POST['pass'];
	$new = $_POST['new'];
	$confirm = $_POST['confirm'];
	$success = false;
	$error_report = "";
	$sid = $_SESSION['student']['id'];
	
	// Checking info
	if ($new != $confirm) {
		error(_("Ошибка"), _("Несовпадение"));
		die;
	}
	if ($type == "PIN") {
		if (strlen($new) != 6) {
			error(_("Ошибка"), _("Пин-код не из 6 цифр"));
			die;
		}		
	}
	$pass = md5(md5($pass));
	if ($type != "email") {
		$new = md5(md5($new));
		
	}	
	$student = sql_select($con, "students", "id = ? and password = ?", array($sid, $pass));
	if ($student ->num_rows < 1) {
		error(_("Ошибка"), _("Пароль неверен"));
		die;
	}
	
	
	// Updating
	
	$student = sql_update($con, "students" ,array($type), array($new), "id = ?", array($sid));
	if ($student) {
		success(_("Успешно"));
	} else {
		error(_("Ошибка"));
		die;
	}
	

	
	
	
	
	
	
?>

	
<?php
	require_once('../stuff/footer.php');
?>
