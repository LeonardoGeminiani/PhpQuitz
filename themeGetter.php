<?php
// include_once per evidare errori di dipendenza ciclica
include_once("function.php");

if (isset($_POST["tema"])) {
    $THEME = $_POST["tema"];
    SetCookieTheme($_POST["tema"]);
    unset($_POST["tema"]);
} else {
    $THEME = getCookieTheme();
}
?>