<?php
	error_reporting(E_ALL);
	require_once('stuff/config.php');
	permission("main");
	echo $site_name;
?>
<div class = "menu">
<center class = 'subheader'>
	Electronic Library
</center>
</div>
<br>
<script>
reTitle("<?php echo _("->Главная"); ?>");
</script>
<center>
<a href = 'public/rating.php' class = 'button large success'>
    <?php echo _("Найти меня"); ?>
</a>
</center>
</body>
</html>