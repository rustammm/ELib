<?php
	require_once('../stuff/config.php');
	permission("main");
	require_once('data.php');
	function show_books($con){
		global $ADMIN, $SUPER_ADMIN;
		$res = sql_select($con, "books", false, false, "SELECT DISTINCT serial1");
		if(!$res){
			error(_("Ошибка"));
			elibDie();
		}
		$rows = $res->num_rows;
		$col1 = "<td><b>"._("НАЗВАНИЕ")."</b></td>";
		$col2 = "<td><b>"._("СЕРИЙНЫЙ НОМЕР 1")."</b></td>";
		// $col3 = "<td><b>СЕРИЙНЫЙ НОМЕР 2</b></td>";
		$col4 = "<td><b>"._("КЛАСС")."</b></td>";
		$col5 = "<td><b>"._("ЯЗЫК")."</b></td>";
		$col6 = "<td><b>"._("КАТЕГОРИЯ")."</b></td>";
		// $col7 = "<td><b>СТАТУС</b></td>";
		// $col8 = "<td><b>У КОГО</b></td>";
		// $col9 = "<td><b>КОГДА ВЗЯЛИ</b></td>";
		$col10 = "<td><b>"._("ЦЕНА")."</b></td>";
		//$col11 = "<td><b>O1</b></td>";
		$col12 = "<td><b>O1</b></td>";
        $col13 = "<td><b>O2</b></td>";
		if(!$SUPER_ADMIN){
			$col12 = "";
            $col13 = "";
		}
		echo "<p  class = 'subheader'><font color = 'orange'> $rows </font> "._("книг в нашей базе данных")." </p>
		<table class='dataTable display cell-border sortable'>
		<thead>
		<tr>$col1 $col2 $col3 $col4 $col5 $col6 $col7 $col8 $col9 $col10 $col11 $col12</tr>
		</thead>
		<tbody>
		";
		while($row = $res->fetch_assoc()){
			$row = get_book_data_s1($row['serial1'], $con);
			$id = $row['id'];
			$name= $row['name'];
			$s1 = "<td>".$row['serial1']."</td>";
			$name = "<td><a href = 'book.php?s1={$row['serial1']}'> $name </a></td>";
			//$s2 = "<td>".$row['serial2']."</td>";
			$grade = "<td>".$row['grade']."</td>";
			$lang = "<td>".$row['lang']."</td>";
			$cat = "<td>".$row['category']."</td>";
			if($row['student'] <= 0){
			//	$col7 = "<td> <font color = 'gren'> НЕ В БИБЛИОТЕКЕ</font></td>";
			//	$col8 = "<td>".'-'."/<td>";
			//	$col9 = "<td>".'-'."/<td>";
			}else{
			//	$col7 = "<td> <font color = 'red'> НЕ В БИБЛИОТЕКЕ</font></td>";
				$sid = $row['student'];
				$data = get_data($sid, $con);
				$sname = $data['name'];
				$surname = $data['surname'];
				$sgrade = $data['grade'];
				$slet = $data['letter'];
			//	$col8 = "<td>"."<a href = '../../public/student.php?id=$sid'> $sname $surname $sgrade$slet </a>"."</td>";
			//	$col9 = "<td>".$row['date_taken']."</td>";
				
			}
			$col10 = "<td>".$row['price']."</td>";
			$col12 = "<td><a href = '../admin/books/manip/delete_book_s1.php?s1={$row['serial1']}' class = 'button danger'> "._("УДАЛИТЬ")." </a></td>";
            // $col13 = "<td><a href = '../admin/books/manip/edit_book.php?id=$id' class = 'button info'> "._("ИЗМЕНИТЬ")." </a></td>";
			if(!$SUPER_ADMIN){
				$col12 = "";
			}
			echo "
			<tr>
			$name
			$s1
			$s2
			$grade
			$lang
			$cat
			$col7 
			$col8
			$col9
			$col10
			$col11
			$col12
			</tr>";
		}
		echo "</tbody></table>";	
	}
	
	if($SUPER_ADMIN)
		echo "<a href = '../admin//books/add_book_db.php' class = 'button success'>"._("Добавить книгу")."</a><br>";
	show_books($con);
	require_once('../stuff/footer.php');
?>