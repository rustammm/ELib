<?php
require_once("config.php");
permission("hoster");

function  direct($dire){
	$directory =  scandir($dire);
	$directory = array_diff($directory, array('.', '..'));
	foreach ($directory as $i){
		if(is_dir("$dire/$i")){
			echo "<i class = 'fa fa-folder-open'></i> <a class = 'subheader' href = 'dir2.php?url=$dire/$i' >$i</a>.....<a href = 'menus.php?url=$dire/$i&type=dir'> <i class = 'fa fa-gear spining fa-2x'></i></a><br>";
			$url = "$dire/$i";
		}else{
			echo "<i class = 'fa fa-file-text-o'></i><a class = 'subheader' href = '$dire/$i' > $i </a> <a href = 'menus.php?url=$dire/$i&type=file' ><i class = 'fa fa-gear spining fa-2x'></i></a> <br> ";
		}
	}
	
}
function p_url($urli){
	for($i = strlen($urli) - 1; $i >= 0; $i--){
		if($urli[$i] == '/'){
			return substr($urli, 0, $i);
		}	
	}
	return false;
}
	
	$home =  "../..";
	$check_url = p_url($_GET['url']);
if(!isset($_GET['url']) || $_GET['url'] == $home){
	$url_name = $home;
}else{
	$url_name = $_GET['url'];
	$up_url = p_url($url_name);
	echo "<a href = 'dir2.php?url=$up_url' > <i class = 'fa fa-arrow-circle-o-up fa-2x'></i> "._("Вверх")." </a><br><br>";
}
echo "
<a href = 'upload.php?path=$url_name'><button data-hint= '"._("Загрузить")."' class = 'primary'><i class = 'fa fa-upload fa-2x' ></i></button></a><br><br>
";
direct($url_name);
require_once("../../stuff/footer.php");
?>