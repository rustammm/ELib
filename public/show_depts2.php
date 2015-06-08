<?php
require_once('../stuff/config.php');
permission("main");
?>
<!--<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
-->

<script>
function reNumber(){
	nums = document.getElementsByClassName("number");
	for(var i = 0; i < nums.length; i++){
		nums[i].innerHTML = "" + (i + 1);
	}
}
function Remove_student(i){
	document.getElementById("stu_" + i).style.display = "none";
	document.getElementById("number_" + i).className = "invis_number";
	reNumber();
}
function removeOptions(){
	var i = 0;
	options = document.getElementsByClassName("option");
	while(i != options.length){
		options[i].style.display = "none";
		i = i + 1;
	}
}
</script>
<?php
function show_stu($cnt_depts, $depts_ful, $con){
	arsort($cnt_depts);
	$cnt = 0;
	echo "
	<table class='dataTable display cell-border sortable'>
	<thead>
	<tr>
	<td>
	<b>№</b>
	</td>
	<td>
	<b>"._("Имя")."</b>
	</td>
	<td>
	<b>"._("Фамилия")."</b>
	</td>
	<td>
	<b>"._("Класс")."</b>
	</td>
	<td>
	<b>"._("Долгов")."</b>
	</td>
	<td class = 'option'>
	<b>"._("Опция 1")."</b>
	</td>
	<td class = 'option'>
	<b>"._("Опция 2")."</b>
	</td>
	</tr>
	</thead>
	<tbody>
	";
	foreach ($cnt_depts as $key => $val) {
		$cnt++;
		$row = get_student_data($key, $con);
		echo "
		<tr id = 'stu_{$cnt}'>
		<td id = 'number_{$cnt}' class = 'number'>
		$cnt
		</td>
		<td>
		<a href = '../../public/student.php?id=$key'>{$row['name']}</a>
		</td>
		<td>
		{$row['surname']}
		</td>
		<td>
		{$row['grade']} {$row['letter']}
		</td>
		<td>
		$val
		</td>
		<td class = 'option'>
		<a target = 'blank' href = '../../public/student.php?id=$key&show=1'><button class = 'info'>Подробнее</button</a>
		</td>
		<td class = 'option'>
		<button onclick = 'Remove_student({$cnt})' class = 'danger'>"._("Скрыть ученика")."</button>
		</td>
		</tr>
		";
	}
	echo "</table>";
}
function set_depts($from, $to, $con){
	$date = new DateTime();
	$from = date_create_from_format('m/d/Y' ,$from);
	$to = date_create_from_format('m/d/Y' ,$to);
	$from = date_timestamp_get($from);
	$to = date_timestamp_get($to);
//	echo "Log: from - $from , to - $to<br>";
	$cnt = 0;
	$res = sql_select($con, "books", "", "", false, "ORDER BY name");
	if(!$res){
		error(_("Ошибка"));
		elibDie();
	}
	while($row = $res->fetch_assoc()){
		$date = strtotime($row['date_taken']);
		if($date < $from || $date > $to) continue;
		$stu = $row['student'];
		$stu = "$stu";
		if($stu == '0')continue;
		$depts_ful["$stu"][] = "
		<td>
		<a href = '../../public/book.php?s1={$row['serial1']}'>{$row['name']}</a>
		</td>
		<td>
		{$row['serial1']}
		</td>
		<td>
		{$row['serial2']}
		</td>
		<td>
		{$row['date_taken']}
		</td>
		<td>
		{$row['price']}
		</td>
		";
		if(!isset($cnt_depts["$stu"])){
			$cnt_depts["$stu"] = 0;
		}
		$cnt_depts["$stu"]++;
		$cnt++;
	}
	if($cnt == 0){
		success(_("Долгов нет"));
		return;
	}
	show_stu($cnt_depts, $depts_ful, $con);	
	echo "</tbody></table>";
}

function eval_date($prefix){
	$date = $_POST[$prefix];
        return $date;
}

if($_POST['sub']){
//	echo $date->format('Y-m-d');
//	echo "\n  Time<br>";
	$from = eval_date("from");
	$to = eval_date("to");
	echo "
	<h1>
	"._("Долги")."
	</h1>
	<center><h3>"._("Книги взятые в промежутке между")."<br> $from - $to </h3>
	"._("(Месяц, День, Год)")."
	</center><br>
	
	";
	echo '
	<button class = "option" onclick = "removeOptions()">'._("Скрыть Опции").'</button><br>
	';
	set_depts($from , $to, $con);
}


?>
<script>
reTitle("<?php echo _("->Долги"); ?>");
</script>
<?php
	require_once('../stuff/footer.php');
?>