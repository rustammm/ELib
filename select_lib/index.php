<?php
	require_once('config.php');
	permission("main");
	$query = "SELECT * FROM libraries WHERE hidden = false";
	$all_libs = mysqli_query($con, $query);
	echo"
	<center>
	<h2><a href = '#' class = 'menu' style = 'border-radius: 30px; border: 1px solid black;'>-?-</a></h2>
	<br> 
	<br>
	<script>
	reTitle(_('->Выбрать библиотеку'));
	</script>
	";
	echo _("Выберите любую библиотеку").":
	
	<table class='dataTable display cell-border sortable'>
	<thead>
		<tr>
			<td>
				<b>"._("НАЗВАНИЕ")."</b>
			</td>
			<td>
				<b>
					"._("ОПЦИЯ")."
				</b>
			</td>
		</tr>
	</thead>
	<tbody>
	";
	while($lib = $all_libs->fetch_assoc()){
		$col1 = $lib['school_name'];
		$col2 = $lib['id'];
		$col2 = "<a class = 'button info' href = 'select.php?id=$col2'> "._("Выбрать")." </a>";
		echo "
		<tr>
		<td>
		$col1
		</td>
		<td>
		$col2
		</td>
		</tr>		
		";
	}
	echo "</tbody></table></center>";

?>