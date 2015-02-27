<?php
	require_once("../stuff/config.php");
	$permission = 'main';
	if($_GET['id'] == -1){
		$permission = 'admin';
	}
	permission($permission);
	require_once("data.php");
	function bookz($pid, $con){
		$total_price = 0;
		$res = sql_select($con, "books", "student = ?", array($pid));
		if(!$res){
			error(_("Ошибка"));
			die;
		}else{
			echo "
			<table class='dataTable display cell-border sortable'>
			<thead>
			<tr>
			<th><b>N</b></th>
			<th><b>"._("НАЗВАНИЕ")."</b></th>
			<th><b>"._("СЕРИЙНЫЙ НОМЕР 1")."</b></th>
			<th><b>"._("СЕРИЙНЫЙ НОМЕР 2")."</b></th>
			<th><b>"._("КОГДА БЫЛ ВЗЯТ")."</b></th>
			<th><b>"._("ЦЕНА")."</b></th>
			</tr>
			</thead>
			<tbody>";		
			$rows = 1;
			while($row = $res->fetch_assoc()){
				$col1 = $rows;
				$rows++;
				$col2 = $row['name'];
				$col3 = $row['serial1'];
				$col2 = "<a href = 'book.php?s1=$col3' title = '"._("Информация о книге")."'>$col2</a>";
				$col4 = $row['serial2'];
				$col5 = $row['date_taken'];
				$col6 = $row['price'];
				$total_price += $col6;
				echo "
				<tr>
				<td> $col1 </td>
				<td> $col2 </td> 
				<td> $col3 </td>
				<td> $col4 </td> 
				<td> $col5 </td>
				<td> $col6 </td>
				</tr>";
			}
			
			echo "
			</tbody>
			</table>
			<br>
			"._("ОБЩАЯ ЦЕНА")." :<font color = 'orange'> $total_price </font>
			";
		}
	
	}
	function history($pid, $con){
		$res = sql_select($con, "history", "object = ?", array($pid));
		// Settings
		echo "
		<!-- Settings -->
		<button onclick = 'showit(-1);' class = 'button info'> "._("Настройки")." </button><br>
		<div id = '-1' style = 'display:none'>
		";
		mes_settings($con);
		echo '
		<br>
			<button onclick = "re_show(); showit(-1);" class = "button success"> '._("Сохранить").' </button>
		</div>
		<!-- Settings -->
		';
		// END Settings
		if(!$res){
			error(_("Ошибка"));
			die;
		}else{
			echo "<table class='dataTable display cell-border sortable'>
			<thead>
			<tr>
			<td><b>"._("СООБЩЕНИЯ")."</b></td>
			<td><b>"._("ДАТА")."</b></td>
			<td><b>"._("КАТЕГОРИЯ")."</b></td>
			</tr>
			</thead><tbody>";		
			while($row = $res->fetch_assoc()){
				$col2 = $row['description'];
				$col3 = $row['date'];
				$col4 = $row['category'];
				echo "<tr class = '{$row['category']}'><td> $col2 </td> <td> $col3 </td>  <td> $col4 </td></tr>";
			}			
			echo "</tbody></table>";
		}
	}
	

    function echoButtons ($button1, $button2) {
        echo "
				<tr>
				<td>$button1</td>
				<td>$button2</td>
				</tr>
				</table>
				<br>
				<center>
				";
    }
	
	
	
	if(isset($_GET['id'])){
		$pid = $_GET['id'];
		addslashes($pid);
		$data = get_data($pid, $con);
		$name = $data['name'];
		$surname = $data['surname'];
		$grade = $data['grade'];
		$letter = $data['letter'];
		$points = $data['points'];
		$rate = give_rating_num($pid, $con);
		echo "
		<center class = 'header'>
			<h1>
			 $name $surname
			</h1>
		</center>
		<br>
		<table class='dataTable display cell-border' align = 'center' class = 'display'>
		<tr><td>"._("Имя")."</td> <td><b>$name</b><br></b></td></tr>
		<tr><td>"._("Фамилия")."</td> <td><b> $surname <br></b></td></tr>
		<tr><td>"._("Класс")." </td><td><b>$grade $letter</b><br></td></tr>
		<tr><td>"._("Баллы")."</td> <td><b>$points<br></b></td></tr>
		<tr><td>"._("Место в рейтинге")."</td> <td><b>$rate<br></b><br></td></tr>
		
		";

        // Buttons History and Books

        $nowBooks = "<button class = 'button success'><b>"._("КНИГИ")."</b></button>";
        $nNowBooks = "<a class = 'button success' href = 'student.php?id=$pid&show=1'> "._("КНИГИ")." </a>";
        $nowHistory = "<b><button class = 'button info'>"._("ИСТОРИЯ")."</b></button>";
        $nNowHistory = "<a href = 'student.php?id=$pid&show=2' class = 'button info'> "._("ИСТОРИЯ")." </a>";
        $buttonBooks;
        $buttonHistory;

		if(isset($_GET['show'])){
			if($_GET['show'] == 1){
                echoButtons($nowBooks, $nNowHistory);
				echo "<div id = '1'>";
				bookz($pid, $con);
				echo "</div>";
			}else{
                echoButtons($nNowBooks, $nowHistory);
				echo "<div id = '2'>";
				history($pid, $con);
				echo "</div>";
			}
		}else{
            echoButtons($nNowBooks, $nNowHistory);
		}
		echo "</center>";
	}
	
?>
<script>
reTitle("<?php echo _("->Инфомация об ученике"); ?>");
</script>