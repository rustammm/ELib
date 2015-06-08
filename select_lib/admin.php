<?php
	require_once("config.php");
	if(!$HOSTER)
	{
		echo "<meta http-equiv='refresh' content='0; URL= auth.php' >";
		elibDie();
	}
	permission("hoster");
?>
<br>
<center>
	<h1 class = "header">
	ELib
	</h1>
	<h3 class = "subheader">
        <?php echo _("Администратор"); ?>
	</h3>
</center>
<?php
	require_once("../stuff/footer.php");
?>