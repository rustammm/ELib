<?php
/* Localization */
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

/* Setting Language */


if ($_COOKIE["elibLocale"] == "") {
    $_COOKIE["elibLocale"] = $defaultLanguage;
}
$setLang = $_COOKIE["elibLocale"];
$domain = "elib";
putenv("LANG=".$setLang);
setlocale(LC_ALL, $setLang);
bindtextdomain($domain, $localeAbsolutePath);
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);
/* Creating Links To Languages */

$langLink = "
<div class='element place-right'>
        <a class='dropdown-toggle' href='#'>
            <icon class = 'icon-earth'> </icon>
        </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
";
for ($i = 0; $i < count($availableLanguages); $i++) {
    $lang = $availableLanguages[$i];
    $disabled = "";
    if ($lang == $setLang) {
        $disabled = "class = 'disabled' style = '-webkit-filter: blur(1px);'";

    };
    $curPage = curPageURL();
    $img = "<img src = '$http_adress/stuff/localeImg/$lang.jpg' width = '30px' height = '15px' class = 'shadow' style = '-webkit-filter: opacity(0.9);'/>";
    $link = "$http_adress/stuff/selectLocale.php?locale=$lang&prev=$curPage";
    $title = $availableLanguagesTitles[$i];
    $langLink .= "
        <li $disabled><a href='$link'>$img  $title </a></li>
    ";
}
$langLink.= "
       </ul>
 </div>
 <span class='element-divider place-right'></span>
";
?>