<?php
	require_once('../../../stuff/db_connection.php');
	
	/* Variables */
	
	$type = NULL;
	$info = NULL;
	$library_id = NULL;
	
	/* Functions */
	function already_in($con ,$type, $info) {  // returns Boolean
		$row = NULL;
		if ($type == 'student') {
			$row = sql_select($con, 'in_act_books', 'item_id = ? and type = ?', array($info['id'], $type));
		} else {
			$id = get_book_data_id($info['s1'], $info['s2'], $con);
			$id = $id->fetch_assoc();
			$id = $id['id'];
			$row = sql_select($con, 'in_act_books', 'item_id = ? and type = ?', array($id, $type));
		}
		if ($row->num_rows == 0) {
			return false;
		}		
		return true;
	}
	
	function exists($con ,$type, $info) {  // returns Boolean
		$row = NULL;
		if ($type == 'student') {
			$row = sql_select($con, 'students', 'id = ?', array($info['id']));
		} else {
			$row = get_book_data_id($info['s1'], $info['s2'], $con);
		}
		if ($row->num_rows != 1) {
			return false;
		}		
		return true;
	}
	
	function del_stu_before($con) {  // returns Boolean
		$row = sql_delete($con, "in_act_books", "type = ? and sid = ?", array("student", $info['admin']['id']));		
		if (!$row)
			return false;
		return true;
	}
	
	function addToQuery($con, $type, $info) { // returns Boolean
		$row = NULL;
		$id = $info['id'];
		if ($type == "book") {
			$id = get_book_data_id($info['s1'], $info['s2'], $con);
			$id = $id->fetch_assoc();
			$id = $id['id'];
		}
		$row = sql_insert($con, "in_act_books" ,array('item_id', 'type', 'sid'), array($id, $type, $info['admin']['id']));
		if (!$row)
			return false;
		return true;
	}
	

	
	/* Logic */
	$type = $_GET['type'];
	$info['id'] = intval($_GET['id']);
	$info['s1'] = intval($_GET['s1']);
	$info['s2'] = intval($_GET['s2']);
	$info['library'] = $_GET['library'];
	$info['login'] = $_GET['login'];
	$info['password'] = md5($_GET['password']);
    $IS_ADMIN = "";
    $SADMIN_ID = "";
    $library_id = "";
	if ($_GET['sid'] != "") {
        session_id($_GET['sid']);
        session_start();
        $IS_ADMIN = $_SESSION['admin'];
        $SADMIN_ID = $_SESSION['said'];
        $library_id = $_SESSION['school_id'];
    }
	
	if(!$IS_ADMIN || $library_id != $info['library']) {     // IS ADMIN And if the book from his library
		echo -2;
		elibDie();
	}
	$info['admin']['id'] = $SADMIN_ID;
	
	if (!exists($con, $type, $info)) {
		echo -1;
		elibDie();
	}
	if (already_in($con, $type, $info)) {
		echo 1;
		elibDie();
	}
	if (!del_stu_before($con)) {
		echo 0;
	}
	if (!addToQuery($con, $type, $info)) {
		echo 0;
		elibDie();
	}
	echo 1;	
?>
