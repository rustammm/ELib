<?php
require_once('config.php');
permission("hoster");
$url = $_GET['url'];
if (is_dir($url)){
	echo "<center class = 'header'>"._("Папка")."<br></center>";
}else{
	$size = filesize($url);
	$df = "D d M Y g:i A";
	$atime = date($df,fileatime($url));
	$mtime = date($df,filemtime($url));
	$ctime = date($df,filectime($url));
	echo "<table class='dataTable display cell-border sortable' border>";
	echo "
    <tr>
    <td>"._("Размер")."</td>
    <td>$size "._("байт")."</td>
    </tr>
	<tr>
	<td>"._("Посещён")." </td>
	<td> $atime </td>
	<tr>
	<tr>
	<td>"._("Модифицирован")."</td>
	<td> $mtime </td>
	<tr>
	<tr>
	<td>"._("Изменён")." </td>
	<td> $ctime </td>
	<tr>
	";

	echo "</table>";
}

?>
<center>
<form method = "post" class = 'span4'>
<input data-transform="input-control" type = "submit" name = "del" value = "Удалить" class = 'danger'>
</form>
</center>
<?php
	if($_POST['del']){
		if($_GET['type'] == "file"){
		unlink($_GET['url']);
			success( _("Удалён"));
		
		}
		if($_GET['type'] == "dir"){
		rmdir($_GET['url']);
			success( _("Удалён"));
		
		}
	}
	require_once("../../stuff/footer.php");
?>