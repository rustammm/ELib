<?php
	require_once('../stuff/config.php');
	permission('student');
	require_once("../public/data.php");
?>



<?php
	$type = $_GET['type'];
	$eng_type = "";
	$rus_type = "";
	$pattern_html = '.{1,100}';
	
	if ($type != "email" && $type != "password" && $type != "PIN") {
		error(_("Ощибка"));
		die;
	}
	$eng_type = $type;
	if ($type == "PIN") {
		$eng_type = "password";
	}
	
	switch($type) {
		case "email":
			$rus_type = _("Email");
			break;
		case "password":
			$rus_type = _("Пароль");
			break;
		case "PIN":
			$rus_type = _("Пин-код (6 цифр)");
			$pattern_html = '.{6,6}';
			break;
	}
	echo "
	<center>
	<h1 class = 'header'>
	"._("Измененить")."$rus_type
	</h1>
	<form method = 'post' align = 'center' style = 'vertical-align:middle' class = 'span6' action = 'editor.php'>
	<input data-transform='input-control' type = 'password' name = 'pass' placeholder = 'Пароль' required>
	<input data-transform='input-control' type = '$eng_type' name = 'new' placeholder = 'Новый' pattern='$pattern_html' required>
	<input data-transform='input-control' type = '$eng_type' name = 'confirm' placeholder = 'Подтверждение' pattern='$pattern_html' required>
	<input type = 'text' name = 'type' value = '$type' hidden>
	<input data-transform='input-control' type = 'submit' name = 'sub' value = '"._("Измененить")."' required class = 'primary'>
	</form>
	</center>
	"	
?>

	
<?php
	require_once('../stuff/footer.php');
?>
