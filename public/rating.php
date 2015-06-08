<?php
	require_once('../stuff/config.php');
	permission("main");
	echo "
	<center class = 'header'>
			<h1>
			"._("Рейтинг")."
			</h1>
		</center>
	";
	$res = sql_select($con, "students", false, false, false, "ORDER BY points DESC");
	if($res == false){
			error(_("Ошибка"), _("Ошибка при подключении к MySQL"));
			elibDie();
	}
	$rows = $res->num_rows;
	$last_p = -1;
	$cnt = 0;
	$rate = 1;
	echo "<table class='dataTable display cell-border sortable' border = 1>
	<thead>
	<tr>
	<td> <b> N </b> </td>
	<td> <b> "._("Имя")." </b> </td>
	<td> <b> "._("Фамилия")." </b> </td>
	<td> <b> "._("Класс")." </b> </td>
	<td><b> "._("БАЛЛЫ")." </b> </td>
	<td> <b> O1 </b> </td>
	</tr>
	</thead>
	<tbody>";
	while($row = $res->fetch_assoc()){
		$cnt++;
		$name = $row['name'];
		$surname = $row['surname'];
		$grade = $row['grade'];
		$let = $row['letter'];
		$points = $row['points'];
		$id = $row['id'];
		if($last_p != $points){
			$last_p = $points;
			$rate = $cnt;
		}
		$col1 = "<a href = 'student.php?id=$id'>$name $surname $grade$let</a>";
		$col3 = $rate;
		$col2 = $points;
		echo "<tr> 
		<td> $col3 </td>
		<td> $name </td>
		<td> $surname </td>
		<td> $grade$let </td>
		<td> $col2 </td> 
		<td> <a href = 'student.php?id=$id' class = 'button info'> "._("Подробнее")." </a> </td>
		</tr>";
	}
	echo "</tbody></table>";
?>
<script>
reTitle("<?php echo _("->Рейтинг"); ?>");
</script>