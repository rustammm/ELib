<?php
require_once('../../stuff/config.php');
permission("admin");
function show_students($con){
	$res = sql_select($con, "students");
	if(!$res){
		error(_("Ошибка"));
		die;
	}
	$rows = $res->num_rows;
	$col1 = "<td><b>"._("ID")."</b></td>";
	$col2 = "<td><b>"._("ИМЯ")."</b></td>";
	$col3 = "<td><b>"._("ФАМИЛИЯ")."</b></td>";
	$col4 = "<td><b>"._("КЛАСС")."</b></td>";
	$col5 = "<td><b>"._("БАЛЛЫ")."</b></td>";
	$col6 = "<td><b>O1</b></td>";
	$col7 = "<td><b>O2</b></td>";
	echo "
	<table class='dataTable display cell-border sortable'>
	<thead>
	<tr>$col1 $col2 $col3 $col4 $col5 $col6 $col7</tr>
	</thead>
	<tbody>
	";
	while($row = $res->fetch_assoc()){
		$id= $row['id'];
		$sid = "<a href = '../../public/student.php?id=$id'>$id</a>";
		$sname = $row['name'];
		$ssurname = $row['surname'];
		$sgrade = $row['grade'];
		$slet = $row['letter'];
		$col5 = $row['points'];
		$col7 = "<a href = 'manip/delete_student.php?id=$id' class = 'button danger'> "._("УДАЛИТЬ")." </a>";
		$col6 = "<a href = 'manip/edit_student.php?id=$id' class = 'button info'> "._("ИЗМЕНИТЬ")." </a>";
		echo "<tr><td>$sid</td><td>$sname</td><td>$ssurname</td><td>$sgrade $slet</td><td> $col5 </td><td> $col6 </td><td> $col7 </td></tr>";
	}
	echo "</tbody></table>";
}
echo "<a href = 'add_student.php' class = 'button success'> "._("Добавить ученика")."</a><br>";
show_students($con);
require_once('../../stuff/footer.php');
?>