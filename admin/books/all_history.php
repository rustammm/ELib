<?php
	require_once('../../stuff/config.php');
	permission("admin");
	require_once('../../public/data.php');
	$person_id = 0;
	$person_name = '';
	$person_surname = '';
	$person_grade = 0;
	$result = sql_select($con, "history");
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
	echo "
    <table class='dataTable display cell-border sortable'>
    <thead>
    <tr>
    <td><b>"._("КОМУ")."</b></td>
    <td><b>"._("СООБЩЕНИЕ")."</b></td>
    <td><b>"._("ДАТА")."</b></td>
    <td><b>"._("КАТЕГОРИЯ")."</b></td>
    </tr>
    </thead>";
	while($row1 = $result->fetch_assoc()){
		$obj = get_data($row1['object'], $con);
		$message = $row1['description'];
		$m_date = $row1['date'];
		$pname = $obj['name'];
		$psur = $obj['surname'];
		echo "<tr class = '{$row1['category']}'><td><a href = '../../public/student.php?id={$row1["object"]}'>$pname $psur</a></td>";
		echo "<td> $message </td>";
		echo "<td> $m_date </td>"
                        . "<td> {$row1['category']} </td>"
                        . "</tr>\n";		
	}
	echo "</table>";
	require_once('../../stuff/footer.php');
?>	