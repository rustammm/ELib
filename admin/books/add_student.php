<?php
	require_once('../../stuff/config.php');
	permission("super");
	
	if($_POST['sub']){
	
		$stu = $_POST['name'];
		$sur = $_POST['surname'];
		$gr = $_POST['grade'];
		$let = $_POST['letter'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $PIN = $_POST['PIN'];
		addslashes($stu);
		addslashes($sur);
		addslashes($gr);
		addslashes($let);
		addslashes($password);
        addslashes($email);
        addslashes($PIN);
        $password = md5(md5($password));
        $PIN = md5(md5($PIN));
		if(is_in_db("students", "name = ? and surname = ? and grade = ? and letter = ?",array($stu, $sur, $gr, $let) , $con)){
			echo "<div style= 'background: red'> "._("УЖЕ СУЩЕСТВУЕТ")." </div> <br>";
			elibDie();
		}
		add_stu_db($con, $stu, $sur, $gr, $let, $password, $email, $PIN);
	}


?>
<center>
<form method="post" class = 'span5'>
	<input data-transform="input-control" type = "text" name = "name" placeholder = "<?php echo _("Имя"); ?>">
	<input data-transform="input-control" type = "text" name = "surname" placeholder = "<?php echo _("Фамилия"); ?>">
	<input data-transform="input-control" type = "number" name = "grade" placeholder = "<?php echo _("Класс"); ?>">
	<input data-transform="input-control" type = "text" name = "letter" placeholder = "<?php echo _("Буква"); ?>">
    <input data-transform="input-control" type = "text" name = "email" placeholder = "<?php echo _("Email"); ?>">
    <input data-transform="input-control" type = "password" name = "PIN" placeholder = "<?php echo _("PIN"); ?>">
    <input data-transform="input-control" type = "password" name = "password" placeholder = "<?php echo _("Пароль"); ?>">
	<input data-transform="input-control" class = 'success' type="submit" name = "sub" value = "<?php echo _("Добавить"); ?>">
</form>
</center>
<?php
	require_once('../../stuff/footer.php');
?>