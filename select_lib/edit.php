<?php
	require_once("config.php");
	permission("hoster");
	if($_POST['sub']){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$hidden = $_POST['hidden'];
		if($hidden != '')
			$hidden = 1;
		else
			$hidden = 0;
		$query = "UPDATE libraries SET school_name = '{$name}', hidden = '$hidden' WHERE id = $id";
		$res = mysqli_query($con, $query);
		if(!$res)
			echo _("Ошибка").mysqli_error($con);
		else{
			echo "<meta http-equiv='refresh' content='0' URL= edit.php?id=$id'>";
		}
	}
	if($_GET['id'] != ''){
		$id = $_GET['id'];
		$query = "SELECT * FROM libraries WHERE id = {$id}";
		$lib = mysqli_query($con, $query);
		$lib = $lib->fetch_assoc();
		$name = $lib['school_name'];
		$hidden = $lib['hidden'];
		if($hidden)
			$hidden = "checked";
		echo "
		<center>
		<form method = 'post' action = 'edit.php?id=$id' class = 'span4'>
			<label>"._("ID")."<input data-transform='input-control' type = 'text' name = 'id' value = '{$id}' readonly> <br></label>
			<label>"._("Название библиотеки")."<input data-transform='input-control' type = 'text' name = 'name' value = '{$name}' required> <br></label>
			<label>"._("Скрыть")."<input data-transform='input-control' type = 'checkbox' name = 'hidden' $hidden data-transform-type = 'switch'> <br></label>
			<label><input data-transform='input-control' class = 'success' type = 'submit' name = 'sub' value = '"._("Сохранить")."'></label>
		</form>	
		</center>
		";
	}
	
?>
<?php
	require_once('../stuff/footer.php');
?>