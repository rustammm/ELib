<?php
	require_once('config.php');
	permission("hoster");
	if($_POST['sub'])
	{
		$uploaddir = $_GET['path'];
		$uploadfile = $uploaddir."/". basename($_FILES['file']['name']);
		echo '<pre>';
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
			success(_("Загружено"));
		} else {
			error(_("Ошибка"));
		}
		print "</pre>";
		
	}
?>
<center>
<form enctype="multipart/form-data" method="POST" class = "span6">
   <h1 class = 'header'> <?php echo _("Загрузка"); ?> </h1>
	<input data-transform="input-control" name="file" type="file" />
    <input data-transform="input-control" type="submit" name = 'sub' value="<?php echo _("Загрузить"); ?>" class = 'primary'/>
</form>
</center>
<?php
require_once("../../stuff/footer.php");
?>