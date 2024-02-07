<?php
function getPost($id)
{
    if (isset($_POST["sel"])) {
        // prec response

        $_SESSION["risposte"][$id] = $_POST["sel"];
    }
}

function SetCookieTheme($val)
{
    setcookie("theme", $val, time() + (86400), "/"); // 86400 = 1 day
}

function getCookieTheme()
{
    // default theme: light
    $defaultTheme = "light";

    if (!isset($_COOKIE["theme"])) {
        SetCookieTheme($defaultTheme);
    }
    return $_COOKIE["theme"] ?? $defaultTheme;
}

?>