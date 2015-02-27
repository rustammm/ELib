<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title id = 'title'> ELib </title>
<style>


div.menu{
	background: white;
}
.fixed{
	position:fixed;
}

.vcenter {
   display: table-cell;
   vertical-align: middle;
}
.spining:hover{
  -webkit-animation:spin 4s linear infinite;
    -moz-animation:spin 4s linear infinite;
    animation:spin 4s linear infinite;
}
@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
</style>
<script>
found_tables = 0;
function reTitle(title){
	title_ = document.getElementById('title').innerHTML += title;
}	
function showit(id_name){
	item = document.getElementById(id_name);
	if(item.style.display == 'none'){
		item.style.display = 'block';
	}else{
		item.style.display = 'none';
	}
}

function tr_display(now){
	now.style.display = 'table-row';
}
function tr_undisplay(now){
	now.style.display = 'none';
}
function mes_display(class_name){
	items =  document.getElementsByClassName(class_name);
	for (i = 0; i < items.length; i++){
		tr_display(items[i]);
	}
}
function unmes_display(class_name){
	items =  document.getElementsByClassName(class_name);
	for (i = 0; i < items.length; i++){
		tr_undisplay(items[i]);
	}
}

function re_show(){
	item =  document.getElementsByClassName('settings');
	//alert(items.length);
	for (mes = 0; mes < item.length; mes++){
		if(item[mes].checked){
			mes_display(item[mes].value);
		}else{
			unmes_display(item[mes].value);
		}
	}
}
function table_class(){
	tables = document.getElementsByTagName('TABLE');
	for(i = 0; i < tables.length; i++){
		tables[i].style.width = 'inherit';
		tables[i].style.textAlign = 'center';
		tables[i].border = '0';
		found_tables++;
	
	}
}
</script>

<!-- DATEPICKER  -->

<script src='http://code.jquery.com/jquery-1.9.1.js'></script>
<script src='http://code.jquery.com/ui/1.10.4/jquery-ui.js'></script>
<link rel='stylesheet' href='http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css'>
<?php
	echo "
<!-- Notifications  -->
<link rel='stylesheet' href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>
<link rel='stylesheet' href='$http_adress/stuff/style/notification_box.css'>
<!-- Metro -->	
	<!-- CSS -->
<link rel='stylesheet' href='$http_adress/stuff/style/metro/docs/css/metro-bootstrap.css'>
<link rel='stylesheet' href='$http_adress/stuff/style/metro/docs/css/iconFont.css'>
	<!-- JS -->
<script src='$http_adress/stuff/style/metro/docs/js/jquery/jquery.min.js'></script>
<script src='$http_adress/stuff/style/metro/docs/js/jquery/jquery.widget.min.js'></script>
<script src='$http_adress/stuff/style/metro/docs/js/metro.min.js'></script>
<script src='$http_adress/stuff/style/metro/docs/js/metro/metro-calendar.js'></script>	
<script src='$http_adress/stuff/style/metro/docs/js/metro/metro-datepicker.js'></script>	
<script src='$http_adress/stuff/style/notify/notify.js'></script>


<!-- dataTable JS  -->
<script src='$http_adress/stuff/style/metro/docs/js/jquery/jquery.dataTables.js'></script>
<link rel='stylesheet' href='http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css'>

";
?>
<script>
$(document).ready(function() 
    { 
		table_class();
		$('.sortable').dataTable();
    } 
);
</script>

</head>
<body style = 'background: #E7E6FA' class = 'metro container'>
