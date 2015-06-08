<?php
	error_reporting(E_ALL);
	require_once('stuff/config.php');
	permission("main");
	echo $site_name;
?>
<div class = "menu">
<div class = 'subheader' style="text-align: center;">
	Electronic Library
</div>
</div>
<br>
<script>
reTitle("<?php echo _("->Главная"); ?>");
</script>
<div style="text-align: center;">
<a href = 'public/rating.php' class = 'button large success'>
    <?php echo _("Найти меня"); ?>
</a>
</div>
</body>
</html>