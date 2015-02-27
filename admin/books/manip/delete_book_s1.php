<?php
	require_once('../../../stuff/config.php');
	permission("super");
	if(isset($_GET['s1'])){
		$bid = $_GET['s1'];
		addslashes($bid);
		$book = get_book_data_s1($bid, $con);
		delete_book_s1($bid, $con);
		put_in_history($con, -1, "Вы удалили книги с serial1 : <b>$bid</b> и Названием : <b>{$book['name']}</b>" , "Книги:Удаление");
	}
	require_once('../../../stuff/footer.php');
?>