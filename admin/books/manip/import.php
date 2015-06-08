<?php
	require_once('../../../stuff/config.php');
	permission("super");
	
	function insert($con, $table, $titles, $data) {
		if ($table == "students") {
			$data[5] = md5(md5($data[5]));			
			$data[6] = md5(md5($data[6]));
			return sql_insert($con, $table , $titles, $data);	
		}
		$s1 = $data[1];
		$s2 = $data[2];
		for ($i = 1; $i <= $s2; $i++) {
			$data[2] = $i;
			if (!sql_insert($con, $table , $titles, $data)) {
				sql_delete($con, $table, "serial1 = ?", array($s1));
				return false;				
			}			
		}
		return true;		
	}
	


?>
<center>
<form enctype="multipart/form-data" method="POST" class = "span5">
	<table class='dataTable display cell-border sortable' style = "text-align: left;">
		<tr>
			<td>
                <?php echo _("Таблица"); ?>
			</td>
			<td>
				<select name = "table" size = "1" data-transform = "input-control">
					<option value = "1">
                        <?php echo _("Ученики"); ?>
                    </option>
					<option value = "2">
                        <?php echo _("Книги"); ?>
                    </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
                <?php echo _("Разделитель"); ?>
			</td>
			<td>
				<input data-transform="input-control" type = "text" name = "divide" value = ";"> 
			</td>
		</tr>
		<tr>
			<td>
                <?php echo _("Файл CSV"); ?>
			</td>
			<td>
				<input data-transform="input-control" name="file" type="file" accept=".csv" /> 
			</td>
		</tr>
    </table>
	<input data-transform="input-control" class = 'success' type="submit" name = 'sub' value="<?php echo _("Загрузить"); ?>" />
	
</form>
</center>
<?php
	$arr['students'] = array("name", "surname", "grade", "letter", "email", "password", "PIN", "points"); // ??
	$arr['books'] = array("name", "serial1", "serial2" , "grade", "category", "lang", "price");
	if(!$_POST['sub']){elibDie();}
	/* VARIABLES */
	if($_POST['table'] == "1")
		$table = "students";
	else
		$table = "books";
	$file = $_FILES['file']['tmp_name'];
	$row = 0;
	$divider = $_POST['divide'];
	/* Action */
	if (($handle = fopen($file, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, $divider)) !== FALSE) {
			$row++;
			if(!insert($con, $table, $arr[$table], $data)){
				echo error(_("Ошибка"). "$row добавлено");
				elibDie();
			}
			debug($data, "Added");
		}
		success( "$row "._("Добавлено"));
		fclose($handle);
	} else {
		echo error(_("Ошибка"));
	}



	require_once('../../../stuff/footer.php');
?>