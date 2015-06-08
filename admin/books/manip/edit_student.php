<?php
	require_once('../../../stuff/config.php');
	require_once('../../../public/data.php');
	permission("super");
	if($_POST['sub']){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$grade = $_POST['grade'];
		$points = $_POST['points'];
		$letter = $_POST['letter'];
		$password = $_POST['password'];
		$titles = array("name", "surname", "grade", "letter", "points");
		$params = array($name, $surname, $grade, $letter, $points);
		if ($password != "") {
			$password = md5(md5($password));
			array_push($titles, "password");			
			array_push($params, $password);
		}
		$res = sql_update($con, "students", $titles, $params, "id = ?", array($id));
		if(!$res){
			error(_("Ошибка"));
			elibDie();
		}else{
			success(_("Успешно"));
		}
		put_in_history($con, -1, "Вы изменили информацию об ученике с id : $id", "Ученики:Изменение");
	}
	if(isset($_GET['id'])){
		$sid = $_GET['id'];
		if($sid <= 0){
			echo "<div style= 'background: red'> "._("ОШИБКА")." </div> <br>";
			elibDie();
		}
		$data = get_data($sid, $con);
		$sname = $data['name'];
		$surname = $data['surname'];
		$sgrade = $data['grade'];
		$letter = $data['letter'];
		$points = $data['points'];
		$email = $data['email'];
		echo "
		<center>
		<form method = 'post' class = 'span4'>
			"._("ID")."<input data-transform='input-control' type = 'number' name = 'id' value = '$sid' required hidden><br>
			"._("ИМЯ")."<input data-transform='input-control' type = 'text' name = 'name' value = '$sname' required><br>
			"._("ФАМИЛИЯ")."<input data-transform='input-control' type = 'text' name = 'surname' value = '$surname' required><br>
			"._("КЛАСС")."<input data-transform='input-control' type = 'number' name = 'grade' value = '$sgrade' required><br>
			"._("БУКВА")."<input data-transform='input-control' type = 'text' name = 'letter' value = '$letter' required><br>
			"._("БАЛЛЫ")."<input data-transform='input-control' type = 'number' name = 'points' value = '$points' required><br>
			"._("ПАРОЛЬ")."<input data-transform='input-control' type = 'password' name = 'password'><br>
			"._("EMAIL")."<input data-transform='input-control' type = 'email' value = '$email' disabled><br>
			<input data-transform='input-control' type = 'submit' name = 'sub' class = 'success'>
		</form>
		</center>
		";
	}
	
	require_once('../../../stuff/footer.php');
?>



