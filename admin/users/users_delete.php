<?php
require_once('../../stuff/config.php');
permission("super");
if(isset($_GET['id']) and isset($_GET['nick'])){
	$id = $_GET['id'];
}
?>
<center>
    <?php echo _("ВЫ УВЕРЕНЫ?"); ?><br>
<form method = "post" name = "form" class = 'span6'>
<input data-transform="input-control" type = "checkbox" name = "yes" data-transform-type = 'switch'> 
<input data-transform=\"input-control\" type = "submit" name = "sub" value = "<?php echo _("УДАЛИТЬ"); ?>" class = 'primary'>
</form>
</center>
<?php
if($_POST['sub']){
		if(!$_POST['yes']){
			error(_("ОТМЕНЁН"));
		}
		if($_POST['yes']){
			$res = sql_delete($con, 'users', "id = ?", array($id));
			if($res){
				success(_("УДАЛЁН"));
				put_in_history($con, -1,  "Удалён пользователь {$_GET['nick']}", "Пользователи:Удаление");
			}else{
				error(_("ОШИБКА"));
			}	
		}
	
}

	require_once('../../stuff/footer.php');
?>