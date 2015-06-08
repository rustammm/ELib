<?php
	require_once("config.php");
	permission("hoster");
	$lib_name = $_POST['name'];
	$pass = $_POST['pass'];
	if($_POST['sub'] && $lib_name != ''){
		$sql="INSERT INTO libraries (school_name)
		VALUES ('{$lib_name}')
		";
		$res = mysqli_query($con, $sql);
		if(!$res){
			error(_("Ошибка") , _("Ошибка добавления библиотеки"));
			elibDie();
		}
		$pass = md5(md5("admin"));
		$lib_id = mysqli_insert_id($con);
		$sql="INSERT INTO users (library, name, password, status)
		VALUES ('{$lib_id}', 'admin', '$pass', 1) 
		";
		$res = mysqli_query($con, $sql);
		if(!$res){
			error(_("Ошибка"), _("Ошибка добавления пользователя"));
			elibDie();
		}else{
			success(_("Создан библиотекарь с Логином и Паролем: <b> admin </b>"));
		}			
	}
	
?>
<center>
<form method = "post" class = "span4">
<input data-transform="input-control" type = "text" name = "name" placeholder = "<?php echo _("Название библиотеки"); ?>"   /><br>
<input data-transform="input-control" type = "submit" name = "sub" placeholder = "<?php echo _("Создать"); ?>" class = "button success"/>
</form>
</center>
<?php
	require_once('../stuff/footer.php');
?>