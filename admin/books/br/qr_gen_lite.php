<?php
require_once( '../../../stuff/config.php');
permission( 'admin', false);
?>

<script src = '../../../stuff/style/jquery.qrcode-0.11.0.js'> </script>

<div id = "loadingIcon" align = "center">
	<i class="fa fa-refresh fa-spin fa-3x on-left-more on-right-more"></i>
	<div id = "pb" class="progress-bar" data-role="progress-bar" data-value="0" data-color="bg-green"></div>
	<div>
		<span id = "stepnum"><?php echo _("Загрузка"); ?></span>
	</div>
</div>

<div style="background-color:white; position: absolute; display:none; height:100%;width:100%; top: 0px;" class = 'multiOpenAccordion loadwait'>
	
<?php







function get_info_qr($qr, $info, $title) {
	$send = "
	<h3><a href='#'>$title</a></h3> 
	<div class = 'inf'>
		<table>
			<tr>
				<td align = 'center'>
					<p class = 'qrcode' style = 'display:none'> $qr </p>
					<div id = 'qr'> </div>
				</td>
				<td align = 'center'>
				<h3>$info </h3>
				</td>
			</tr>
		</table>
	</div>";
	return $send;
}


$grades = get_qr_students($con);
foreach ($grades as $key => $grade) {
    echo "<h3><a href='#'>$key</a></h3>";
	echo "<div class = 'multiOpenAccordion stu'>";
	for ($student = 0; $student < count($grade); $student++) {
		$this_stu = $grade[$student];
		$books = $this_stu['books'];
		echo "<h3><a href='#'>{$this_stu['i']['info_small']}</a></h3>";
		echo "<div class = 'multiOpenAccordion sinf'>";
		echo get_info_qr($this_stu['i']['qr'], "{$this_stu['i']['info']}", _("Информация"));
		echo "<h3><a href='#'>"._("Книги")."</a></h3>";
		echo "<div class = 'multiOpenAccordion book sinf'>";
		for ($book = 0; $book < count($books); $book++) {
			$this_book = $books[$book];
			echo get_info_qr($this_book['qr'], $this_book['info'], $this_book['info_small'], 'sinf');
		}
		echo "
		</div>
		</div>";		
	}	
	echo "</div>";	
}




?>
	
</div>

<script>
	function pbchange(val) {
		var pb = $("#pb").progressbar();
		pb.progressbar("value", val)
	}
	
	function qr_code_img() {
		var w = 100;
		var h = 100;
		var qrs =  document.getElementsByClassName("qrcode");
		for (i = 0; i < qrs.length; i++) {
			pbchange(i * 100 / qrs.length);
			console.log(i);
			var textel = qrs[i];
			var text = $(textel).text();
			console.log(text);
			var qrel = $(textel).parent().children('#qr');
			qrel.empty("");
			$(qrel).qrcode({
				"width": w,
				"height": h,
				"color": "#3a3",
				"text": text
			});
		}		
	}
	
	function loading(status) {
		if (status == "end")  {
			$('#loadingIcon').hide();
			$('.loadwait').show();			
		}				
	}
	
	function steps(i) {
		$("#stepnum").html(i);
	}
	
	var show = 0;
	function toggle_all(selel, btn) {
		if (show) {
			$(selel).multiOpenAccordion({active:"none"});
			$(btn ).removeClass( "success" ).addClass( "danger" );
			show = (show + 1) % 2;
		} else {
			$(selel).multiOpenAccordion({active:"all"});
			$(btn ).removeClass( "danger" ).addClass( "success" );
			show = (show + 1) % 2;
		}
		return 1;
	}
	loading("begin");
	steps("<?php echo _("Создание QR"); ?>");
	qr_code_img();
	steps("<?php echo _("Готово"); ?>");
	loading("end");
	
</script>

<?php require_once( "../../../stuff/footer.php") ?>