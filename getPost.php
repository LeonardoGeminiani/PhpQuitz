<?php
function getPost($id){
    
    if(isset($_POST["sel"])){
        // prec response
        // if(!isset($_SESSION["risposte"])) $_SESSION["risposte"] = [];
        
        $_SESSION["risposte"] [$id] = $_POST["sel"];
    }
}

?>