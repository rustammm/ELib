<?php
	require_once("../stuff/config.php");
	permission('student');
	require_once("../public/data.php");
	
	$id = $_SESSION['student']['id'];
	addslashes($id);
	$data = get_data($id, $con);
	$name = $data['name'];
	$surname = $data['surname'];
	$grade = $data['grade'];
	$letter = $data['letter'];
	$points = $data['points'];
	$email = $data['email'];
	$rate = give_rating_num($id, $con);
	echo "
	<center class = 'header'>
		<h1>
		 $name $surname
		</h1>
	</center>
	<br>
	<table class='dataTable display cell-border' align = 'center' class = 'display'>
	<tr>
	<td>"._("Email адрес")."</td>
	<td><b>$email<br></b><br></td>
	<td><a class = 'button primary span2' href = 'edit.php?type=email'> "._("Изменить")."</a></td>
	</tr>
	<tr>
	<td>"._("PIN код")."</td>
	<td><b>******<br></b><br></td>
	<td><a class = 'button primary span2' href = 'edit.php?type=PIN'>"._("Изменить")."</a></td>
	</tr>
	<tr>
	<td>"._("Пароль")."</td>
	<td><b>******<br></b><br></td>
	<td><a class = 'button primary span2' href = 'edit.php?type=password'>"._("Изменить")."</a></td>
	</tr>
	</table>
	";

	
?>
<?php

?>