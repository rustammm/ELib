<?php
/* Variables */
$type = $_POST['type'];
$sid = $_POST['sid'];
$jsoned = "";
$to_send = "";
session_id($sid);
session_start();
require_once('../../../stuff/db_connection.php');
$IS_ADMIN = $_SESSION['admin'];
$SADMIN_ID = $_SESSION['said'];
$library_id = $_SESSION['school_id'];
/* Functions */

function del_in_act($con)
{  // returns Boolean
    global $SADMIN_ID;
    $row = sql_delete($con, "in_act_books", "sid = ?", array($SADMIN_ID));
    if (!$row)
        return false;
    return true;
}

function json_error($explanation)
{
    $to_send['error']["status"] = 1;
    $to_send['error']['message'] = $explanation;
    $jsoned = json_encode($to_send);
    return $jsoned;
}

function check_student($con, $id, $password)
{
    $password = md5(md5($password));
    $res = sql_select($con, "students", "id = ? and PIN = ?", array($id, $password));
    if ($res->num_rows != 1) {
        return 0;
    }
    return 1;
}

function get_info($con)
{
    global $SADMIN_ID;
    $to_send["student"]["num"] = 0;
	$to_send["error"]["status"] = 0;
    $to_send["book"]["num"] = 0;
    $last_id = $_POST['last_id'];
    $res = sql_select($con, "in_act_books", "sid = ?", array(intval($SADMIN_ID)));
    if ($res->num_rows < 1) {
        if (!$res) {
            $to_send["error"]["status"] = 1;
            $to_send["error"]["message"] = _("Ошибка Базы Данных");
        }
        $to_send["num"] = 0;
        $to_send["last_id"] = $last_id;
        return json_encode($to_send);
    }
    $res = sql_select($con, "in_act_books", "sid = ? and id > ?", array($SADMIN_ID, $last_id));
    $to_send["num"] = $res->num_rows;
    while ($row = $res->fetch_assoc()) {
        $this_type = $row["type"];
        $last_id = max($last_id, $row["id"]);
        $to_send[$this_type]["num"]++;
        if ($this_type == "student") {
            $to_send[$this_type]['item'] = $row["item_id"];
        } else {
            $book_data = get_book_data_by_id($row["item_id"], $con);
            $to_send[$this_type]["item"][] = array($book_data['name'], $book_data['grade'], $book_data['serial1'], $book_data['serial2']);
        }
        $to_send["last_id"] = $last_id;
    }
    return json_encode($to_send);
}

function update_books($con, $get = false)
{	
    global $SADMIN_ID;
    $to_send = NULL;
    $to_send["error"]["status"] = 0;
	$id = $_POST['student_id'];
    if ($get) {
        $id = 0;
    }
    $password = $_POST['password'];
    $books_num = 0;
    $books_success = 0;
	
    $to_send['passlog'] = check_student($con, $id, $password);
    if (!$get && (!check_student($con, $id, $password))) {
        return json_error(_("Неправильный пароль"));
    }
	
    $res = sql_select($con, "in_act_books", "sid = ? and type = ?", array($SADMIN_ID, "book"));
    $books_num = $res->num_rows;
	
    while ($row = $res->fetch_assoc()) {
        if (sql_update($con, "books", array("student"), array($id), "id = ?", array($row["item_id"]))) {
            $books_success++;
        }
    }
    if ($books_num == $books_success && update_ratings($id, $books_num, $con)) {
        $to_send["message"] = $books_success ." "._("книг(а) изменили статус");
        $to_send["last_id"] = "0";
        if (!del_in_act($con)) {
            return json_error(_("Ошибка изменения статусов книг. Попбробуйте снова"));
        }
        return json_encode($to_send);
    } else {
        return json_error(_("Ошибка изменения статусов книг. Попбробуйте снова"));
    }
	
}


/* Logic */

if (!$IS_ADMIN) {
    echo json_error(_("Ошибка доступа"));
    die;
}
if ($type == "i") {
    echo get_info($con);
}
if ($type == "tolib") {
    echo update_books($con, 1);
}
if ($type == "tostu") {
    echo update_books($con, 0);
}
?>
