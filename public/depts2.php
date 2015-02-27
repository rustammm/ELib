<?php
require_once('../stuff/config.php');
permission("main");
?>
<!--
<script>
  $(function() {
    $( "#datepicker1" ).datepicker();	
  });
  $(function() {
    $( "#datepicker2" ).datepicker();
  });
</script>
-->

<center>
<form action = "show_depts2.php" method="post" class = "span8">
    <h4>
        <?php echo _("Долги"); ?>
        <br>
		<br>
        <?php echo _("От"); ?>
        <i class="fa fa-refresh fa-spin fa-3x on-left-more on-right-more"></i>
        <?php echo _("До"); ?>
		<br>
        <div class= "input-control text span4 dp">
			<input  type="text" name = "from">
			<button class="btn-date"></button>
		</div>
        <div class="input-control text span4 dp">
			<input  type="text" name = "to">
			<button class="btn-date"></button>
		</div>
        <input data-transform="input-control" type = "submit" class = "primary" name = "sub">
    </h4>
</form>
</center>
<script>
    $(".dp").datepicker({
        date: "<?php echo date("Y-m-d");?>", // set init date
        format: "m/d/yyyy", // set output format
        effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: 'ru' // 'ru' or 'en', default is $.Metro.currentLocale
    });
</script>
<?php
require_once('../stuff/footer.php');
?>


