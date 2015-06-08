<?php
	if($_GET['id'] == -1) {
		require_once('../admin/is_admin.php');
	}
        
	require_once("../stuff/config.php");
	require_once("../stuff/functions.php");
	require_once("data.php");
	
        if ($_GET['id'] == -2) {
            echo "
                <center>
                        <h1> "._("Не выбран")." </h1>
                </center>
            ";
            elibDie();
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
			<center>
				<h1> $name </h1>
				<h2> $surname </h2>
				<h2> $grade $letter </h2>
			</center>
		
		";
	}
?>
<script>
reTitle("<?php echo _("->Инфомация об ученике"); ?>");
</script>