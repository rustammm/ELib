<?php
function get_data($person_id, $con){  // student
	if($person_id == -1){
		$row['name'] = "Admin";
		return $row;
	}
	$res = sql_select($con, "students", "id = ?", array($person_id));
	if(!$res){
		error(_("ОШИБКА"));
		elibDie();
	}else{
		if($res->num_rows > 0){
			$row = $res->fetch_assoc();
			return $row;
		}
	}
}

function get_book_data($book_id, $con){
	$query = "SELECT * FROM books WHERE id = $book_id";
	$res = sql_select($con, "books", "id = ?", array($book_id));
	if(!$res){
		error(_("ОШИБКА"));
		elibDie();
	}else{
		return $res->fetch_assoc();
	}
}

?>