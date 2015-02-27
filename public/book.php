<?php
	require_once('../stuff/config.php');
	permission("main");
	require_once('data.php');
	if(!$_GET['s1'])
		die;
	$s1 = $_GET['s1'];
	
	 function echo_book_data($s1, $con){
		$data = get_book_data_s1($s1, $con);
		$name = $data['name'];
		$grade =  $data['grade'];
		$lang = $data['lang'];
		$categ =  $data['category'];
		$price = $data['price'];
		$to_search = "$name $grade";
		echo "<center><a href =  'from_kitap.php?name={$to_search}&s1={$s1}' class = 'button success span12 large' >"._("СКАЧАТЬ")."</a></center>";
		
	  }
	
	
	function show_books($con){
		global $ADMIN, $SUPER_ADMIN;
		global $s1;
		echo_book_data($s1, $con);		
		
		$res = sql_select($con, "books", "serial1 = ?", array($s1));
		if(!$res){
			error(_("Ошибка"));
			die;
		}
		$rows = $res->num_rows;	
		$col1 = "<td><b>"._("НАЗВАНИЕ")."</b></td>";
		$col2 = "<td><b>"._("СЕРИЙНЫЙ НОМЕР 1")."</b></td>";
		$col3 = "<td><b>"._("СЕРИЙНЫЙ НОМЕР 2")."</b></td>";
		$col4 = "<td><b>"._("КЛАСС")."</b></td>";
		$col5 = "<td><b>"._("ЯЗЫК")."</b></td>";
		$col6 = "<td><b>"._("КАТЕГОРИЯ")."</b></td>";
		$col7 = "<td><b>"._("СТАТУС")."</b></td>";
		$col8 = "<td><b>"._("У КОГО")."</b></td>";
		$col9 = "<td><b>"._("КОГДА ВЗЯЛИ")."</b></td>";
		$col10 = "<td><b>"._("ЦЕНА")."</b></td>";
		$col11 = "<td><b>O1</b></td>";
		$col12 = "<td><b>O2</b></td>";
		if(!$ADMIN){
			$col8 = "";
			$col9 = "";
			$col11 = "";
			$col12 = "";
		}
		if(!$SUPER_ADMIN){
				$col11 = "";
				$col12 = "";
			}
		echo "
		<table class='dataTable display cell-border sortable'>
		<thead>
		<tr>$col1 $col2 $col3 $col4 $col5 $col6 $col7 $col8 $col9 $col10 $col11 $col12</tr>
		</thead>
		<tbody>
		";
		while($row = $res->fetch_assoc()){
			$id = $row['id'];
			$name= $row['name'];
			$s1 = "<td>".$row['serial1']."</td>";
			$name = "<td> $name </td>";
			$s2 = "<td>".$row['serial2']."</td>";
			$grade = "<td>".$row['grade']."</td>";
			$lang = "<td>".$row['lang']."</td>";
			$cat = "<td>".$row['category']."</td>";
			if($row['student'] <= 0){
				$col7 = "<td> <font color = 'gren'> "._("В БИБЛИОТЕКЕ")."</font></td>";
				$col8 = "<td>".'-'."</td>";
				$col9 = "<td>".'-'."</td>";
			}else{
				$col7 = "<td> <font color = 'red'> "._("НЕ В БИБЛИОТЕКЕ")."</font></td>";
				$sid = $row['student'];
				$data = get_data($sid, $con);
				$sname = $data['name'];
				$surname = $data['surname'];
				$sgrade = $data['grade'];
				$slet = $data['letter'];
				$col8 = "<td>"."<a href = 'student.php?id=$sid'> $sname $surname $sgrade$slet </a>"."</td>";
				$col9 = "<td>".$row['date_taken']."</td>";
				
			}
			$col10 = "<td>".$row['price']."</td>";
			$col12 = "<td><a href = '../admin/books/manip/delete_book.php?id=$id' class = 'button danger'> "._("УДАЛИТЬ")." </a></td>";
			$col11 = "<td><a href = '../admin/books/manip/edit_book.php?id=$id' class = 'button info'> "._("ИЗМЕНИТЬ")." </a></td>";
			if(!$ADMIN){
				$col8 = "";
				$col9 = "";
				$col11 = "";
				$col12 = "";
			}
			if(!$SUPER_ADMIN){
				$col11 = "";
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
	
	show_books($con);
	require_once('../stuff/footer.php');
?>