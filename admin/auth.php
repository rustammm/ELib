<?php
	require_once('../stuff/config.php');
	permission("main");
	if($ADMIN == 1){
		echo '<script>window.location.href = "index.php";</script>';
		die;
	}
	if ($_POST['sub']){
		$login = $_POST['login'];
		$pass = md5(md5($_POST['pass']));
		$res = sql_select($con, 'users', "name = ?", array($login));
		if($users = $res){
			$row = $users->fetch_assoc();			
			if($row && $row["password"] == $pass){
				$_SESSION["admin"] = 1;
                    if($row["status"] == '1'){
                        $_SESSION["super_admin"] = 1;
                    }
                $_SESSION["said"] = $row['id'];
				echo '<script>window.location.href = "index.php";</script>';
				put_in_history($con, -1, "Вы вошли", "Вход администратора $login");
			}else{
				error(_("Вы ввели неправильный пароль или логин!"));
			}
		}else{
			error(_("Ошибка"));
		}	
	}

?>

<center>
<h1 class = 'header'>
    <?php echo _("Авторизация"); ?>
</h1>
<form method = "post" align = "center" style = "vertical-align:middle" class = 'span6'>
<input data-transform='input-control' type = "text" name = "login" placeholder = "<?php echo _("Логин"); ?>" required>
<input data-transform='input-control' type = "password" name = "pass" placeholder = "<?php echo _("Пароль"); ?>" required>
<input data-transform='input-control' type = "submit" name = "sub" value = "<?php echo _("Войти"); ?>" required class = 'primary'>
</form>
</center>
<?php
	require_once('../stuff/footer.php');
?>