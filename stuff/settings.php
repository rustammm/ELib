<?php
	/* GENERAL */
	$http_adress = ""; // E.g. http://elibonline.com
	$site_name = "
	<center>
	<h1>
		<a class = 'title' href = '$http_adress'>ELib</a>
	</h1>
	</center>
	";		// Password for Super Admin Page (hoster)	
	$super_password = "";
	/* FTP */		// FTP server address (e.g. localhost), username, password	// Not required	
	$elib_ftp_server = "";
	$elib_ftp_username = "";
	$elib_ftp_password = "";
	/* MYSQL DATA */
	$database_name = "";
	$mysql_server = "";
	$mysql_username = "";
	$mysql_password  = "";

    /* Localization */	// Absolute Path to Localization ( "stuff/locale" ) that is in ELib	
    $localeAbsolutePath = "/var/www/html/stuff/locale";
    $defaultLanguage = "ru_RU";
    $availableLanguages = array("ru_RU", "tt_RU", "en_GB");
    $availableLanguagesTitles = array("Русский", "Татарча", "English");

    /*
    Languages are English(en_GB), Russian(ru_RU), Tatar(tt_RU)
     */
    require_once("lcl.php");

	/* DEBUG & ERRORS */		// If $debug_show is true it will output debug output that was called with debug() function in "stuff/functions.php"
	$debug_show = true;
	// If you want more information about errors, set $full_errors true	// NOTE: Other users also will see full errors if enabled		$full_errors = true;
	$DEBUG_OUTPUT = "";
	if($debug_show){
		// Report simple running errors		// You may change them
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
	}
?>
