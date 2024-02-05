<?php
function getPost($id){
    
    if(isset($_POST["sel"])){
        // prec response
        // if(!isset($_SESSION["risposte"])) $_SESSION["risposte"] = [];
        
        $_SESSION["risposte"] [$id] = $_POST["sel"];
    }
}

function SetCookieTheme($val){
    setcookie("theme", $val, time() + (86400), "/"); // 86400 = 1 day
}

function getCookieTheme() {
    if(!isset($_COOKIE["theme"])){
        // default theme: dark
        SetCookieTheme("dark");
    }
    return $_COOKIE["theme"];
}

?>