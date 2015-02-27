<?php
	require_once("../stuff/config.php");	
    if($ADMIN != 1){
			echo '<script>window.location.href = "auth.php";</script>';
            die();
    }else{
        permission("admin");
    }
?>
<script>
reTitle("<?php echo _("->Библиотекарь"); ?>");
</script>

<div class = "menu">
<center>
	<h1 class = 'header'>
        <?php echo _("Библиотекарь"); ?>
	</h1>
</center>
<?php
	require_once('../stuff/footer.php');
?>