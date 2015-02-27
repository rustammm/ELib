<?php
    $newLang = $_GET["locale"];
    $prevPage = $_GET["prev"];
    setcookie("elibLocale", $newLang, 0, "/");
    header("Location: $prevPage");
?>