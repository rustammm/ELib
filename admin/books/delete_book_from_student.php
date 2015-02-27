<?php
	require_once('../../stuff/config.php');
	permission("admin");

	function update_db($id, $serial1, $serial2, $day, $con){
		addslashes($id);
		$result = sql_update($con, "books", array("student", "date_taken"), array($id, $day), "serial1 = ? and serial2 = ?", array($serial1, $serial2));
		if($result == false){
			error("Ошибка");
			die;
		}else{
			success("Успешно");
		}
	}
	

	if($_POST['sub']){
		$stu = $_POST['stu'];
		$s1 = $_POST['s1'];
		$s2 = $_POST['s2'];
		addslashes($stu);
		addslashes($s1);
		addslashes($s2);		
		$result = get_book_data_id($s1, $s2, $con);
		if($result == false){
			error("Ошибка");
		}
		$rows = $result->num_rows;
		if($rows <= 0){
			error("Такой книги нет");
			die;
		}
		// finding book name and owner
		$row = $result->fetch_assoc();
		$book_name = $row["name"];
		$owner = $row["student"];
		if($owner != 0){
			error("КНИГА НАХОДИТСЯ У ДРУГОГО УЧЕНИКА С id : $owner");
			die;
		}
		$today = date("d F Y H:i");
		// end of finding 
		if(!is_in_db("students",  "id = ?", array($stu), $con)){
			error("ТАКОГО УЧЕНИКА НЕТ");
			die;
		}
		update_db(0, $s1, $s2, $today, $con);
		put_in_history($con, $stu, "Вы сдали в библиотеку книгу с СН : $s1 / $s2 и названием = $book_name", "Книга возвращена");	
		update_ratings($stu, $con);
	}
?>
<script>
	function refresh_frames(){
		var stu = document.getElementById('11').value;
		var book = document.getElementById('12').value;
		var frame1 = document.getElementById('1');
		var frame2 = document.getElementById('2');
		frame1.src = "../../public/student_data_only.php?id=" + stu;
		frame2.src = "../../public/book_data_only.php?s1=" + book;
	}

</script>


<form method="post">
	<input data-transform='input-control' type="number" id = '11' name = 'stu' placeholder="ID ученика" onkeydown = "refresh_frames()">
	<input data-transform='input-control' type = "number" id = '12' name = 's1' placeholder="СЕРИЙНЫЙ НОМЕР 1" onkeydown = "refresh_frames()">
	<input data-transform='input-control' type = "number" id = '13' name = 's2' placeholder="СЕРИЙНЫЙ НОМЕР 2" onkeydown = "refresh_frames()">
	<input data-transform='input-control' type="submit" name = 'sub'>
 <form>
 <br>
 
<iframe name = "student" id = '1' ></iframe>
<iframe name = "book" id = '2' ></iframe>
Выдача книги
<script>
reTitle("->Выдача книги");
</script>
<?php
	require_once('../../stuff/footer.php');
?>