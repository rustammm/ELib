<?php
	/*
	INSERT: sql_insert($con, "libraries" ,array("school_name", "school_db"), array($lib_name, $db_name));    WORKS
	UPDATE: sql_update($con, "libraries" ,array("school_name", "school_db"), array($lib_name, $db_name), "id = ?", array(1)); WORKS
	DELETE: sql_delete($con, "libraries", "id = ?", array(15))  WORKS
	SELECT ALL: sql_select($con, "students", "surname = ?", array("Surname"), "SELECT DISTINCT", "ORDER By points DESC") WORKS 
	*/

	/* 
		####################
		GENERAL1				
		####################
	*/
	
	function error($message_short, $message_full = ""){
		global $full_errors;
		echo "
		<div class='isa_error'>
		<i class='fa fa-times-circle'></i>
		<span class = 'subheader'> $message_short </span>
		";
		if($full_errors){
			echo "<span class = 'subheader'> : </span><span class = 'subheader-secondary'> $message_full </span>";
		}
		echo "
		</div>
		";
	}

    function elibDie() {
        require_once("footer.php");
        die;
    };

	function success($message_short){
		echo "
		<div class='isa_success'>
		<i class='fa fa-check'></i>
		<p class = 'subheader'> $message_short </p>
		</div>
		";	
	}
	function debug($value, $name = "DEBUG OUTPUT"){
		global $DEBUG_OUTPUT;
		ob_start();
		var_dump($value);
		$value = ob_get_clean();
		$DEBUG_OUTPUT .= "
		<tr>
			<td> $name </td>
			<td> $value </td>
		</tr>
		";
	}
	
	function permission($name, $show = true){
		global $ADMIN, $SUPER_ADMIN, $HOSTER, $STUDENT;
		if((($ADMIN && $name == "hoster") || ($ADMIN && $name == "super")) && !$HOSTER && !$SUPER_ADMIN ){
			error(_("Ошибка доступа"), _("Вы не Администратор или не Библеотекарь +"));
			elibDie();
		}
		if($name == "hoster" && !$HOSTER){
			error(_("Ошибка доступа"), _("Вы не Администратор"));
			elibDie();
		}
		if($HOSTER && $name != "hoster" && $name != "main" && !$ADMIN){
			error(_("Ошибка доступа"), _("Вы не Библеотекарь"));
			elibDie();
		}
		if(!$HOSTER && !$ADMIN  && !$SUPER_ADMIN && !$STUDENT && $name != "main"){
			menu("main");
			error(_("Ошибка доступа"), _("Вы не вошли в систему"));
			elibDie();
		}
		if(!$STUDENT)
		$name = "main";
		if($STUDENT)$name = "student";
		if($ADMIN)$name = "admin";
		if($SUPER_ADMIN)$name = "super";
		if($HOSTER)$name = "hoster";
		if($show)
			menu($name);
	}
	
	function refValues($arr)   // For Prepared Statements
	{ 
		if(!is_array($arr))
			return array();
        $refs = array();

        foreach ($arr as $key => $value)
        {
            $refs[$key] = &$arr[$key]; 
        }

        return $refs; 
	}
	
	function paramtypez($arr)  // For Prepared Statements
	{
        $types = '';                        //initial sting with types
        foreach($arr as $para) 
        {     
            if(is_int($para)) {
                $types .= 'i';              //integer
            } elseif (is_float($para)) {
                $types .= 'd';              //double
            } elseif (is_string($para)) {
                $types .= 's';              //string
            } else {
                $types .= 'b';              //blob and unknown
            }
        }
        return $types;
	}
	
	/* 
		####################
		SQL 				
		####################
	*/
	
	
	function prepared_query($con, $query, $params, $is_select = false){
		if($params)
			$params = array_merge(array(paramtypez($params)), $params);
		if (!$stmt = $con->prepare($query)){
			debug($con->error);
			debug($query);
			return false;
		}
		
		if($params){
			call_user_func_array(array($stmt, "mysqli_stmt::bind_param"), refValues($params));
		}
		if (!$stmt->execute()){
			error($stmt->error);
			return false;
		}

		if($is_select){
			$return = $stmt->get_result();	
		}else{
			$return = true;
		}
		$stmt->close();
		return $return;
	}
	
	
	
	function sql_insert($con, $table_name, $to_insert_table_titles, $to_insert){ // Last two - arrays	
		global $library_id;
		$to_insert_table_titles[] = "library";
		$to_insert[] = $library_id;
		$query_part1 = implode(', ', $to_insert_table_titles);
		$query_part2 = "?";
		for($i = 1; $i < count($to_insert_table_titles); $i++)
			$query_part2 .= ", ?";
		$query = "INSERT INTO $table_name($query_part1) VALUES ($query_part2)";
		return prepared_query($con , $query, $to_insert);
	}
	
	
	function sql_update($con, $table_name, $to_ubdate_table_titles, $to_update, $where, $where_values){ // $where like "id = ? AND date = ?"	
		global $library_id;
		if($where == "")
			$where = " library = ?";
		else
			$where .= " and library = ?";
		$where_values[] = $library_id;
		$query_part1 = implode('= ?, ', $to_ubdate_table_titles)." = ?";
		$query_part2 = array_merge($to_update, $where_values);
		$query = "UPDATE $table_name SET $query_part1 WHERE $where";
		if($where == "")
			$query = "UPDATE $table_name SET $query_part1";
		return prepared_query($con , $query, $query_part2);
	}
	
	
	function sql_delete($con, $table_name, $where, $where_values){ // $where like "id = ? AND date = ?"	
		global $library_id;
		if($where == "")
			$where = " library = ?";
		else
			$where .= " and library = ?";
		$where_values[] = $library_id;
		$query = "DELETE FROM $table_name WHERE $where";
		return prepared_query($con , $query, $where_values);
	}
	
	
	function sql_select($con, $table_name ,$where = "", $where_values = "", $after_select = false, $after_all = ""){ // $where like "id = ? AND date = ?"	, selects all info (SELECT * )
		global $library_id;
		if($where == "")
			$where = " library = ?";
		else
			$where .= " and library = ?";
		$where_values[] = $library_id;
		$query = "SELECT * FROM $table_name WHERE $where $after_all";
		if($after_select != false){
			$query = str_replace('SELECT *', $after_select, $query, $count);
		}
		return prepared_query($con , $query, $where_values, $is_select = true);
	}
	
	/* 
		####################
		GENERAL2 				
		####################
	*/

	function mes_settings($con){
		$to_return = "<div>";
		$result = sql_select($con, "history", "", "", "SELECT DISTINCT category");
		if(!$result){
			error(_("Ошибка"), _("Ошибка при построение фильтра"));
		}
		while($row = $result->fetch_assoc()){
			$to_return .= "  <label><input data-transform=\"input-control\" type = 'checkbox' class = 'settings' value = '{$row['category']}' data-transform = 'input data-transform=\"input-control\"-control' checked> {$row['category']} </label>	";
		}		
		$to_return .= " </div>";
		echo $to_return;
	}
	
	
	function put_in_history($con ,$object, $message, $category = "Без категории"){
		$query = "INSERT INTO history (object, description, category) VALUES ($object, '$message', '$category');";
		$res = sql_insert($con, 'history', array("object","description","category"), array($object, $message, $category));
		
		if(!$res){
			error(_("Ошибка"), _("Ошибка при отправке истории"));
			elibDie();
		}else{
			success(_("История сохранена"));
		}
	}
	
	
	function is_in_db($table, $where, $params, $con){
			$result = sql_select($con, $table, $where, $params);
			if($result == false){
				error(_("Ошибка"), _("Ошибка при при проверки на существование элемента"));
				elibDie();
			}
			if($result->num_rows > 0){
				return true;
			}
			return false;
	}
	
	function x_eval($con, $data){
		return md5("{$data['id']}"."{$data['library']}"."{$data['email']}"."{$data['pass']}"."{$data['pin']}"."{$data['pin']}");
	}
	/* 
		####################
		BOOKS 				
		####################
	*/
	
	function put_books_db($name, $s1, $max_s2, $lang, $categ, $grade, $price, $con){
		for($i = 1; $i <= $max_s2; $i++){
			$result = sql_insert($con, "books" ,array("name", "serial1", "serial2", "lang", "category", "grade", "price"), array($name, $s1, $i, $lang, $categ, $grade, $price));
			
			if($result == false){
				error(_("Ошибка"), _("Ошибка при добавлении книги в библиотеку"));
				elibDie();
			}
		}
		$last_id = mysqli_insert_id($con);
		put_in_history($con, -1, "Вы добавили книгу с id : <b>$last_id</b> и названием : <b>$name</b>, номером: <b>$s1</b>", "Книги:Добавление");
	}
	
	function get_book_data_s1($book_s1, $con){                                         // book_data
		$res = sql_select($con, "books", "serial1 = ?", array($book_s1));
		if(!$res){
			error(_("Ошибка"), _("Ошибка при попытке нахождения информации книге"));
			elibDie();
		}else{
			$res = $res->fetch_assoc();
			return $res;
		}
	}
	function get_book_data_id($s1, $s2, $con){                                         // book_data
		$res = sql_select($con, "books", "serial1 = ? and serial2 = ?", array($s1, $s2));
		if(!$res){
			error(_("Ошибка"), _("Ошибка при попытке нахождения информации книге"));
			elibDie();
		}else{
			return $res;
		}
	}
	
    function get_book_data_by_id($bid, $con){                                         // book_data
		$res = sql_select($con, "books", "id = ?", array($bid));
		if(!$res){
            return -1;
		}else{
			return $res->fetch_assoc();
		}
	}
	
	function delete_book_s1($s1, $con){
		$res = sql_delete($con, "books", "serial1 = ?", array($s1));
		if(!$res){
			error(_("Ошибка"), _("Ошибка при удалении книги"));
			elibDie();
		}else{
			success(_("Успешно удалено"));
		}
	}
	/* 
		####################
		STUDENTS 				
		####################
	*/
	function add_stu_db($con, $name, $surname, $grade, $letter, $password, $email, $PIN){
		if($id == ""){
			$title_names = array("name", "surname", "grade", "letter", "password", "email", "PIN");
			$params = array($name, $surname, $grade, $letter, $password, $email, $PIN);
		}else{	
			$title_names = array("name", "surname", "grade", "letter", "password","id", "email", "PIN");
			$params = array($name, $surname, $grade, $letter, $password, $id, $email, $PIN);
		}
			$res = sql_insert($con, "students" ,$title_names, $params);
			if(!$res){
				error(_("Ошибка"), _("Ошибка при добавлении ученика"));
				elibDie();
			}else{
				success(_("Успешно добавлено"));
			}
			$last_id = mysqli_insert_id($con);
			put_in_history($con, -1, "Вы добавили ученика с id : <b>$last_id</b> , Фамилией : <b>$surname</b>, Именем: <b>$name</b>", "Ученики:Добавление");
	}
	
	function get_student_data($person_id, $con){  // student
		if($person_id == -1){
			$row['name'] = "Admin";
			return $row;
		}
		$res = sql_select($con, "students", "id = ?", array($person_id));
		if(!$res){
			error(_("Ошибка"), _("Ошибка при попытке нахождения информации об ученике"));
			elibDie();
		}else{
			if($res->num_rows > 0){
				$row = $res->fetch_assoc();
				return $row;
			}
		}
	}
	
	
	function update_ratings($sid, $p, $con){
		$data = get_student_data($sid, $con);
		$points = $data['points'];
		$points+=$p;
		$res = sql_update($con, "students", array("points"), array($points), "id = ?", array($sid));
		return !(!$res);
	}
	
	
	function give_rating_num($sid, $con){
		$res = sql_select($con, "students", "", "", false, "ORDER By points DESC");
		if($res == false){
				error(_("Ошибка"), _("Ошибка при составлени рейтинга"));
				elibDie();
		}
		$last_p = -1;
		$cnt = 0;
		$rate = 1;
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
			if($sid == $id){
				return $rate;
			}
		}
		
		return _("УЧЕНИК ОТСУТСТВУЕТ");
	}


	
	/* 
		####################
		AUTH  				
		####################
	*/
	function check_auth_user($con, $login, $password) { // Boolean
		if (!$res = sql_select($con, "users", "name = ? and password = ?", array($login, $password))) {
			return false;
		}
		if ($res->num_rows < 1) {
			return false;
		}
		return true;
	}
	function get_data_user($con, $login, $password) {
		if (!check_auth_user($con, $login, $password))
			return false;
		if (!$res = sql_select($con, "users", "name = ? and password = ?", array($login, $password))) {
			return false;
		}
		return $res->fetch_assoc();
	} 
		
	/* 
		####################
		QR GEN  				
		####################
	*/

	function get_books_qr($con, $id) { // ??
		$send;
		$res = sql_select($con, "books", "student = ?", array($id), "SELECT *", "ORDER BY  name ASC");
		while($data = $res->fetch_assoc()) {
			$now["info"] = "{$data['name']} <br> {$data['grade']} <br> "._("номер")." {$data['serial1']} {$data['serial2']} {$data['library_name']}";
			$now["info_small"] = "{$data['name']}  {$data['grade']}";
			$now["qr"] = "{$data['library']}@{$data['serial1']}@{$data['serial2']}"; 
			$send[] = $now;
		}
		return $send;
	}


		function get_qr_student($con, $data) {
		if ($data['id'] == 0) {
			$info = "Нет QR кода";
			$qr = "";
			$send['i']['info'] = $info;
			$send['i']['qr'] = $qr;
			$send['i']['info_small'] = _("В библиотеке");
			$send['books'] = get_books_qr($con, $data['id']);		
			return $send;
		}
	
		$info = "{$data['name']} <br> {$data['surname']} <br> {$data['grade']}{$data['letter']} <br> {$data['library_name']}";
		$qr = "{$data['library']}@{$data['id']}";
		$send['i']['info'] = $info;
		$send['i']['qr'] = $qr;
		$send['i']['info_small'] = "{$data['name']} {$data['surname']}";
		$send['books'] = get_books_qr($con, $data['id']);
		return $send;
	}


	function get_qr_students($con) {

		global $library_name;
		$send;
		$res = sql_select($con, "students", "", "", "SELECT *", "ORDER BY grade, letter, surname, name ASC");
		while ($row = $res->fetch_assoc()) {
			$id = $row['id'];
			$row['library_name'] = $library_name;
			$gradel = $row['grade'].$row['letter'];
			$send[$gradel][] = get_qr_student($con, $row);
		}
		$row['id'] = 0;
		$send[_("В Библиотеке")][] = get_qr_student($con, $row);
		return $send;
	}

	?>