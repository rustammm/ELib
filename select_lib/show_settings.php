<?php
	require_once("config.php");
	permission("hoster");
	$all_settings_string = "
	<h1 class = 'header'>
		"._("Информация")."
	</h1>
	<table class='dataTable display cell-border sortable'>
		<tr>
			<td>
				<b>"._("GENERAL")."</b>
			</td>
		</tr>
		<tr>
			<td>
				"._("HTTP Адрес")."
			</td>
			<td>
				$http_adress
			</td>
		</tr>
		<tr>
			<td>
				"._("Название сайта")."
			</td>
			<td>
				$site_name
			</td>
		</tr>
		<tr>
			<td>
				<b>"._("FTP")."</b>
			</td>
		</tr>
		<tr>
			<td>
				"._("FTP Host")."
			</td>
			<td>
				$elib_ftp_server;
			</td>
		</tr>
		
		<tr>
			<td>
				"._("FTP User Name")."
			</td>
			<td>
				$elib_ftp_username
			</td>
		</tr>
		<tr>
			<td>
				"._("FTP Password")."
			</td>
			<td>
				$elib_ftp_password
			</td>
		</tr>
		<tr>
			<td>
				<b>"._("MySQL")."</b>
			</td>
		</tr>
		<tr>
			<td>
				"._("MySQL Host")."
			</td>
			<td>
				$mysql_server
			</td>
		</tr>
		
		<tr>
			<td>
				"._("MySQL Username")."
			</td>
			<td>
				$mysql_username
			</td>
		</tr>
		<tr>
			<td>
				"._("MySQL Password")."
			</td>
			<td>
				$mysql_password
			</td>
		</tr>
	
	</table>
	";
	echo "<center>$all_settings_string</center>";

?>
<?php
	require_once("../stuff/footer.php");
?>
