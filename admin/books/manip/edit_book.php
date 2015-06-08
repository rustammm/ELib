<?php
require_once('../../../stuff/config.php');
require_once('../../../public/data.php');
permission("super");
	if($_POST['sub']){
		$id = $_POST['s11'];
		$s1 = $_POST['s1'];
		$name = $_POST['name'];
		$lang = $_POST['lang'];
		$grade = $_POST['grade'];
		$categ = $_POST['categ'];
		$price = $_POST['price'];
		$titles = array("name", "lang", "grade", "category", "serial1", "price");
		$params = array($name, $lang, $grade, $categ, $s1, $price);
		$res = sql_update($con, "books", $titles, $params, "serial1 = ?", array($id));
		if(!$res){
			error(_("Ошибка"));
			elibDie();
		}else{
			success(_("Успешно"));
		}
		put_in_history($con, -1, "Вы изменили информацию о книге с s1 : $s1", "Книги:Изменение");
		
	}
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$data = get_book_data($id, $con);
		$s1 = $data['serial1'];
		$name = $data['name'];
		$grade =  $data['grade'];
		$lang = $data['lang'];
		$categ =  $data['category'];
		$price = $data['price'];
		echo "
		<center>
		<form method = 'post' class = 'span4'>
			<input data-transform='input-control' type = 'number' name = 's11' value = '$s1' hidden><br>
			"._("СЕРИЙНЫЙ НОМЕР 1")."<input data-transform='input-control' type = 'number' name = 's1' value = '$s1' required><br>
			"._("НАЗВАНИЕ")."<input data-transform='input-control' type = 'text' name = 'name' value = '$name' required><br>
			"._("ЯЗЫК")."<input data-transform='input-control' type = 'text' name = 'lang' value = '$lang' required><br>
			"._("КЛАСС")."<input data-transform='input-control' type = 'number' name = 'grade' value = '$grade' required><br>
			"._("КАТЕГОРИЯ")."<input data-transform='input-control' type = 'text' name = 'categ' value = '$categ' required><br>
			"._("ЦЕНА")."<input data-transform='input-control' type = 'number' name = 'price' value = '$price' required><br>
			<input data-transform='input-control' type = 'submit' name = 'sub' class = 'success'>
		</form>
		</center>
		";
	}

	require_once('../../../stuff/footer.php');
?>



