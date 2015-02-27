<?php
	require_once('../../../stuff/config.php');
    permission("super");
	function delete_student($sid, $con){
		$res = sql_delete($con, "students", "id = ?", array($sid));
		if(!$res){
			error(_("Ошибка"), _("Ошибка при удалении"));
			die;
		}else{
			success(_("Успешно удалено"));
		}
	}
	
	if(isset($_GET['id'])){
		$sid = $_GET['id'];
		addslashes($sid);
		$stu = get_student_data($sid, $con);
		delete_student($sid, $con);
		put_in_history($con, -1, "Вы удалили ученика с id : <b>$sid</b>, ФИ: <b>{$stu['surname']} {$stu['name']} </b>", "Ученики:Удаление");
	}



	require_once('../../../stuff/footer.php');
?>