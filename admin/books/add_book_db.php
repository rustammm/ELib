<?php
	require_once('../../stuff/config.php');
	permission("super");
	
	
	if($_POST['sub']){
		$name = $_POST['name_of_book'];
		$s1 = $_POST['serial1'];
		$max_s2 = $_POST['max_serial2'];
		$lang = $_POST['lang'];
		$categ = $_POST['categ']; 
		$grade = $_POST['grade'];
		$price = $_POST['price'];
		addslashes($name);
		addslashes($s1);
		addslashes($max_s2);
		addslashes($lang);
		addslashes($categ);
		addslashes($grade);
		put_books_db($name, $s1, $max_s2, $lang, $categ, $grade, $price, $con);
		success(_("Успешно"));
	}



?>
<center>
<form method="post" class = "span5">
	<input data-transform='input-control' type = "text" name = "name_of_book" placeholder = <?php echo _("НАЗВАНИЕ КНИГИ"); ?>"" required>
	<br>
	<input data-transform='input-control' type = "number" name = "serial1" placeholder = "<?php echo _("СЕРИЙНЫЙ НОМЕР 1"); ?>" required>
	<input data-transform='input-control' type = "number" name = "max_serial2" placeholder = <?php echo _("МАКСИМАЛЬНЫЙ СЕРИЙНЫЙ НОМЕР 2"); ?>"" required>
	<br>
	<input data-transform='input-control' type = "text" name = "lang" placeholder = "<?php echo _("ЯЗЫК"); ?>" required>
	<input data-transform='input-control' type = "text" name = "categ" placeholder = "<?php echo _("КАТЕГОРИЯ"); ?>" required><br>
	<input data-transform='input-control' type = "number" name = "grade" placeholder = "<?php echo _("КЛАСС"); ?>" required><br>
	<input data-transform='input-control' type = "number" name = "price" placeholder = "<?php echo _("ЦЕНА"); ?>" required>
	<input data-transform='input-control' class = 'success' type = "submit" name = "sub">
</form>
</center>
<script>
reTitle("<?php echo _("->Добавление Книги"); ?>");
</script>


<?php
	require_once('../../stuff/footer.php');
?>

