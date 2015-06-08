<?php
	require_once('../../../stuff/config.php');
    permission("super");
	function delete_book($bid, $con){
		$res = sql_delete($con, "books", "id = ?", array($bid));
		if(!$res){
			error(_("Ошибка"), _("Ошибка при удаление"));
			elibDie();
		}else{
			success(_("Успешно удалено"));
		}
	}	
	if(isset($_GET['id'])){
		$bid = $_GET['id'];
		addslashes($bid);
		delete_book($bid, $con);
		put_in_history($con, -1, "Вы удалили книгу с id : <b>$bid</b>", "Книги:Удаление");
	}

	require_once('../../../stuff/footer.php');
	?>
