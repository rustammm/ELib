<?php
	require_once("config.php");
	permission("hoster");
	$query = "SELECT * FROM libraries";
	$all_libs = mysqli_query($con, $query);
	echo "
	<table class='dataTable display cell-border sortable'>
	<thead>
	<tr>
	<th>	
	<b>"._("НАЗВАНИЕ")."</b>
	</th>
	<th>	
	<b>"._("НАЗВАНИЕ БАЗЫ ДАННЫХ")."</b>
	</th>
	<th>	
	<b>"._("СТАТУС")."</b>
	</th>
	<th>
	<b>
	"._("ОПЦИЯ")."
	</b>
	</th>
	</tr>
	</thead>
	<tbody>
	";
	while($lib = $all_libs->fetch_assoc()){
		$col1 = $lib['school_name'];
		$col2 = $lib['school_db'];
		if($lib['hidden']){
			$col3 = "<font color = 'red'>"._("Не виден")."</font>";
		}else{
			$col3 = "<font color = 'green'>"._("Виден")."</font>";
		}
		$col4 = $lib['id'];
		$col4 = "<a class = 'button info' href = 'edit.php?id=$col4'>  "._("Изменить")."  </a>";
		
		echo "
		<tr>
		<td>
		$col1
		</td>
		<td>
		$col2
		</td>
		<td>
		$col3
		</td>
		<td>
		$col4
		</td>
		</tr>		
		";
	}
	echo "</tbody></table>";
?>
<?php
	require_once('../stuff/footer.php');
?>