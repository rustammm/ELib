<?php
	require_once('../../stuff/config.php');
	permission("super");
?>
<center>
<p class = 'subheader'>
    <?php echo _("Добавление пользователя"); ?>
</p>
<br>
<form method = "post" class = 'span6'>
<input data-transform='input-control' type = "text" name = "login" placeholder = "<?php echo _("Login"); ?>" required>
<input data-transform='input-control' type = "password" name = "pass" placeholder = "<?php echo _("Password"); ?>" required>
<br>
<h5><label>
        <input data-transform='input-control' type = "checkbox" name = "adm" data-transform-type = 'switch' >
        <?php echo _("Разрешить полное редактирование данных"); ?>  <i class = 'fa fa-warning fa-2x'></i>
    </label>
</h5>
<br>
<input data-transform='input-control' type = "submit" name = "sub" value = "<?php echo _("Создать"); ?>" class = 'primary' required>

</form>

</center>
<?php

if ($_POST['sub']){
		if($_POST['adm']){
			$status = 1;
		}		
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		$pass = md5($pass);
		$pass = md5($pass);
		addslashes($login);
		$res = sql_select($con, 'users', 'name = ?', array($login));
		if ($res->num_rows > 0) {
			error (_("Ошибка"), _("Пользователь с таким логином уже существует!"));
			elibDie();
		}
		$res = sql_insert($con, 'users', array("name", "password", "status"), array($login, $pass, $status));
		if($res){
			success(_("Добавлен"));
			put_in_history($con, -1,  "Добавлен пользователь $login", "Пользователи:Добавление");
		}else{
			error(_("Ошибка"));
		}	
	}
	require_once("../../stuff/footer.php");
?>
